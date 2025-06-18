@extends('admin.dashboard')

@section('title', 'Tambah Reward')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Tambah Reward</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.rewards.store') }}"
          method="POST"
          enctype="multipart/form-data"  {{-- penting --}}
          class="space-y-4">
        @csrf

        <div>
            <label class="block font-semibold">Nama Reward</label>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="w-full border px-4 py-2 rounded" required>
        </div>

        <div>
            <label class="block font-semibold">Poin yang Dibutuhkan</label>
            <input type="number" name="points_required" value="{{ old('points_required') }}"
                   class="w-full border px-4 py-2 rounded" required>
        </div>

        <div>
            <label class="block font-semibold">Jumlah Stok</label>
            <input type="number" name="stock_quantity" value="{{ old('stock_quantity') }}"
                   class="w-full border px-4 py-2 rounded" required>
        </div>

        <div>
            <label class="block font-semibold">Deskripsi</label>
            <textarea name="description"
                      class="w-full border px-4 py-2 rounded"
                      rows="3">{{ old('description') }}</textarea>
        </div>

        <div>
            <label class="block font-semibold">Gambar Reward</label>
            <input type="file" name="image" accept="image/*"
                   class="w-full border px-4 py-2 rounded">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('admin.rewards.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>
@endsection
