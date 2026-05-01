<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::inRandomOrder()->take(8)->get();
        $featuredProducts = Product::where('featured', 1)->inRandomOrder()->take(8)->get();
        $saleProducts = Product::whereNotNull('sale_price')->inRandomOrder()->take(8)->get();
        $cheapProducts = Product::where('regular_price', '<', 100000)->inRandomOrder()->take(2)->get();
        $sliders = Slider::latest('id')->get();
        return view('home', compact('categories', 'featuredProducts', 'saleProducts', 'sliders', 'cheapProducts'));
    }
}
