<?php
include '../config/class-parfum.php';

// Buat objek class Parfum
$parfum = new Parfum();

// Pastikan form disubmit lewat POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Ambil data dari form
    $dataParfum = [
        'kode_parfum' => $_POST['kode_parfum'],
        'nama_parfum' => $_POST['nama_parfum'],
        'id_jenis' => $_POST['id_jenis'],
        'id_aroma' => $_POST['id_aroma'],
        'deskripsi' => $_POST['deskripsi'],
        'harga' => $_POST['harga'],
        'stok' => $_POST['stok']
    ];

    // Cek semua field wajib terisi
    if (
        empty($dataParfum['kode_parfum']) || 
        empty($dataParfum['nama_parfum']) || 
        empty($dataParfum['id_jenis']) || 
        empty($dataParfum['id_aroma'])
    ) {
        header("Location: ../data-input.php?status=failed");
        exit;
    }

    // Proses input ke database
    $input = $parfum->inputParfum($dataParfum);

    if ($input) {
        header("Location: ../data-list.php?status=inputsuccess");
    } else {
        header("Location: ../data-input.php?status=failed");
    }

} else {
    // Kalau bukan POST, langsung tolak
    header("Location: ../data-input.php?status=invalid");
    exit;
}
?>
