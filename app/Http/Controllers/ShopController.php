<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        switch ($request->sort) {
            case 'featured':
                $query->where('featured', true);
                break;
            case 'best-selling':
                $query->orderBy('quantity', 'asc');
                break;
            case 'name-asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name-desc':
                $query->orderBy('name', 'desc');
                break;
            case 'price-asc':
                $query->orderByRaw('COALESCE(sale_price, regular_price) ASC');
                break;
            case 'price-desc':
                $query->orderByRaw('COALESCE(sale_price, regular_price) DESC');
                break;
            case 'date-asc':
                $query->orderBy('created_at', 'asc');
                break;
            case 'date-desc':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->latest('id');
                break;
        }

        $products = $query->paginate(9)->withQueryString();

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
