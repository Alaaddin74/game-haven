<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-10 text-white">
        <h1 class="text-2xl font-bold mb-6">🛒 Keranjang Belanja</h1>

            {{-- Notifikasi --}}
    @if(session('success'))
        <div class="bg-green-600 text-white px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($order && $order->items->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Daftar Produk --}}
            <div class="lg:col-span-2 bg-[#1e293b] p-6 rounded-lg shadow">
                <table class="w-full text-white text-sm">
                    <thead class="border-b border-gray-600 text-left">
                        <tr>
                            <th class="py-2">Produk</th>
                            <th class="py-2">Harga</th>
                            <th class="py-2 text-center">Jumlah</th>
                            <th class="py-2">Subtotal</th>
                            <th class="py-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($order->items as $item)
                            @php
                                $subtotal = $item->quantity * $item->price_at_purchase;
                                $total += $subtotal;
                            @endphp
                            <tr class="border-b border-gray-700">
                                <td class="py-4 flex items-center gap-4">
                                    <img src="{{ $item->product->image_url ?? asset('images/placeholder.png') }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded-md">
                                    <span class="font-semibold">{{ $item->product->name }}</span>
                                </td>
                                <td class="py-2">Rp {{ number_format($item->price_at_purchase, 0, ',', '.') }}</td>
                                <td class="py-2 text-center">{{ $item->quantity }}</td>
                                <td class="py-2">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                                <td class="py-2 text-center">
                                    <form method="POST" action="{{ route('order.remove', $item->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-500 hover:text-red-700">
                                            🗑️
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Ringkasan --}}
            <div class="bg-[#1e293b] p-6 rounded-lg shadow text-white">
                <h2 class="text-xl font-bold mb-4">Total Belanja</h2>
                <div class="flex justify-between border-b border-gray-600 py-2">
                    <span>Subtotal</span>
                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between font-semibold text-lg py-4">
                    <span>Total</span>
                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <button class="w-full bg-cyan-600 hover:bg-cyan-700 text-white py-2 px-4 rounded-lg mt-4">
                    Check Out
                </button>
            </div>
        </div>
    @else
        <p class="text-gray-300 text-sm">Keranjang kamu masih kosong.</p>
    @endif
</div>
</x-app-layout>
