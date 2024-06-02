<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="struk.css">
</head>
<body>
    <div class="container">
        <h1>Struk Pembayaran</h1>
        <table>
            <tr>
                <th>Nama Barang</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>
            <?php 
            session_start(); // Memulai sesi PHP
            if (isset($_SESSION["kasir"])) { // Memeriksa apakah ada data belanja dalam sesi
                foreach ($_SESSION["kasir"] as $index => $value) : // Melooping setiap barang dalam sesi
                   echo "<tr>"; // Memulai baris tabel
                   echo  "<td>" . $value["nama"] . "</td>"; // Menampilkan nama barang
                   echo  "<td>" . "Rp " . number_format($value["harga"], 0, ",", ".") . "</td>"; // Menampilkan harga satuan dengan format Rupiah
                   echo "<td>" . $value["jumlah"] . "</td>"; // Menampilkan jumlah barang
                   echo "<td>" . "Rp " . number_format($value["total"], 0, ",", ".") . "</td>"; // Menampilkan total harga dengan format Rupiah
                   echo "</tr>"; // Mengakhiri baris tabel
                endforeach; // Mengakhiri loop foreach

                // Hitung total semua
                $totalSemua = 0;
                foreach ($_SESSION["kasir"] as $item) {
                    $totalSemua += $item["total"]; // Menjumlahkan total harga setiap barang
                }

                echo "<tr>
                        <td colspan='3' class='total'>Total Semua</td> <!-- Sel untuk total semua -->
                        <td class='total'>Rp " . number_format($totalSemua, 0, ",", ".") . "</td> <!-- Menampilkan total semua dengan format Rupiah -->
                    </tr>";
            } else {
                echo "<tr><td colspan='4'>Tidak ada data belanja.</td></tr>"; // Menampilkan pesan jika tidak ada data belanja
            }
            ?>
        </table>

        <div class="kembali">
            <button><a href="index.php"><i class='bx bx-arrow-back'></i> KEMBALI</a></button>
            <button onclick="window.print()">CETAK STRUK</button>
        </div>
    </div>
</body>
</html>
