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
                                    <td class="py-2">Rp {{ number_format($item->product->price, 0, ',', '.') }}</td>
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

                {{-- Ringkasan dan Pilihan Pengiriman --}}
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
<form method="POST" action="{{ route('order.checkout') }}" id="checkout-form">
    @csrf
                    {{-- Pilihan Pengiriman --}}
                    <div class="mt-4">
    <label class="block font-semibold mb-2">Metode Pengiriman:</label>
    <div class="space-y-2">
        <label class="flex items-center">
            <input type="radio" name="delivery_method" value="ambil" checked class="mr-2 delivery-option">
            Ambil Langsung
        </label>
        <label class="flex items-center">
            <input type="radio" name="delivery_method" value="antar" class="mr-2 delivery-option">
            Diantar ke Alamat
        </label>
    </div>

    {{-- Input alamat hanya muncul jika pilih "antar" --}}
    <div id="address-section" class="mt-4 hidden">
        <label for="delivery_address" class="block mb-1">Alamat Pengantaran:</label>
        <textarea id="shipping_address" rows="3" class="w-full p-2 rounded bg-gray-800 border border-gray-600 text-white" placeholder="Masukkan alamat lengkap..."></textarea>
        <p id="address-error" class="text-red-500 text-sm mt-1 hidden">Alamat harus diisi jika memilih antar.</p>
    </div>
</div>

                    @if ($order->snap_token)
                        <button id="pay-button" class="w-full bg-cyan-600 hover:bg-cyan-700 text-white py-2 px-4 rounded-lg mt-6">
                            Bayar Sekarang
                        </button>
                    @else
                        <p class="text-red-500 mt-4">❗ Snap token tidak tersedia. Silakan refresh halaman atau tunggu proses sistem.</p>
                    @endif
                </div>

                </form>
            </div>
        @else
            <p class="text-gray-300 text-sm">Keranjang kamu masih kosong.</p>
        @endif
    </div>

    {{-- Script Midtrans --}}
    @if ($order && $order->snap_token)
@section('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY')}}"></script>
<script>
    const deliveryOptions = document.querySelectorAll('.delivery-option');
    const addressSection = document.getElementById('address-section');
    const addressInput = document.getElementById('shipping_address');
    const addressError = document.getElementById('address-error');

    deliveryOptions.forEach(option => {
        option.addEventListener('change', function () {
            if (this.value === 'antar') {
                addressSection.classList.remove('hidden');
            } else {
                addressSection.classList.add('hidden');
                addressInput.value = '';
                addressError.classList.add('hidden');
            }
        });
    });

    document.getElementById('pay-button').onclick = function (e) {
        e.preventDefault();

        const selectedDelivery = document.querySelector('input[name="delivery_method"]:checked').value;
        const address = addressInput.value.trim();

        if (selectedDelivery === 'antar' && address === '') {
            addressError.classList.remove('hidden');
            addressInput.focus();
            return;
        }

        // Kirim delivery_method dan address via AJAX ke backend
        fetch("{{ route('order.saveDeliveryInfo') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                delivery_method: selectedDelivery,
                shipping_address: address
            }),
        })
        .then(response => {
            if (!response.ok) throw new Error('Gagal menyimpan data pengiriman');
            return response.json();
        })
        .then(data => {
            // Setelah sukses simpan, lanjutkan ke Midtrans
            snap.pay('{{ $order->snap_token }}', {
                onSuccess: function (result) {
                    window.location.href = '{{ route('customer.success', $order->id) }}';
                },
                onPending: function (result) {
                    alert("Pembayaran sedang diproses...");
                },
                onError: function (result) {
                    alert("Terjadi kesalahan pada pembayaran.");
                }
            });
        })
        .catch(error => {
            alert("Terjadi kesalahan saat menyimpan alamat pengiriman.");
            console.error(error);
        });
    };
</script>

@endsection

    @endif
</x-app-layout>
