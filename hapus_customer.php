<?php
include 'config.php';

if (isset($_GET['id'])) {
    $kode_custo = $_GET['id'];

    $sql = "DELETE FROM customer WHERE kode_custo = $kode_custo";

    if ($conn->query($sql) === TRUE) {
        echo "customer berhasil dihapus";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
    header("Location: tambah_customer.php");
    exit();
} else {
    echo "data customer tidak ditemukan.";
}
?>
