<?php
abstract class Kendaraan {
    protected $id_kendaraan;
    protected $brand;
    protected $model;
    protected $tahun;
    protected $hargaDasar;
    protected $statusPajak;
    protected $lamaMenunggak; // Properti Baru

    public function __construct($id_kendaraan, $brand, $model, $tahun, $hargaDasar, $statusPajak, $lamaMenunggak) {
        $this->id_kendaraan = $id_kendaraan;
        $this->brand = $brand;
        $this->model = $model;
        $this->tahun = $tahun;
        $this->hargaDasar = $hargaDasar;
        $this->statusPajak = $statusPajak;
        $this->lamaMenunggak = $lamaMenunggak;
    }

    public function getIdKendaraan() { return $this->id_kendaraan; }
    public function getBrand() { return $this->brand; }
    public function getModel() { return $this->model; }
    public function getTahun() { return $this->tahun; }
    public function getHargaDasar() { return $this->hargaDasar; }
    public function getStatusPajak() { return $this->statusPajak; }
    public function getLamaMenunggak() { return $this->lamaMenunggak; }

    // REVISI LOGIKA: Denda akumulatif dikalikan dengan lamanya tahun menunggak
    public function hitungDendaPajak() {
        if ($this->statusPajak === 'mati' && $this->lamaMenunggak > 0) {
            return 0.25 * $this->hitungPajakTahunan() * $this->lamaMenunggak;
        }
        return 0;
    }

    // Total akumulasi beban fiskal
    public function hitungTotalBebanFiskal() {
        return $this->hitungPajakTahunan() + $this->hitungDendaPajak();
    }

    abstract public function hitungPajakTahunan();
    abstract public function tampilkanSpesifikasi();
}