# 🚗 Proyek Sandbox: Sistem Manajemen Inventaris & Fiskal Showroom
### 🛠️ Repositori Eksperimen Pribadi — Sunu Setyo Jati
**URL Repositori:** `https://github.com/DreamInLogic/pbo_showroom.git`

---

## 📌 Pengantar & Tujuan Proyek
Repositori ini merupakan ruang kerja digital privat (*sandbox*) yang saya gunakan untuk merancang, menguji, dan mensimulasikan arsitektur kode program berbasis **Pemrograman Berorientasi Objek (PBO)** untuk sistem manajemen showroom kendaraan. 

Dalam pengembangan proyek ini, saya bertindak sebagai **Project Manager & UML Designer** yang berkolaborasi secara intensif bersama **Gemini (AI Collaborator)** untuk menyusun dokumentasi arsitektur yang bersih, modular, dan sesuai dengan standar industri.

---

## 🤖 Tim Kolaborasi Proyek
* **SUNU SETYO JATI** (`@DreamInLogic`) — *Project Manager, Core Lead Developer, & UML Designer*
  * Bertanggung jawab penuh atas manajemen repositori, perancangan diagram kelas, arsitektur *Multi-Layer*, dan integrasi antarmuka utama (`index.php`).
* **GEMINI (AI COLLABORATOR)** — *Software Co-Architect & Quality Assurance (QA)*
  * Bertanggung jawab mendampingi penataan koordinat XML Draw.io agar presisi, melakukan peninjauan kode (*code review*), serta memastikan penerapan 4 pilar OOP berjalan dengan sempurna.

---

## 📐 Arsitektur Sistem (Enterprise Multi-Layer Class Diagram)

Untuk menghindari masalah *spaghetti code*, arsitektur sistem ini dirancang dengan pendekatan berlapis (*layered architecture*) yang memisahkan antara infrastruktur data, model domain bisnis, dan lapisan tampilan (View):

class diagram.drawio.svg

---

## 🗂️ Struktur Direktori & Analisis Fungsi Berkas

Proyek ini dibagi ke dalam struktur folder modular untuk memisahkan tanggung jawab (*Separation of Concerns*). Berikut adalah rincian isi dan fungsi dari setiap berkas program:

```text
pbo_showroom/
│
├── config/
│   └── Database.php             # Data Access Layer (DAL)
│
├── core/
│   ├── Kendaraan.php            # Abstract Parent Class (Domain Model)
│   ├── MobilKonvensional.php    # Subclass / Turunan Kendaraan
│   ├── MobilListrik.php         # Subclass / Turunan Kendaraan
│   └── MotorBesar.php           # Subclass / Turunan Kendaraan
│
├── controller/
│   └── ManajemenShowroom.php    # Controller / Logic Handler
│
├── database/
│   └── showroom_db.sql          # Script Struktur & Data Basis Data
│
└── index.php                    # Presentation Layer / Dashboard View

```

### 1. Lapisan Infrastruktur & Data Access Layer (DAL)

* **`database/showroom_db.sql`**
* **Fungsi:** Menyimpan skrip DDL/DML untuk menginisialisasi basis data di MySQL.
* **Di dalam file ini:** Struktur tabel kendaraan (ID, brand, model, tahun, harga, status pajak, lama menunggak, serta kolom spesifik seperti cc, bbm, baterai, rantai) dan beberapa data sampel (*dummy data*) siap pakai.


* **`config/Database.php`**
* **Fungsi:** Mengelola gerbang koneksi tunggal aman ke server MySQL menggunakan driver PDO.
* **Di dalam file ini:** Atribut enkapsulasi seperti `-host`, `-username`, `-password`, `-dbname`, dan properti publik `+conn`. Berisi metode `+__construct()` yang otomatis menyalakan koneksi via blok `try-catch` saat kelas ini diinstansiasi.



### 2. Lapisan Inti Domain Model (Pilar Abstraksi & Pewarisan)

* **`core/Kendaraan.php`**
* **Fungsi:** Sebagai *Abstract Parent Class* (induk) yang menetapkan standar atribut dan kontrak metode untuk seluruh jenis armada showroom.
* **Di dalam file ini:** Properti bersama berhak akses `#protected` (`id_kendaraan`, `brand`, `model`, `tahun`, `hargaDasar`, `statusPajak`, `lamaMenunggak`). Memiliki metode konkret (*Getter*) serta dua metode murni *abstract* tanpa tubuh: `+hitungPajakTahunan()` dan `+tampilkanSpesifikasi()`.


* **`core/MobilKonvensional.php`**
* **Fungsi:** Subclass konkret untuk memodelkan mobil berbasis bahan bakar fosil.
* **Di dalam file ini:** Atribut spesifik `-kapasitasMesin (cc)` dan `-jenisBahanBakar`. Mengimplementasikan secara nyata metode `hitungPajakTahunan()` (berdasarkan rumus CC) dan `tampilkanSpesifikasi()` *(Method Overriding)*.


* **`core/MobilListrik.php`**
* **Fungsi:** Subclass konkret untuk memodelkan kendaraan ramah lingkungan bertenaga baterai.
* **Di dalam file ini:** Atribut spesifik `-kapasitasBaterai` dan `-jarakTempuh`. Mengimplementasikan metode kalkulasi pajak tahunan yang telah disesuaikan dengan program insentif pajak murah dari pemerintah.


* **`core/MotorBesar.php`**
* **Fungsi:** Subclass konkret untuk memodelkan motor premium berdaya tinggi (Moge).
* **Di dalam file ini:** Atribut spesifik `-tipeRantai` dan `-modeBerkendara`. Mengimplementasikan kalkulasi denda dan beban pajak khusus kendaraan roda dua segmen premium.



### 3. Lapisan Pengendali & Tampilan (Controller & View Layer)

* **`controller/ManajemenShowroom.php`**
* **Fungsi:** Sebagai pengontrol pusat (*engine*) yang bertindak menjembatani data mentah dari database dengan objek-objek OOP.
* **Di dalam file ini:** Memiliki atribut `-db` (koneksi) dan `-daftarKendaraan` (array kumpulan objek). Berisi metode `+muatDataInventaris(search)` untuk menarik data dari MySQL, lalu melakukan instansiasi objek dinamis (apakah menjadi `MobilListrik` atau `MotorBesar` tergantung kolom tipe di DB) lalu memasukkannya ke dalam *Polymorphic Array*.


* **`index.php`**
* **Fungsi:** Lapisan *Presentation Layer* utama yang bertugas merender UI dashboard modern di browser user.
* **Di dalam file ini:** Menangkap input pencarian `$_GET['search']`, memanggil mesin `ManajemenShowroom`, melakukan perulangan (*looping*) objek untuk memicu fungsi polimorfi `.hitungTotalBebanFiskal()`, serta menyajikan statistik ringkas (total unit, jumlah unit pajak mati, total tanggungan kas showroom) secara visual menggunakan komponen HTML/CSS.



---

## 🧬 Implementasi Empat Pilar OOP Berdasarkan Hasil Diskusi Tim

Melalui sesi diskusi dan kolaborasi bersama Gemini AI, sistem ini berhasil menerapkan empat pilar utama Pemrograman Berorientasi Objek secara komprehensif:

### 1. Abstraction (Abstraksi)

Penerapan *Abstract Class* pada `Kendaraan` berfungsi sebagai cetak biru murni yang mengunci kontrak metode wajib untuk semua jenis kendaraan. Metode `hitungPajakTahunan()` dan `tampilkanSpesifikasi()` dideklarasikan sebagai fungsi abstrak tanpa tubuh.

### 2. Inheritance (Pewarisan)

Subkelas `MobilKonvensional`, `MobilListrik`, dan `MotorBesar` menggunakan keyword `extends` untuk mewarisi seluruh properti dasar (seperti `brand`, `model`, `hargaDasar`) dari kelas induk `Kendaraan`. Hal ini memangkas redundansi kode secara signifikan.

### 3. Encapsulation (Enkapsulasi)

Seluruh properti sensitif dilindungi menggunakan hak akses `protected` pada kelas induk dan `private` pada subkelas. Data hanya dapat diakses atau dimodifikasi dari luar lingkungan kelas menggunakan metode perantara resmi (*Getter & Setter*).

### 4. Polymorphism (Polimorfisme)

Diterapkan melalui teknik *Method Overriding*. Tiga subkelas kendaraan menulis ulang fungsi `hitungPajakTahunan()` untuk menyisipkan rumus kalkulasi biaya fiscal yang berbeda (misalnya: insentif pajak murah khusus untuk `MobilListrik` berbasis kapasitas baterai, dibandingkan tarif progresif untuk `MobilKonvensional` berbasis CC).

---

## 📈 Log Aktivitas Pengembangan & Git Commit (`@DreamInLogic`)

Tabel di bawah ini merekam jejak langkah pengerjaan saya dalam membangun dan merapikan repositori `pbo_showroom`:

| Tahap | Aktivitas Utama Bersama AI Collaborator | Status |
| --- | --- | --- |
| 1 | Inisiasi awal repositori GitHub `pbo_showroom.git` dan penentuan struktur folder. | `Done` |
| 2 | Merancang arsitektur diagram kelas terintegrasi (UC-1 sampai UC-4) di Draw.io. | `Done` |
| 3 | Optimasi tata letak diagram kelas (XML) bersama Gemini untuk membuang garis relasi yang bersilangan. | `Done` |
| 4 | Pemetaan fungsi rinci berkas (DAL, Core Model, Controller, View) ke dalam dokumentasi. | `Done` |
| 5 | Eksperimen penulisan kode program PHP (Core Model & View Dashboard). | `In Progress` |

---

*Dokumen ini merupakan jurnal resmi proyek sandbox yang dikelola secara mandiri oleh Sunu Setyo Jati bersama Gemini AI.*

```