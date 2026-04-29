<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cart = null;
        if (Auth::check()) {
            $currentUser = Auth::user()->id;
            $cart = Cart::where('user_id', $currentUser)->latest('id')->first();
            $cartItems = $cart ? $cart->items : collect();
        } else {
            $cartItems = collect();
        }

        $this->recalculateCoupon();
        return view('cart', compact('cart', 'cartItems'));
    }

    public function add(Request $request)
    {
        $user = Auth::user();

        // Cari cart user, jika belum ada maka buat baru
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        // Cek apakah product sudah ada di cart
        $cartItem = $cart->items()->where('product_id', $request->productId)->first();
        if ($cartItem) {
            // Jika sudah ada → tambah quantity
            $cartItem->increment('quantity');
        } else {
            // Jika belum ada → create baru
            $cart->items()->create([
                'product_id' => $request->productId,
                'quantity' => 1,
            ]);
        }
        $this->recalculateCoupon();
        return redirect()->back();
    }

    public function increase(Request $request)
    {
        $user = Auth::user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        $cartItem = $cart->items()->where('product_id', $request->productId)->first();
        if ($cartItem) {
            $cartItem->increment('quantity');
        }

        $this->recalculateCoupon();
        return redirect()->back();
    }

    public function decrease(Request $request)
    {
        $user = Auth::user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        $cartItem = $cart->items()->where('product_id', $request->productId)->first();
        if ($cartItem && $cartItem->quantity > 1) {
            $cartItem->decrement('quantity');
        } elseif ($cartItem && $cartItem->quantity == 1) {
            $cartItem->delete();
        }

        $this->recalculateCoupon();
        return redirect()->back();
    }

    public function destroy(CartItem $cartItem)
    {
        $cartItem->delete();
        return redirect()->back();
    }

    public function destroyAll()
    {
        $user = Auth::user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);
        $cart->items()->delete();
        return redirect()->back();
    }

    public function apply(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required'
        ]);

        // get cart current user
        $user = Auth::user();
        $cart = Cart::with(['items.product'])->where('user_id', $user->id)->first();
        if (!$cart || $cart->items->isEmpty()) return back()->with('error', 'Your cart is empty.');

        // cek coupon valid coupon
        $coupon = Coupon::where('code', $request->coupon_code)->where(function ($query) {
            $query->whereNull('expiry_date')->orWhere('expiry_date', '>=', now());
        })->first();
        if (!$coupon) return back()->with('error', 'Coupon is invalid or expired.');

        $cartTotal = 0;
        foreach ($cart->items as $item) {
            $price = $item->product->sale_price ?? $item->product->regular_price;
            $cartTotal += ($price * $item->quantity);
        }

        if ($cartTotal < $coupon->cart_value) return back()->with('error', 'Minimum cart value for this coupon is Rp ' . number_format($coupon->cart_value, 0, ',', '.'));

        $this->setCouponSession($coupon, $cartTotal);

        return back()->with('success', 'Coupon applied successfully!');
    }

    public function remove()
    {
        session()->forget('coupon');
        return back();
    }

    private function recalculateCoupon()
    {
        if (!session()->has('coupon')) {
            return;
        }
        $user = Auth::user();
        $cart = Cart::with(['items.product'])
            ->where('user_id', $user->id)
            ->first();
        if (!$cart || $cart->items->isEmpty()) {
            session()->forget('coupon');
            return;
        }

        $cartTotal = 0;
        foreach ($cart->items as $item) {
            $price = $item->product->sale_price ?? $item->product->regular_price;
            $cartTotal += ($price * $item->quantity);
        }

        $couponCode = session('coupon.code');
        $coupon = Coupon::where('code', $couponCode)
            ->where(function ($query) {
                $query->whereNull('expiry_date')
                    ->orWhere('expiry_date', '>=', now());
            })
            ->first();

        if (!$coupon) {
            session()->forget('coupon');
            return;
        }

        if ($cartTotal < $coupon->cart_value) {
            session()->forget('coupon');
            return;
        }

        $this->setCouponSession($coupon, $cartTotal);
    }

    private function setCouponSession($coupon, $cartTotal)
    {
        if ($coupon->type === 'fixed') {
            $discount = $coupon->value;
        } else {
            $discount = ($cartTotal * $coupon->value) / 100;
        }
        $finalTotal = max($cartTotal - $discount, 0);
        session()->put('coupon', [
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => $coupon->value,
            'discount' => $discount,
            'cart_total' => $cartTotal,
            'final_total' => $finalTotal,
        ]);
    }

    public function checkout()
    {
        $user = Auth::user()->id;
        $cart = Cart::where('user_id', $user)->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Cart is empty.');
        }

        $address = Address::where('user_id', $user)->first();

        return view('checkout', compact('cart', 'address'));
    }

    public function order(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric|digits_between:1,15',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'subdistrict' => 'required|string|max:255',
            'postal_code' => 'required|numeric|digits:5',
            'full_address' => 'required|string|max:500',
            'address_note' => 'nullable|string|max:500',
            'checkout_payment_method' => 'required',
        ]);

        // save address
        $userId = Auth::user()->id;
        Address::updateOrCreate(
            ['user_id' => $userId],
            [
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'province' => $validated['province'],
                'city' => $validated['city'],
                'district' => $validated['district'],
                'subdistrict' => $validated['subdistrict'],
                'postal_code' => $validated['postal_code'],
                'full_address' => $validated['full_address'],
                'address_note' => $validated['address_note'] ?? null,
            ]
        );


        if (in_array($validated['checkout_payment_method'], ['e_wallet', 'bank_transfer', 'qris', 'virtual_account'])) {
            return 'Fitur belum tersedia';
        }

        if ($validated['checkout_payment_method'] == 'cod') {
            $cart = Cart::where('user_id', $userId)->first();

            if (!$cart || $cart->items->isEmpty()) {
                return back()->withErrors(['error' => 'Cart is empty.']);
            }

            // Get address again to ensure up-to-date
            $address = Address::where('user_id', $userId)->first();

            // Calculate total
            $subTotal = 0;
            foreach ($cart->items as $item) {
                $price = $item->product->sale_price ?? $item->product->regular_price;
                $subTotal += $price * $item->quantity;
            }

            $discount = session()->has('coupon') ? session('coupon.discount') : 0;
            $orderTotal = $subTotal - $discount;
            if ($orderTotal < 0) $orderTotal = 0;

            // Create the order
            $order = Order::create([
                'user_id'         => $userId,
                'subtotal'        => $subTotal,
                'discount'        => $discount,
                'tax'             => 0,
                'shipping_cost'   => 0,
                'total'           => $orderTotal,
                'name'            => $address->name ?? $validated['name'],
                'phone'           => $address->phone ?? $validated['phone'],
                'province'        => $address->province ?? $validated['province'],
                'city'            => $address->city ?? $validated['city'],
                'district'        => $address->district ?? $validated['district'],
                'subdistrict'     => $address->subdistrict ?? $validated['subdistrict'],
                'postal_code'     => $address->postal_code ?? $validated['postal_code'],
                'full_address'    => $address->full_address ?? $validated['full_address'],
                'address_note'    => $address->address_note ?? $validated['address_note'] ?? null,
                'status'          => 'ordered',
            ]);

            // Create order items
            foreach ($cart->items as $item) {
                OrderItem::create([
                    'product_id' => $item->product_id,
                    'order_id'   => $order->id,
                    'price'      => $item->product->sale_price ?? $item->product->regular_price,
                    'quantity'   => $item->quantity,
                    'options'    => null,
                ]);
            }

            // Create transaction record
            Transaction::create([
                'user_id'        => $userId,
                'order_id'       => $order->id,
                'mode'           => $validated['checkout_payment_method'],
                'status'         => 'pending',
            ]);

            // Remove cart items after order creation
            $cart->items()->delete();
            $cart->delete();

            // Optionally clear any coupon from session (because order is placed)
            if (session()->has('coupon')) {
                session()->forget('coupon');
            }
        }

        return redirect()->route('user.confirmation', $order->id);
    }

    public function confirmation(Transaction $transaction)
    {
        // dd($transaction);
        return view('order-confirmation', compact('transaction'));
    }
}
