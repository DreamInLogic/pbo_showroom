<?php
require_once 'ManajemenShowroom.php';

$showroom = new ManajemenShowroom();
$keyword = isset($_GET['search']) ? $_GET['search'] : '';
$showroom->muatDataInventaris($keyword);
$inventaris = $showroom->getDaftarKendaraan();

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Showroomku - Management System</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { display: flex; background-color: #f4f6f9; min-height: 100vh; }
        
        /* Sidebar Styling */
        .sidebar { width: 260px; background-color: #1e293b; color: #fff; padding: 20px 10px; min-height: 100vh; position: fixed; }
        .sidebar h2 { text-align: center; margin-bottom: 30px; font-size: 22px; color: #38bdf8; }
        .menu-item { display: block; padding: 12px 15px; color: #cbd5e1; text-decoration: none; border-radius: 6px; margin-bottom: 5px; font-weight: 500; cursor: pointer; }
        .menu-item:hover, .menu-item.active { background-color: #334155; color: #fff; }
        
        /* Dropdown Sub-menu */
        .submenu { display: none; padding-left: 20px; background-color: #0f172a; border-radius: 6px; margin-bottom: 5px; }
        .submenu a { display: block; padding: 10px; color: #94a3b8; text-decoration: none; font-size: 14px; }
        .submenu a:hover, .submenu a.sub-active { color: #38bdf8; font-weight: bold; }
        .show { display: block; }

        /* Main Content Styling */
        .content { flex: 1; padding: 30px; margin-left: 260px; }
        
        /* Top Bar Styling */
        .top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; background: white; padding: 15px 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .search-form { display: flex; gap: 10px; width: 400px; }
        .search-input { flex: 1; padding: 8px 15px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; }
        .search-btn { padding: 8px 15px; background-color: #0284c7; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; }
        .search-btn:hover { background-color: #0369a1; }

        /* Dashboard Card Widgets */
        .card-summary { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 30px; }
        .card { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); border-left: 5px solid #6366f1; }
        .card.aktif { border-left-color: #22c55e; }
        .card.mati { border-left-color: #ef4444; }
        .card.finansial { border-left-color: #f59e0b; grid-column: span 3; background-color: #fffbeb; }
        .card h3 { font-size: 13px; color: #64748b; text-transform: uppercase; margin-bottom: 5px; letter-spacing: 0.5px; }
        .card p { font-size: 26px; font-weight: bold; color: #1e293b; }

        /* Table Styling */
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); margin-top: 15px; }
        th, td { padding: 14px; text-align: left; border-bottom: 1px solid #e2e8f0; }
        th { background-color: #334155; color: white; font-weight: 600; }
        tr:hover { background-color: #f8fafc; }
        
        .badge { padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: bold; text-transform: uppercase; }
        .badge.aktif { background-color: #dcfce7; color: #166534; }
        .badge.mati { background-color: #fee2e2; color: #991b1b; }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>🚗 Showroomku</h2>
        <a href="index.php?page=dashboard" class="menu-item <?= $page=='dashboard'?'active':'' ?>">Dashboard</a>
        
        <div class="menu-item" onclick="toggleDropdown('unitDropdown')">📦 Unit Kendaraan ▾</div>
        <div id="unitDropdown" class="submenu <?= in_array($page, ['konvensional', 'listrik', 'motor_besar'])?'show':'' ?>">
            <a href="index.php?page=konvensional" class="<?= $page=='konvensional'?'sub-active':'' ?>">Mobil Konvensional</a>
            <a href="index.php?page=listrik" class="<?= $page=='listrik'?'sub-active':'' ?>">Mobil Listrik</a>
            <a href="index.php?page=motor_besar" class="<?= $page=='motor_besar'?'sub-active':'' ?>">Motor Besar</a>
        </div>

        <div class="menu-item" onclick="toggleDropdown('pajakDropdown')">📊 Manajemen Pajak ▾</div>
        <div id="pajakDropdown" class="submenu <?= in_array($page, ['pajak_aktif', 'pajak_mati'])?'show':'' ?>">
            <a href="index.php?page=pajak_aktif" class="<?= $page=='pajak_aktif'?'sub-active':'' ?>">Pajak Aktif</a>
            <a href="index.php?page=pajak_mati" class="<?= $page=='pajak_mati'?'sub-active':'' ?>">Pajak Mati / Denda</a>
        </div>
    </div>

    <div class="content">
        
        <div class="top-bar">
            <h3 style="color:#0284c7; font-weight: bold;">💎 Showroomku Smart Dashboard</h3>
            <form action="index.php" method="GET" class="search-form">
                <input type="hidden" name="page" value="<?= htmlspecialchars($page) ?>">
                <input type="text" name="search" class="search-input" placeholder="Cari unit, spek, brand atau jenis..." value="<?= htmlspecialchars($keyword) ?>">
                <button type="submit" class="search-btn">Cari</button>
            </form>
        </div>

        <?php
        // HITUNG AGREGASI STATISTIK UTAMA
        $jumlahTotalUnit = 0;
        $jumlahPajakAktif = 0;
        $jumlahPajakMati = 0;
        $totalPajakShowroom = 0;
        $totalTanggunganPembeli = 0;

        foreach ($inventaris as $k) {
            $jumlahTotalUnit++;
            if ($k->getStatusPajak() === 'aktif') {
                $jumlahPajakAktif++;
                $totalPajakShowroom += $k->hitungPajakTahunan();
            } else {
                $jumlahPajakMati++;
                $totalTanggunganPembeli += $k->hitungTotalBebanFiskal();
            }
        }
        ?>

        <div class="card-summary">
            <div class="card">
                <h3>Total Inventaris Showroom</h3>
                <p><?= $jumlahTotalUnit ?> Unit</p>
            </div>
            <div class="card aktif">
                <h3>Unit Pajak Aktif</h3>
                <p><?= $jumlahPajakAktif ?> Unit</p>
            </div>
            <div class="card mati">
                <h3>Unit Pajak Menunggak</h3>
                <p><?= $jumlahPajakMati ?> Unit</p>
            </div>

            <?php if(in_array($page, ['pajak_aktif', 'pajak_mati'])): ?>
                <div class="card finansial">
                    <?php if($page == 'pajak_aktif'): ?>
                        <h3>💰 Total Beban Pajak Pokok yang Sedang Ditanggung Showroom</h3>
                        <p style="color: #166534;">Rp <?= number_format($totalPajakShowroom, 0, ',', '.') ?> / Tahun</p>
                    <?php else: ?>
                        <h3>⚠️ Total Pajak + Akumulasi Denda Ditanggung Pembeli (Jika Membeli Unit Pajak Mati)</h3>
                        <p style="color: #991b1b;">Rp <?= number_format($totalTanggunganPembeli, 0, ',', '.') ?></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

        <?php if(!empty($keyword)): ?>
            <p style="margin-bottom: 15px; color: #0284c7;">🔍 Hasil pencarian untuk: <strong>"<?= htmlspecialchars($keyword) ?>"</strong> (<a href="index.php?page=<?= $page ?>">Reset</a>)</p>
        <?php endif; ?>

        <h2>
            <?php 
                if($page == 'dashboard') echo "Semua Daftar Inventaris Kendaraan";
                elseif($page == 'pajak_aktif') echo "Manajemen Fiskal: Unit Pajak Aktif";
                elseif($page == 'pajak_mati') echo "Manajemen Fiskal: Unit Menunggak (Pajak Mati & Denda)";
                else echo "Kategori Unit: " . ucfirst(str_replace('_', ' ', $page));
            ?>
        </h2>

        <table>
            <thead>
                <tr>
                    <th>Unit Kendaraan</th>
                    <th>Spesifikasi Teknis</th>
                    <th>Status Fiskal</th>
                    <?php if(in_array($page, ['pajak_aktif', 'pajak_mati'])): ?>
                        <th>Pajak Pokok / Tahun</th>
                        <?php if($page == 'pajak_mati'): ?>
                            <th>Lama Menunggak</th>
                            <th>Total Denda</th>
                        <?php endif; ?>
                        <th>Total Tagihan</th>
                        <th>Penanggung</th>
                    <?php else: ?>
                        <th>Harga Dasar</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $barisTampil = 0;
                foreach ($inventaris as $k) {
                    $class_name = get_class($k);
                    
                    // Filter berdasarkan menu halaman
                    if ($page == 'konvensional' && $class_name != 'MobilKonvensional') continue;
                    if ($page == 'listrik' && $class_name != 'MobilListrik') continue;
                    if ($page == 'motor_besar' && $class_name != 'MotorBesar') continue;
                    if ($page == 'pajak_aktif' && $k->getStatusPajak() != 'aktif') continue;
                    if ($page == 'pajak_mati' && $k->getStatusPajak() != 'mati') continue;

                    $barisTampil++;
                    echo "<tr>";
                    echo "<td><strong>{$k->getBrand()}</strong> - {$k->getModel()} ({$k->getTahun()})</td>";
                    echo "<td>" . $k->tampilkanSpesifikasi() . "</td>";
                    echo "<td><span class='badge {$k->getStatusPajak()}'>{$k->getStatusPajak()}</span></td>";

                    // REVISI: Menu Kendaraan TIDAK menampilkan total pajak (hanya harga dasar)
                    if (in_array($page, ['pajak_aktif', 'pajak_mati'])) {
                        $penanggung = ($k->getStatusPajak() == 'aktif') ? "Showroom" : "Pembeli Baru";
                        echo "<td>Rp " . number_format($k->hitungPajakTahunan(), 0, ',', '.') . "</td>";
                        
                        if($page == 'pajak_mati') {
                            echo "<td style='color:orange; font-weight:bold;'>{$k->getLamaMenunggak()} Tahun</td>";
                            echo "<td style='color:red;'>Rp " . number_format($k->hitungDendaPajak(), 0, ',', '.') . "</td>";
                        }
                        
                        echo "<td style='font-weight:bold;'>Rp " . number_format($k->hitungTotalBebanFiskal(), 0, ',', '.') . "</td>";
                        echo "<td><strong>{$penanggung}</strong></td>";
                    } else {
                        echo "<td>Rp " . number_format($k->getHargaDasar(), 0, ',', '.') . "</td>";
                    }
                    echo "</tr>";
                }

                if($barisTampil === 0) {
                    echo "<tr><td colspan='7' style='text-align:center; color:#64748b; padding:30px;'>Data unit tidak ditemukan.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function toggleDropdown(id) {
            var dropdown = document.getElementById(id);
            dropdown.classList.toggle("show");
        }
    </script>
</body>
</html>