<?php
include 'config.php';

if (isset($_GET['id'])) {
    $no_faktur = $_GET['id'];

    $sql = "DELETE FROM trans_jual WHERE no_faktur = $no_faktur";

    if ($conn->query($sql) === TRUE) {
        echo "pembayaran berhasil dihapus";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
    header("Location: tambah_trans_jual.php");
    exit();
} else {
    echo "ID trans tidak ditemukan.";
}
?>
