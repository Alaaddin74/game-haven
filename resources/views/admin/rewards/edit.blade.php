@extends('admin.dashboard')

@section('title', 'Edit Reward')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Edit Reward</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.rewards.update', $reward->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold">Nama Reward</label>
            <input type="text" name="name" value="{{ $reward->name }}" class="w-full border px-4 py-2 rounded" required>
        </div>

        <div>
            <label class="block font-semibold">Poin yang Dibutuhkan</label>
            <input type="number" name="points_required" value="{{ $reward->points_required }}" class="w-full border px-4 py-2 rounded" required>
        </div>

        <div>
            <label class="block font-semibold">Jumlah Stok</label>
            <input type="number" name="stock_quantity" value="{{ $reward->stock_quantity }}" class="w-full border px-4 py-2 rounded" required>
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Update</button>
        <a href="{{ route('admin.rewards.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>
@endsection
