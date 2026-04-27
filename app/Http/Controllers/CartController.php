<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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
}
