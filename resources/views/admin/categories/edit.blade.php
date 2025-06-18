@extends('admin.dashboard')
@section('title', 'Edit Kategori')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Edit Kategori</h2>
    <form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block mb-1">Nama</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Deskripsi</label>
            <textarea name="description" class="w-full border rounded px-3 py-2">{{ old('description', $category->description) }}</textarea>
        </div>
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
