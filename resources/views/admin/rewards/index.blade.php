@extends('admin.dashboard')

@section('title', 'Kelola Reward')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Daftar Reward</h2>

    {{-- Flash message sukses --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tombol tambah reward --}}
    <a href="{{ route('admin.rewards.create') }}" class="mb-4 inline-block bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600">
        + Tambah Reward
    </a>

    {{-- Tabel daftar reward --}}
    <table class="min-w-full bg-white text-sm">
        <thead>
            <tr>
                <th class="py-2 px-4 border">Nama</th>
                <th class="py-2 px-4 border">Poin Dibutuhkan</th>
                <th class="py-2 px-4 border">Stok</th>
                <th class="py-2 px-4 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rewards as $reward)
                <tr class="hover:bg-gray-100">
                    <td class="py-2 px-4 border">{{ $reward->name }}</td>
                    <td class="py-2 px-4 border">{{ $reward->points_required }}</td>
                    <td class="py-2 px-4 border">{{ $reward->stock_quantity }}</td>
                    <td class="py-2 px-4 border space-x-2">
                        <a href="{{ route('admin.rewards.edit', $reward->id) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('admin.rewards.destroy', $reward->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus reward ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            @if ($rewards->isEmpty())
                <tr>
                    <td colspan="4" class="py-4 px-4 text-center text-gray-500">Belum ada reward ditambahkan.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
