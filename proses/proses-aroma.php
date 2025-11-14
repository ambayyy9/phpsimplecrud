<?php
include '../config/class-master.php';
$master = new MasterData();

if ($_GET['aksi'] == 'inputaroma') {
    // Gunakan key 'nama_aroma' sesuai dengan form input
    $dataAroma = [
        'nama_aroma' => $_POST['nama_aroma']
    ];

    $input = $master->inputAroma($dataAroma);
    if ($input) {
        header("Location: ../master-aroma-list.php?status=inputsuccess");
    } else {
        header("Location: ../master-aroma-input.php?status=failed");
    }

} elseif ($_GET['aksi'] == 'updatearoma') {
    $dataAroma = [
        'id_aroma' => $_POST['id_aroma'],
        'nama_aroma' => $_POST['nama_aroma']
    ];

    $update = $master->updateAroma($dataAroma);
    if ($update) {
        header("Location: ../master-aroma-list.php?status=editsuccess");
    } else {
        header("Location: ../master-aroma-edit.php?id=" . $dataAroma['id_aroma'] . "&status=failed");
    }

} elseif ($_GET['aksi'] == 'deletearoma') {
    $id = $_GET['id'];
    $delete = $master->deleteAroma($id);
    if ($delete) {
        header("Location: ../master-aroma-list.php?status=deletesuccess");
    } else {
        header("Location: ../master-aroma-list.php?status=deletefailed");
    }
}
?>
