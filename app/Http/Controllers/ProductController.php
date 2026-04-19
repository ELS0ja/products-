<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index(Request $request)
    {
        // Select id so we can generate links in the view, but keep JSON output
        // limited to name and price only.
        $products = Product::orderBy('id', 'desc')->get(['id', 'name', 'price']);

        if ($request->wantsJson()) {
            $payload = $products->map(function ($p) {
                return $p->only(['name', 'price']);
            });

            return response()->json($payload);
        }

        return view('products.index', ['products' => $products]);
    }

    /**
     * Display a single product (name and price only).
     */
    public function show(Request $request, Product $product)
    {
        $data = $product->only(['name', 'price']);

        if ($request->wantsJson()) {
            return response()->json($data);
        }

        return view('products.show', ['product' => $data]);
    }


    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'description' => ['nullable', 'string'],
        ]);


        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $data['slug'] = Str::slug($data['name']) . '-' . substr(md5(uniqid('', true)), 0, 6);

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created.');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted.');
    }
    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        return view('products.edit', ['product' => $product]);
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
        ]);

        if ($request->hasFile('image')) {
            // delete old image if exists
            if ($product->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated.');
    }
}
