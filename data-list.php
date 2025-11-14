<?php
include_once 'config/class-parfum.php';
$parfum = new Parfum();

// Alert berdasarkan status
if(isset($_GET['status'])){
    if($_GET['status'] == 'inputsuccess'){
        echo "<script>alert('Data parfum berhasil ditambahkan.');</script>";
    } else if($_GET['status'] == 'editsuccess'){
        echo "<script>alert('Data parfum berhasil diubah.');</script>";
    } else if($_GET['status'] == 'deletesuccess'){
        echo "<script>alert('Data parfum berhasil dihapus.');</script>";
    } else if($_GET['status'] == 'deletefailed'){
        echo "<script>alert('Gagal menghapus data parfum. Silakan coba lagi.');</script>";
    }
}

// Ambil semua data parfum
$dataParfum = $parfum->getAllParfum();
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
                            <h3 class="mb-0">Daftar Parfum</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                                <li class="breadcrumb-item active" aria-current="page">List Parfum</li>
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
                                    <h3 class="card-title">Tabel Parfum</h3>
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

                                <div class="card-body p-0 table-responsive">
                                    <table class="table table-striped" role="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode</th>
                                                <th>Nama Parfum</th>
                                                <th>Jenis</th>
                                                <th>Aroma</th>
                                                <th>Deskripsi</th>
                                                <th>Harga (Rp)</th>
                                                <th>Stok</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if(count($dataParfum) == 0){
                                                echo '<tr class="align-middle">
                                                    <td colspan="9" class="text-center">Tidak ada data parfum.</td>
                                                </tr>';
                                            } else {
                                                foreach ($dataParfum as $index => $p){
                                                    echo '<tr class="align-middle">
                                                        <td>'.($index + 1).'</td>
                                                        <td>'.$p['kode_parfum'].'</td>
                                                        <td>'.$p['nama_parfum'].'</td>
                                                        <td>'.$p['nama_jenis'].'</td>
                                                        <td>'.$p['nama_aroma'].'</td>
                                                        <td>'.$p['deskripsi'].'</td>
                                                        <td>'.number_format($p['harga'],0,',','.').'</td>
                                                        <td>'.$p['stok'].'</td>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-sm btn-warning me-1" onclick="window.location.href=\'data-edit.php?id='.$p['id_parfum'].'\'"><i class="bi bi-pencil-fill"></i> Edit</button>
                                                            <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm(\'Yakin ingin menghapus parfum ini?\')){window.location.href=\'proses/proses-delete.php?id='.$p['id_parfum'].'\'}"><i class="bi bi-trash-fill"></i> Hapus</button>
                                                        </td>
                                                    </tr>';
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary" onclick="window.location.href='data-input.php'"><i class="bi bi-plus-lg"></i> Tambah Parfum</button>
                                </div>
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
