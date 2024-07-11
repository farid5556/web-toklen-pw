<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $no_faktur = $_POST['no_faktur'];
    $kode_produk = $_POST['kode_produk'];
    $tgl_trans = $_POST['tgl_trans'];
    $jlh_trans = $_POST['jlh_trans'];

    // Mulai transaksi
    $conn->begin_transaction();

    try {
        // Periksa apakah no faktur sudah ada
        $sql_check = "SELECT * FROM trans_jual WHERE no_faktur = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("s", $no_faktur);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            // No faktur sudah ada
            echo "Data ini sudah digunakan.";
            $conn->rollback();
        } else {
            // No faktur belum ada, lanjutkan proses penyimpanan
            // Periksa stok produk
            $stmt_check_produk = $conn->prepare("SELECT stok FROM produk WHERE kode_produk = ?");
            $stmt_check_produk->bind_param("s", $kode_produk);
            $stmt_check_produk->execute();
            $result_check_produk = $stmt_check_produk->get_result();

            if ($result_check_produk->num_rows > 0) {
                $row_produk = $result_check_produk->fetch_assoc();
                $stok_sekarang = $row_produk['stok'];

                if ($stok_sekarang >= $jlh_trans) {
                    // Kurangi stok produk
                    $stok_baru = $stok_sekarang - $jlh_trans;
                    $stmt_update = $conn->prepare("UPDATE produk SET stok = ? WHERE kode_produk = ?");
                    $stmt_update->bind_param("is", $stok_baru, $kode_produk);
                    $stmt_update->execute();

                    // Simpan transaksi penjualan
                    $stmt_insert = $conn->prepare("INSERT INTO trans_jual (no_faktur, kode_produk, tgl_trans, jlh_trans) 
                                                   VALUES (?, ?, ?, ?)");
                    $stmt_insert->bind_param("sssi", $no_faktur, $kode_produk, $tgl_trans, $jlh_trans);
                    $stmt_insert->execute();

                    // Commit transaksi
                    $conn->commit();
                    echo "Data jual berhasil ditambahkan dan stok berhasil diperbarui";
                } else {
                    echo "Stok produk tidak mencukupi.";
                    $conn->rollback();
                }
            } else {
                echo "Produk tidak ditemukan.";
                $conn->rollback();
            }
        }

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        $conn->rollback();
    }

    
}
?>

<a href="tambah_trans_jual.php">Kembali</a>
