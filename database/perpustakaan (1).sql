-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2016 at 05:06 PM
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
  `nip_nim_anggota` varchar(20) NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nama_anggota` varchar(50) NOT NULL,
  `alamat_anggota` varchar(255) NOT NULL,
  `jk_anggota` varchar(10) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `id_kategori_anggota` tinyint(1) NOT NULL,
  `id_jurusan` tinyint(2) NOT NULL,
  `status_anggota` int(11) NOT NULL DEFAULT '1' COMMENT '1 = aktif; 2 = tidak aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_anggota`
--

INSERT INTO `table_anggota` (`id_anggota`, `nip_nim_anggota`, `tgl_input`, `nama_anggota`, `alamat_anggota`, `jk_anggota`, `tempat_lahir`, `tanggal_lahir`, `id_kategori_anggota`, `id_jurusan`, `status_anggota`) VALUES
(1, 'AGT-000001', '2016-05-06 14:56:29', 'Kusnadi', 'Kircon', 'Laki-Laki', 'Cimahi', '2016-05-16', 3, 1, 1),
(2, 'AGT-00002', '2016-05-06 14:56:33', 'Ari Budiman', 'Buah Batu', 'Laki-Laki', 'Bandung', '2016-02-25', 3, 2, 1),
(3, 'AGT-00003', '2016-05-06 14:56:37', 'Effa Katrina', 'Cibeureum', 'Perempuan', 'Rancaekek', '2016-02-16', 2, 0, 1),
(4, 'AGT-0000411', '2016-05-06 15:10:23', 'Hani111', 'Cikarang11111', 'Laki-Laki', 'Cimahi11', '2001-05-13', 2, 0, 1),
(5, '10512003', '2016-05-06 14:56:50', 'Yazid', 'bla bla bla', 'Laki-Laki', 'Aceh', '2016-05-10', 2, 0, 1),
(6, '1051200302', '2016-05-06 14:56:54', 'Salman', 'fasdfasd fas dfsad dasf', 'Perempuan', 'Lorong A2. Rak 1b, ', '2016-07-07', 3, 1, 1),
(7, 'AGT-000001dd', '2016-05-06 14:56:59', 'asdfasdff', 'asdfasd fasdf', 'Laki-Laki', 'Bha3', '2016-02-24', 1, 0, 1);

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

--
-- Dumping data for table `table_arus_detail`
--

INSERT INTO `table_arus_detail` (`id_arus_detail`, `id_transaksi`, `id_buku`, `jumlah`, `jns_transaksi`, `tgl_input`) VALUES
(1, 2, 11, 1, 2, '2016-05-08 11:37:54'),
(2, 3, 12, 1, 2, '2016-05-08 11:39:15'),
(3, 47, 13, 5, 1, '2016-05-08 11:39:39'),
(4, 48, 14, 2, 1, '2016-05-08 11:39:48');

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
(10, 11, 5, 1, 0, 2, 1, 4, 3),
(11, 12, 3, 2, 0, 3, 3, 1, 1),
(12, 13, 5, 0, 0, 0, 0, 5, 5),
(13, 14, 2, 0, 0, 0, 0, 2, 2);

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
(12, 'BSN-00001', 'Entrepreneurship', 'Mark Casson', 'Informatika', 42, 'Lorong A2. Rak 1c', 'Jogjakarta', 2013, '302154587163664452', '', 'uploads/images/entrepreneu.jpg', 'uploads/thumbnails/entrepreneu_thumb.jpg', 1, 'entrepreneurship', '2016-05-05 12:06:47', 1),
(13, 'PRG-00002', 'The Shortcut Of MATLAB Programing /INF', 'Gunaidi Abdia Away S.Si', 'Informatika', 41, 'Lorong A3. Rak 1b', 'Jogjakarta', 2006, '1234564213312', '', 'uploads/images/matlab.jpg', 'uploads/thumbnails/matlab_thumb.jpg', 1, 'the-shortcut-of-matlab-programing-inf', '2016-05-08 11:34:45', 1),
(14, 'PRG-00003', 'Panduan Mudah LINUX /INF', 'Ali Akbar', 'Informatika', 41, 'Lorong A2. Rak 1b', 'Jogjakarta', 2006, '1234564213312', '', 'uploads/images/linux.jpg', 'uploads/thumbnails/linux_thumb.jpg', 1, 'panduan-mudah-linux-inf', '2016-05-08 11:37:20', 1);

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
(30, 11, 1, '2016-05-05 13:25:52', 1, 'Hilang', 10000, 0),
(31, 12, 2, '2016-05-07 07:57:22', 1, 'Hilang', 0, 1);

--
-- Triggers `table_buku_keluar`
--
DELIMITER $$
CREATE TRIGGER `delete_detail_arus_keluar` AFTER DELETE ON `table_buku_keluar` FOR EACH ROW DELETE FROM table_arus_detail WHERE id_transaksi = OLD.id_buku_keluar AND jns_transaksi = '2'
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_detail_arus_keluar` AFTER INSERT ON `table_buku_keluar` FOR EACH ROW INSERT INTO table_arus_detail(id_transaksi,id_buku,jumlah,jns_transaksi) VALUES(NEW.id_buku_keluar,NEW.id_buku,NEW.jumlah,'2')
$$
DELIMITER ;

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
(46, 12, 3, '2016-05-05 13:24:53', 1, ''),
(47, 13, 5, '2016-05-08 11:39:39', 1, ''),
(48, 14, 2, '2016-05-08 11:39:48', 1, '');

--
-- Triggers `table_buku_masuk`
--
DELIMITER $$
CREATE TRIGGER `delete_detail_arus_masuk` AFTER DELETE ON `table_buku_masuk` FOR EACH ROW DELETE FROM table_arus_detail WHERE id_transaksi = OLD.id_buku_masuk AND jns_transaksi = '1'
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_detail_arus_masuk` AFTER INSERT ON `table_buku_masuk` FOR EACH ROW INSERT INTO table_arus_detail(id_transaksi,id_buku,jumlah,jns_transaksi) VALUES(NEW.id_buku_masuk,NEW.id_buku,NEW.jumlah,'1')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `table_jurusan`
--

CREATE TABLE `table_jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `kode_jurusan` varchar(15) NOT NULL,
  `nama_jurusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_jurusan`
--

INSERT INTO `table_jurusan` (`id_jurusan`, `kode_jurusan`, `nama_jurusan`) VALUES
(1, 'IF', 'Tekhnik Informatika'),
(2, 'ABI', 'Administrasi Bisnis');

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
('2016-000008', 12, 46),
('2016-000009', 11, 47),
('2016-000010', 11, 47),
('2016-000011', 11, 47),
('2016-000012', 13, 47),
('2016-000013', 13, 47),
('2016-000014', 14, 48),
('2016-000015', 14, 48);

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
(39, 'PNJ-2016-0000001', '2016-05-08 07:29:32', '2016-05-07 00:00:00', '0000-00-00 00:00:00', 2, 3, 1, 1, 1),
(40, 'PNJ-2016-0000002', '2016-05-08 11:39:15', '2016-05-07 00:00:00', '0000-00-00 00:00:00', 2, 0, 3, 1, 1),
(41, 'PNJ-2016-0000003', '2016-05-08 11:37:54', '2016-05-13 00:00:00', '0000-00-00 00:00:00', 4, 0, 2, 1, NULL),
(42, 'PNJ-2016-0000004', '2016-05-06 11:21:31', '2016-05-13 00:00:00', '0000-00-00 00:00:00', 3, 0, 0, 1, NULL);

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

--
-- Dumping data for table `table_peminjaman_detail`
--

INSERT INTO `table_peminjaman_detail` (`id_peminjaman_detail`, `id_peminjaman`, `id_buku`, `jumlah`) VALUES
(21, 39, 12, 2),
(22, 40, 12, 1),
(23, 41, 11, 1),
(24, 42, 11, 1);

--
-- Triggers `table_peminjaman_detail`
--
DELIMITER $$
CREATE TRIGGER `insert_detail_arus_peminjaman` AFTER INSERT ON `table_peminjaman_detail` FOR EACH ROW INSERT INTO table_arus_detail(id_transaksi,id_buku,jumlah,jns_transaksi) VALUES(NEW.id_peminjaman_detail,NEW.id_buku,NEW.jumlah,'3')
$$
DELIMITER ;

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

--
-- Dumping data for table `table_pengembalian`
--

INSERT INTO `table_pengembalian` (`id_pengembalian`, `nomor_pengembalian`, `id_peminjaman`, `tgl_pengembalian`, `keterlambatan`, `denda`, `id_pustakawan`) VALUES
(1, 'PMB-2016-0000001', 39, '2016-05-07 07:57:22', 0, 0, 1),
(2, 'PMB-2016-0000002', 41, '2016-05-08 11:37:54', 0, 0, 1),
(3, 'PMB-2016-0000003', 40, '2016-05-08 11:39:15', 1, 1000, 1);

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

--
-- Dumping data for table `table_pengembalian_detail`
--

INSERT INTO `table_pengembalian_detail` (`id_pengembalian_detail`, `id_pengembalian`, `id_buku`, `jumlah`, `status_buku`, `denda`) VALUES
(1, 1, 12, 2, 'Hilang', 0),
(2, 2, 11, 1, '', 0),
(3, 3, 12, 1, '', 0);

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
(1, 'SIPERPUS', 'assets/backend/img/logo.jpg', 2500, 7);

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
-- Indexes for table `table_jurusan`
--
ALTER TABLE `table_jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

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
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `table_arus_detail`
--
ALTER TABLE `table_arus_detail`
  MODIFY `id_arus_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `table_arus_stok`
--
ALTER TABLE `table_arus_stok`
  MODIFY `id_arus_stok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `table_buku`
--
ALTER TABLE `table_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `table_buku_keluar`
--
ALTER TABLE `table_buku_keluar`
  MODIFY `id_buku_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `table_buku_masuk`
--
ALTER TABLE `table_buku_masuk`
  MODIFY `id_buku_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `table_jurusan`
--
ALTER TABLE `table_jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `table_kategori_anggota`
--
ALTER TABLE `table_kategori_anggota`
  MODIFY `id_kategori_anggota` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `table_kategori_buku`
--
ALTER TABLE `table_kategori_buku`
  MODIFY `id_ktgr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `table_peminjaman`
--
ALTER TABLE `table_peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `table_peminjaman_detail`
--
ALTER TABLE `table_peminjaman_detail`
  MODIFY `id_peminjaman_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `table_peminjaman_detail_transit`
--
ALTER TABLE `table_peminjaman_detail_transit`
  MODIFY `id_peminjaman_detail_transit` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_pengembalian`
--
ALTER TABLE `table_pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `table_pengembalian_detail`
--
ALTER TABLE `table_pengembalian_detail`
  MODIFY `id_pengembalian_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `table_setting`
--
ALTER TABLE `table_setting`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
