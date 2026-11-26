
<?php

// 1. Mengubah angka menjadi format Rupiah
function formatRupiah($angka) {
    return "Rp " . number_format($angka, 0, ',', '.');
}


// 2. Menghitung harga setelah diskon
function hitungDiskon($harga, $persentase) {
    $diskon = $harga * ($persentase / 100);
    return $harga - $diskon;
}


// 3. Memvalidasi format email
function validasiEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}


// 4. Meringkas teks berdasarkan jumlah karakter
function ringkasTeks($teks, $maksimal = 50) {
    if (strlen($teks) > $maksimal) {
        return substr($teks, 0, $maksimal) . "...";
    }

    return $teks;
}

?>
