<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode_custo = $_POST['kode_custo'];
    $nama_cus = $_POST['nama_cus'];
    $kota = $_POST['kota'];
    $alamat = $_POST['alamat'];
    $kode_pos = $_POST['kode_pos'];
    $telp = $_POST['telp'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE customer SET nama_cus=?, kota=?, alamat=?, kode_pos=?, telp=?, email=? WHERE kode_custo=?");
    $stmt->bind_param("sssssss", $nama_cus, $kota, $alamat, $kode_pos, $telp, $email, $kode_custo);

    if ($stmt->execute()) {
        header("Location: tambah_customer.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    $kode_custo = $_GET['id'];
    $sql = "SELECT * FROM customer WHERE kode_custo=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $kode_custo);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data customer</title>
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

        input[type="number"], input[type="text"], select {
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
        <h2>Edit Data customer</h2>
        <form method="POST" action="edit_customer.php">
            <div class="form-group">
                <label for="kode_custo">kode customer:</label>
                <input type="number" id="kode_custo" name="kode_custo" value="<?php echo $row['kode_custo']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="nama_cus">nama:</label>
                <input type="text" id="nama_cus" name="nama_cus" value="<?php echo $row['nama_cus']; ?>" required>
            </div>
            <div class="form-group">
                <label for="kota">kota:</label>
                <input type="text" id="kota" name="kota" value="<?php echo $row['kota']; ?>" required>
            </div>
            <div class="form-group">
                <label for="alamat">alamat:</label>
                <input type="text" id="alamat" name="alamat" value="<?php echo $row['alamat']; ?>" required>
            </div>
            <div class="form-group">
                <label for="kode_pos">kode pos:</label>
                <input type="number" id="kode_pos" name="kode_pos" value="<?php echo $row['kode_pos']; ?>" required>
            </div>
            <div class="form-group">
                <label for="telp">telpon:</label>
                <input type="number" id="telp" name="telp" value="<?php echo $row['telp']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">email:</label>
                <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>
            </div>
            <button type="submit">Update customer</button>
        </form>
        <div class="back-button">
            <a href="tambah_customer.php">Back</a>
        </div>
    </div>
</body>
</html>
