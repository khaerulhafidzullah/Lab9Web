
<?php
// Memanggil koneksi database dan library function
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../helpers/functions.php';

// Mengambil seluruh data barang
$sql = "SELECT * FROM data_barang ORDER BY id_barang DESC";
$result = mysqli_query($conn, $sql);

// Memeriksa apakah query berhasil
if (!$result) {
    die("Gagal mengambil data: " . mysqli_error($conn));
}
?>

<section>
    <h2>Data Barang</h2>
    <p>Berikut adalah daftar barang yang tersimpan di database.</p>

    <p>
        <a href="index.php?page=user/add">
            + Tambah Barang
        </a>
    </p>

    <table border="1" cellpadding="10" cellspacing="0"
           width="100%">

        <thead>
            <tr>
                <th>No.</th>
                <th>Gambar</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php $no = 1; ?>

                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $no++; ?></td>

                        <td>
                            <?php if (!empty($row['gambar'])): ?>
                                <img
                                    src="<?= htmlspecialchars($row['gambar']); ?>"
                                    alt="Gambar barang"
                                    width="70"
                                >
                            <?php else: ?>
                                Tidak ada gambar
                            <?php endif; ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($row['nama']); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($row['kategori']); ?>
                        </td>

                        <td>
                            <?= formatRupiah($row['harga_beli']); ?>
                        </td>

                        <td>
                            <?= formatRupiah($row['harga_jual']); ?>
                        </td>

                        <td><?= $row['stok']; ?></td>

                        <td>
                            <a href="index.php?page=user/edit&id=<?= $row['id_barang']; ?>">
                                Ubah
                            </a>

                            <form
                                action="index.php?page=user/delete"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus barang ini?');"
                            >
                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?= $row['id_barang']; ?>"
                                >

                                <button type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>

            <?php else: ?>
                <tr>
                    <td colspan="8" align="center">
                        Belum ada data barang.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>
