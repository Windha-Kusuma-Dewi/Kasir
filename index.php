<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> <!-- Menyertakan link ke stylesheet untuk ikon -->
    <link rel="stylesheet" href="index.css"> <!-- Menyertakan link ke stylesheet eksternal -->
</head>
<body>
    <div class="box"> <!-- Kontainer utama -->
        <h1>Masukkan Data Barang</h1>
        <div class="box1"> <!-- Kontainer dalam untuk formulir -->
            <form action="" method="post"> <!-- Formulir untuk memasukkan data barang -->
                <!-- masukkan data nama, harga dan banyak barang -->
                <input type="text" name="nama" id="nama" placeholder="Nama barang" required autocomplete="off"> <!-- Input nama barang -->
                <input type="number" name="harga" id="harga" placeholder="Harga" required autocomplete="off"> <!-- Input harga barang -->
                <input type="number" name="jumlah" id="jumlah" placeholder="Jumlah" required autocomplete="off"><br><br> <!-- Input jumlah barang -->

                <div class="button"> <!-- Div untuk tombol-tombol -->
                    <div class="tambah">
                        <button name="kirim1" value="kirim"><i class='bx bx-basket'></i>Tambah</button> <!-- Tombol untuk menambah data barang -->
                    </div>

                    <div class="hapusSemua">
                        <button name="kirim3" value="kirim"><a href="hapus.php"><i class='bx bx-trash'></i> Hapus Data</a></button> <!-- Tombol untuk menghapus semua data -->
                    </div>
                </div>
            </form>

            <!-- Form untuk menghitung kembalian -->
            <form action="kembalian.php" method="post"> <!-- Formulir untuk menghitung kembalian -->
            <div class="itu">
                <button type="submit"><i class='bx bx-money'></i>Hitung Kembalian</button> <!-- Tombol untuk menghitung kembalian -->
            </div>
            </form>
        </div>

        <?php
        session_start(); // Memulai sesi
        if (!isset($_SESSION["kasir"])) { // Jika sesi "kasir" belum ada
            $_SESSION["kasir"] = array(); // Inisialisasi "kasir" sebagai array kosong
        }

        if (isset($_POST["nama"]) && isset($_POST["harga"]) && isset($_POST["jumlah"])) { // Jika semua input dari formulir diisi
            $total = $_POST['harga'] * $_POST['jumlah']; // Menghitung total harga barang
            $data = array(
                "nama" => $_POST["nama"], // Nama barang
                "harga" => $_POST["harga"], // Harga barang
                "jumlah" => $_POST["jumlah"], // Jumlah barang
                "total" => $total, // Total harga
            );
            array_push($_SESSION["kasir"], $data); // Menambahkan data barang ke dalam sesi "kasir"
        }

        // Proses penghapusan data barang
        if (isset($_GET['page'])) { // Jika parameter "page" ada di URL
            $index = $_GET['page']; // Mendapatkan indeks barang yang akan dihapus
            unset($_SESSION['kasir'][$index]); // Menghapus barang dari sesi berdasarkan indeks
            header('Location: http://windhakusumadewi.liveblog365.com/projectkasir/index.php'); // Redirect ke halaman ini setelah penghapusan
            exit; // Keluar dari skrip
        }

        echo "<table border=1px>"; // Membuat tabel
        echo "<br>";
        echo "<br>";
        echo "<tr>";
        echo "<th>Nama barang</th>"; // Header kolom nama barang
        echo "<th>Harga barang</th>"; // Header kolom harga barang
        echo "<th>Jumlah</th>"; // Header kolom jumlah barang
        echo "<th>Total</th>"; // Header kolom total harga
        echo "<th>Aksi</th>"; // Header kolom aksi
        echo "</tr>";

        $totalSemua = 0; // Inisialisasi total semua harga

        foreach ($_SESSION["kasir"] as $index => $value) { // Loop melalui data barang di sesi
            echo "<tr>";
            echo "<td>" . $value["nama"] . "</td>"; // Menampilkan nama barang
            echo "<td>" . $value["harga"] . "</td>"; // Menampilkan harga barang
            echo "<td>" . $value["jumlah"] . "</td>"; // Menampilkan jumlah barang
            echo "<td>" . "Rp " . number_format((isset($value["total"]) ? $value["total"] : ''), 0, ",", ".") . "</td>"; // Menampilkan total harga barang
            echo "<td><a href='?page=" . $index . "'><i class='bx bx-trash'></i>Hapus</a></td>"; // Tombol untuk menghapus barang
            echo "</tr>";

            $totalSemua += $value["total"]; // Menambahkan total harga barang ke total semua
        }

        echo "<tr>";
        echo "<td colspan='3'><strong>Total Semua</strong></td>"; // Baris untuk total semua
        echo "<td>" . "Rp " . number_format($totalSemua, 0, ",", ".") . "</td>"; // Menampilkan total semua harga
        echo "<td></td>"; // Kolom aksi kosong
        echo "</tr>";

        echo "</table>"; // Menutup tabel
        ?>

    </div>
</body>
</html>
