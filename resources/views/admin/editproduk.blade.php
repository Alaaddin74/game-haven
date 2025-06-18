@extends('admin.dashboard')

@section('title', 'Edit Produk')
@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Edit Produk</h2>

    {{-- Tampilkan semua error validasi --}}
    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Nama --}}
        <div class="mb-4">
            <label class="block mb-1">Nama Produk</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}"
                   class="w-full border rounded px-3 py-2 @error('name') border-red-500 @enderror" required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Platform --}}
        <div class="mb-4">
            <label class="block mb-1">Platform</label>
            <input type="text" name="platform" value="{{ old('platform', $product->platform) }}"
                   class="w-full border rounded px-3 py-2 @error('platform') border-red-500 @enderror">
            @error('platform')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Kategori --}}
        <div class="mb-4">
            <label class="block mb-1">Kategori</label>
            <select name="category_id" class="w-full border rounded px-3 py-2 @error('category_id') border-red-500 @enderror" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Harga --}}
        <div class="mb-4">
            <label class="block mb-1">Harga</label>
            <input type="number" name="price" value="{{ old('price', $product->price) }}"
                   class="w-full border rounded px-3 py-2 @error('price') border-red-500 @enderror" required>
            @error('price')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Stok --}}
        <div class="mb-4">
            <label class="block mb-1">Stok</label>
            <input type="number" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}"
                   class="w-full border rounded px-3 py-2 @error('stock_quantity') border-red-500 @enderror" required>
            @error('stock_quantity')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Deskripsi --}}
        <div class="mb-4">
            <label class="block mb-1">Deskripsi</label>
            <textarea name="description"
                      class="w-full border rounded px-3 py-2 @error('description') border-red-500 @enderror">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Gambar --}}
        <div class="mb-4">
            <label class="block mb-1">Gambar Produk</label>
            @if ($product->image_url)
                <img src="{{ asset('storage/'.$product->image_url) }}"
                     alt="Preview"
                     class="mb-2 w-32 h-32 object-cover rounded">
            @endif
            <input type="file" name="image"
                   class="w-full border rounded px-3 py-2 @error('image') border-red-500 @enderror"
                   accept="image/*">
            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">
            Update
        </button>
    </form>
</div>
@endsection
