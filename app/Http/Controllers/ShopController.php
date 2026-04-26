<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::latest('id')->paginate(9);
        return view('shop', compact('products'));
    }

    public function detail(Product $product)
    {
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->take(8)
            ->get();
        return view('shop-detail', compact('product', 'relatedProducts'));
    }
}
