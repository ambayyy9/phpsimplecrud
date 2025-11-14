<?php
// Memasukkan file class-parfum.php untuk mengakses class Parfum
include_once '../config/class-parfum.php';

// Membuat objek dari class Parfum
$parfum = new Parfum();

// Pastikan semua data POST tersedia
if (isset($_POST['id_parfum'])) {

    // Mengambil data parfum dari form edit
    $dataParfum = [
        'id_parfum'   => $_POST['id_parfum'],
        'kode_parfum' => $_POST['kode_parfum'],
        'nama_parfum' => $_POST['nama_parfum'],
        'id_jenis'    => $_POST['id_jenis'],
        'id_aroma'    => $_POST['id_aroma'],
        'deskripsi'   => $_POST['deskripsi'],
        'harga'       => $_POST['harga'],
        'stok'        => $_POST['stok']
    ];

    // Panggil method editParfum untuk update data
    $edit = $parfum->editParfum($dataParfum);

    // Mengecek apakah proses edit berhasil
    if ($edit) {
        header("Location: ../data-list.php?status=editsuccess");
    } else {
        header("Location: ../data-edit.php?id=" . $dataParfum['id_parfum'] . "&status=failed");
    }

} else {
    // Jika tidak ada id_parfum, kembali ke daftar
    header("Location: ../data-list.php?status=invalid");
}

?>
