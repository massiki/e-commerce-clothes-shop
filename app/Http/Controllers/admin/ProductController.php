<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest('id')->paginate(10);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::latest('id')->get();
        $brands = Brand::latest('id')->get();
        return view('admin.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:255',
            'description' => 'required|string',
            'regular_price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'SKU' => 'required|string|max:255',
            'stock_status' => 'required|in:instock,outofstock',
            'featured' => 'required|boolean',
            'quantity' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpeg,jpg,png,webp|max:1028',
            'images.*' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:1028',
            'category_id' => 'nullable|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
        ]);

        // slug
        $baseSlug = Str::slug($validated['name']);
        $slug = $baseSlug;
        $count = 1;
        while (Product::where('slug', $slug)->exists()) { // Should be Product, not Category
            $slug = $baseSlug . '-' . $count;
            $count++;
        }

        // image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // images (gallery)
        $galleryImagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $galleryImage) {
                $path = $galleryImage->store('product_galleries', 'public');
                $galleryImagePaths[] = $path;
            }
        }

        Product::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'short_description' => $validated['short_description'] ?? null,
            'description' => $validated['description'],
            'regular_price' => $validated['regular_price'],
            'sale_price' => $validated['sale_price'] ?? null,
            'SKU' => $validated['SKU'],
            'stock_status' => $validated['stock_status'],
            'featured' => $validated['featured'],
            'quantity' => $validated['quantity'],
            'image' => $imagePath ?? null,
            'images' => $galleryImagePaths ?? null,
            'category_id' => $validated['category_id'] ?? null,
            'brand_id' => $validated['brand_id'] ?? null,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Products created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::latest('id')->get();
        $brands = Brand::latest('id')->get();
        return view('admin.product.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        if ($product->images) {
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Products created successfully!');
    }
}
