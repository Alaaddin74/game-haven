<?php
include 'koneksi.php';
$result = mysqli_query($conn, "SELECT * FROM produk");
?>

<h2 class="text-xl font-semibold mb-4">Daftar Produk</h2>
<a href="create.php" class="bg-indigo-600 text-white px-4 py-2 rounded mb-4 inline-block">+ Tambah Produk</a>
<table class="min-w-full bg-white rounded shadow">
    <thead>
        <tr class="bg-gray-100 text-left">
            <th class="px-4 py-2">ID</th>
            <th class="px-4 py-2">Nama</th>
            <th class="px-4 py-2">Harga</th>
            <th class="px-4 py-2">Stok</th>
            <th class="px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr class="border-b">
            <td class="px-4 py-2"><?= $row['id'] ?></td>
            <td class="px-4 py-2"><?= $row['nama_produk'] ?></td>
            <td class="px-4 py-2">Rp <?= number_format($row['harga']) ?></td>
            <td class="px-4 py-2"><?= $row['stok'] ?></td>
            <td class="px-4 py-2">
                <a href="edit.php?id=<?= $row['id'] ?>" class="text-blue-600 hover:underline">Edit</a> |
                <a href="delete.php?id=<?= $row['id'] ?>" class="text-red-600 hover:underline" onclick="return confirm('Hapus produk ini?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
