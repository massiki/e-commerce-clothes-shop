<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (Auth::check()) {
            $wishlist = Wishlist::where('user_id', $user->id)->latest()->get();
        } else {
            $wishlist = collect();
        }
        return view('wishlist', compact('wishlist'));
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
}
