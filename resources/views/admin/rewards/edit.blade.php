@extends('admin.dashboard')

@section('title', 'Edit Reward')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Edit Reward</h2>

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

    <form action="{{ route('admin.rewards.update', $reward->id) }}" method="POST" enctype="multipart/form-data"> {{-- penting untuk upload --}}
        @csrf
        @method('PUT')

        {{-- Nama Reward --}}
        <div class="mb-4">
            <label class="block mb-1">Nama Reward</label>
            <input type="text"
                   name="name"
                   value="{{ old('name', $reward->name) }}"
                   class="w-full border rounded px-3 py-2 @error('name') border-red-500 @enderror"
                   required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Poin yang Dibutuhkan --}}
        <div class="mb-4">
            <label class="block mb-1">Poin yang Dibutuhkan</label>
            <input type="number"
                   name="points_required"
                   value="{{ old('points_required', $reward->points_required) }}"
                   class="w-full border rounded px-3 py-2 @error('points_required') border-red-500 @enderror"
                   required>
            @error('points_required')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Jumlah Stok --}}
        <div class="mb-4">
            <label class="block mb-1">Jumlah Stok</label>
            <input type="number"
                   name="stock_quantity"
                   value="{{ old('stock_quantity', $reward->stock_quantity) }}"
                   class="w-full border rounded px-3 py-2 @error('stock_quantity') border-red-500 @enderror"
                   required>
            @error('stock_quantity')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Deskripsi --}}
        <div class="mb-4">
            <label class="block mb-1">Deskripsi</label>
            <textarea name="description"
                      class="w-full border rounded px-3 py-2 @error('description') border-red-500 @enderror"
                      rows="3">{{ old('description', $reward->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Gambar Reward --}}
    <div class="mb-4">
        <label class="block mb-1">Gambar Reward</label>
        @if ($reward->image_url)
            <img src="{{ asset('storage/' . $reward->image_url) }}"
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
