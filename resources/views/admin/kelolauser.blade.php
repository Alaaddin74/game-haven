@extends('admin.dashboard')

@section('title', 'Kelola User')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Daftar User</h2>
    <a href="{{ route('admin.users.create') }}" class="mb-4 inline-block bg-indigo-600 text-white px-4 py-2 rounded">+ Tambah User</a>

    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2 px-4 border">ID</th>
                <th class="py-2 px-4 border">Nama</th>
                <th class="py-2 px-4 border">Email</th>
                <th class="py-2 px-4 border">Role</th>
                <th class="py-2 px-4 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr class="hover:bg-gray-100">
                <td class="py-2 px-4 border">{{ $user->id }}</td>
                <td class="py-2 px-4 border">{{ $user->name }}</td>
                <td class="py-2 px-4 border">{{ $user->email }}</td>
                <td class="py-2 px-4 border">{{ $user->role }}</td>
                <td class="py-2 px-4 border">
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-500 hover:underline">Edit</a>
                    <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" class="inline">
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
