<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header style="background-color: #430404;">
            <div class="logo">BBLLBLBLBL</div>
            <nav>
                <ul>
                    <li><a href="index.php" style="font-weight: bold;">Kembali</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <h1>Laporan Penjualan</h1>
            <form method="GET" action="">
                <div class="form-group">
                    <label for="kode_produk">Pilih Kode Produk :</label>
                    <select id="kode_produk" name="kode_produk">
                        <option value="">Pilih Kode Produk</option>
                        <?php
                        include 'config.php';
                        $sql = "SELECT kode_produk, nama_produk FROM produk";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['kode_produk'] . "'>" . $row['kode_produk'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>Tidak ada produk</option>";
                        }
                        $conn->close();
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tgl_trans">Pilih Tanggal Transaksi :</label>
                    <select id="tgl_trans" name="tgl_trans">
                        <option value="">Pilih Tanggal</option>
                        <?php
                        include 'config.php';
                        $sql = "SELECT DISTINCT tgl_trans FROM trans_jual";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['tgl_trans'] . "'>" . $row['tgl_trans'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>Tidak ada transaksi</option>";
                        }
                        $conn->close();
                        ?>
                    </select>
                </div>
                <button type="submit" style="background-color: #430404;">Tampilkan Laporan</button>
            </form>

            <?php
            if ((isset($_GET['kode_produk']) && !empty($_GET['kode_produk'])) || (isset($_GET['tgl_trans']) && !empty($_GET['tgl_trans']))) {
                $kode_produk = isset($_GET['kode_produk']) ? $_GET['kode_produk'] : '';
                $tgl_trans = isset($_GET['tgl_trans']) ? $_GET['tgl_trans'] : '';

                include 'config.php';
                $sql = "SELECT tj.no_faktur, tj.tgl_trans, tj.kode_produk, p.nama_produk, p.harga 
                        FROM trans_jual tj
                        JOIN produk p ON tj.kode_produk = p.kode_produk
                        WHERE 1=1";
                
                if (!empty($kode_produk)) {
                    $sql .= " AND tj.kode_produk = ?";
                }
                if (!empty($tgl_trans)) {
                    $sql .= " AND tj.tgl_trans = ?";
                }

                $stmt = $conn->prepare($sql);

                if (!empty($kode_produk) && !empty($tgl_trans)) {
                    $stmt->bind_param("ss", $kode_produk, $tgl_trans);
                } elseif (!empty($kode_produk)) {
                    $stmt->bind_param("s", $kode_produk);
                } elseif (!empty($tgl_trans)) {
                    $stmt->bind_param("s", $tgl_trans);
                }

                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    echo '<table>';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th style="background-color: #430404;">No Faktur</th>';
                    echo '<th style="background-color: #430404;">Tanggal Transaksi</th>';
                    echo '<th style="background-color: #430404;">Kode Produk</th>';
                    echo '<th style="background-color: #430404;">Nama Produk</th>';
                    echo '<th style="background-color: #430404;">Harga produk</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['no_faktur'] . '</td>';
                        echo '<td>' . $row['tgl_trans'] . '</td>';
                        echo '<td>' . $row['kode_produk'] . '</td>';
                        echo '<td>' . $row['nama_produk'] . '</td>';
                        echo '<td>' . $row['harga'] . '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo '<p>Tidak ada data penjualan untuk filter yang dipilih.</p>';
                }

                $stmt->close();
                $conn->close();
            }
            ?>
        </main>
    </div>
</body>
</html>
