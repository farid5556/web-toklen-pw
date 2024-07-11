<?php
include 'config.php';

if (isset($_GET['id'])) {
    $kode_produk = $_GET['id'];

    $sql = "DELETE FROM produk WHERE kode_produk = $kode_produk";

    if ($conn->query($sql) === TRUE) {
        echo "produk berhasil dihapus";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
    header("Location: tambah_produk.php");
    exit();
} else {
    echo "kode produk tidak ditemukan.";
}
?>
