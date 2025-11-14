<?php 
include_once 'config/class-master.php';
$master = new MasterData();

// Ambil daftar jenis dan aroma parfum
$jenisList = $master->getJenis();
$aromaList = $master->getAroma();

// Menampilkan alert jika ada status gagal
if(isset($_GET['status'])){
    if($_GET['status'] == 'failed'){
        echo "<script>alert('Gagal menambahkan data parfum. Silakan coba lagi.');</script>";
    }
}
?>

<!doctype html>
<html lang="en">
    <head>
        <?php include 'template/header.php'; ?>
    </head>

    <body class="layout-fixed fixed-header fixed-footer sidebar-expand-lg sidebar-open bg-body-tertiary">

        <div class="app-wrapper">

            <?php include 'template/navbar.php'; ?>
            <?php include 'template/sidebar.php'; ?>

            <main class="app-main">

                <div class="app-content-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="mb-0">Input Parfum</h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Input Data Parfum</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="app-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Formulir Parfum</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse" title="Collapse">
                                                <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                                <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-lte-toggle="card-remove" title="Remove">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <form action="proses/proses-input.php" method="POST" enctype="multipart/form-data">
                                        <div class="card-body">

                                            <div class="mb-3">
                                                <label for="kode_parfum" class="form-label">Kode Parfum</label>
                                                <input type="text" class="form-control" id="kode_parfum" name="kode_parfum" placeholder="Masukkan kode parfum (misal: PRF001)" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="nama_parfum" class="form-label">Nama Parfum</label>
                                                <input type="text" class="form-control" id="nama_parfum" name="nama_parfum" placeholder="Masukkan nama parfum" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="jenis" class="form-label">Jenis Parfum</label>
                                                <select class="form-select" id="jenis" name="id_jenis" required>
                                                    <option value="" selected disabled>Pilih Jenis Parfum</option>
                                                    <?php 
                                                    foreach ($jenisList as $jenis){ //$jenisList adalah array berisi semua data jenis parfum dari tabel tb_jenis
                                                        echo '<option value="'.$jenis['id_jenis'].'">'.$jenis['nama_jenis'].'</option>'; //kalo ubah di database otomatis muncul di sistem webnya
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="aroma" class="form-label">Aroma Parfum</label>
                                                <select class="form-select" id="aroma" name="id_aroma" required>
                                                    <option value="" selected disabled>Pilih Aroma Parfum</option>
                                                    <?php
                                                    foreach ($aromaList as $aroma){
                                                        echo '<option value="'.$aroma['id_aroma'].'">'.$aroma['nama_aroma'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Masukkan deskripsi parfum" required></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="harga" class="form-label">Harga (Rp)</label>
                                                <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukkan harga parfum" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="stok" class="form-label">Stok</label>
                                                <input type="number" class="form-control" id="stok" name="stok" placeholder="Masukkan jumlah stok" required>
                                            </div>

                                        </div>

                                        <div class="card-footer">
                                            <button type="button" class="btn btn-danger me-2 float-start" onclick="window.location.href='data-list.php'">Batal</button>
                                            <button type="reset" class="btn btn-secondary me-2 float-start">Reset</button>
                                            <button type="submit" class="btn btn-primary float-end">Submit</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </main>

            <?php include 'template/footer.php'; ?>
        </div>
        
        <?php include 'template/script.php'; ?>
    </body>
</html>
