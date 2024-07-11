<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $no_faktur = $_POST['no_faktur'];
    $kode_produk = $_POST['kode_produk'];
    $kode_suplier = $_POST['kode_suplier'];
    $tgl_trans = $_POST['tgl_trans'];
    $jlh_trans = $_POST['jlh_trans'];

    $stmt = $conn->prepare("UPDATE trans_beli SET kode_produk=?, kode_suplier=?, tgl_trans=?, jlh_trans=? WHERE no_faktur=?");
    $stmt->bind_param("ssssi", $kode_produk, $kode_suplier, $tgl_trans, $jlh_trans, $no_faktur);

    if ($stmt->execute()) {
        header("Location: tambah_trans_beli.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    $no_faktur = $_GET['id'];
    $sql = "SELECT * FROM trans_beli WHERE no_faktur=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $no_faktur);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data beli</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
        }

        h2 {
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 10px;
        }

        input[type="number"], input[type="text"], input[type="date"] {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            opacity: 0.8;
        }

        .back-button {
            margin-top: 20px;
            text-align: center;
        }

        .back-button a {
            text-decoration: none;
            color: white;
            background-color: #808080;
            padding: 10px 20px;
            border-radius: 4px;
        }

        .back-button a:hover {
            background-color: #666666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Data Pembayaran</h2>
        <form method="POST" action="edit_trans_beli.php">
            <div class="form-group">
                <label for="no_faktur">no faktur :</label>
                <input type="number" id="no_faktur" name="no_faktur" value="<?php echo $row['no_faktur']; ?>" required>
            </div>
            <div class="form-group">
                <label for="kode_produk">kode produk:</label>
                <input type="number" id="kode_produk" name="kode_produk" value="<?php echo $row['kode_produk']; ?>" required>
            </div>
            <div class="form-group">
                <label for="kode_suplier">kode suplier:</label>
                <input type="number" id="kode_suplier" name="kode_suplier" value="<?php echo $row['kode_suplier']; ?>" required>
            </div>
            <div class="form-group">
                <label for="tgl_trans">tanggal transaksi:</label>
                <input type="text" id="tgl_trans" name="tgl_trans" value="<?php echo $row['tgl_trans']; ?>" required>
            </div>
            <div class="form-group">
                <label for="jlh_trans">jumlah transaksi:</label>
                <input type="number" id="jlh_trans" name="jlh_trans" value="<?php echo $row['jlh_trans']; ?>" required>
            </div>
            <button type="submit">Update beli</button>
        </form>
        <div class="back-button">
            <a href="tambah_trans_beli.php">Back</a>
        </div>
    </div>
</body>
</html>
