<!DOCTYPE html>
<html>
<head>
    <title>Hitung Kembalian</title>
    <style>
        /* Mengatur gaya dasar untuk seluruh halaman */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Mengatur gaya untuk container utama */
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        /* Mengatur gaya untuk judul halaman */
        h1 {
            text-align: center;
            color: #333;
        }

        /* Mengatur gaya untuk form */
        form {
            display: flex;
            flex-direction: column;
        }

        /* Mengatur gaya untuk label */
        label {
            margin-bottom: 5px;
            color: #666;
        }

        /* Mengatur gaya untuk input type number */
        input[type="number"] {
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: calc(100% - 20px);
        }

        /* Mengatur gaya untuk tombol submit */
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        /* Mengatur gaya tombol submit saat dihover */
        input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Mengatur gaya untuk hasil perhitungan */
        .result {
            margin-top: 20px;
            color: #333;
        }

        /* Mengatur gaya untuk tombol */
        button {
            margin-top: 10px;
            background-color: #007BFF;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            display: inline-block;
        }

        /* Mengatur gaya untuk link di dalam tombol */
        button a {
            color: white;
            text-decoration: none;
        }

        /* Mengatur gaya tombol saat dihover */
        button:hover {
            background-color: #0056b3;
        }

        /* Mengatur gaya untuk container tombol */
        .buttons {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hitung Kembalian</h1>
        <form method="POST">
            <label for="total_belanja">Total Belanja:</label>
            <input type="number" id="total_belanja" name="total_belanja" required>
            <label for="uang_dibayar">Uang Dibayar:</label>
            <input type="number" id="uang_dibayar" name="uang_dibayar" required>
            <input type="submit" value="Hitung Kembalian">
        </form>

        <div class="result">
            <?php
            // Memeriksa apakah form telah disubmit
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Memeriksa apakah field total_belanja dan uang_dibayar telah diisi
                if (isset($_POST["total_belanja"]) && isset($_POST["uang_dibayar"])) {
                    // Mengambil nilai dari form
                    $total_belanja = intval($_POST["total_belanja"]);
                    $uang_dibayar = intval($_POST["uang_dibayar"]);

                    // Fungsi untuk menghitung kembalian
                    function hitung_kembalian($total_belanja, $uang_dibayar) {
                        // Array pecahan uang yang tersedia
                        $pecahan_uang = [100000, 50000, 20000, 10000, 5000, 2000, 1000, 500, 200, 100];
                        // Menghitung kembalian
                        $kembalian = $uang_dibayar - $total_belanja;

                        // Jika uang dibayar kurang dari total belanja
                        if ($kembalian < 0) {
                            echo "Uang yang dibayarkan kurang.";
                            return;
                        }

                        // Menampilkan total belanja, uang dibayar, dan kembalian
                        echo "Total belanja: " . $total_belanja . "<br>";
                        echo "Uang dibayar: " . $uang_dibayar . "<br>";
                        echo "Kembalian: " . $kembalian . "<br><br>";
                        echo "Rincian kembalian:<br>";

                        // Array untuk rincian kembalian
                        $rincian_kembalian = [];
                        // Menghitung rincian kembalian berdasarkan pecahan uang
                        foreach ($pecahan_uang as $pecahan) {
                            $jumlah_pecahan = intdiv($kembalian, $pecahan);
                            if ($jumlah_pecahan > 0) {
                                $rincian_kembalian[$pecahan] = $jumlah_pecahan;
                                $kembalian %= $pecahan;
                            }
                        }

                        // Menampilkan rincian kembalian
                        foreach ($rincian_kembalian as $pecahan => $jumlah) {
                            echo "Pecahan " . $pecahan . ": " . $jumlah . " lembar/keping <br>";
                        }
                    }

                    // Memanggil fungsi hitung_kembalian
                    hitung_kembalian($total_belanja, $uang_dibayar);
                } else {
                    echo "Mohon isi semua field.";
                }
            }
            ?>
        </div>

        <div class="buttons">
            <button><a href="index.php">Kembali</a></button>
            <button><a href="struk.php">Cetak Struk</a></button>
        </div>
    </div>
</body>
</html>
