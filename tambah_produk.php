<?php
include 'config.php';

$message = "";

// Periksa koneksi database
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode_produk = $_POST['kode_produk'];
    $nama_produk = $_POST['nama_produk'];
    $jenis_produk = $_POST['jenis_produk'];
    $stok = $_POST['stok'];
    $satuan = $_POST['satuan'];
    $harga = $_POST['harga'];

    // Cek apakah kode produk sudah ada di database
    $sql = "SELECT * FROM produk WHERE kode_produk = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare statement gagal: " . $conn->error);
    }
    
    $stmt->bind_param("s", $kode_produk);
    if (!$stmt->execute()) {
        die("Eksekusi statement gagal: " . $stmt->error);
    }
    
    $result = $stmt->get_result();
    
    if ($result === false) {
        die("Get result gagal: " . $stmt->error);
    }

    if ($result->num_rows > 0) {
        // Kode produk sudah ada
        $message = "Maaf, Kode yang anda masukkan sudah ada. Silakan masukkan ulang kode yang berbeda.";
    } else {
        // Kode produk belum ada, lanjutkan proses penyimpanan
        $sql = "INSERT INTO produk (kode_produk, nama_produk, jenis_produk, stok, satuan, harga) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Prepare statement gagal: " . $conn->error);
        }
        
        $stmt->bind_param("ssssss", $kode_produk, $nama_produk, $jenis_produk, $stok, $satuan, $harga);
        
        if ($stmt->execute()) {
            $message = "Produk berhasil ditambahkan.";
        } else {
            $message = "Terjadi kesalahan saat menambahkan produk. Silakan coba lagi.";
        }
    }

    $stmt->close();
    $conn->close(); // Tutup koneksi database setelah operasi selesai
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header style="background-color: #430404;">
            <div class="logo">SIMH</div>
            <nav>
                <ul>
                    <li><a href="index.php" style="font-weight: bold;">Kembali</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <h1>Produk</h1>
            <table>
                <thead>
                    <tr>
                        <th style="background-color: #430404;">Kode Produk</th>
                        <th style="background-color: #430404;">Nama Produk</th>
                        <th style="background-color: #430404;">Jenis Produk</th>
                        <th style="background-color: #430404;">Stok</th>
                        <th style="background-color: #430404;">Satuan</th>
                        <th style="background-color: #430404;">Harga</th>
                        <th style="background-color: #430404;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Buka koneksi baru untuk menampilkan data
                    include 'config.php';

                    if ($conn->connect_error) {
                        die("Koneksi database gagal: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM produk";
                    $result = $conn->query($sql);

                    if ($result === false) {
                        die("Query gagal: " . $conn->error);
                    }

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["kode_produk"] . "</td>";
                            echo "<td>" . $row["nama_produk"] . "</td>";
                            echo "<td>" . $row["jenis_produk"] . "</td>";
                            echo "<td>" . $row["stok"] . "</td>";
                            echo "<td>" . $row["satuan"] . "</td>";
                            echo "<td>" . $row["harga"] . "</td>";
                            echo '<td>';
                            echo '<button class="edit" onclick="window.location.href=\'edit_produk.php?id=' . $row['kode_produk'] . '\'">Edit</button> ';
                            echo '<button class="delete" onclick="confirmDelete(' . $row['kode_produk'] . ')">Hapus</button>';
                            echo '</td>';
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>Tidak ada data produk.</td></tr>";
                    }

                    $conn->close(); // Tutup koneksi database setelah operasi selesai
                    ?>
                </tbody>
            </table>

            <h1>Tambah Produk</h1>
            <?php
            if (!empty($message)) {
                echo "<p>$message</p>";
            }
            ?>
            <form action="submit_produk.php" method="post">
                <div class="form-group">
                    <label for="kode_produk">Kode Produk:</label>
                    <input type="number" id="kode_produk" name="kode_produk" required>
                </div>
                <div class="form-group">
                    <label for="nama_produk">Nama Produk:</label>
                    <input type="text" id="nama_produk" name="nama_produk" required>
                </div>
                <div class="form-group">
                    <label for="jenis_produk">Jenis Produk:</label>
                    <input type="text" id="jenis_produk" name="jenis_produk" required>
                </div>
                <div class="form-group">
                    <label for="stok">Stok:</label>
                    <input type="number" id="stok" name="stok" required>
                </div>
                <div class="form-group">
                    <label for="satuan">Satuan:</label>
                    <input type="text" id="satuan" name="satuan" required>
                </div>
                <div class="form-group">
                    <label for="harga">Harga:</label>
                    <input type="number" id="harga" name="harga" required>
                </div>
                <button type="submit" style="background-color: #430404;">Tambah Produk</button>
            </form>
        </main>
    </div>
    <script>
        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
                window.location.href = 'hapus_produk.php?id=' + id;
            }
        }
    </script>
</body>
</html>
