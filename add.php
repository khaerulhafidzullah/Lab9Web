<?php
require_once __DIR__ . '/../../config/database.php';

$errors = [];
$nama = '';
$kategori = '';
$harga_beli = '';
$harga_jual = '';
$stok = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $kategori = trim($_POST['kategori'] ?? '');
    $harga_beli = trim($_POST['harga_beli'] ?? '');
    $harga_jual = trim($_POST['harga_jual'] ?? '');
    $stok = trim($_POST['stok'] ?? '');
    $gambar = '';

    if ($nama === '') {
        $errors[] = 'Nama barang wajib diisi.';
    }

    if ($kategori === '') {
        $errors[] = 'Kategori wajib diisi.';
    }

    if (!is_numeric($harga_beli) || (float) $harga_beli < 0) {
        $errors[] = 'Harga beli harus berupa angka yang tidak negatif.';
    }

    if (!is_numeric($harga_jual) || (float) $harga_jual < 0) {
        $errors[] = 'Harga jual harus berupa angka yang tidak negatif.';
    }

    if (!filter_var($stok, FILTER_VALIDATE_INT) || (int) $stok < 0) {
        $errors[] = 'Stok harus berupa angka bulat yang tidak negatif.';
    }

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] !== UPLOAD_ERR_NO_FILE) {
        $file = $_FILES['gambar'];

        if ($file['error'] !== UPLOAD_ERR_OK) {
            $errors[] = 'Gagal mengunggah gambar.';
        } else {
            $allowedTypes = [
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                'image/gif' => 'gif',
                'image/webp' => 'webp',
            ];
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $file['tmp_name']);
            finfo_close($finfo);

            if (!isset($allowedTypes[$mimeType])) {
                $errors[] = 'Format gambar harus JPG, PNG, GIF, atau WebP.';
            } elseif ($file['size'] > 2 * 1024 * 1024) {
                $errors[] = 'Ukuran gambar maksimal 2 MB.';
            } else {
                $uploadDirectory = __DIR__ . '/../../assets/images/';
                if (!is_dir($uploadDirectory)) {
                    mkdir($uploadDirectory, 0777, true);
                }

                $filename = uniqid('barang_', true) . '.' . $allowedTypes[$mimeType];
                $targetPath = $uploadDirectory . $filename;

                if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                    $gambar = 'assets/images/' . $filename;
                } else {
                    $errors[] = 'Gambar tidak dapat disimpan.';
                }
            }
        }
    }

    if (empty($errors)) {
        $sql = "INSERT INTO data_barang
                (nama, kategori, harga_beli, harga_jual, stok, gambar)
                VALUES (?, ?, ?, ?, ?, ?)";
        $statement = mysqli_prepare($conn, $sql);

        if (!$statement) {
            $errors[] = 'Gagal menyiapkan penyimpanan data.';
        } else {
            mysqli_stmt_bind_param(
                $statement,
                'ssddis',
                $nama,
                $kategori,
                $harga_beli,
                $harga_jual,
                $stok,
                $gambar
            );

            if (mysqli_stmt_execute($statement)) {
                mysqli_stmt_close($statement);
                header('Location: index.php?page=user/list');
                exit;
            }

            $errors[] = 'Gagal menyimpan data barang.';
            mysqli_stmt_close($statement);
        }
    }
}
?>

<section>
    <h2>Tambah Barang</h2>

    <?php if (!empty($errors)): ?>
        <div style="margin-bottom: 15px; padding: 10px; border: 1px solid #dc2626;">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="index.php?page=user/add" method="POST" enctype="multipart/form-data">
        <table cellpadding="8">
            <tr>
                <td><label for="nama">Nama Barang</label></td>
                <td>
                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        value="<?= htmlspecialchars($nama); ?>"
                        required
                    >
                </td>
            </tr>
            <tr>
                <td><label for="kategori">Kategori</label></td>
                <td>
                    <input
                        type="text"
                        id="kategori"
                        name="kategori"
                        value="<?= htmlspecialchars($kategori); ?>"
                        required
                    >
                </td>
            </tr>
            <tr>
                <td><label for="harga_beli">Harga Beli</label></td>
                <td>
                    <input
                        type="number"
                        id="harga_beli"
                        name="harga_beli"
                        min="0"
                        step="1"
                        value="<?= htmlspecialchars($harga_beli); ?>"
                        required
                    >
                </td>
            </tr>
            <tr>
                <td><label for="harga_jual">Harga Jual</label></td>
                <td>
                    <input
                        type="number"
                        id="harga_jual"
                        name="harga_jual"
                        min="0"
                        step="1"
                        value="<?= htmlspecialchars($harga_jual); ?>"
                        required
                    >
                </td>
            </tr>
            <tr>
                <td><label for="stok">Stok</label></td>
                <td>
                    <input
                        type="number"
                        id="stok"
                        name="stok"
                        min="0"
                        step="1"
                        value="<?= htmlspecialchars($stok); ?>"
                        required
                    >
                </td>
            </tr>
            <tr>
                <td><label for="gambar">Gambar</label></td>
                <td>
                    <input
                        type="file"
                        id="gambar"
                        name="gambar"
                        accept="image/jpeg,image/png,image/gif,image/webp"
                    >
                    <br>
                    <small>Maksimal 2 MB.</small>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit">Simpan</button>
                    <a href="index.php?page=user/list">Batal</a>
                </td>
            </tr>
        </table>
    </form>
</section>