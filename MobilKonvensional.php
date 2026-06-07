<?php
require_once 'Kendaraan.php';

class MobilKonvensional extends Kendaraan {
    private $kapasitasMesin;
    private $jenisBahanBakar;

    public function __construct($id, $brand, $model, $tahun, $hargaDasar, $statusPajak, $lamaMenunggak, $cc, $bbm) {
        parent::__construct($id, $brand, $model, $tahun, $hargaDasar, $statusPajak, $lamaMenunggak);
        $this->kapasitasMesin = $cc;
        $this->jenisBahanBakar = $bbm;
    }

    public function hitungPajakTahunan() {
        return (0.02 * $this->hargaDasar) + ($this->kapasitasMesin * 500);
    }

    public function tampilkanSpesifikasi() {
        return "BBM: {$this->jenisBahanBakar} | Mesin: {$this->kapasitasMesin} cc";
    }
}