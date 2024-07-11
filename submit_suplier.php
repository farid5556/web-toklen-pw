<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode_suplier = $_POST['kode_suplier'];
    $nama_suplier = $_POST['nama_suplier'];
    $kota = $_POST['kota'];
    $alamat = $_POST['alamat'];
    $kode_pos = $_POST['kode_pos'];
    $telp = $_POST['telp'];
    $email = $_POST['email'];

    // Cek apakah kode suplier sudah ada di database
    $sql_check = "SELECT * FROM suplier WHERE kode_suplier = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $kode_suplier);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // Kode suplier sudah ada
        echo "Data ini sudah digunakan.";
    } else {
        // Kode suplier belum ada, lanjutkan proses penyimpanan
        $stmt_insert = $conn->prepare("INSERT INTO suplier (kode_suplier, nama_suplier, kota, alamat, kode_pos, telp, email) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt_insert->bind_param("sssssss", $kode_suplier, $nama_suplier, $kota, $alamat, $kode_pos, $telp, $email);

        if ($stmt_insert->execute()) {
            echo "Data suplier berhasil ditambahkan";
        } else {
            echo "Error: " . $stmt_insert->error;
        }

        $stmt_insert->close();
    }

    $stmt_check->close();
    $conn->close();
}
?>

<a href="tambah_suplier.php">Kembali</a>
