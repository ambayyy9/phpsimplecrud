<?php 

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class Parfum extends Database {

    // INPUT DATA PARFUM
    public function inputParfum($data){
        // Ambil semua data dari array parameter
        $kode      = $data['kode_parfum'] ?? null; //supaya kalo datanya ga diisi ga error
        $nama      = $data['nama_parfum'] ?? null;
        $id_jenis  = $data['id_jenis'] ?? null;
        $id_aroma  = $data['id_aroma'] ?? null;
        $deskripsi = $data['deskripsi'] ?? null;
        $harga     = $data['harga'] ?? null;
        $stok      = $data['stok'] ?? null;


        // Query insert
        $query = "INSERT INTO tb_parfum (kode_parfum, nama_parfum, id_jenis, id_aroma, deskripsi, harga, stok)
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt) return false;

        // harga pakai string ("s") agar aman untuk DECIMAL
        $stmt->bind_param("ssissss", $kode, $nama, $id_jenis, $id_aroma, $deskripsi, $harga, $stok);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    
    // GET SEMUA DATA PARFUM
public function getAllParfum() {
    $query = "SELECT 
                p.id_parfum, /*pake alias tabel*/
                p.kode_parfum,
                p.nama_parfum,
                j.nama_jenis,
                a.nama_aroma,
                p.deskripsi,
                p.harga,
                p.stok
              FROM tb_parfum p /*disini yang mencetuskan aliasnya*/
              LEFT JOIN tb_jenis j ON p.id_jenis = j.id_jenis /*ini jugaaa*/
              LEFT JOIN tb_aroma a ON p.id_aroma = a.id_aroma";

    $result = $this->conn->query($query);
    $data = [];

    if($result && $result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
    }
    return $data;
}

    // GET PARFUM BY ID (UNTUK UPDATE)
    public function getUpdateParfum($id){
        $query = "SELECT p.id_parfum, p.kode_parfum, p.nama_parfum, p.id_jenis, j.nama_jenis, 
                         p.id_aroma, a.nama_aroma, p.deskripsi, p.harga, p.stok
                  FROM tb_parfum p
                  JOIN tb_jenis j ON p.id_jenis = j.id_jenis
                  JOIN tb_aroma a ON p.id_aroma = a.id_aroma
                  WHERE p.id_parfum = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt) return false;

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = null;
        if($result && $result->num_rows > 0){
            $row = $result->fetch_assoc();
            $data = [
                'id_parfum' => $row['id_parfum'],
                'kode_parfum' => $row['kode_parfum'],
                'nama_parfum' => $row['nama_parfum'],
                'id_jenis' => $row['id_jenis'],
                'nama_jenis' => $row['nama_jenis'],
                'id_aroma' => $row['id_aroma'],
                'aroma' => $row['nama_aroma'],
                'deskripsi' => $row['deskripsi'],
                'harga' => $row['harga'],
                'stok' => $row['stok']
                 ];
        }

        $stmt->close();
        return $data;
    }

    // UPDATE DATA PARFUM
    public function editParfum($data){
        $id        = $data['id_parfum'];
        $kode      = $data['kode_parfum'];
        $nama      = $data['nama_parfum'];
        $id_jenis  = $data['id_jenis'];
        $id_aroma  = $data['id_aroma'];
        $deskripsi = $data['deskripsi'];
        $harga     = $data['harga']; // DECIMAL
        $stok      = $data['stok'];

        $query = "UPDATE tb_parfum 
                  SET kode_parfum = ?, nama_parfum = ?, id_jenis = ?, id_aroma = ?, deskripsi = ?, harga = ?, stok = ?
                  WHERE id_parfum = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt) return false;

        $stmt->bind_param("ssiisdii", $kode, $nama, $id_jenis, $id_aroma, $deskripsi, $harga, $stok, $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    // DELETE DATA PARFUM
    public function deleteParfum($id){
        $query = "DELETE FROM tb_parfum WHERE id_parfum = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt) return false;

        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    // SEARCH PARFUM
    public function searchParfum($kataKunci){
        $likeQuery = "%".$kataKunci."%";
        $query = "SELECT p.id_parfum, p.kode_parfum, p.nama_parfum, j.nama_jenis, a.nama_aroma, 
                         p.deskripsi, p.harga, p.stok
                  FROM tb_parfum p
                  JOIN tb_jenis j ON p.id_jenis = j.id_jenis
                  JOIN tb_aroma a ON p.id_aroma = a.id_aroma
                  WHERE p.kode_parfum LIKE ? OR p.nama_parfum LIKE ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt) return [];

        $stmt->bind_param("ss", $likeQuery, $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();

        $parfum = [];
        if($result && $result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $parfum[] = [
                    'id_parfum' => $row['id_parfum'],
                    'kode_parfum' => $row['kode_parfum'],
                    'nama_parfum' => $row['nama_parfum'],
                    'nama_jenis' => $row['nama_jenis'],
                    'aroma' => $row['nama_aroma'],
                    'deskripsi' => $row['deskripsi'],
                    'harga' => $row['harga'],
                    'stok' => $row['stok']
                            ];
            }
        }

        $stmt->close();
        return $parfum;
    }
}

?>
