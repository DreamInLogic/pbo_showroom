<?php
require_once 'Database.php';
require_once 'MobilKonvensional.php';
require_once 'MobilListrik.php';
require_once 'MotorBesar.php';

class ManajemenShowroom {
    private $db;
    private $daftarKendaraan = [];

    public function __construct() {
        $this->db = new Database();
    }

    public function muatDataInventaris($search = "") {
        $this->daftarKendaraan = [];
        
        if (!empty($search)) {
            $query = "SELECT * FROM kendaraan WHERE 
                      brand LIKE :search OR 
                      model LIKE :search OR 
                      tahun LIKE :search OR 
                      jenis_kendaraan LIKE :search OR 
                      jenis_bahan_bakar LIKE :search OR 
                      mode_berkendara LIKE :search";
            $stmt = $this->db->conn->prepare($query);
            $stmt->execute(['search' => "%$search%"]);
        } else {
            $query = "SELECT * FROM kendaraan";
            $stmt = $this->db->conn->prepare($query);
            $stmt->execute();
        }
        
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rows as $row) {
            if ($row['jenis_kendaraan'] == 'konvensional') {
                $this->daftarKendaraan[] = new MobilKonvensional(
                    $row['id_kendaraan'], $row['brand'], $row['model'], $row['tahun'], $row['harga_dasar'], 
                    $row['status_pajak'], $row['lama_menunggak_tahun'], $row['kapasitas_mesin'], $row['jenis_bahan_bakar']
                );
            } elseif ($row['jenis_kendaraan'] == 'listrik') {
                $this->daftarKendaraan[] = new MobilListrik(
                    $row['id_kendaraan'], $row['brand'], $row['model'], $row['tahun'], $row['harga_dasar'], 
                    $row['status_pajak'], $row['lama_menunggak_tahun'], $row['kapasitas_baterai'], $row['jarak_tempuh']
                );
            } elseif ($row['jenis_kendaraan'] == 'motor_besar') {
                $this->daftarKendaraan[] = new MotorBesar(
                    $row['id_kendaraan'], $row['brand'], $row['model'], $row['tahun'], $row['harga_dasar'], 
                    $row['status_pajak'], $row['lama_menunggak_tahun'], $row['tipe_rantai'], $row['mode_berkendara']
                );
            }
        }
    }

    public function getDaftarKendaraan() {
        return $this->daftarKendaraan;
    }
}