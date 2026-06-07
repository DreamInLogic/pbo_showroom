<?php
require_once 'Kendaraan.php';

class MobilListrik extends Kendaraan {
    private $kapasitasBaterai;
    private $jarakTempuh;

    public function __construct($id, $brand, $model, $tahun, $hargaDasar, $statusPajak, $lamaMenunggak, $baterai, $jarak) {
        parent::__construct($id, $brand, $model, $tahun, $hargaDasar, $statusPajak, $lamaMenunggak);
        $this->kapasitasBaterai = $baterai;
        $this->jarakTempuh = $jarak;
    }

    // Overriding Perhitungan Pajak Listrik (Insentif emisi nol)
    public function hitungPajakTahunan() {
        return 0.005 * $this->hargaDasar;
    }

    public function tampilkanSpesifikasi() { 
        return "Jenis: Mobil Listrik (EV) | Baterai: {$this->kapasitasBaterai} kWh | Jarak Tempuh: {$this->jarakTempuh} km";
    }
}