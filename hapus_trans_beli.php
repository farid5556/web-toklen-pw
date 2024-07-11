<?php
include 'config.php';

if (isset($_GET['id'])) {
    $no_faktur = $_GET['id'];

    $sql = "DELETE FROM trans_beli WHERE no_faktur = $no_faktur";

    if ($conn->query($sql) === TRUE) {
        echo "pembelian berhasil dihapus";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
    header("Location: tambah_trans_beli.php");
    exit();
} else {
    echo "pembelian tidak ditemukan.";
}
?>
