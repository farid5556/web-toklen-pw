<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $no_faktur = $_POST['no_faktur'];
    $kode_produk = $_POST['kode_produk'];
    $kode_suplier = $_POST['kode_suplier'];
    $tgl_trans = $_POST['tgl_trans'];
    $jlh_trans = $_POST['jlh_trans'];

    $sql_check = "SELECT * FROM trans_beli WHERE no_faktur = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $no_faktur);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        echo "Data ini sudah digunakan.";
    } else {
        $stmt_insert = $conn->prepare("INSERT INTO trans_beli (no_faktur, kode_produk, kode_suplier, tgl_trans, jlh_trans) 
                                VALUES (?, ?, ?, ?, ?)");
        $stmt_insert->bind_param("sssss", $no_faktur, $kode_produk, $kode_suplier, $tgl_trans, $jlh_trans);

        if ($stmt_insert->execute()) {
            echo "Data transaksi berhasil ditambahkan";
        } else {
            echo "Error: " . $stmt_insert->error;
        }

        $stmt_insert->close();
    }

    $stmt_check->close();
    $conn->close();
}
?>

<a href="tambah_trans_beli.php">Kembali</a>
