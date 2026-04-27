<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
