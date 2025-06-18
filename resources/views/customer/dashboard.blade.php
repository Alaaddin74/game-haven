<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-10 text-white">
        {{-- Notifikasi --}}
        @if(session('success'))
            <div class="bg-green-500 text-white px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Form Pencarian dan Filter --}}
        <form action="{{ route('customer.dashboard') }}" method="GET" class="mb-8">
            <div class="flex flex-col md:flex-row gap-4">
                <input type="text"
                       name="q"
                       value="{{ $query ?? '' }}"
                       placeholder="Cari produk..."
                       class="w-full md:w-1/2 px-4 py-2 rounded-lg bg-gray-800 text-white border border-gray-600 focus:ring focus:border-cyan-500" />

                <select name="category"
                        class="w-full md:w-1/4 px-4 py-2 rounded-lg bg-gray-800 text-white border border-gray-600 focus:ring focus:border-cyan-500">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ isset($categoryId) && $categoryId == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <button type="submit"
                        class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-2 rounded-lg">
                    Cari
                </button>
            </div>
        </form>

        {{-- Grid Produk Responsive --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="bg-[#1e293b] p-4 rounded-xl shadow hover:shadow-lg transition cursor-pointer"
                     onclick="showDetail({{ $product->id }})">
                    <div class="w-full aspect-[4/3] bg-gray-800 rounded-md mb-4 overflow-hidden flex items-center justify-center">
                        <img 
                            src="{{ $product->image_url 
                                      ? asset('storage/'.$product->image_url) 
                                      : asset('images/placeholder.png') }}" 
                            alt="{{ $product->name }}" 
                            class="object-cover w-full h-full" 
                        />
                    </div>
                    <h2 class="text-base font-semibold truncate">{{ $product->name }}</h2>
                    @if ($product->category)
                        <p class="text-sm text-gray-400">{{ $product->category->name }}</p>
                    @endif
                    <p class="text-cyan-400 text-sm mt-1">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>
                </div>

                {{-- Modal --}}
                <div id="modal-{{ $product->id }}"
                     class="fixed inset-0 bg-black bg-opacity-70 hidden items-center justify-center z-50">
                    <div class="bg-white rounded-lg w-11/12 md:w-2/5 lg:max-w-md p-6 relative text-gray-800 shadow-lg">
                        <button onclick="hideDetail({{ $product->id }})"
                                class="absolute top-2 right-3 text-xl font-bold text-gray-500 hover:text-red-500">
                            &times;
                        </button>

                        <img 
                            src="{{ $product->image_url 
                                      ? asset('storage/'.$product->image_url) 
                                      : asset('images/placeholder.png') }}"
                            alt="{{ $product->name }}" 
                            class="w-full h-48 object-contain rounded mb-4" 
                        />

                        <h2 class="text-xl font-bold mb-2">{{ $product->name }}</h2>
                        <p class="mb-2 text-sm">{{ $product->description }}</p>
                        <p class="mb-4 font-semibold text-cyan-600">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                        <form action="{{ route('order.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                    class="bg-cyan-600 hover:bg-cyan-700 text-white font-semibold py-2 px-4 rounded-lg w-full">
                                Checkout
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
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
