@extends('admin.dashboard')

@section('title', 'Kelola Produk')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Daftar Produk</h2>
    <a href="{{ route('admin.products.create') }}" class="mb-4 inline-block bg-indigo-600 text-white px-4 py-2 rounded">+ Tambah Produk</a>

    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2 px-4 border">ID</th>
                <th class="py-2 px-4 border">Nama</th>
                <th class="py-2 px-4 border">Kategori</th>
                <th class="py-2 px-4 border">Harga</th>
                <th class="py-2 px-4 border">Stok</th>
                <th class="py-2 px-4 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr class="hover:bg-gray-100">
                <td class="py-2 px-4 border">{{ $product->id }}</td>
                <td class="py-2 px-4 border">{{ $product->name }}</td>
                <td class="py-2 px-4 border">{{ $product->category->name ?? '-' }}</td>
                <td class="py-2 px-4 border">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                <td class="py-2 px-4 border">{{ $product->stock_quantity }}</td>
                <td class="py-2 px-4 border">
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-500 hover:underline">Edit</a>
                    <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline ml-2">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
