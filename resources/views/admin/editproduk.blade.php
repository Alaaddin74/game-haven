{{-- resources/views/admin/products/editproduk.blade.php --}}
@extends('admin.dashboard')

@section('title', 'Edit Produk')
@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Edit Produk</h2>
    <form method="POST" action="{{ route('admin.products.update', $product->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block mb-1">Nama Produk</label>
            <input type="text" name="name" value="{{ $product->name }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Deskripsi</label>
            <textarea name="description" class="w-full border rounded px-3 py-2">{{ $product->description }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Kategori</label>
            <select name="category_id" class="w-full border rounded px-3 py-2" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Harga</label>
            <input type="number" name="price" value="{{ $product->price }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Stok</label>
            <input type="number" name="stock" value="{{ $product->stock }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Image URL</label>
            <input type="url" name="image_url" value="{{ $product->image_url }}" class="w-full border rounded px-3 py-2">
        </div>
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection