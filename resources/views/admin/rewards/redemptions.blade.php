@extends('admin.dashboard')

@section('title', 'Kelola Penukaran Reward')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Daftar Penukaran Reward</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 mb-4 rounded">{{ session('success') }}</div>
    @endif

    <table class="min-w-full bg-white text-sm">
        <thead>
            <tr>
                <th class="py-2 px-4 border">User</th>
                <th class="py-2 px-4 border">Reward</th>
                <th class="py-2 px-4 border">Tanggal</th>
                <th class="py-2 px-4 border">Status</th>
                <th class="py-2 px-4 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($redemptions as $redemption)
                <tr class="hover:bg-gray-100">
                    <td class="py-2 px-4 border">{{ $redemption->user->name }}</td>
                    <td class="py-2 px-4 border">{{ $redemption->reward->name }}</td>
                    <td class="py-2 px-4 border">{{ $redemption->created_at->format('d-m-Y') }}</td>
                    <td class="py-2 px-4 border capitalize">{{ $redemption->status }}</td>
                    <td class="py-2 px-4 border">
                        <form action="{{ route('admin.redemptions.updateStatus', $redemption->id) }}" method="POST">
                            @csrf
                            <select name="status" onchange="this.form.submit()" class="border px-2 py-1 rounded">
                                <option value="pending" @selected($redemption->status == 'pending')>Pending</option>
                                <option value="approved" @selected($redemption->status == 'approved')>Approved</option>
                                <option value="rejected" @selected($redemption->status == 'rejected')>Rejected</option>
                            </select>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
