-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jul 2024 pada 18.12
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbproduk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `kode_custo` int(222) NOT NULL,
  `nama_cus` varchar(222) NOT NULL,
  `kota` varchar(222) NOT NULL,
  `alamat` varchar(222) NOT NULL,
  `kode_pos` int(222) NOT NULL,
  `telp` int(222) NOT NULL,
  `email` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`kode_custo`, `nama_cus`, `kota`, `alamat`, `kode_pos`, `telp`, `email`) VALUES
(453, 'yuki', 'medan', 'jl durian musangking', 6875, 2147483647, 'uhuyganteng12@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `kode_produk` int(222) NOT NULL,
  `nama_produk` varchar(222) NOT NULL,
  `jenis_produk` varchar(222) NOT NULL,
  `stok` int(222) NOT NULL,
  `satuan` varchar(222) NOT NULL,
  `harga` int(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`kode_produk`, `nama_produk`, `jenis_produk`, `stok`, `satuan`, `harga`) VALUES
(123, 'jojo', 'celana', 8, 'pasang', 20000),
(549, 'gh', 'gelang', 8, 'buah', 7000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `suplier`
--

CREATE TABLE `suplier` (
  `kode_suplier` int(222) NOT NULL,
  `nama_suplier` varchar(222) NOT NULL,
  `kota` varchar(222) NOT NULL,
  `alamat` varchar(222) NOT NULL,
  `kode_pos` int(222) NOT NULL,
  `telp` int(222) NOT NULL,
  `email` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `suplier`
--

INSERT INTO `suplier` (`kode_suplier`, `nama_suplier`, `kota`, `alamat`, `kode_pos`, `telp`, `email`) VALUES
(111, 'yanti', 'bandung', 'jl.siliwangi', 5643, 2147483647, 'badak45@gmail.com'),
(333, 'sdsg', 'sgsdgsdg', 'rehth', 464, 676776, 'sdf@sdff');

-- --------------------------------------------------------

--
-- Struktur dari tabel `trans_beli`
--

CREATE TABLE `trans_beli` (
  `no_faktur` int(222) NOT NULL,
  `kode_produk` int(222) NOT NULL,
  `kode_suplier` int(222) NOT NULL,
  `tgl_trans` date NOT NULL,
  `jlh_trans` int(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `trans_beli`
--

INSERT INTO `trans_beli` (`no_faktur`, `kode_produk`, `kode_suplier`, `tgl_trans`, `jlh_trans`) VALUES
(344, 123, 111, '0000-00-00', 454);

-- --------------------------------------------------------

--
-- Struktur dari tabel `trans_jual`
--

CREATE TABLE `trans_jual` (
  `no_faktur` int(222) NOT NULL,
  `kode_produk` int(222) NOT NULL,
  `tgl_trans` date NOT NULL,
  `jlh_trans` int(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `trans_jual`
--

INSERT INTO `trans_jual` (`no_faktur`, `kode_produk`, `tgl_trans`, `jlh_trans`) VALUES
(666, 549, '2024-07-14', 12),
(777, 123, '2024-07-21', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`username`, `password`, `role`) VALUES
('admin', 'pwadmin', 'admin'),
('user', 'pwuser', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`kode_custo`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`kode_produk`);

--
-- Indeks untuk tabel `suplier`
--
ALTER TABLE `suplier`
  ADD PRIMARY KEY (`kode_suplier`);

--
-- Indeks untuk tabel `trans_beli`
--
ALTER TABLE `trans_beli`
  ADD PRIMARY KEY (`no_faktur`),
  ADD KEY `kode_produk` (`kode_produk`),
  ADD KEY `kode_suplier` (`kode_suplier`);

--
-- Indeks untuk tabel `trans_jual`
--
ALTER TABLE `trans_jual`
  ADD PRIMARY KEY (`no_faktur`),
  ADD KEY `kode_produk` (`kode_produk`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `trans_beli`
--
ALTER TABLE `trans_beli`
  ADD CONSTRAINT `trans_beli_ibfk_1` FOREIGN KEY (`kode_produk`) REFERENCES `produk` (`kode_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trans_beli_ibfk_2` FOREIGN KEY (`kode_suplier`) REFERENCES `suplier` (`kode_suplier`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `trans_jual`
--
ALTER TABLE `trans_jual`
  ADD CONSTRAINT `trans_jual_ibfk_1` FOREIGN KEY (`kode_produk`) REFERENCES `produk` (`kode_produk`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
