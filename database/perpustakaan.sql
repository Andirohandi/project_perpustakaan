-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2016 at 07:02 PM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `table_admin`
--

CREATE TABLE `table_admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_admin`
--

INSERT INTO `table_admin` (`id_admin`, `nama_admin`, `username`, `password`) VALUES
(1, 'Andi Rohandi', 'pustakawan', 'ed3e211df2603d4832e7ec0afba5e513');

-- --------------------------------------------------------

--
-- Table structure for table `table_anggota`
--

CREATE TABLE `table_anggota` (
  `id_anggota` int(11) NOT NULL,
  `kode_anggota` varchar(20) NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nama_anggota` varchar(50) NOT NULL,
  `alamat_anggota` varchar(255) NOT NULL,
  `jk_anggota` varchar(10) NOT NULL,
  `no_hp_anggota` varchar(13) NOT NULL,
  `id_kategori_anggota` tinyint(1) NOT NULL,
  `status_anggota` int(11) NOT NULL DEFAULT '1' COMMENT '1 = aktif; 2 = tidak aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_anggota`
--

INSERT INTO `table_anggota` (`id_anggota`, `kode_anggota`, `tgl_input`, `nama_anggota`, `alamat_anggota`, `jk_anggota`, `no_hp_anggota`, `id_kategori_anggota`, `status_anggota`) VALUES
(1, 'AGT-000001', '2016-05-05 15:31:29', 'Kusnadi', 'Kircon', 'Laki-Laki', '0896904280558', 2, 1),
(2, 'AGT-00002', '2016-05-05 15:31:33', 'Ari Budiman', 'Buah Batu', 'Laki-Laki', '0226585456682', 3, 1),
(3, 'AGT-00003', '2016-05-05 15:31:38', 'Effa Katrina', 'Cibeureum', 'Perempuan', '0896542864560', 2, 1),
(4, 'AGT-00004', '2016-05-05 15:31:43', 'Hani', 'Cikarang', 'Perempuan', '0245689754128', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `table_arus_detail`
--

CREATE TABLE `table_arus_detail` (
  `id_arus_detail` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `jns_transaksi` tinyint(4) NOT NULL COMMENT '1 =>buku masuk, 2 => buku keluar, 3 => peminjaman, 4 => pengembalian, 5 => booking',
  `tgl_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `table_arus_stok`
--

CREATE TABLE `table_arus_stok` (
  `id_arus_stok` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `buku_masuk` int(11) NOT NULL DEFAULT '0',
  `buku_keluar` int(11) NOT NULL DEFAULT '0',
  `booking_buku` int(11) NOT NULL DEFAULT '0',
  `peminjaman_buku` int(11) NOT NULL DEFAULT '0',
  `pengembalian_buku` int(11) DEFAULT '0',
  `buku_real` int(11) NOT NULL DEFAULT '0',
  `buku_free` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_arus_stok`
--

INSERT INTO `table_arus_stok` (`id_arus_stok`, `id_buku`, `buku_masuk`, `buku_keluar`, `booking_buku`, `peminjaman_buku`, `pengembalian_buku`, `buku_real`, `buku_free`) VALUES
(10, 11, 5, 1, 0, 0, 0, 4, 4),
(11, 12, 3, 0, 0, 0, 0, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `table_buku`
--

CREATE TABLE `table_buku` (
  `id_buku` int(11) NOT NULL,
  `kode_buku` varchar(10) NOT NULL,
  `judul_buku` varchar(255) NOT NULL,
  `penulis` varchar(100) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `id_ktgr` tinyint(4) NOT NULL,
  `tempat_buku` varchar(50) NOT NULL,
  `kota_terbit` varchar(50) NOT NULL,
  `tahun_terbit` year(4) NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `deskripsi_buku` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `id_pustakawan` tinyint(4) DEFAULT NULL,
  `url_buku` tinytext NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL COMMENT '0 = tidak aktif; 1 = aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_buku`
--

INSERT INTO `table_buku` (`id_buku`, `kode_buku`, `judul_buku`, `penulis`, `penerbit`, `id_ktgr`, `tempat_buku`, `kota_terbit`, `tahun_terbit`, `isbn`, `deskripsi_buku`, `image`, `thumbnail`, `id_pustakawan`, `url_buku`, `tgl_input`, `status`) VALUES
(11, 'PRG-00001', 'Algoritma Pemrograman', 'Rinaldi Munir', 'Informatika', 41, 'Lorong A2. Rak 1b', 'Jogjakarta', 2010, '33254858642123', '<p>Buku ini dibuat untu mengasah kemampuan seseorang adalam hal algoritma<br></p>', 'uploads/images/rinaldimunir1.jpg', 'uploads/thumbnails/rinaldimunir1_thumb.jpg', 1, 'algoritma-pemrograman', '2016-05-05 12:03:45', 1),
(12, 'BSN-00001', 'Entrepreneurship', 'Mark Casson', 'Informatika', 42, 'Lorong A2. Rak 1c', 'Jogjakarta', 2013, '302154587163664452', '', 'uploads/images/entrepreneu.jpg', 'uploads/thumbnails/entrepreneu_thumb.jpg', 1, 'entrepreneurship', '2016-05-05 12:06:47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `table_buku_keluar`
--

CREATE TABLE `table_buku_keluar` (
  `id_buku_keluar` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_pustakawan` int(11) DEFAULT NULL,
  `status_buku` varchar(100) NOT NULL,
  `denda` int(11) NOT NULL DEFAULT '0',
  `id_pengembalian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_buku_keluar`
--

INSERT INTO `table_buku_keluar` (`id_buku_keluar`, `id_buku`, `jumlah`, `tgl_input`, `id_pustakawan`, `status_buku`, `denda`, `id_pengembalian`) VALUES
(30, 11, 1, '2016-05-05 13:25:52', 1, 'Hilang', 10000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `table_buku_masuk`
--

CREATE TABLE `table_buku_masuk` (
  `id_buku_masuk` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_pustakawan` int(11) DEFAULT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_buku_masuk`
--

INSERT INTO `table_buku_masuk` (`id_buku_masuk`, `id_buku`, `jumlah`, `tgl_input`, `id_pustakawan`, `keterangan`) VALUES
(45, 11, 5, '2016-05-05 13:24:34', 1, ''),
(46, 12, 3, '2016-05-05 13:24:53', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `table_kategori_anggota`
--

CREATE TABLE `table_kategori_anggota` (
  `id_kategori_anggota` int(1) NOT NULL,
  `nama_kategori_anggota` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_kategori_anggota`
--

INSERT INTO `table_kategori_anggota` (`id_kategori_anggota`, `nama_kategori_anggota`) VALUES
(1, 'Akademik'),
(2, 'Dosen'),
(3, 'Mahasiswa');

-- --------------------------------------------------------

--
-- Table structure for table `table_kategori_buku`
--

CREATE TABLE `table_kategori_buku` (
  `id_ktgr` int(11) NOT NULL,
  `kode_ktgr` varchar(10) NOT NULL,
  `nama_ktgr` varchar(50) NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL COMMENT '0 = Tidak Aktif, 1 = Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_kategori_buku`
--

INSERT INTO `table_kategori_buku` (`id_ktgr`, `kode_ktgr`, `nama_ktgr`, `tgl_input`, `status`) VALUES
(41, 'PRG', 'Pemrograman', '2016-05-05 11:58:35', 1),
(42, 'BSN', 'Bisnis dan Manajemen', '2016-05-05 11:58:52', 1),
(43, 'FK', 'Fiksi', '2016-05-05 11:59:13', 1),
(44, 'NFK', 'Non Fiksi', '2016-05-05 11:59:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `table_label_buku`
--

CREATE TABLE `table_label_buku` (
  `id_label_buku` varchar(12) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_buku_masuk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_label_buku`
--

INSERT INTO `table_label_buku` (`id_label_buku`, `id_buku`, `id_buku_masuk`) VALUES
('2016-000001', 11, 45),
('2016-000002', 11, 45),
('2016-000003', 11, 45),
('2016-000004', 11, 45),
('2016-000005', 11, 45),
('2016-000006', 12, 46),
('2016-000007', 12, 46),
('2016-000008', 12, 46);

-- --------------------------------------------------------

--
-- Table structure for table `table_peminjaman`
--

CREATE TABLE `table_peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `nomor_peminjaman` varchar(20) NOT NULL,
  `tgl_peminjaman` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tgl_kembali` datetime NOT NULL,
  `tgl_perpanjangan` datetime NOT NULL,
  `id_peminjam` tinyint(4) NOT NULL,
  `id_level_peminjam` tinyint(1) NOT NULL,
  `id_pengembalian` int(5) NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0 => datamasih di transit. 1 => data sudah ke detail peminjaman',
  `id_pustakawan` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_peminjaman`
--

INSERT INTO `table_peminjaman` (`id_peminjaman`, `nomor_peminjaman`, `tgl_peminjaman`, `tgl_kembali`, `tgl_perpanjangan`, `id_peminjam`, `id_level_peminjam`, `id_pengembalian`, `status`, `id_pustakawan`) VALUES
(37, 'PNJ-2016-0000001', '2016-05-05 17:02:06', '2016-05-13 00:00:00', '0000-00-00 00:00:00', 1, 2, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `table_peminjaman_detail`
--

CREATE TABLE `table_peminjaman_detail` (
  `id_peminjaman_detail` int(11) NOT NULL,
  `id_peminjaman` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `jumlah` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `table_peminjaman_detail_transit`
--

CREATE TABLE `table_peminjaman_detail_transit` (
  `id_peminjaman_detail_transit` int(6) NOT NULL,
  `id_buku` int(6) NOT NULL,
  `jumlah` tinyint(2) NOT NULL,
  `id_peminjaman` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `table_pengembalian`
--

CREATE TABLE `table_pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `nomor_pengembalian` varchar(17) NOT NULL,
  `id_peminjaman` int(11) NOT NULL,
  `tgl_pengembalian` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `keterlambatan` tinyint(3) NOT NULL,
  `denda` float NOT NULL,
  `id_pustakawan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `table_pengembalian_detail`
--

CREATE TABLE `table_pengembalian_detail` (
  `id_pengembalian_detail` int(11) NOT NULL,
  `id_pengembalian` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `jumlah` tinyint(1) NOT NULL,
  `status_buku` varchar(10) DEFAULT NULL,
  `denda` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `table_setting`
--

CREATE TABLE `table_setting` (
  `id` int(2) NOT NULL,
  `nama_perpustakaan` varchar(50) NOT NULL,
  `logo_perpustakaan` varchar(100) NOT NULL,
  `denda` float NOT NULL,
  `lama_peminjaman` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_setting`
--

INSERT INTO `table_setting` (`id`, `nama_perpustakaan`, `logo_perpustakaan`, `denda`, `lama_peminjaman`) VALUES
(1, 'SIPERPUS', 'assets/backend/img/logo.png', 2500, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_admin`
--
ALTER TABLE `table_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `table_anggota`
--
ALTER TABLE `table_anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `table_arus_detail`
--
ALTER TABLE `table_arus_detail`
  ADD PRIMARY KEY (`id_arus_detail`);

--
-- Indexes for table `table_arus_stok`
--
ALTER TABLE `table_arus_stok`
  ADD PRIMARY KEY (`id_arus_stok`);

--
-- Indexes for table `table_buku`
--
ALTER TABLE `table_buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD UNIQUE KEY `kode_buku` (`kode_buku`);

--
-- Indexes for table `table_buku_keluar`
--
ALTER TABLE `table_buku_keluar`
  ADD PRIMARY KEY (`id_buku_keluar`);

--
-- Indexes for table `table_buku_masuk`
--
ALTER TABLE `table_buku_masuk`
  ADD PRIMARY KEY (`id_buku_masuk`);

--
-- Indexes for table `table_kategori_anggota`
--
ALTER TABLE `table_kategori_anggota`
  ADD PRIMARY KEY (`id_kategori_anggota`);

--
-- Indexes for table `table_kategori_buku`
--
ALTER TABLE `table_kategori_buku`
  ADD PRIMARY KEY (`id_ktgr`),
  ADD UNIQUE KEY `kode_ktgr` (`kode_ktgr`),
  ADD UNIQUE KEY `nama_ktgr` (`nama_ktgr`);

--
-- Indexes for table `table_label_buku`
--
ALTER TABLE `table_label_buku`
  ADD PRIMARY KEY (`id_label_buku`);

--
-- Indexes for table `table_peminjaman`
--
ALTER TABLE `table_peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indexes for table `table_peminjaman_detail`
--
ALTER TABLE `table_peminjaman_detail`
  ADD PRIMARY KEY (`id_peminjaman_detail`);

--
-- Indexes for table `table_peminjaman_detail_transit`
--
ALTER TABLE `table_peminjaman_detail_transit`
  ADD PRIMARY KEY (`id_peminjaman_detail_transit`);

--
-- Indexes for table `table_pengembalian`
--
ALTER TABLE `table_pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`);

--
-- Indexes for table `table_pengembalian_detail`
--
ALTER TABLE `table_pengembalian_detail`
  ADD PRIMARY KEY (`id_pengembalian_detail`);

--
-- Indexes for table `table_setting`
--
ALTER TABLE `table_setting`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_admin`
--
ALTER TABLE `table_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `table_anggota`
--
ALTER TABLE `table_anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `table_arus_detail`
--
ALTER TABLE `table_arus_detail`
  MODIFY `id_arus_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;
--
-- AUTO_INCREMENT for table `table_arus_stok`
--
ALTER TABLE `table_arus_stok`
  MODIFY `id_arus_stok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `table_buku`
--
ALTER TABLE `table_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `table_buku_keluar`
--
ALTER TABLE `table_buku_keluar`
  MODIFY `id_buku_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `table_buku_masuk`
--
ALTER TABLE `table_buku_masuk`
  MODIFY `id_buku_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `table_kategori_anggota`
--
ALTER TABLE `table_kategori_anggota`
  MODIFY `id_kategori_anggota` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `table_kategori_buku`
--
ALTER TABLE `table_kategori_buku`
  MODIFY `id_ktgr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `table_peminjaman`
--
ALTER TABLE `table_peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `table_peminjaman_detail`
--
ALTER TABLE `table_peminjaman_detail`
  MODIFY `id_peminjaman_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `table_peminjaman_detail_transit`
--
ALTER TABLE `table_peminjaman_detail_transit`
  MODIFY `id_peminjaman_detail_transit` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `table_pengembalian`
--
ALTER TABLE `table_pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `table_pengembalian_detail`
--
ALTER TABLE `table_pengembalian_detail`
  MODIFY `id_pengembalian_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `table_setting`
--
ALTER TABLE `table_setting`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
