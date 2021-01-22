-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2020 at 03:19 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `husada`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id_dosen` double NOT NULL,
  `id_prodi` int(10) UNSIGNED DEFAULT NULL,
  `NIP` varchar(20) NOT NULL,
  `akta` varchar(40) DEFAULT NULL,
  `jenis_identitas` varchar(10) DEFAULT NULL,
  `no_identitas` varchar(40) DEFAULT NULL,
  `nama` varchar(80) NOT NULL,
  `title` varchar(40) DEFAULT NULL,
  `gelar` varchar(40) DEFAULT NULL,
  `kelamin` varchar(1) DEFAULT 'P' COMMENT 'P,L',
  `tmp_lahir` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `alamat` varchar(80) DEFAULT NULL,
  `kodepos` varchar(5) DEFAULT NULL,
  `negara` varchar(50) DEFAULT NULL,
  `propinsi` varchar(50) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `NIDN` varchar(40) DEFAULT NULL,
  `status_pegawai` varchar(10) DEFAULT 'TETAP',
  `status` varchar(10) DEFAULT 'AKTIF',
  `mulai_aktif` date DEFAULT NULL,
  `id_jabatan` int(10) UNSIGNED DEFAULT NULL,
  `gol_darah` varchar(2) DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `sk_angkat` varchar(40) DEFAULT NULL,
  `facebook` varchar(80) DEFAULT NULL,
  `twitter` varchar(80) DEFAULT NULL,
  `bbm` varchar(80) DEFAULT NULL,
  `no_seri_dosen` varchar(20) DEFAULT NULL,
  `no_rekening` varchar(20) DEFAULT NULL,
  `create_user` int(10) UNSIGNED DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `lastup_user` int(10) UNSIGNED DEFAULT NULL,
  `lastup_date` datetime DEFAULT NULL,
  `flag_karyawan` int(10) UNSIGNED DEFAULT 0,
  `foto` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `flag_login` int(10) UNSIGNED DEFAULT 0,
  `pass_reset` varchar(100) DEFAULT NULL,
  `login_session` varchar(100) DEFAULT NULL,
  `auth_key` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id_dosen`, `id_prodi`, `NIP`, `akta`, `jenis_identitas`, `no_identitas`, `nama`, `title`, `gelar`, `kelamin`, `tmp_lahir`, `tgl_lahir`, `telepon`, `hp`, `email`, `alamat`, `kodepos`, `negara`, `propinsi`, `kota`, `NIDN`, `status_pegawai`, `status`, `mulai_aktif`, `id_jabatan`, `gol_darah`, `tgl_masuk`, `sk_angkat`, `facebook`, `twitter`, `bbm`, `no_seri_dosen`, `no_rekening`, `create_user`, `create_date`, `lastup_user`, `lastup_date`, `flag_karyawan`, `foto`, `password`, `flag_login`, `pass_reset`, `login_session`, `auth_key`) VALUES
(1, 1, '111690001', '', '', '', 'Shinta Prawitasari', '', 'M.Kep', 'P', 'Jakarta', '1900-01-00', NULL, NULL, NULL, NULL, NULL, 'INDONESIA', NULL, NULL, '320096907', 'TETAP', 'AKTIF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1.jpg', '$2y$13$wnDHdjynmVomr7WkkhYoWeilw5R85Je8VGQiTxa0MnV6Rt89OM322', 1, NULL, NULL, 'c4ca4238a0b923820dcc509a6f75849b'),
(2, 1, '111700002', '', '', '', 'Enni Juliani', '', 'M.Kep', 'P', '', '1970-07-11', NULL, NULL, NULL, NULL, NULL, 'INDONESIA', NULL, NULL, '311077003', 'TETAP', 'AKTIF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '$2y$13$wnDHdjynmVomr7WkkhYoWeilw5R85Je8VGQiTxa0MnV6Rt89OM322', 1, NULL, NULL, 'c81e728d9d4c2f636f067f89cc14862c'),
(3, 1, '111590003 ', '', '', ' ', 'Ni Made Suarti', 'Ns.', 'M.Kep', 'P', 'Denpasar', '1900-01-00', NULL, NULL, NULL, NULL, NULL, 'INDONESIA', NULL, NULL, '0', 'TETAP', 'AKTIF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '$2y$13$wnDHdjynmVomr7WkkhYoWeilw5R85Je8VGQiTxa0MnV6Rt89OM322', 1, NULL, NULL, 'eccbc87e4b5ce2fe28308fd9f2a7baf3'),
(4, 1, '21012014017', '', '', '', 'Rasyid Sartuni', '', 'MA', 'P', '', '1900-01-00', NULL, NULL, NULL, NULL, NULL, 'INDONESIA', NULL, NULL, '0', 'TETAP', 'AKTIF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '$2y$13$wnDHdjynmVomr7WkkhYoWeilw5R85Je8VGQiTxa0MnV6Rt89OM322', 1, NULL, NULL, 'a87ff679a2f3e71d9181a67b7542122c'),
(5, 1, '21012014018', '', '', '', 'Eirene R', 'Ns.', 'S.Kep', 'P', '', '1900-01-00', NULL, NULL, NULL, NULL, NULL, 'INDONESIA', NULL, NULL, '0', 'TETAP', 'AKTIF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '$2y$13$wnDHdjynmVomr7WkkhYoWeilw5R85Je8VGQiTxa0MnV6Rt89OM322', 1, NULL, NULL, 'e4da3b7fbbce2345d7772b0674a318d5'),
(6, 1, '21012014019', '', '', '', 'Anom Jatiningsih', '', '', 'P', '', '1900-01-00', NULL, NULL, NULL, NULL, NULL, 'INDONESIA', NULL, NULL, '0', 'TETAP', 'AKTIF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '$2y$13$wnDHdjynmVomr7WkkhYoWeilw5R85Je8VGQiTxa0MnV6Rt89OM322', 1, NULL, NULL, '1679091c5a880faf6fb5e6087eb1b2dc'),
(7, 1, '21012014020', '', 'KTP', '', 'Hendra', '', '', 'P', '', '1900-01-00', '', '', '', '', '', 'INDONESIA', '', '', '0', 'TETAP', 'AKTIF', NULL, NULL, 'A', NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, 0, '7.jpg', '$2y$13$wnDHdjynmVomr7WkkhYoWeilw5R85Je8VGQiTxa0MnV6Rt89OM322', 1, NULL, NULL, '8f14e45fceea167a5a36dedd4bea2543'),
(8, 1, '21012014021', '', '', '', 'Zhu Ting', '', '', 'P', '', '1900-01-00', NULL, NULL, NULL, NULL, NULL, 'INDONESIA', NULL, NULL, '123', 'TETAP', 'AKTIF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '$2y$13$wnDHdjynmVomr7WkkhYoWeilw5R85Je8VGQiTxa0MnV6Rt89OM322', 1, NULL, NULL, 'c9f0f895fb98ab9159f51fd0297e236d'),
(9, 1, '21012014022', '', '', '', 'Rosnalisa', '', ' M.Psi', 'P', '', '1900-01-00', NULL, NULL, NULL, NULL, NULL, 'INDONESIA', NULL, NULL, '0', 'TETAP', 'AKTIF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '$2y$13$wnDHdjynmVomr7WkkhYoWeilw5R85Je8VGQiTxa0MnV6Rt89OM322', 1, NULL, NULL, '45c48cce2e2d7fbdea1afc51c7c6ad26'),
(10, 1, '21012014023', '', '', '', 'Phinehas Eka', 'M.Psi', '', 'P', '', '1900-01-00', NULL, NULL, NULL, NULL, NULL, 'INDONESIA', NULL, NULL, '0', 'TETAP', 'AKTIF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '$2y$13$wnDHdjynmVomr7WkkhYoWeilw5R85Je8VGQiTxa0MnV6Rt89OM322', 1, NULL, NULL, 'd3d9446802a44259755d38e6d163e820'),
(11, 1, '21012014024', '', '', '', 'Enty', 'Sp.Mk', '', 'P', '', '1900-01-00', NULL, NULL, NULL, NULL, NULL, 'INDONESIA', NULL, NULL, '0', 'TETAP', 'AKTIF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '$2y$13$wnDHdjynmVomr7WkkhYoWeilw5R85Je8VGQiTxa0MnV6Rt89OM322', 1, NULL, NULL, '6512bd43d9caa6e02c990b0a82652dca'),
(12, 1, '21012014025', '', '', '', 'Soerini', 'Si.Apt', '', 'P', '', '1900-01-00', NULL, NULL, NULL, NULL, NULL, 'INDONESIA', NULL, NULL, '0', 'TETAP', 'AKTIF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '$2y$13$wnDHdjynmVomr7WkkhYoWeilw5R85Je8VGQiTxa0MnV6Rt89OM322', 1, NULL, NULL, 'c20ad4d76fe97759aa27a0c99bff6710'),
(13, 1, '21012014026', '', '', '', 'Dewi Indrianti, S.Pd', '', '', 'P', '', '1900-01-00', NULL, NULL, NULL, NULL, NULL, 'INDONESIA', NULL, NULL, '0', 'TETAP', 'AKTIF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '$2y$13$wnDHdjynmVomr7WkkhYoWeilw5R85Je8VGQiTxa0MnV6Rt89OM322', 1, NULL, NULL, 'c51ce410c124a10e0db5e4b97fc2af39'),
(14, 1, '21012014027', '', '', '', 'Dewi Indriyanti, S.Pd', '', 'S.Pd', 'L', '', '1900-01-00', NULL, NULL, NULL, NULL, NULL, 'INDONESIA', NULL, NULL, '0', 'TETAP', 'AKTIF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '$2y$13$wnDHdjynmVomr7WkkhYoWeilw5R85Je8VGQiTxa0MnV6Rt89OM322', 1, NULL, NULL, 'aab3238922bcc25a6f606eb525ffdc56'),
(15, 1, '21012014028', '', '', '', 'Ellynia, SE.,MM', '', '', 'P', '', '1900-01-00', NULL, NULL, NULL, NULL, NULL, 'INDONESIA', NULL, NULL, '321127901', 'TETAP', 'AKTIF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '$2y$13$wnDHdjynmVomr7WkkhYoWeilw5R85Je8VGQiTxa0MnV6Rt89OM322', 1, NULL, NULL, '9bf31c7ff062936a96d3c8bd1f8f2ff3'),
(16, 1, '21012014029', '', '', '', 'Ellynia, SE.,MM', '', '', 'P', '', '1900-01-00', NULL, NULL, NULL, NULL, NULL, 'INDONESIA', NULL, NULL, '0', 'TETAP', 'AKTIF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '$2y$13$wnDHdjynmVomr7WkkhYoWeilw5R85Je8VGQiTxa0MnV6Rt89OM322', 1, NULL, NULL, 'c74d97b01eae257e44aa9d5bade97baf'),
(17, 1, '21012014030', '', '', '', 'Ardi Ardiansyah', '', '', 'L', '', '1900-01-00', NULL, NULL, NULL, NULL, NULL, 'INDONESIA', NULL, NULL, '0', 'TETAP', 'AKTIF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '$2y$13$wnDHdjynmVomr7WkkhYoWeilw5R85Je8VGQiTxa0MnV6Rt89OM322', 1, NULL, NULL, '70efdf2ec9b086079795c442636b55fb'),
(18, 1, '21012014031', '', '', '', 'Evvi Sugiharti', '', '', 'P', '', '1900-01-00', NULL, NULL, NULL, NULL, NULL, 'INDONESIA', NULL, NULL, '0', 'TETAP', 'AKTIF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '$2y$13$wnDHdjynmVomr7WkkhYoWeilw5R85Je8VGQiTxa0MnV6Rt89OM322', 1, NULL, NULL, '6f4922f45568161a8cdf4ad2299f6d23'),
(19, 1, '21012014032', '', '', '', 'Ns. Malianti Silalahi, S.Kep', '', '', 'P', '', '1900-01-00', NULL, NULL, NULL, NULL, NULL, 'INDONESIA', NULL, NULL, '0', 'TETAP', 'AKTIF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '$2y$13$wnDHdjynmVomr7WkkhYoWeilw5R85Je8VGQiTxa0MnV6Rt89OM322', 1, NULL, NULL, '1f0e3dad99908345f7439f8ffabdffc4'),
(20, 1, '21012014033', '', '', '', 'Veronica Yeni', 'Ns.', 'S.Kep', 'P', 'Kediri', '1988-11-24', NULL, NULL, NULL, NULL, NULL, 'INDONESIA', NULL, NULL, '0', 'TETAP', 'AKTIF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '$2y$13$wnDHdjynmVomr7WkkhYoWeilw5R85Je8VGQiTxa0MnV6Rt89OM322', 1, NULL, NULL, '98f13708210194c475687be6106a3b84'),
(21, 1, '21012014034', '', '', '', 'Ns. Santa Maria', '', '', 'P', '', '1900-01-00', NULL, NULL, NULL, NULL, NULL, 'INDONESIA', NULL, NULL, '0', 'TETAP', 'AKTIF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '$2y$13$wnDHdjynmVomr7WkkhYoWeilw5R85Je8VGQiTxa0MnV6Rt89OM322', 1, NULL, NULL, '3c59dc048e8850243be8079a5c74d079'),
(22, 1, '21012014035', '', '', '', 'Andri Sulaswati', '', '', 'P', '', '1900-01-00', NULL, NULL, 'Andri.Sulaswati@gmail.com', NULL, NULL, 'INDONESIA', NULL, NULL, '0', 'TETAP', 'AKTIF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '$2y$13$wnDHdjynmVomr7WkkhYoWeilw5R85Je8VGQiTxa0MnV6Rt89OM322', 1, NULL, NULL, 'b6d767d2f8ed5d21a44b0e5886680cb9'),
(23, 1, '21012014036', '', '', '', 'dr. Andi', '', '', 'P', '', '1900-01-00', NULL, NULL, NULL, NULL, NULL, 'INDONESIA', NULL, NULL, '0', 'TETAP', 'AKTIF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '$2y$13$wnDHdjynmVomr7WkkhYoWeilw5R85Je8VGQiTxa0MnV6Rt89OM322', 1, NULL, NULL, '37693cfc748049e45d87b8c7d8b9aacd'),
(24, 1, '21012014037', '', '', '', 'Ika Mustafida', 'Ns.', 'S.Kep', 'L', '', '1900-01-00', NULL, NULL, NULL, NULL, NULL, 'INDONESIA', NULL, NULL, '0', 'TETAP', 'AKTIF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '$2y$13$wnDHdjynmVomr7WkkhYoWeilw5R85Je8VGQiTxa0MnV6Rt89OM322', 1, NULL, NULL, '1ff1de774005f8da13f42943881c655f'),
(25, 1, '21012014038', '', 'KTP', '321117430289000', 'Ressa Andriyani Utami', 'Ns.', 'M.Kep., Sp.Kep.Kom', 'P', 'Sumedang', '1989-02-03', NULL, NULL, NULL, NULL, NULL, 'INDONESIA', NULL, NULL, '0', 'TETAP', 'AKTIF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '$2y$13$wnDHdjynmVomr7WkkhYoWeilw5R85Je8VGQiTxa0MnV6Rt89OM322', 1, NULL, NULL, '8e296a067a37563370ded05f5a3bf3ec'),
(26, 1, '21012014039', '', '', '', 'Rini Warini', 'Ns.', 'S.Kep', 'P', '', '1900-01-00', NULL, NULL, NULL, NULL, NULL, 'INDONESIA', NULL, NULL, '0', 'TETAP', 'AKTIF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '$2y$13$wnDHdjynmVomr7WkkhYoWeilw5R85Je8VGQiTxa0MnV6Rt89OM322', 1, NULL, NULL, '4e732ced3463d06de0ca9a15b6153677'),
(27, 1, '20190101001', NULL, 'KTP', '1234567890', 'Jemy', '', 'S.Kom', 'L', 'Medan', '1978-01-18', '', '081911151230', 'jemy.id@gmail.com', 'karawaci', '15810', 'INDONESIA', 'BANTEN', 'TANGERANG', NULL, 'MAGANG', 'AKTIF', NULL, NULL, 'B', NULL, NULL, 'jemy', '', '', '', '1080635920', NULL, NULL, NULL, NULL, 1, NULL, '$2y$13$wnDHdjynmVomr7WkkhYoWeilw5R85Je8VGQiTxa0MnV6Rt89OM322', 1, NULL, NULL, '02e74f10e0327ad868d138f2b4fdd6f0'),
(28, NULL, '202001001', NULL, 'KTP', '', 'Regina', '', '', 'P', '', '1900-01-01', '', '', 'reginaer74@gmail.com', '', '', '', '', '', NULL, 'MAGANG', 'AKTIF', NULL, NULL, 'A', NULL, NULL, '', '', '', NULL, '', NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id_dosen`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id_dosen` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
