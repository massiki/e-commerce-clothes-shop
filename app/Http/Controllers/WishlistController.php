<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (Auth::check()) {
            $wishlists = Wishlist::where('user_id', $user->id)->latest()->get();
        } else {
            $wishlists = collect();
        }
        return view('wishlist', compact('wishlists'));
    }

    public function store(Request $request)
    {
        Wishlist::firstOrCreate([
            'product_id' => $request->productId,
        ], [
            'user_id' => Auth::id(),
            'product_id' => $request->productId,
        ]);

        return redirect()->back();
    }

    public function destroy(Wishlist $wishlist)
    {
        $wishlist->delete();
        return redirect()->back();
    }

    public function destroyAll()
    {
        $user = Auth::user();
        Wishlist::where('user_id', $user->id)->delete();
        return redirect()->back();
    }

    public function move(Request $request)
    {
        $user = Auth::user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);
        $cartItem = $cart->items()->where('product_id', $request->productId)->first();
        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            $cart->items()->create([
                'product_id' => $request->productId,
                'quantity' => 1,
            ]);
        }
        Wishlist::find($request->wishlistId)->delete();
        return redirect()->back();
    }
}
