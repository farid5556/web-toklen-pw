<?php
include 'config.php';

if (isset($_GET['id'])) {
    $kode_suplier = $_GET['id'];

    $sql = "DELETE FROM suplier WHERE kode_suplier = $kode_suplier";

    if ($conn->query($sql) === TRUE) {
        echo "suplier berhasil dihapus";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
    header("Location: tambah_suplier.php");
    exit();
} else {
    echo "data suplier tidak ditemukan.";
}
?>
