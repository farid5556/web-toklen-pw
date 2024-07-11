<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode_produk = $_POST['kode_produk'];
    $nama_produk = $_POST['nama_produk'];
    $jenis_produk = $_POST['jenis_produk'];
    $stok = $_POST['stok'];
    $satuan = $_POST['satuan'];
    $harga = $_POST['harga'];

    $stmt = $conn->prepare("UPDATE produk SET nama_produk=?, jenis_produk=?, stok=?, satuan=?, harga=? WHERE kode_produk=?");
    $stmt->bind_param("ssisss", $nama_produk, $jenis_produk, $stok, $satuan, $harga, $kode_produk);

    if ($stmt->execute()) {
        echo "produk berhasil diperbarui";
        header("Location: tambah_produk.php"); 
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Metode request tidak valid.";
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Edit Data produk</title>
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

        input[type="number"], select {
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
        <h2>Edit Data produk</h2>
        <?php
        include 'config.php';

        if (isset($_GET['id'])) {
            $kode_produk = $_GET['id'];
            $sql = "SELECT * FROM produk WHERE kode_produk = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $kode_produk);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
        ?>
        <form method="POST" action="edit_produk.php">
            <input type="hidden" name="kode_produk" value="<?php echo $row['kode_produk']; ?>" required>
            <div class="form-group">
                <label for="nama_produk">Nama produk:</label>
                <input type="text" id="nama_produk" name="nama_produk" value="<?php echo $row['nama_produk']; ?>" required>
            </div>
            <div class="form-group">
                <label for="jenis_produk">Jenis produk:</label>
                <input type="text" id="jenis_produk" name="jenis_produk" value="<?php echo $row['jenis_produk']; ?>" required>
            </div>
            <div class="form-group">
            <label for="stok">Stok:</label>
            <input type="number" id="stok" name="stok" value="<?php echo $row['stok']; ?>" required>
            </div>
            <div class="form-group">
            <label for="satuan">Satuan:</label>
            <input type="text" id="satuan" name="satuan" value="<?php echo $row['satuan']; ?>" required>
            </div>
            <div class="form-group">
            <label for="harga">Harga:</label>
            <input type="number" id="harga" name="harga" value="<?php echo $row['harga']; ?>" required>
            </div>
            <button type="submit">Update</button>
        </form>
        <?php
            } else {
                echo "produk tidak ditemukan.";
            }
            $stmt->close();
            $conn->close();
        } else {
            echo "data produk tidak diberikan.";
        }
        ?>
        <div class="back-button">
            <a href="tambah_produk.php">Back</a>
        </div>
    </div>
</body>
</html>
