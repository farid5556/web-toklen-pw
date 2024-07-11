<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah suplier</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
    <header style="background-color: #430404;">
            <div class="logo">BLBLLBLBLB</div>
            <nav >
                <ul>
                    <li><a href="index.php" style="font-weight: bold;">Kembali</a></li>
            </nav>
        </header>
        <main>
            <h1>Data suplier</h1>
            <table>
                <thead >
                    <tr >
                        <th style="background-color: #430404;">Kode suplier</th>
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

                    $sql = "SELECT * FROM suplier";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["kode_suplier"] . "</td>";
                            echo "<td>" . $row["nama_suplier"] . "</td>";
                            echo "<td>" . $row["kota"] . "</td>";
                            echo "<td>" . $row["alamat"] . "</td>";
                            echo "<td>" . $row["kode_pos"] . "</td>";
                            echo "<td>" . $row["telp"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo '<td>';
                            echo '<button class="edit" onclick="window.location.href=\'edit_suplier.php?id=' . $row['kode_suplier'] . '\'">Edit</button> ';
                            echo '<button class="delete" onclick="confirmDelete(' . $row['kode_suplier'] . ')">Hapus</button>';
                            echo '</td>';
                            echo "</tr>";
                        }
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
            <h2>Tambah suplier</h2>
            <form action="submit_suplier.php" method="post">
                <div class="form-group">
                    <label for="kode_suplier">Kode suplier:</label>
                    <input type="number" id="kode_suplier" name="kode_suplier" required>
                </div>
                <div class="form-group">
                    <label for="nama_suplier">Nama:</label>
                    <input type="text" id="nama_suplier" name="nama_suplier" required>
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
                <button type="submit" style="background-color: #430404;">Tambah suplier</button>
            </form>
        </main>    </div>
        <script>
        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus suplier ini?')) {
                window.location.href = 'hapus_suplier.php?id=' + id;
            }
        }
    </script>
</body>
</html>
