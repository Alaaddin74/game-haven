<!-- File: /resources/views/admin/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Dashboard - Game Haven</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-thumb {
            background-color: rgba(107, 114, 128, 0.5);
            border-radius: 4px;
        }
    </style>
</head>
<body class="bg-gray-100 flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <aside class="bg-white w-64 flex-shrink-0 flex flex-col border-r border-gray-200 overflow-y-auto">
        <div class="px-6 py-4 flex items-center justify-center border-b border-gray-200">
            <h1 class="text-2xl font-bold text-indigo-600">Game Haven</h1>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-indigo-50 font-semibold transition">Kelola Kategori</a>
            <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-indigo-50 font-semibold transition">Kelola User</a>
            <a href="{{ route('admin.products.index') }}" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-indigo-50 font-semibold transition">Kelola Produk</a>
            <a href="{{ route('admin.rewards.index') }}" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-indigo-50 font-semibold transition">Kelola Rewards</a>
            <a href="{{ route('admin.redemptions.index') }}" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-indigo-50 font-semibold transition">Kelola Penukaran Reward</a>
            <a href="{{ route('admin.orders.index') }}" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-indigo-50 font-semibold transition">Histori Transaksi</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 rounded-lg text-red-600 hover:bg-red-100 font-semibold transition">Logout</button>
            </form>
        </nav>
    </aside>

    <!-- Main content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <header class="flex items-center justify-between bg-white px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">@yield('title', 'Admin Dashboard')</h2>
            <div class="flex items-center space-x-4">
                <div class="text-gray-600 font-medium">Admin</div>
                <img class="h-10 w-10 rounded-full object-cover" src="https://i.pravatar.cc/300" alt="User avatar" />
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-6">
            @yield('content')
        </main>
    </div>
</body>
</html>
