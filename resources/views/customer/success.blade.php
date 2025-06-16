<x-app-layout>
<div class="max-w-7xl mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-white mb-4">Pembayaran Berhasil</h1>
    <p class="text-gray-300 mb-4">Terima kasih telah berbelanja di Game Haven!</p>

    <div class="bg-[#1e293b] p-6 rounded-lg shadow text-white">
        {{-- <h2 class="text-xl font-bold mb-4">Rincian Pesanan</h2>
        <p class="mb-2">ID Pesanan: <span class="font-semibold">{{ $order->id }}</span></p>
        <p class="mb-2">Total Pembayaran: <span class="font-semibold">Rp {{ number_format($order->total, 0, ',', '.') }}</span></p>
        <p class="mb-4">Status: <span class="font-semibold text-green-500">Berhasil</span></p> --}}

        <a href="{{ route('customer.dashboard') }}" class="inline-block bg-cyan-600 hover:bg-cyan-700 text-white font-semibold py-2 px-4 rounded-lg">
            Kembali ke Dashboard
        </a>
    </div>

</div>
</x-app-layout>
