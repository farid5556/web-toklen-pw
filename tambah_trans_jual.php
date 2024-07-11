<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jual</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header style="background-color: #430404;">
            <div class="logo">SIMH</div>
            <nav>
                <ul>
                    <li><a href="index.php" style="font-weight: bold;">Kembali</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <h1>Jual</h1>
            <table>
                <thead>
                    <tr>
                        <th style="background-color: #430404;">No Faktur</th>
                        <th style="background-color: #430404;">Kode Produk</th>
                        <th style="background-color: #430404;">Tanggal Transaksi</th>
                        <th style="background-color: #430404;">Jumlah Transaksi</th>
                        <th style="background-color: #430404;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'config.php';

                    $sql = "SELECT * FROM trans_jual";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["no_faktur"] . "</td>";
                            echo "<td>" . $row["kode_produk"] . "</td>";
                            echo "<td>" . $row["tgl_trans"] . "</td>";
                            echo "<td>" . $row["jlh_trans"] . "</td>";
                            echo '<td>';
                            echo '<button class="edit" onclick="window.location.href=\'edit_trans_jual.php?id=' . $row['no_faktur'] . '\'">Edit</button> ';
                            echo '<button class="delete" onclick="confirmDelete(' . $row['no_faktur'] . ')">Hapus</button>';
                            echo '</td>';
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Tidak ada data</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
            <h1>Tambah Jual</h1>
            <form action="submit_trans_jual.php" method="post">
                <div class="form-group">
                    <label for="no_faktur">NO Faktur:</label>
                    <input type="number" id="no_faktur" name="no_faktur" required>
                </div>
                <div class="form-group">
                    <label for="kode_produk">Kode Produk:</label>
                    <select id="kode_produk" name="kode_produk" required>
                        <?php
                        include 'config.php';
                        $sql = "SELECT kode_produk, jenis_produk FROM produk";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['kode_produk'] . "'>" . $row['kode_produk'] . " - " . $row['jenis_produk'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>Tidak ada produk</option>";
                        }
                        $conn->close();
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tgl_trans">Tanggal Transaksi:</label>
                    <input type="date" id="tgl_trans" name="tgl_trans" required>
                </div>
                <div class="form-group">
                    <label for="jlh_trans">Jumlah Transaksi:</label>
                    <input type="number" id="jlh_trans" name="jlh_trans" required>
                </div>
                <button type="submit" style="background-color: #430404;">Tambah Jual</button>
            </form>
        </main>
    </div>
    <script>
        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus penjualan ini?')) {
                window.location.href = 'hapus_trans_jual.php?id=' + id;
            }
        }
    </script>
</body>
</html>
