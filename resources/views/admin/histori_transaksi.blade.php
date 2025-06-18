@extends('admin.dashboard')

@section('title', 'Histori Transaksi')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Histori Transaksi</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full bg-white text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th class="py-2 px-4 border">#</th>
                <th class="py-2 px-4 border">User</th>
                <th class="py-2 px-4 border">Jumlah Item</th>
                <th class="py-2 px-4 border">Total Harga</th>
                <th class="py-2 px-4 border">Status</th>
                <th class="py-2 px-4 border">Metode Bayar</th>
                <th class="py-2 px-4 border">Alamat Kirim</th>
                <th class="py-2 px-4 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr class="hover:bg-gray-50">
                    <td class="py-2 px-4 border">{{ $order->id }}</td>
                    <td class="py-2 px-4 border">{{ $order->user->name }}</td>
                    <td class="py-2 px-4 border">{{ $order->total_amount }}</td>
                    <td class="py-2 px-4 border">Rp {{ number_format($order->total_price,0,',','.') }}</td>
                    <td class="py-2 px-4 border capitalize">{{ $order->status }}</td>
                    <td class="py-2 px-4 border">{{ $order->payment_method ?? '-' }}</td>
                    <td class="py-2 px-4 border">{{ $order->shipping_address ?? '-' }}</td>
                    <td class="py-2 px-4 border">
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                            @csrf
                            <select name="status"
                                    onchange="this.form.submit()"
                                    class="border px-2 py-1 rounded text-sm">
                                <option value="pending"    @selected($order->status == 'pending')>Pending</option>
                                <option value="paid"       @selected($order->status == 'paid')>Paid</option>
                                <option value="cancelled"  @selected($order->status == 'cancelled')>Cancelled</option>
                                <option value="refunded"   @selected($order->status == 'refunded')>Refunded</option>
                            </select>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="py-4 px-4 text-center text-gray-500">
                        Belum ada transaksi.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
