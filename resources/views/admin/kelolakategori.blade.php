@extends('admin.dashboard')

@section('title', 'Kelola Kategori')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Daftar Kategori</h2>
    <a href="{{ route('admin.categories.create') }}" class="mb-4 inline-block bg-indigo-600 text-white px-4 py-2 rounded">+ Tambah Kategori</a>

    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2 px-4 border">ID</th>
                <th class="py-2 px-4 border">Nama</th>
                <th class="py-2 px-4 border">Deskripsi</th>
                <th class="py-2 px-4 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr class="hover:bg-gray-100">
                <td class="py-2 px-4 border">{{ $category->id }}</td>
                <td class="py-2 px-4 border">{{ $category->name }}</td>
                <td class="py-2 px-4 border">{{ $category->description }}</td>
                <td class="py-2 px-4 border">
                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-blue-500 hover:underline">Edit</a>
                    <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}" class="inline">
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
