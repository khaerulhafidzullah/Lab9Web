<?php
require_once __DIR__ . '/../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php?page=user/list');
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    header('Location: index.php?page=user/list');
    exit;
}

$statement = mysqli_prepare($conn, 'SELECT gambar FROM data_barang WHERE id_barang = ?');

if (!$statement) {
    header('Location: index.php?page=user/list');
    exit;
}

mysqli_stmt_bind_param($statement, 'i', $id);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);
$barang = mysqli_fetch_assoc($result);
mysqli_stmt_close($statement);

if (!$barang) {
    header('Location: index.php?page=user/list');
    exit;
}

$delete = mysqli_prepare($conn, 'DELETE FROM data_barang WHERE id_barang = ?');

if (!$delete) {
    header('Location: index.php?page=user/list');
    exit;
}

mysqli_stmt_bind_param($delete, 'i', $id);
$deleted = mysqli_stmt_execute($delete);
mysqli_stmt_close($delete);

if ($deleted && !empty($barang['gambar'])) {
    $imagePath = __DIR__ . '/../../' . $barang['gambar'];

    if (is_file($imagePath)) {
        unlink($imagePath);
    }
}

header('Location: index.php?page=user/list');
exit;