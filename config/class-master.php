<?php

include_once 'db-config.php';

class MasterData extends Database {

    // DATA JENIS PARFUM
    public function getJenis(){
        $query = "SELECT * FROM tb_jenis";
        $result = $this->conn->query($query);
        $jenis = [];
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $jenis[] = [
                    'id_jenis' => $row['id_jenis'],
                    'nama_jenis' => $row['nama_jenis']
                ];
            }
        }
        return $jenis;
    }

    public function inputJenis($data){
        $namaJenis = $data['nama_jenis'];
        $query = "INSERT INTO tb_jenis (nama_jenis) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt) return false;
        $stmt->bind_param("s", $namaJenis);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function getUpdateJenis($id){
        $query = "SELECT * FROM tb_jenis WHERE id_jenis = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt) return false;
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $jenis = null;
        if($result && $result->num_rows > 0){
            $row = $result->fetch_assoc();
            $jenis = [
                'id_jenis' => $row['id_jenis'],
                'nama_jenis' => $row['nama_jenis']
            ];
        }
        $stmt->close();
        return $jenis;
    }

    public function updateJenis($data){
        $idJenis = $data['id_jenis'];
        $namaJenis = $data['nama_jenis'];
        $query = "UPDATE tb_jenis SET nama_jenis = ? WHERE id_jenis = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt) return false;
        $stmt->bind_param("si", $namaJenis, $idJenis);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function deleteJenis($id){
        $query = "DELETE FROM tb_jenis WHERE id_jenis = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt) return false;
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // DATA AROMA PARFUM
    public function getAroma(){
        $query = "SELECT * FROM tb_aroma";
        $result = $this->conn->query($query);
        $aroma = [];
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $aroma[] = [
                    'id_aroma' => $row['id_aroma'],
                    'nama_aroma' => $row['nama_aroma']
                ];
            }
        }
        return $aroma;
    }

    public function inputAroma($data){
        $namaAroma = $data['nama_aroma'];
        $query = "INSERT INTO tb_aroma (nama_aroma) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt) return false;
        $stmt->bind_param("s", $namaAroma);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function getUpdateAroma($id){
        $query = "SELECT * FROM tb_aroma WHERE id_aroma = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt) return false;
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $aroma = null;
        if($result && $result->num_rows > 0){
            $row = $result->fetch_assoc();
            $aroma = [
                'id_aroma' => $row['id_aroma'],
                'nama_aroma' => $row['nama_aroma']
            ];
        }
        $stmt->close();
        return $aroma;
    }

    public function updateAroma($data){
        $idAroma = $data['id_aroma'];
        $namaAroma = $data['nama_aroma'];
        $query = "UPDATE tb_aroma SET nama_aroma = ? WHERE id_aroma = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt) return false;
        $stmt->bind_param("si", $namaAroma, $idAroma);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function deleteAroma($id){
        $query = "DELETE FROM tb_aroma WHERE id_aroma = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt) return false;
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
}

?>
