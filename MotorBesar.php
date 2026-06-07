<?php
require_once 'Kendaraan.php';

class MotorBesar extends Kendaraan {
    private $tipeRantai;
    private $modeBerkendara;

    public function __construct($id, $brand, $model, $tahun, $hargaDasar, $statusPajak, $lamaMenunggak, $rantai, $mode) {
        parent::__construct($id, $brand, $model, $tahun, $hargaDasar, $statusPajak, $lamaMenunggak);
        $this->tipeRantai = $rantai;
        $this->modeBerkendara = $mode; 
    }

    // Overriding Perhitungan Pajak Motor Besar
    public function hitungPajakTahunan() {
        return 0.015 * $this->hargaDasar;
    }
    
    public function tampilkanSpesifikasi() {
        return "Jenis: Motor Besar (Moge) | Rantai: {$this->tipeRantai} | Mode: {$this->modeBerkendara}";
    }
}