<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode_custo = $_POST['kode_custo'];
    $nama_cus = $_POST['nama_cus'];
    $kota = $_POST['kota'];
    $alamat = $_POST['alamat'];
    $kode_pos = $_POST['kode_pos'];
    $telp = $_POST['telp'];
    $email = $_POST['email'];

    $sql_check = "SELECT * FROM customer WHERE kode_custo = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $kode_custo);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        echo "Data ini sudah digunakan.";
    } else {
        $stmt_insert = $conn->prepare("INSERT INTO customer (kode_custo, nama_cus, kota, alamat, kode_pos, telp, email) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt_insert->bind_param("sssssss", $kode_custo, $nama_cus, $kota, $alamat, $kode_pos, $telp, $email);

        if ($stmt_insert->execute()) {
            echo "Data customer berhasil ditambahkan";
        } else {
            echo "Error: " . $stmt_insert->error;
        }

        $stmt_insert->close();
    }

    $stmt_check->close();
    $conn->close();
}
?>

<a href="tambah_customer.php">Kembali</a>
