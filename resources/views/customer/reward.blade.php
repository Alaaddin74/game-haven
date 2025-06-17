{{-- resources/views/customer/reward.blade.php --}}
<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-10 text-white">
        {{-- Notifikasi --}}
        @if(session('success'))
            <div class="bg-green-500 text-white px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="bg-red-500 text-white px-4 py-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <h2 class="text-2xl font-bold mb-6">Tukar Poin dengan Reward</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($rewards as $reward)
                <div class="bg-[#1e293b] p-4 rounded-xl shadow hover:shadow-lg transition cursor-pointer"
                     onclick="showDetail({{ $reward->id }})">
                    <div class="w-full aspect-[4/3] bg-gray-800 rounded-md mb-4 overflow-hidden flex items-center justify-center">
                        <img src="{{ asset('images/reward-default.png') }}" alt="Reward Image"
                             class="object-contain w-full h-full">
                    </div>
                    <h2 class="text-base font-semibold truncate">{{ $reward->name }}</h2>
                    <p class="text-sm text-gray-400">Stok: {{ $reward->stock_quantity }}</p>
                    <p class="text-yellow-400 text-sm mt-1">Poin: {{ $reward->points_required }}</p>
                </div>

                {{-- Modal --}}
                <div id="modal-{{ $reward->id }}"
                     class="fixed inset-0 bg-black bg-opacity-70 hidden items-center justify-center z-50">
                    <div class="bg-white rounded-lg w-11/12 md:w-2/5 lg:max-w-md p-6 relative text-gray-800 shadow-lg">
                        <button onclick="hideDetail({{ $reward->id }})"
                                class="absolute top-2 right-3 text-xl font-bold text-gray-500 hover:text-red-500">
                            &times;
                        </button>
                        <img src="{{ asset('images/reward-default.png') }}"
                             alt="{{ $reward->name }}"
                             class="w-full h-48 object-contain rounded mb-4">
                        <h2 class="text-xl font-bold mb-2">{{ $reward->name }}</h2>
                        <p class="mb-2 text-sm">{{ $reward->description }}</p>
                        <p class="mb-1 font-medium text-gray-700">Poin dibutuhkan: <span class="text-yellow-600">{{ $reward->points_required }}</span></p>
                        <p class="mb-4 text-sm text-gray-600">Stok tersedia: {{ $reward->stock_quantity }}</p>

                        <form action="{{ route('rewards.redeem', $reward->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-lg w-full">
                                Tukarkan Poin
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach

            
        </div>

        
{{-- Redeemed Rewards Section --}}
@if($approvedRewards->count() > 0)
    <h2 class="text-2xl font-bold mt-12 mb-6">Reward yang Sudah Ditukar</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($approvedRewards as $redemption)
            <div class="bg-gray-800 p-4 rounded-xl shadow text-white">
                <div class="w-full aspect-[4/3] bg-gray-700 rounded-md mb-4 overflow-hidden flex items-center justify-center">
                    <img src="{{ asset('images/reward-default.png') }}" alt="Reward Image" class="object-contain w-full h-full">
                </div>
                <h2 class="text-base font-semibold truncate">{{ $redemption->reward->name }}</h2>
                <p class="text-sm text-gray-300">Status: 
                    @if($redemption->status == 'approved')
                        <span class="text-green-400">Disetujui</span>
                    @elseif($redemption->status == 'pending')
                        <span class="text-yellow-400">Menunggu</span>
                    @elseif($redemption->status == 'rejected')
                        <span class="text-red-400">Ditolak</span>
                    @else
                        {{ ucfirst($redemption->status) }}
                    @endif
                </p>
                <p class="text-sm text-gray-400 mt-1">Ditukar pada: {{ \Carbon\Carbon::parse($redemption->created_at)->format('d M Y') }}</p>
            </div>
        @endforeach
    </div>
@endif
        
    </div>

    {{-- Script Modal --}}
    <script>
        function showDetail(id) {
            const modal = document.getElementById('modal-' + id);
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function hideDetail(id) {
            const modal = document.getElementById('modal-' + id);
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
</x-app-layout>
