-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2023 at 01:34 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_buah`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getPendapatan` ()   begin
select sum(harga_terjual) from produk_keluar;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getProdukKeluarCount` ()   begin
declare jumlahProdukKeluar int;
select count(*) into jumlahProdukKeluar from produk_keluar;
select jumlahProdukKeluar;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getProdukKeluarCount2` ()   begin
select jumlahProdukKeluar from produk_keluar;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getProdukKeluarCount3` ()   begin
select count(*) from produk_keluar;
end$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `hitungTotalPendapatan` () RETURNS INT(11)  begin
declare totalPendapatan int;
select sum(harga_terjual) into totalPendapatan from produk_keluar;
return totalPendapatan;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `jenis_kelamin` enum('perempuan','laki-laki') NOT NULL,
  `level` enum('admin','owner') NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL,
  `waktu_dibuat` date NOT NULL DEFAULT curdate(),
  `email` varchar(30) DEFAULT NULL,
  `no_telp` varchar(30) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id`, `nama`, `jenis_kelamin`, `level`, `username`, `password`, `status`, `waktu_dibuat`, `email`, `no_telp`, `alamat`) VALUES
(1, 'devi irawati', 'perempuan', 'owner', 'devi', '$2y$10$OTM61L2vKkJ97W.oatO2heh4OuDOjgnsIu7bXwg5Y.s2xeQFjJeTa', 'aktif', '2023-05-23', 'devi@gmail.com', '083142301830', ''),
(12, '', 'perempuan', 'owner', 'owner', '$2y$10$UOx5V9GhrAQKkneYDODf5.Oby09IX8JZu7OS5fuVj9cnlFgapyxKW', 'tidak aktif', '2023-05-21', '', '083142301830', ''),
(14, 'nova afriana', 'perempuan', 'admin', 'nova', '$2y$10$3RZs.LYNtNFyu7.FaUVjMuyY2GWzR31J.GFiFhJ0n3ASRPsuqJj52', 'aktif', '2023-05-23', 'nova@gmail.com', '083142301830', ''),
(16, '', 'perempuan', 'owner', 'hendy&#039;', '$2y$10$wWVbILeey7wNJGRpFb4sKuXQPbbHC9mYZT9RJK6ZoZL4z2.mKEcqi', 'tidak aktif', '2023-05-25', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `harga` int(11) NOT NULL,
  `kategori` enum('buah','frozen food','lainnya') DEFAULT NULL,
  `stok` float NOT NULL,
  `satuan` enum('kg','biji','pcs') NOT NULL,
  `gambar` varchar(30) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `status` enum('aktif','tidak aktif') DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `harga`, `kategori`, `stok`, `satuan`, `gambar`, `deskripsi`, `status`) VALUES
(120, 'apel fuji', 35000, 'buah', 78, 'kg', '6467240c58e98.jpg', '', 'aktif'),
(121, 'anggur', 60000, 'buah', 96, 'kg', '646cd5b345f66.jpg', '', 'tidak aktif'),
(122, 'mangga', 30000, 'buah', 37, 'kg', '646cd5cdf3d56.jpg', '', 'aktif'),
(123, 'nugget', 27000, 'frozen food', 0, 'pcs', '646cd60fb793b.jpeg', '', 'aktif'),
(124, 'apel hijau', 25000, 'buah', 0, 'kg', '646d67b7657e1.jpg', '', 'aktif'),
(125, 'kelengkeng', 60000, 'buah', 91.7, 'kg', '646d67d0a127b.png', '', 'aktif'),
(126, 'pepaya', 5000, 'buah', 0, 'biji', '646d67e96ce53.jpg', '', 'aktif'),
(127, 'durian', 25000, 'buah', 0, 'pcs', '646efb3c34e82.jpg', '', 'aktif'),
(128, 'melon oren', 12000, 'buah', 77, 'kg', '646efb8809108.jpg', '', 'aktif'),
(129, 'melon hijau', 10000, 'buah', 91, 'kg', '646efefa915a0.jpg', '', 'tidak aktif'),
(130, 'sirsak', 10000, 'buah', 0, 'kg', '646efbcd7ff13.jpg', '', 'aktif'),
(131, 'nugget kanzler', 29000, 'frozen food', 76, 'pcs', '646efc078e8e1.jpg', '', 'aktif'),
(132, 'manggis', 70000, 'buah', 14, 'kg', '646efc1cb515a.jpg', '', 'aktif'),
(133, 'uyah acan', 8000, 'lainnya', 81, 'pcs', '646f08255fff1.jpg', '', 'aktif'),
(134, 'warik', 2000, 'lainnya', 92, 'pcs', '6476cd032a894.jpg', '', 'tidak aktif'),
(135, 'nanas', 8000, 'buah', 0, 'biji', '647dbeca10031.jpg', '', 'tidak aktif'),
(136, 'jambu kristal', 20000, 'buah', 24, 'kg', '647dbf063c3dd.jpg', '', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `produk_keluar`
--

CREATE TABLE `produk_keluar` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `harga_terjual` int(11) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `jumlah` float NOT NULL,
  `catatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk_keluar`
--

INSERT INTO `produk_keluar` (`id`, `id_produk`, `id_akun`, `harga_terjual`, `tanggal_keluar`, `jumlah`, `catatan`) VALUES
(107, 120, 1, 175000, '2023-05-23', 5, ''),
(108, 120, 1, 525000, '2023-05-23', 15, ''),
(109, 121, 1, 120000, '2023-05-19', 2, ''),
(110, 122, 1, 90000, '2023-05-23', 3, ''),
(111, 123, 1, 270000, '2023-05-20', 10, ''),
(112, 120, 1, 70000, '2023-05-24', 2, ''),
(113, 122, 1, 150000, '2023-05-24', 5, ''),
(114, 123, 1, 27000, '2023-05-24', 1, ''),
(116, 123, 1, 27000, '2023-05-17', 1, ''),
(117, 125, 1, 120000, '2023-05-25', 2, ''),
(118, 131, 1, 116000, '2023-05-21', 4, ''),
(119, 132, 1, 1400000, '2023-05-18', 20, ''),
(120, 129, 1, 70000, '2023-05-25', 7, ''),
(121, 123, 1, 324000, '2023-05-16', 12, ''),
(122, 123, 1, 540000, '2023-05-25', 20, ''),
(123, 133, 1, 200000, '2023-05-17', 25, ''),
(124, 133, 1, 80000, '2023-05-25', 10, ''),
(125, 131, 1, 116000, '2023-05-26', 4, ''),
(126, 132, 1, 490000, '2023-05-26', 7, ''),
(127, 133, 1, 40000, '2023-05-26', 5, ''),
(128, 131, 1, 58000, '2023-05-26', 2, ''),
(129, 131, 1, 58000, '2023-05-26', 2, ''),
(130, 129, 1, 20000, '2023-05-27', 2, ''),
(131, 123, 1, 81000, '2023-05-31', 3, ''),
(132, 132, 1, 350000, '2023-05-31', 5, ''),
(133, 133, 1, 8000, '2023-05-31', 1, ''),
(134, 134, 1, 4000, '2023-05-31', 2, ''),
(135, 122, 1, 60000, '2023-06-05', 2, ''),
(136, 136, 1, 60000, '2023-06-05', 3, ''),
(137, 123, 1, 108000, '2023-06-05', 4, ''),
(138, 133, 1, 472000, '2023-06-05', 59, ''),
(139, 123, 1, 1323000, '2023-06-05', 49, ''),
(140, 128, 1, 36000, '2023-06-06', 3, ''),
(141, 134, 1, 12000, '2023-06-06', 6, ''),
(142, 132, 1, 280000, '2023-06-06', 4, ''),
(143, 131, 1, 58000, '2023-06-06', 2, ''),
(144, 136, 1, 60000, '2023-06-06', 3, ''),
(145, 122, 1, 90000, '2023-06-06', 3, ''),
(146, 125, 1, 378000, '2023-06-06', 6.3, ''),
(147, 133, 1, 112000, '2023-06-06', 14, ''),
(148, 133, 1, 40000, '2023-06-16', 5, '');

-- --------------------------------------------------------

--
-- Table structure for table `produk_masuk`
--

CREATE TABLE `produk_masuk` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `jumlah` float NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `catatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk_masuk`
--

INSERT INTO `produk_masuk` (`id`, `id_produk`, `id_akun`, `harga_beli`, `jumlah`, `tanggal_masuk`, `catatan`) VALUES
(302, 120, 1, 3000000, 100, '2023-05-23', ''),
(303, 121, 1, 500000, 100, '2023-05-23', ''),
(304, 122, 1, 1000000, 50, '2023-05-23', ''),
(305, 123, 1, 2500000, 100, '2023-05-23', ''),
(306, 125, 1, 5000000, 100, '2023-05-25', ''),
(307, 132, 1, 3000000, 50, '2023-05-25', ''),
(308, 131, 1, 1800000, 90, '2023-05-25', ''),
(309, 128, 1, 800000, 80, '2023-05-25', ''),
(310, 129, 1, 800000, 100, '2023-05-25', ''),
(311, 133, 1, 500000, 100, '2023-05-25', ''),
(312, 134, 1, 100000, 100, '2023-05-31', ''),
(313, 136, 1, 450000, 30, '2023-06-05', ''),
(314, 133, 1, 500000, 100, '2023-06-06', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_username` (`username`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk_keluar`
--
ALTER TABLE `produk_keluar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pk_akun` (`id_akun`),
  ADD KEY `fk_pk_produk` (`id_produk`);

--
-- Indexes for table `produk_masuk`
--
ALTER TABLE `produk_masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pm_produk` (`id_produk`),
  ADD KEY `fk_pm_akun` (`id_akun`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `produk_keluar`
--
ALTER TABLE `produk_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `produk_masuk`
--
ALTER TABLE `produk_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=315;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produk_keluar`
--
ALTER TABLE `produk_keluar`
  ADD CONSTRAINT `fk_pk_akun` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id`),
  ADD CONSTRAINT `fk_pk_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`);

--
-- Constraints for table `produk_masuk`
--
ALTER TABLE `produk_masuk`
  ADD CONSTRAINT `fk_pm_akun` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id`),
  ADD CONSTRAINT `fk_pm_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
