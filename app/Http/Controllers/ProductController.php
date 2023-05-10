<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProduct;
use App\Models\Allergy;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display the product's index.
     */
    public function index(Request $request): View
    {
        $products = Product::orderBy('updated_at', 'desc')->paginate();

        return view('products.index', [
            'products' => $products,
            'allergies' => Allergy::all(),
        ]);
    }

    /**
     * Create a new product.
     */
    public function store(StoreProduct $request)
    {
        $product = Product::create($request->all());

        $this->updateAllergies($product, $request);


        return redirect(route('products.index'));
    }

    /**
     * Display the product's edit form.
     */
    public function edit(Request $request, Product $product): View
    {
        $allergies = Allergy::all();
        $product->allergies = $this->getAllergiesIds($product);

        return view('products.edit', compact('product', 'allergies'));
    }

    /**
     * Update a product.
     */
    public function update(StoreProduct $request, Product $product): RedirectResponse
    {
        $product->update($request->all());
        $product->allergies()->sync($request->allergies);
        $product->allergies = $this->getAllergiesIds($product);

        return redirect()->route('products.index')
            ->with('success', sprintf(__('%s updated successfully'), __('Product')));
    }

    /**
     * Delete a product.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect(route('products.index'));
    }

    private function updateAllergies($product, $request)
    {
        $product->allergies()->sync($request->allergies);
        $product->allergies = $this->getAllergiesIds($product);
    }

    /**
     * @param $product
     * @return array
     */
    private function getAllergiesIds($product): array
    {
        return array_map(function ($allergy) {
            return $allergy['id'];
        }, $product->allergies->toArray());
    }
}
