<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|string'
        ]);

        if ($request->search || $request->searh != '') {
            $product = Product::where('name', 'like', '%' . $request->search . '%')->take(5)->get();
        }

        return response()->json(['product' => $product]);
    }
}
