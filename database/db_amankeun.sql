-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2022 at 01:40 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_amankeun`
--

-- --------------------------------------------------------

--
-- Table structure for table `angkatan`
--

CREATE TABLE `angkatan` (
  `id_angkatan` varchar(20) NOT NULL,
  `tahun_masuk` year(4) NOT NULL,
  `id_aturan_bayar` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `angkatan`
--

INSERT INTO `angkatan` (`id_angkatan`, `tahun_masuk`, `id_aturan_bayar`) VALUES
('-', 0000, '-'),
('202203200722599sb1', 2022, '202203201922599sb1'),
('20220320081949oOCa', 2020, '20220320201949oOCa');

-- --------------------------------------------------------

--
-- Table structure for table `aturan_pembayaran`
--

CREATE TABLE `aturan_pembayaran` (
  `id_aturan_bayar` varchar(20) NOT NULL,
  `listrik_mondok` int(6) NOT NULL,
  `listrik_tdk_mondok` int(6) NOT NULL,
  `kas` int(6) NOT NULL,
  `beras` int(6) NOT NULL,
  `lauk` int(6) NOT NULL,
  `kesehatan` int(6) NOT NULL,
  `bangunan` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aturan_pembayaran`
--

INSERT INTO `aturan_pembayaran` (`id_aturan_bayar`, `listrik_mondok`, `listrik_tdk_mondok`, `kas`, `beras`, `lauk`, `kesehatan`, `bangunan`) VALUES
('-', 0, 0, 0, 0, 0, 0, 0),
('202203201922599sb1', 10000, 5000, 10000, 10000, 10000, 2000, 20000),
('20220320201949oOCa', 3000, 3000, 3000, 3000, 3000, 3000, 4000);

-- --------------------------------------------------------

--
-- Table structure for table `bantuan`
--

CREATE TABLE `bantuan` (
  `id_bantuan` varchar(20) NOT NULL,
  `tgl_bantuan` date NOT NULL,
  `keterangan` varchar(535) NOT NULL,
  `jumlah` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bantuan`
--

INSERT INTO `bantuan` (`id_bantuan`, `tgl_bantuan`, `keterangan`, `jumlah`) VALUES
('20220421230647xcoL', '2022-01-01', 'a', 1000),
('20220421230706DWcv', '2022-02-01', 'b', 1000),
('20220421230718tJoa', '2022-03-01', 'c', 1000),
('20220421230727xM3R', '2022-04-01', 'd', 1000),
('2022050613823QkYb', '2022-12-06', 'sdfgshfsgsdf', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_pembayaran`
--

CREATE TABLE `kategori_pembayaran` (
  `id_kategori_pembayaran` varchar(20) NOT NULL,
  `jenis_kategori` varchar(15) NOT NULL,
  `role_id` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_pembayaran`
--

INSERT INTO `kategori_pembayaran` (`id_kategori_pembayaran`, `jenis_kategori`, `role_id`) VALUES
('1', 'Listrik', '1'),
('2', 'Kas', '1'),
('3', 'Beras', '1'),
('4', 'Kesehatan', '1'),
('5', 'Lauk', '1'),
('6', 'Infaq/Sodaqoh', '1');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_santri`
--

CREATE TABLE `kategori_santri` (
  `id_kategori_santri` varchar(20) NOT NULL,
  `mondok` char(1) NOT NULL,
  `yatim` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_santri`
--

INSERT INTO `kategori_santri` (`id_kategori_santri`, `mondok`, `yatim`) VALUES
('0', '-', '-'),
('1', '1', '0'),
('2', '1', '1'),
('3', '0', '1'),
('4', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `orang_tua`
--

CREATE TABLE `orang_tua` (
  `id_ortu` varchar(20) NOT NULL,
  `ayah` varchar(32) NOT NULL,
  `ibu` varchar(32) NOT NULL,
  `no_kk` varchar(20) NOT NULL,
  `alamat_ortu` varchar(535) NOT NULL,
  `no_telp` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orang_tua`
--

INSERT INTO `orang_tua` (`id_ortu`, `ayah`, `ibu`, `no_kk`, `alamat_ortu`, `no_telp`) VALUES
('-', '-', '-', '-', '-', '0'),
('20220415223014v5mp', 'asep', 'ibu', '12345', 'abcdrfghij', '12345678'),
('20220415234635YG5w', 'wadeqe12eqwe', 'dcasdafd', '54321', 'wqeasdsadqwqed', '2132453758907'),
('2022041605426GOe9', 'cdsds', 'ibu', '213454363', '13qrqrqewer', '132124141'),
('202206151430374AVK', 'agus', 'dcasdafd', '234', 'hgg', '089'),
('20220615143146i8SI', 'cdsds', 'ibu', '087', 'Kp.Loa Rt.01/Rw.09, Kel.Margawati Kec.Garut Kota', '098'),
('21315468742684asd', 'Ayah', 'Ibu', '1234567890', 'Alamat', '0'),
('21315468742684ase', 'Nama Ayah', 'Nama Ibu', '1235467890', 'Alamat', '0');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` varchar(20) NOT NULL,
  `id_santri` varchar(20) NOT NULL,
  `id_jenis_transaksi` varchar(20) NOT NULL,
  `jumlah` int(8) NOT NULL,
  `bulan_bayar` date NOT NULL,
  `tgl_bayar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_santri`, `id_jenis_transaksi`, `jumlah`, `bulan_bayar`, `tgl_bayar`) VALUES
('20220421110804LvNnbA', '2', '1', 3000, '2022-04-01', '2022-01-01'),
('20220421110908GFRZgb', '2', '1', 3000, '2022-03-01', '2022-03-01'),
('20220505111945jHXo7Z', '2', '1', 3000, '2022-05-02', '2022-02-01'),
('20220505115458HN57AS', '2', '1', 3000, '2022-02-17', '2022-02-24'),
('20220505115602UwOuxE', '1', '1', 10000, '2022-02-23', '2022-02-22'),
('202205211027570lQXxu', '2', '2', 3000, '2022-05-02', '2022-05-01'),
('20220523035150i3AP8K', '2022041605426GOe9', '7', 100, '2022-05-06', '2022-05-06'),
('20220523035150i3AP8L', '2022041605426GOe9', '7', 100, '2022-05-06', '2022-05-06'),
('202205230422432xyEih', '2022041605426GOe9', '7', 200, '2022-05-23', '2022-05-23'),
('20220523044705WXdl8H', '2022041605426GOe9', '7', 3600, '2022-05-12', '2022-05-12'),
('20220523081757afp0JQ', '2', '7', 1200, '2022-05-11', '2022-05-11'),
('20220524120753RW1VQn', '2', '7', 500, '2022-05-05', '2022-05-05'),
('20220524120818T9bXRp', '2', '7', 100, '2022-05-07', '2022-05-07'),
('20220615023437rNEMzZ', '2', '1', 3000, '2022-06-16', '2022-06-14'),
('20220615024310ahpCzn', '20220615143146i8SI', '1', 10000, '2022-06-14', '2022-06-07'),
('20220615024626IBijQG', '1', '1', 10000, '2022-06-15', '2022-06-15');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` varchar(20) NOT NULL,
  `tgl_pengeluaran` date NOT NULL,
  `keterangan` varchar(535) NOT NULL,
  `jumlah` int(9) NOT NULL,
  `id_kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `tgl_pengeluaran`, `keterangan`, `jumlah`, `id_kategori`) VALUES
('202204220105286lqyYJ', '2022-04-12', 'a', 1000, '4'),
('20220424051132ruTy9I', '2022-04-07', 'b', 500, '1'),
('20220424051754gbutZJ', '2022-01-13', 'as', 500, '1'),
('202204240615480wq9YO', '2022-01-06', 'faghghgdsfd fdghdfgfhs gdf ddhfhgstrss rsgdsghtkjdd srhsgs', 1000, '2'),
('202204241123133C0QGP', '2022-02-17', 'lashjd', 300, '1'),
('20220424114345RtMAO7', '2022-02-18', 'n', 200, '1'),
('202205060146253g46er', '2022-05-19', 'adaradsda', 200, '8'),
('202205211032438i4Rpe', '2022-05-01', 'tes pengeluaran kas 1', 200, '2'),
('20220523082318GwvxJ4', '2022-05-21', 'Tes pengeluaran bangunan bulan mei', 100, '7'),
('202206150224515KgROl', '2022-06-15', 'tes', 100, '2');

-- --------------------------------------------------------

--
-- Table structure for table `saldo`
--

CREATE TABLE `saldo` (
  `tanggal` date NOT NULL,
  `listrik` int(12) NOT NULL,
  `kas` int(12) NOT NULL,
  `beras` int(12) NOT NULL,
  `lauk` int(12) NOT NULL,
  `kesehatan` int(12) NOT NULL,
  `bangunan` int(12) NOT NULL,
  `bantuan` int(12) NOT NULL,
  `infaq` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saldo`
--

INSERT INTO `saldo` (`tanggal`, `listrik`, `kas`, `beras`, `lauk`, `kesehatan`, `bangunan`, `bantuan`, `infaq`) VALUES
('2022-01-01', 3000, 0, 0, 0, 0, 0, 1000, 0),
('2022-01-06', 3000, -1000, 0, 0, 0, 0, 1000, 0),
('2022-01-13', 2500, -1000, 0, 0, 0, 0, 1000, 0),
('2022-01-31', 5500, -1000, 0, 0, 0, 0, 1000, 0),
('2022-02-01', 8500, -1000, 0, 0, 0, 0, 2000, 0),
('2022-02-10', 8500, -1000, 0, 0, 0, 0, 2000, 0),
('2022-02-17', 8200, -1000, 0, 0, 0, 0, 2000, 0),
('2022-02-18', 8000, -1000, 0, 0, 0, 0, 2000, 0),
('2022-02-22', 18000, -1000, 0, 0, 0, 0, 2000, 0),
('2022-02-24', 21000, -1000, 0, 0, 0, 0, 2000, 0),
('2022-03-01', 24000, -1000, 0, 0, 0, 0, 3000, 0),
('2022-04-05', 24000, -1000, 0, 0, 0, 0, 3000, 0),
('2022-04-07', 23500, -1000, 0, 0, 0, 0, 3000, 0),
('2022-04-12', 23500, -1000, 0, 0, -1000, 0, 3000, 0),
('2022-04-15', 23500, -1000, 0, 0, -1000, 0, 3000, 0),
('2022-05-01', 23500, 1800, 0, 0, -1000, 0, 3000, 0),
('2022-05-05', 23500, 1800, 0, 0, -1000, 500, 3000, 0),
('2022-05-06', 23500, 1800, 0, 0, -1000, 700, 3000, 0),
('2022-05-07', 23500, 1800, 0, 0, -1000, 800, 3000, 0),
('2022-05-11', 23500, 1800, 0, 0, -1000, 2000, 3000, 0),
('2022-05-12', 23500, 1800, 0, 0, -1000, 5600, 3000, 0),
('2022-05-19', 23500, 1800, 0, 0, -1000, 5600, 2800, 0),
('2022-05-21', 23500, 1800, 0, 0, -1000, 5500, 2800, 0),
('2022-05-23', 23500, 1800, 0, 0, -1000, 5700, 2800, 0),
('2022-06-07', 33500, 1800, 0, 0, -1000, 5700, 2800, 0),
('2022-06-14', 36500, 1800, 0, 0, -1000, 5700, 2800, 0),
('2022-06-15', 46500, 1700, 0, 0, -1000, 5700, 2800, 0),
('2022-12-06', 46500, 1700, 0, 0, -1000, 5700, 3800, 0);

-- --------------------------------------------------------

--
-- Table structure for table `santri`
--

CREATE TABLE `santri` (
  `id_santri` varchar(25) NOT NULL,
  `nik` varchar(25) NOT NULL,
  `nis` varchar(25) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `tempat_lahir` varchar(128) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(535) NOT NULL,
  `foto` varchar(128) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_keluar` date NOT NULL,
  `status` char(2) NOT NULL,
  `id_orang_tua` varchar(20) NOT NULL,
  `id_angkatan` varchar(20) NOT NULL,
  `id_kategori_santri` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `santri`
--

INSERT INTO `santri` (`id_santri`, `nik`, `nis`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tgl_lahir`, `alamat`, `foto`, `tgl_masuk`, `tgl_keluar`, `status`, `id_orang_tua`, `id_angkatan`, `id_kategori_santri`) VALUES
('0', '-', '-', 'Tidak diketahui', '-', '-', '0000-00-00', '-', 'default_image.jpeg', '0000-00-00', '0000-00-00', '0', '-', '-', 0),
('1', '123456789134598', '1233568789654687', 'Santri', 'P', 'Garut', '2022-03-02', 'kahdgkfhasskd jhaskgdbashd jashdjka asdhjsagd asdhjsagdjashd sadjhasjgd asdhbjsadb asdjasbd asdbjsab dasbdbas d', 'default_image.jpg', '2022-01-01', '0000-00-00', '1', '21315468742684asd', '202203200722599sb1', 1),
('2', '1234567891345985', '1233568789654689', 'Nama Santri', 'L', 'Garut', '2022-03-02', 'kahdgkfhasskdjhaskgdbashd', 'default_image8.jpg', '2022-02-01', '0000-00-00', '1', '21315468742684ase', '20220320081949oOCa', 1),
('20220415223014v5mp', '12345', '12345', 'Deva Shofa Alfathin', 'P', 'Garut', '2022-03-30', 'abcdefg', 'default_image.jpg', '2022-03-31', '2022-06-15', '1', '20220415223014v5mp', '20220320081949oOCa', 3),
('2022041605426GOe9', '1122334455667788', '1234573', 'CONTOH pemilhan 11111', 'L', 'sadase', '2022-04-08', 'sadasdasdasd', 'default_image.jpg', '2022-03-31', '2022-12-31', '1', '2022041605426GOe9', '20220320081949oOCa', 1),
('202206151430374AVK', '0987', '98989', 'asep', 'L', 'Garut', '2022-06-14', 'Kp.Loa Rt.01/Rw.09, Kel.Margawati Kec.Garut Kota', 'default_image.jpg', '2022-06-15', '0000-00-00', '1', '202206151430374AVK', '202203200722599sb1', 2),
('20220615143146i8SI', '0888', '98', 'mnj', 'L', 'Garut', '2022-06-11', 'Kp.Loa Rt.01/Rw.09, Kel.Margawati Kec.Garut Kota', 'default_image.jpg', '2022-04-05', '0000-00-00', '1', '20220615143146i8SI', '202203200722599sb1', 1),
('20221121007196qho', '', '', 'Tidak diketahui', '-', '-', '0000-00-00', '-', '-', '2022-11-02', '0000-00-00', '-', '-', '20220320081949oOCa', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(5) NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `role_id` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `nama`, `image`, `role_id`) VALUES
(1, 'administrator', 'administrator@gmail.com', 'YWRtaW5pc3RyYXRvcg==', 'Umi', 'default_image.jpg', '0'),
(2, 'bendahara', 'bendahara@gmail.com', 'YmVuZGFoYXJh', 'Bendahara', 'default_image.jpg', '1'),
(3, 'pengurus2', 'pengurus2@gmail.com', 'cGVuZ3VydXMy', 'Pengurus Santri Putri ', 'default_image.jpg', '3'),
(4, 'pengurus1', 'pengurus1@gmail.com', 'cGVuZ3VydXMx', 'Pengurus Santri Putra', 'default_image.jpg', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `angkatan`
--
ALTER TABLE `angkatan`
  ADD PRIMARY KEY (`id_angkatan`);

--
-- Indexes for table `aturan_pembayaran`
--
ALTER TABLE `aturan_pembayaran`
  ADD PRIMARY KEY (`id_aturan_bayar`);

--
-- Indexes for table `bantuan`
--
ALTER TABLE `bantuan`
  ADD PRIMARY KEY (`id_bantuan`);

--
-- Indexes for table `kategori_pembayaran`
--
ALTER TABLE `kategori_pembayaran`
  ADD PRIMARY KEY (`id_kategori_pembayaran`);

--
-- Indexes for table `kategori_santri`
--
ALTER TABLE `kategori_santri`
  ADD PRIMARY KEY (`id_kategori_santri`);

--
-- Indexes for table `orang_tua`
--
ALTER TABLE `orang_tua`
  ADD PRIMARY KEY (`id_ortu`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indexes for table `saldo`
--
ALTER TABLE `saldo`
  ADD PRIMARY KEY (`tanggal`);

--
-- Indexes for table `santri`
--
ALTER TABLE `santri`
  ADD PRIMARY KEY (`id_santri`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD UNIQUE KEY `nis` (`nis`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
