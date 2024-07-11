<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode_produk = $_POST['kode_produk'];
    $nama_produk = $_POST['nama_produk'];
    $jenis_produk = $_POST['jenis_produk'];
    $stok = $_POST['stok'];
    $satuan = $_POST['satuan'];
    $harga = $_POST['harga'];

    // Cek apakah kode produk sudah ada di database
    $sql_check = "SELECT * FROM produk WHERE kode_produk = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $kode_produk);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // Kode produk sudah ada
        echo "Data ini sudah digunakan.";
    } else {
        // Kode produk belum ada, lanjutkan proses penyimpanan
        $sql_insert = "INSERT INTO produk (kode_produk, nama_produk, jenis_produk, stok, satuan, harga) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("ssssss", $kode_produk, $nama_produk, $jenis_produk, $stok, $satuan, $harga);

        if ($stmt_insert->execute()) {
            echo "Data produk berhasil ditambahkan";
        } else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    }

    
}
?>

<a href="tambah_produk.php">Kembali</a>
