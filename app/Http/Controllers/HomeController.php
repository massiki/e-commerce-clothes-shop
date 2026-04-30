<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::inRandomOrder()->take(8)->get();
        $featuredProducts = Product::where('featured', 1)->inRandomOrder()->take(8)->get();
        return view('home', compact('categories', 'featuredProducts'));
    }

    public function brands()
    {
        $brands = Brand::latest('id')->paginate(10);
        return view('admin.brand', compact('brands'));
    }
}
