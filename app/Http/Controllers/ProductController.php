<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display the product's index.
     */
    public function index(Request $request): View
    {
        return view('products.index', [
            'products' => Product::paginate(),
        ]);
    }

    /**
     * Create a new product.
     */
    public function store(StoreProduct $request)
    {
        Product::create($request->all());

        return redirect(route('products.index'));
    }

    /**
     * Display the product's edit form.
     */
    public function edit(Request $request, Product $product): View
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update a product.
     */
    public function update(StoreProduct $request, Product $product): View
    {
        $product->update($request->all());

        return view('products.edit', compact('product'));
    }

    /**
     * Delete a product.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect(route('products.index'));
    }
}
