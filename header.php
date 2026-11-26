
<?php
if (!isset($pageTitle)) {
    $pageTitle = "Aplikasi Data Barang";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars($pageTitle); ?></title>

    <link rel="stylesheet"
          href="assets/css/style.css">
</head>
<body>

<div class="container">

    <header class="header">
        <h1>Aplikasi Data Barang</h1>
        <p>Praktikum 9 - PHP Modular</p>
    </header>

    <nav class="navbar">
        <a href="index.php?page=dashboard">Dashboard</a>
        <a href="index.php?page=user/list">Data Barang</a>
    </nav>

    <main class="content">
