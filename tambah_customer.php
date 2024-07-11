<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Customer</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header style="background-color: #430404;">
            <div class="logo">BLBLBLBLBL</div>
            <nav >
                <ul>
                    <li><a href="index.php" style="font-weight: bold;">Kembali</a></li>
            </nav>
        </header>
        <main>
            <h1>Data customer</h1>
            <table>
                <thead >
                    <tr >
                        <th style="background-color: #430404;">Kode cutomer</th>
                        <th style="background-color: #430404;">Nama</th>
                        <th style="background-color: #430404;">Kota</th>
                        <th style="background-color: #430404;">Alamat</th>
                        <th style="background-color: #430404;">Kode pos</th>
                        <th style="background-color: #430404;">Telpon</th>
                        <th style="background-color: #430404;">Email</th>
                        <th style="background-color: #430404;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'config.php';

                    $sql = "SELECT * FROM customer";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["kode_custo"] . "</td>";
                            echo "<td>" . $row["nama_cus"] . "</td>";
                            echo "<td>" . $row["kota"] . "</td>";
                            echo "<td>" . $row["alamat"] . "</td>";
                            echo "<td>" . $row["kode_pos"] . "</td>";
                            echo "<td>" . $row["telp"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo '<td>';
                            echo '<button class="edit" onclick="window.location.href=\'edit_customer.php?id=' . $row['kode_custo'] . '\'">Edit</button> ';
                            echo '<button class="delete" onclick="confirmDelete(' . $row['kode_custo'] . ')">Hapus</button>';
                            echo '</td>';
                            echo "</tr>";
                        }
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
            <h2>Tambah customer</h2>
            <form action="submit_customer.php" method="post">
                <div class="form-group">
                    <label for="kode_custo">Kode customer:</label>
                    <input type="number" id="kode_custo" name="kode_custo" required>
                </div>
                <div class="form-group">
                    <label for="nama_cus">Nama:</label>
                    <input type="text" id="nama_cus" name="nama_cus" required>
                </div>
                <div class="form-group">
                    <label for="kota">kota:</label>
                    <input type="text" id="kota" name="kota" required>
                </div>
                <div class="form-group">
                    <label for="alamat">alamat:</label>
                    <input type="text" id="alamat" name="alamat" required>
                </div>
                <div class="form-group">
                    <label for="kode_pos">kode pos:</label>
                    <input type="number" id="kode_pos" name="kode_pos" required>
                </div>
                <div class="form-group">
                    <label for="telp">telpon:</label>
                    <input type="number" id="telp" name="telp" required>
                </div>
                <div class="form-group">
                    <label for="email">email:</label>
                    <input type="text" id="email" name="email" required>
                </div>
                <button type="submit" style="background-color: #430404;">Tambah customer</button>
            </form>
        </main>    </div>
        <script>
        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus kamar ini?')) {
                window.location.href = 'hapus_customer.php?id=' + id;
            }
        }
    </script>
</body>
</html>
