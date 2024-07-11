<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$isAdmin = $_SESSION['role'] === 'admin';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLALBALBALB</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header style="background-color: #430404;">
            <div class="logo">BLLBLBL</div>
            <nav>
                
                <div class="user-info">
                    
                    <a href="logout.php" style="color: white;">Logout</a>
                </div>
            </nav>
        </header>
        <main>
            <div class="welcome-message" style="text-align: center;">
                <p>Selamat Datang <?php echo $_SESSION['username']; ?></span></p>
                <p>BLBLBBLL</p>
            </div>
            
            <div class="dashboard">

                <a href="tambah_customer.php" class="card-link">
                    <div class="card" style="background-color: #430404;">
                        <div class="icon">👤</div>
                        <p>Customer</p>
                    </div>
                </a>
                <a href="tambah_produk.php" class="card-link">
                    <div class="card" style="background-color: #430404;">
                        <div class="icon">📦</div>
                        <p>Produk</p>
                    </div>
                </a>
                <?php if ($isAdmin) : ?>

                <a href="tambah_suplier.php" class="card-link">
                    <div class="card" style="background-color: #430404;">
                        <div class="icon">🏷️</div>
                        <p>Suplier</p>
                    </div>
                </a>
                <a href="tambah_trans_beli.php" class="card-link">
                    <div class="card" style="background-color: #430404;">
                        <div class="icon">💵</div>
                        <p>Transaksi beli</p>
                    </div>
                </a>
                <a href="tambah_trans_jual.php" class="card-link">
                    <div class="card" style="background-color: #430404;">
                        <div class="icon">💸</div>
                        <p>Transaksi jual</p>
                    </div>
                </a>
                <a href="laporan_penjualan.php" class="card-link">
                    <div class="card" style="background-color: #430404;">
                        <div class="icon">📊</div>
                        <p>Laporan Penjualan</p>
                    </div>
                </a>
                <?php endif; ?>

            </div>

        </main>
    </div>
</body>
</html>