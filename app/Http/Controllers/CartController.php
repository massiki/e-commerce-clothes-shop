<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Coupon;
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
}
