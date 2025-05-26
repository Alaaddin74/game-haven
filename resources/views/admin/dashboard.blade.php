<x-app-layout>
    <div class="py-10 bg-white dark:bg-[#0f172a] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Stat Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                <!-- Produk -->
                <div class="bg-gray-100 dark:bg-[#1e293b] p-6 rounded-xl shadow-lg border border-cyan-500 dark:border-cyan-600 hover:border-cyan-700 dark:hover:border-cyan-400 transition">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">Total Produk</h3>
                    <p class="text-4xl font-bold text-gray-900 dark:text-white">124</p>
                </div>

                <!-- Pengguna -->
                <div class="bg-gray-100 dark:bg-[#1e293b] p-6 rounded-xl shadow-lg border border-purple-500 dark:border-purple-600 hover:border-purple-700 dark:hover:border-purple-400 transition">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">Total Pengguna</h3>
                    <p class="text-4xl font-bold text-gray-900 dark:text-white">87</p>
                </div>

                <!-- Transaksi -->
                <div class="bg-gray-100 dark:bg-[#1e293b] p-6 rounded-xl shadow-lg border border-pink-500 dark:border-pink-600 hover:border-pink-700 dark:hover:border-pink-400 transition">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">Total Transaksi</h3>
                    <p class="text-4xl font-bold text-gray-900 dark:text-white">192</p>
                </div>
            </div>

            <!-- Welcome Section -->
            <div class="bg-gray-100 dark:bg-[#1e293b] p-8 rounded-xl shadow-lg border border-gray-300 dark:border-gray-700">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Selamat datang, Admin!</h3>
                <p class="text-gray-700 dark:text-gray-400 leading-relaxed">
                    Kelola produk, pengguna, dan transaksi dari panel ini. Platform <span class="text-cyan-600 dark:text-cyan-400 font-semibold">Game Haven</span> dirancang untuk memberikan pengalaman belanja terbaik bagi komunitas gamer.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
