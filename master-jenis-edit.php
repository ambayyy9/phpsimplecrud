<?php 

// Mengambil data jenis parfum berdasarkan ID
include_once 'config/class-master.php';
$master = new MasterData();
$dataJenis = $master->getUpdateJenis($_GET['id']); 

// Menampilkan notifikasi jika update gagal
if(isset($_GET['status'])){
    if($_GET['status'] == 'failed'){
        echo "<script>alert('Gagal mengubah data jenis parfum. Silakan coba lagi.');</script>";
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
								<h3 class="mb-0">Edit Jenis Parfum</h3>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-end">
									<li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
									<li class="breadcrumb-item active" aria-current="page">Edit Jenis</li>
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
										<h3 class="card-title">Formulir Jenis Parfum</h3>
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
                                    
                                    <!-- Form Edit Jenis Parfum -->
                                    <form action="proses/proses-jenis.php?aksi=updatejenis" method="POST">
									    <div class="card-body">
                                            <input type="hidden" name="id_jenis" value="<?php echo $dataJenis['id_jenis']; ?>">
											<div class="mb-3">
												<label for="nama" class="form-label">Nama Jenis Parfum</label>
												<input type="text" class="form-control" id="nama_jenis" name="nama_jenis" placeholder="Masukkan Nama Jenis Parfum" value="<?php echo $dataJenis['nama_jenis']; ?>" required>
											</div>
                                        </div>
									    <div class="card-footer">
                                            <button type="button" class="btn btn-danger me-2 float-start" onclick="window.location.href='master-jenis-list.php'">Batal</button>
                                            <button type="submit" class="btn btn-warning float-end">Update Data</button>
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
