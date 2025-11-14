<?php
include_once 'config/class-parfum.php';
$parfum = new Parfum();
$kataKunci = '';
$cariParfum = [];

// Mengecek apakah parameter GET 'search' ada
if(isset($_GET['search'])){
    $kataKunci = $_GET['search'];
    // Memanggil method searchParfum untuk mencari data parfum berdasarkan kode atau nama
    $cariParfum = $parfum->searchParfum($kataKunci);
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
                            <h3 class="mb-0">Cari Parfum</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Cari Data</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="app-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h3 class="card-title">Pencarian Parfum</h3>
                                </div>
                                <div class="card-body">
                                    <form action="data-search.php" method="GET">
                                        <div class="mb-3">
                                            <label for="search" class="form-label">Masukkan Kode atau Nama Parfum</label>
                                            <input type="text" class="form-control" id="search" name="search" placeholder="Cari berdasarkan kode atau nama parfum" value="<?php echo htmlspecialchars($kataKunci); ?>" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-search-heart-fill"></i> Cari</button>
                                    </form>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Hasil Pencarian</h3>
                                </div>
                                <div class="card-body">
                                    <?php
                                    if(isset($_GET['search'])){
                                        if(count($cariParfum) > 0){
                                            echo '<table class="table table-striped" role="table">
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
                                                    <tbody>';
                                            foreach($cariParfum as $index => $p){
                                                echo '<tr class="align-middle">
                                                        <td>'.($index + 1).'</td>
                                                        <td>'.$p['kode_parfum'].'</td>
                                                        <td>'.$p['nama_parfum'].'</td>
                                                        <td>'.$p['nama_jenis'].'</td>
                                                        <td>'.$p['aroma'].'</td>
                                                        <td>'.$p['deskripsi'].'</td>
                                                        <td>'.number_format($p['harga'],0,',','.').'</td>
                                                        <td>'.$p['stok'].'</td>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-sm btn-warning me-1" onclick="window.location.href=\'data-edit.php?id='.$p['id_parfum'].'\'"><i class="bi bi-pencil-fill"></i> Edit</button>
                                                            <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm(\'Yakin ingin menghapus parfum ini?\')){window.location.href=\'proses/proses-delete.php?id='.$p['id_parfum'].'\'}"><i class="bi bi-trash-fill"></i> Hapus</button>
                                                        </td>
                                                    </tr>';
                                            }
                                            echo '</tbody></table>';
                                        } else {
                                            echo '<div class="alert alert-warning" role="alert">
                                                    Tidak ditemukan parfum yang sesuai dengan kata kunci "<strong>'.htmlspecialchars($kataKunci).'</strong>".
                                                  </div>';
                                        }
                                    } else {
                                        echo '<div class="alert alert-info" role="alert">
                                                Silakan masukkan kata kunci pencarian di atas untuk mencari parfum.
                                              </div>';
                                    }
                                    ?>
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
