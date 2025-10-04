<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::latest()->paginate(20);

        if ($request->wantsJson()) {
            return response()->json($products, 200);
        }

        return view('admin.products.products', compact('products'));
    }

    public function create()
    {
        return view('admin.products.add');
    }

    public function store(Request $request)
    {
        $data = $this->validateProduct($request);

        $data['image'] = $this->handleImageUpload($request);

        $product = Product::create($data);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Product created successfully.',
                'product' => $product,
            ], 201);
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->validateProduct($request, $product->id);

        $data['image'] = $this->handleImageUpload($request, $product->image);

        $product->update($data);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Product updated successfully.',
                'product' => $product,
            ], 200);
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated.');
    }

    public function destroy(Request $request, Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Product deleted successfully.',
            ], 200);
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted.');
    }

    // 🔹 Helpers
    private function validateProduct(Request $request, $ignoreId = null)
    {
        $rules = [
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price'       => 'required|numeric|min:0.01',
            'stock'       => 'required|integer|min:0',
            'image'       => ($ignoreId ? 'nullable' : 'required') . '|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ];

        return $request->validate($rules);
    }
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product-details', compact('product'));
    }
    
    private function handleImageUpload(Request $request, $oldImage = null)
    {
        if ($request->hasFile('image')) {
            if ($oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
            return $request->file('image')->store('products', 'public');
        }
        return $oldImage;
    }
}
