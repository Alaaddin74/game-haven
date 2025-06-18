@extends('admin.dashboard')

@section('title', 'Tambah Produk')
@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Tambah Produk Baru</h2>
    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @csrf

        {{-- Nama --}}
        <div class="mb-4">
            <label class="block mb-1">Nama Produk</label>
            <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
        </div>

        {{-- Platform --}}
        <div class="mb-4">
            <label class="block mb-1">Platform</label>
            <input type="text" name="platform" class="w-full border rounded px-3 py-2">
        </div>

        {{-- Kategori --}}
        <div class="mb-4">
            <label class="block mb-1">Kategori</label>
            <select name="category_id" class="w-full border rounded px-3 py-2" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Harga --}}
        <div class="mb-4">
            <label class="block mb-1">Harga</label>
            <input type="number" name="price" class="w-full border rounded px-3 py-2" required>
        </div>

        {{-- Stok --}}
        <div class="mb-4">
            <label class="block mb-1">Stok</label>
            <input type="number" name="stock_quantity" class="w-full border rounded px-3 py-2" required>
        </div>

        {{-- Deskripsi --}}
        <div class="mb-4">
            <label class="block mb-1">Deskripsi</label>
            <textarea name="description" class="w-full border rounded px-3 py-2"></textarea>
        </div>

        {{-- Gambar --}}
        <div class="mb-4">
            <label class="block mb-1">Gambar Produk</label>
            <input type="file" name="image" accept="image/*" class="w-full border rounded px-3 py-2" required>
        </div>

        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
