<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.kelolaproduk', compact('products'));

    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.tambahproduk', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:150',
            'platform'       => 'nullable|string|max:100',
            'category_id'    => 'required|exists:categories,id',
            'price'          => 'required|integer|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'description'    => 'nullable|string',
            'image'          => 'required|image|max:2048',
        ]);

        // upload dan simpan ke kolom image_url
        $path = $request->file('image')->store('products', 'public');
        $validated['image_url'] = $path;

        Product::create($validated);

        return redirect()->route('admin.products.index')
                         ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $product    = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.editproduk', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name'           => 'required|string|max:150',
            'platform'       => 'nullable|string|max:100',
            'category_id'    => 'required|exists:categories,id',
            'price'          => 'required|integer|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'description'    => 'nullable|string',
            'image'          => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // hapus lama
            if ($product->image_url && Storage::disk('public')->exists($product->image_url)) {
                Storage::disk('public')->delete($product->image_url);
            }
            $path = $request->file('image')->store('products', 'public');
            $validated['image_url'] = $path;
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')
                         ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image_url && Storage::disk('public')->exists($product->image_url)) {
            Storage::disk('public')->delete($product->image_url);
        }
        $product->delete();

        return redirect()->route('admin.products.index')
                         ->with('success', 'Produk berhasil dihapus.');
    }
}
