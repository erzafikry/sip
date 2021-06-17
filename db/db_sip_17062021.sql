-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2021 at 12:44 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sip`
--

-- --------------------------------------------------------

--
-- Table structure for table `ms_berkas`
--

CREATE TABLE `ms_berkas` (
  `id_berkas` int(11) NOT NULL,
  `no_berkas` varchar(25) NOT NULL,
  `tahun_berkas` int(4) NOT NULL,
  `id_pemohon` int(11) NOT NULL,
  `id_layanan` int(11) NOT NULL,
  `id_kecamatan` int(11) NOT NULL,
  `id_kelurahan` int(11) NOT NULL,
  `volume` int(4) NOT NULL,
  `di_305` varchar(25) NOT NULL,
  `di_302` varchar(25) NOT NULL,
  `status_berkas` varchar(15) NOT NULL,
  `keterangan_berkas` text NOT NULL,
  `createdBy` varchar(250) DEFAULT NULL,
  `createdTime` date DEFAULT NULL,
  `updatedBy` varchar(250) DEFAULT NULL,
  `updatedTime` date DEFAULT NULL,
  `no_surtug` varchar(50) DEFAULT NULL,
  `tgl_mulai_surtug` date DEFAULT NULL,
  `tgl_terbit_surtug` date DEFAULT NULL,
  `id_petugas_ukur` int(6) DEFAULT NULL,
  `id_petugas_grafis` int(6) DEFAULT NULL,
  `id_petugas_textual` int(6) DEFAULT NULL,
  `id_kasubsie` int(6) DEFAULT NULL,
  `id_kasie` int(6) DEFAULT NULL,
  `posisi_berkas` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ms_berkas`
--

INSERT INTO `ms_berkas` (`id_berkas`, `no_berkas`, `tahun_berkas`, `id_pemohon`, `id_layanan`, `id_kecamatan`, `id_kelurahan`, `volume`, `di_305`, `di_302`, `status_berkas`, `keterangan_berkas`, `createdBy`, `createdTime`, `updatedBy`, `updatedTime`, `no_surtug`, `tgl_mulai_surtug`, `tgl_terbit_surtug`, `id_petugas_ukur`, `id_petugas_grafis`, `id_petugas_textual`, `id_kasubsie`, `id_kasie`, `posisi_berkas`) VALUES
(1, '0001', 2010, 3, 2, 1, 6, 232, ' 1212', ' 332434', 'Active', 'sdsd', '1', '2020-11-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Petugas Ukur'),
(2, '3434', 2010, 8, 3, 2, 8, 43243, '1212', '1212344', 'Active', 'dfsdfdsfdsf', '25', '2020-11-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Petugas Ukur'),
(3, '43545', 2010, 8, 3, 2, 9, 343, '32432', '34234', 'Active', 'dsfsdf', '25', '2020-11-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Petugas Ukur'),
(4, '45435', 2020, 6, 3, 2, 10, 434, '657657', '543534', 'Active', 'dgfgdfgdfg', '25', '2020-11-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Petugas Ukur'),
(5, '876876', 2020, 6, 3, 4, 20, 232, '46565', '7878', 'Active', 'hjkhjkh', '25', '2020-11-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Petugas Ukur'),
(6, '203994431', 2021, 8, 2, 1, 1, 121, '43242      ', '32232      ', 'Dibuat', 'test', '1', '2021-06-16', '1', '2021-06-16', '20209020', '2021-05-30', '2021-06-23', 17, NULL, NULL, NULL, NULL, 'Petugas Ukur');

-- --------------------------------------------------------

--
-- Table structure for table `ms_jabatan`
--

CREATE TABLE `ms_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(250) NOT NULL,
  `tipe_jabatan` enum('Struktural','Jabatan Fungsional Umum','Jabatan Fungsional Tertentu','PPNPN','Petugas Ukur','SKB','ASKB','Pembantu Ukur') NOT NULL,
  `eselon` varchar(4) DEFAULT NULL,
  `createdBy` varchar(250) DEFAULT NULL,
  `createdTime` date DEFAULT NULL,
  `updatedBy` varchar(250) DEFAULT NULL,
  `updatedTime` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_jabatan`
--

INSERT INTO `ms_jabatan` (`id_jabatan`, `nama_jabatan`, `tipe_jabatan`, `eselon`, `createdBy`, `createdTime`, `updatedBy`, `updatedTime`) VALUES
(19, 'Kepala Seksi Infrastruktur Pertanahan ', 'Struktural', 'IV', '', '0000-00-00', '', '0000-00-00'),
(20, 'Kepala Subseksi Pengukuran dan Pemetaan Dasar dan Tematik', 'Struktural', 'V', '', '0000-00-00', '', '0000-00-00'),
(21, 'Kepala Subseksi Pengukuran dan Pemetaan Kadastral ', 'Struktural', 'V', '', '0000-00-00', '', '0000-00-00'),
(37, 'Petugas Ukur', 'Jabatan Fungsional Umum', '-', '', '0000-00-00', '1', '2020-10-22'),
(50, 'Surveyor Pemetaan Penyelia', 'Jabatan Fungsional Tertentu', '-', '1', '2020-10-22', NULL, NULL),
(51, 'Pengadministrasi Pertanahan', 'Jabatan Fungsional Umum', '-', '1', '2020-10-22', NULL, NULL),
(52, 'Analis Survei, Pengukuran Dan Pemetaan', 'Jabatan Fungsional Umum', '-', '1', '2020-10-22', NULL, NULL),
(53, 'Surveyor Pemetaan Pelaksana', 'Jabatan Fungsional Tertentu', '-', '1', '2020-10-22', NULL, NULL),
(54, 'Asisten Surveyor Kadaster Berlisensi', 'ASKB', '-', '1', '2020-10-22', NULL, NULL),
(55, 'Pembantu Ukur', 'Pembantu Ukur', '-', '1', '2020-10-22', NULL, NULL),
(56, 'PPNPN', 'PPNPN', '-', '1', '2020-10-22', NULL, NULL),
(57, 'Pengelola Aplikasi', 'PPNPN', '-', '', '0000-00-00', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `ms_kecamatan`
--

CREATE TABLE `ms_kecamatan` (
  `id_kecamatan` int(11) NOT NULL,
  `id_kota` int(11) NOT NULL,
  `nama_kecamatan` varchar(100) NOT NULL,
  `keterangan_kecamatan` text,
  `status_kecamatan` enum('Active','Non Active') NOT NULL,
  `createdBy` varchar(250) DEFAULT NULL,
  `createdTime` date DEFAULT NULL,
  `updatedBy` varchar(250) DEFAULT NULL,
  `updatedTime` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ms_kecamatan`
--

INSERT INTO `ms_kecamatan` (`id_kecamatan`, `id_kota`, `nama_kecamatan`, `keterangan_kecamatan`, `status_kecamatan`, `createdBy`, `createdTime`, `updatedBy`, `updatedTime`) VALUES
(1, 1, 'Andir', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(2, 1, 'Antapani', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(3, 1, 'Arcamanik', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(4, 1, 'Astanaanyar', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(5, 1, 'Babakan Ciparay', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(6, 1, 'Bandung Kidul', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(7, 1, 'Bandung Kulon', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(8, 1, 'Bandung Wetan', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(9, 1, 'Batununggal', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(10, 1, 'Bojongloa Kaler', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(11, 1, 'Bojongloa Kidul', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(12, 1, 'Buahbatu', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(13, 1, 'Cibeunying Kaler', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(14, 1, 'Cibeunying Kidul', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(15, 1, 'Cibiru', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(16, 1, 'Cicendo', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(17, 1, 'Cidadap', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(18, 1, 'Cinambo', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(19, 1, 'Coblong', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(20, 1, 'Gedebage', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(21, 1, 'Kiara Condong', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(22, 1, 'Lengkong', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(23, 1, 'Mandalajati', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(24, 1, 'Panyileukan', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(25, 1, 'Rancasari', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(26, 1, 'Regol', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(27, 1, 'Sukajadi', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(28, 1, 'Sukasari', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(29, 1, 'Sumur Bandung', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(30, 1, 'Ujungberung', '-', 'Active', '', '0000-00-00', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `ms_kelurahan`
--

CREATE TABLE `ms_kelurahan` (
  `id_kelurahan` int(11) NOT NULL,
  `id_kecamatan` int(11) NOT NULL,
  `nama_kelurahan` varchar(100) NOT NULL,
  `keterangan_kelurahan` text,
  `status_kelurahan` enum('Active','Non Active') NOT NULL,
  `createdBy` varchar(250) DEFAULT NULL,
  `createdTime` date DEFAULT NULL,
  `updatedBy` varchar(250) DEFAULT NULL,
  `updatedTime` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ms_kelurahan`
--

INSERT INTO `ms_kelurahan` (`id_kelurahan`, `id_kecamatan`, `nama_kelurahan`, `keterangan_kelurahan`, `status_kelurahan`, `createdBy`, `createdTime`, `updatedBy`, `updatedTime`) VALUES
(1, 1, 'Campaka', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(2, 1, 'Ciroyom', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(3, 1, 'Dunguscariang', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(4, 1, 'Garuda', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(5, 1, 'Kebon Jeruk', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(6, 1, 'Maleber', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(7, 2, 'Antapani', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(8, 2, 'Antapani Kidul', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(9, 2, 'Antapani Kulon', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(10, 2, 'Antapani Tengah', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(11, 2, 'Antapani Wetan', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(12, 2, 'Karang Pamulang', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(13, 2, 'Mandalajati', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(14, 3, 'Cisaranten Bina Harapan', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(15, 3, 'Cisaranten Endah', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(16, 3, 'Cisaranten Kulon', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(17, 3, 'Sindang Jaya', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(18, 3, 'Sukamiskin', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(19, 4, 'Cibadak', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(20, 4, 'Karanganyar', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(21, 4, 'Karasak', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(22, 4, 'Nyengseret', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(23, 4, 'Panjunan', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(24, 4, 'Pelindung Hewan', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(25, 5, 'Babakan', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(26, 5, 'Babakan Ciparay', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(27, 5, 'Cirangrang', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(28, 5, 'Margahayu Utara', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(29, 5, 'Margasuka', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(30, 5, 'Sukahaji', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(31, 6, 'Batununggal', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(32, 6, 'Kujang Sari', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(33, 6, 'Mengger', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(34, 6, 'Wates', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(35, 7, 'Caringin', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(36, 7, 'Cibuntu', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(37, 7, 'Cigondewah Kaler', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(38, 7, 'Cigondewah Kidul', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(39, 7, 'Cigondewah Rahayu', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(40, 7, 'Cijerah', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(41, 7, 'Gempol Sari', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(42, 7, 'Warung Muncang', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(43, 8, 'Cihapit', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(44, 8, 'Citarum', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(45, 8, 'Taman Sari', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(46, 9, 'Binong', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(47, 9, 'Cibangkong', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(48, 9, 'Gumuruh', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(49, 9, 'Kacapiring', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(50, 9, 'Kebon Gedang', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(51, 9, 'Kebon Waru', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(52, 9, 'Maleer', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(53, 9, 'Samoja', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(54, 10, 'Babakan Asih', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(55, 10, 'Babakan Tarogong', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(56, 10, 'Jamika', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(57, 10, 'Kopo', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(58, 10, 'Sukaasih', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(59, 11, 'Cibaduyut', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(60, 11, 'Cibaduyut Kidul', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(61, 11, 'Cibaduyut Wetan', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(62, 11, 'Kebon Lega', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(63, 11, 'Mekarwangi', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(64, 11, 'Situsaeur', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(65, 12, 'Cijawura', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(66, 12, 'Jati Sari', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(67, 12, 'Margasari', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(68, 12, 'Margasenang', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(69, 12, 'Sekejati', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(70, 13, 'Cigadung', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(71, 13, 'Cihaurgeulis', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(72, 13, 'Neglasari', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(73, 13, 'Sukaluyu', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(74, 14, 'Cicadas', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(75, 14, 'Cikutra', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(76, 14, 'Padasuka', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(77, 14, 'Pasirlayung', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(78, 14, 'Sukamaju', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(79, 14, 'Sukapada', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(80, 15, 'Cipadung', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(81, 15, 'Cipadung Kidul', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(82, 15, 'Cipadung Kulon', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(83, 15, 'Cisurupan', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(84, 15, 'Palasari', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(85, 15, 'Pasir Biru', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(86, 16, 'Arjuna', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(87, 16, 'Husen Sastranegara', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(88, 16, 'Pajajaran', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(89, 16, 'Pamoyanan', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(90, 16, 'Pasirkaliki', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(91, 16, 'Sukaraja', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(92, 17, 'Ciumbuleuit', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(93, 17, 'Hegarmanah', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(94, 17, 'Ledeng', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(95, 18, 'Babakan Penghulu', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(96, 18, 'Cisaranten Wetan', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(97, 18, 'Pakemitan', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(98, 18, 'Sukamulya', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(99, 19, 'Cipaganti', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(100, 19, 'Dago', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(101, 19, 'Lebak Siliwangi', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(102, 19, 'Lebakgede', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(103, 19, 'Sadang Serang', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(104, 19, 'Sekeloa', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(105, 20, 'Cimincrang', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(106, 20, 'Cisaranten Kidul', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(107, 20, 'Rancabolang', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(108, 20, 'Rancanumpang', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(109, 21, 'Babakan Sari', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(110, 21, 'Babakan Surabaya', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(111, 21, 'Cicaheum', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(112, 21, 'Kebon Jayanti', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(113, 21, 'Kebon Kangkung', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(114, 21, 'Sukapura', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(115, 22, 'Burangrang', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(116, 22, 'Cijagra', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(117, 22, 'Cikawao', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(118, 22, 'Lingkar Selatan', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(119, 22, 'Malabar', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(120, 22, 'Paledang', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(121, 22, 'Turangga', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(122, 23, 'Jatihandap', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(123, 23, 'Karang Pamulang', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(124, 23, 'Pasir Impun', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(125, 23, 'Sindang Jaya', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(126, 24, 'Cipadung Kidul', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(127, 24, 'Cipadung Kulon', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(128, 24, 'Cipadung Wetan', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(129, 24, 'Mekar Mulya', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(130, 25, 'Cipamokolan', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(131, 25, 'Cisaranten Kidul', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(132, 25, 'Derwati', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(133, 25, 'Manjahlega', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(134, 25, 'Mekar Jaya', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(135, 25, 'Mekar Mulya', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(136, 26, 'Ancol', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(137, 26, 'Balonggede', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(138, 26, 'Ciateul', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(139, 26, 'Cigereleng', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(140, 26, 'Ciseureuh', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(141, 26, 'Pasirluyu', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(142, 26, 'Pungkur', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(143, 27, 'Cipedes', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(144, 27, 'Pasteur', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(145, 27, 'Sukabungah', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(146, 27, 'Sukagalih', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(147, 27, 'Sukawarna', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(148, 28, 'Gegerkalong', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(149, 28, 'Isola', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(150, 28, 'Sarijadi', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(151, 28, 'Sukarasa', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(152, 29, 'Babakan Ciamis', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(153, 29, 'Braga', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(154, 29, 'Kebon Pisang', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(155, 29, 'Merdeka', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(156, 30, 'Cigending', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(157, 30, 'Pasanggrahan', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(158, 30, 'Pasir Endah', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(159, 30, 'Pasir Jati', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(160, 30, 'Pasir Wangi', '-', 'Active', '', '0000-00-00', '', '0000-00-00'),
(161, 30, 'Ujung Berung', '-', 'Active', '', '0000-00-00', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `ms_kota`
--

CREATE TABLE `ms_kota` (
  `id_kota` int(11) NOT NULL,
  `id_provinsi` int(11) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `keterangan_kota` text,
  `status_kota` enum('Active','Non Active') NOT NULL,
  `createdBy` varchar(250) DEFAULT NULL,
  `createdTime` date DEFAULT NULL,
  `updatedBy` varchar(250) DEFAULT NULL,
  `updatedTime` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ms_kota`
--

INSERT INTO `ms_kota` (`id_kota`, `id_provinsi`, `nama_kota`, `keterangan_kota`, `status_kota`, `createdBy`, `createdTime`, `updatedBy`, `updatedTime`) VALUES
(1, 1, 'Kota Bandung', '-', 'Active', '1', '2020-10-21', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ms_layanan`
--

CREATE TABLE `ms_layanan` (
  `id_layanan` int(4) NOT NULL,
  `nama_layanan` varchar(50) NOT NULL,
  `keterangan_layanan` text,
  `status_layanan` enum('Active','Non Active') NOT NULL,
  `createdBy` varchar(250) DEFAULT NULL,
  `createdTime` date DEFAULT NULL,
  `updatedBy` varchar(250) DEFAULT NULL,
  `updatedTime` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ms_layanan`
--

INSERT INTO `ms_layanan` (`id_layanan`, `nama_layanan`, `keterangan_layanan`, `status_layanan`, `createdBy`, `createdTime`, `updatedBy`, `updatedTime`) VALUES
(2, 'Pemecahan Bidang', 'Pengukuran dan Pemetaan', 'Active', '1', '2020-10-22', '1', '2020-10-23'),
(3, 'Pemisahan Bidang', 'Pengukuran dan Pemetaan', 'Active', '1', '2020-10-22', NULL, NULL),
(4, 'Penggabungan Bidang', 'Pengukuran dan Pemetaan', 'Active', '1', '2020-10-22', NULL, NULL),
(5, 'Pengakuan Hak', 'Pengukuran dan Pemetaan', 'Active', '1', '2020-10-22', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ms_pegawai`
--

CREATE TABLE `ms_pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `nama_pegawai` varchar(250) NOT NULL,
  `alamat_pegawai` varchar(250) DEFAULT NULL,
  `tempat_lahir_pegawai` varchar(250) DEFAULT NULL,
  `tgl_lahir_pegawai` date DEFAULT NULL,
  `kelamin_pegawai` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `status_pegawai` enum('Active','Non Active') DEFAULT NULL,
  `id_satker` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `createdBy` varchar(250) DEFAULT NULL,
  `createdTime` date DEFAULT NULL,
  `updatedBy` varchar(250) DEFAULT NULL,
  `updatedTime` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_pegawai`
--

INSERT INTO `ms_pegawai` (`id_pegawai`, `nip`, `nama_pegawai`, `alamat_pegawai`, `tempat_lahir_pegawai`, `tgl_lahir_pegawai`, `kelamin_pegawai`, `status_pegawai`, `id_satker`, `id_jabatan`, `createdBy`, `createdTime`, `updatedBy`, `updatedTime`) VALUES
(9, '910200107', 'Erza Fikry', 'Jl. Saturnus Utara II - Margahayu Raya', 'Jakarta', '1989-01-02', 'Laki-laki', 'Active', 3, 57, NULL, NULL, '1', '2020-10-23'),
(12, '197808102003121004', 'Popie Hagy Gusmartin, S.T.', '-', 'Surabaya', '1978-08-10', 'Laki-laki', 'Active', 3, 19, '1', '2020-10-22', '1', '2020-10-23'),
(13, '198612222009121002', 'Muhammad Luthfi, S.T., M.Sc.', 'Antapani', 'Bandung', '1986-12-22', 'Laki-laki', 'Active', 3, 20, '1', '2020-10-22', '1', '2020-10-23'),
(14, '196402011984031002', 'Dani Syamsul Purnama, A.Ptnh., M.H.', 'Jalan jurang', 'Bandung', '1964-02-01', 'Laki-laki', 'Active', 3, 21, '1', '2020-10-22', NULL, NULL),
(15, '196801031994031006', 'Tommi Rahmadi', 'Komp. Griya Asri', 'Garut', '1968-01-03', 'Laki-laki', 'Active', 3, 50, '1', '2020-10-22', NULL, NULL),
(16, '196906111991031010', 'Asep Tatang', 'Margahayu Raya', 'Sumedang', '1969-06-11', 'Laki-laki', 'Active', 3, 50, '1', '2020-10-22', NULL, NULL),
(17, '196401201989031007', 'Undang Dedi Mulyadi', 'Jl. Riung Saluyu', 'Bandung', '1964-01-20', 'Laki-laki', 'Active', 3, 50, '1', '2020-10-22', NULL, NULL),
(18, '196407111989031016', 'Windarsah', 'Jl. Cilacap', 'Bandung', '1964-07-11', 'Laki-laki', 'Active', 3, 50, '1', '2020-10-22', NULL, NULL),
(19, '196409231989031004', 'Nenden Adi Harsana', 'Komplek Setra Dago Timur', 'Majalengka', '1964-09-23', 'Laki-laki', 'Active', 3, 51, '1', '2020-10-22', NULL, NULL),
(20, '197107251995031001', 'Elan', 'Jl. Permai 23', 'Ciamis', '1971-07-25', 'Laki-laki', 'Active', 3, 51, '1', '2020-10-22', NULL, NULL),
(21, '196904301995031002', 'Isa Alamsyah Undayat', 'Jl. Aria Timur', 'Bandung', '1969-04-03', 'Laki-laki', 'Active', 3, 51, '1', '2020-10-22', NULL, NULL),
(22, '196503131993031003', 'Aceng Margakusumah', 'Jl. Pager Betis', 'Sumedang', '1965-03-13', 'Laki-laki', 'Active', 3, 51, '1', '2020-10-22', NULL, NULL),
(23, '196409091989102001', 'Siti Balilah', 'Jl Podang', 'Bandung', '1964-09-09', 'Perempuan', 'Active', 3, 51, '1', '2020-10-22', NULL, NULL),
(24, '199006272011011001', 'Hanggas Wirapradeksa S.Tr.', 'Margahayu Raya ', 'Purbalingga', '1990-06-27', 'Laki-laki', 'Active', 3, 52, '1', '2020-10-22', NULL, NULL),
(25, '196912082014081001', 'Asep Muljana', 'Cilisung', 'Bandung', '1969-12-18', 'Laki-laki', 'Active', 3, 53, '1', '2020-10-22', NULL, NULL),
(26, '196811012014081001', 'Dadang Suherman', 'JL. Lengkong Tengah I', 'Bandung', '1968-11-01', 'Laki-laki', 'Active', 3, 51, '1', '2020-10-22', NULL, NULL),
(27, '197001152014081001', 'Deni Suryana', 'Jl. Nyengseret', 'Bandung', '1970-01-15', 'Laki-laki', 'Active', 3, 53, '1', '2020-10-22', NULL, NULL),
(28, '910200130', 'Asep Abdul Kohar', 'Bandung', 'Bandung', '2020-10-22', 'Laki-laki', 'Active', 3, 56, '1', '2020-10-22', NULL, NULL),
(29, '910200021', 'Arief HIdayat Sumpena', 'Bandung', 'Bandung', '2020-10-22', 'Laki-laki', 'Active', 3, 56, '1', '2020-10-22', NULL, NULL),
(30, '910200156', 'Aprialdi Dwi Putra', 'Bandung', 'Bandung', '2020-10-22', 'Laki-laki', 'Active', 3, 56, '1', '2020-10-22', NULL, NULL),
(31, '910200018', 'Ade Achmad Saputra', 'Bandung', 'Bandung', '2020-10-22', 'Laki-laki', 'Active', 3, 56, '1', '2020-10-22', NULL, NULL),
(32, '910200053', 'Rivan Halen Satriani', 'Bandung', 'Bandung', '2020-10-22', 'Laki-laki', 'Active', 3, 56, '1', '2020-10-22', NULL, NULL),
(33, '2020914', 'Asep Rudi Ruhimat', '-', 'Bandung', '2020-10-23', 'Laki-laki', 'Active', 3, 54, '1', '2020-10-23', NULL, NULL),
(34, '910200125', 'Arif Rahman Hakim', '-', 'Bandung', '2020-11-03', 'Laki-laki', 'Active', 3, 56, '1', '2020-11-03', '1', '2020-11-03');

-- --------------------------------------------------------

--
-- Table structure for table `ms_pemohon`
--

CREATE TABLE `ms_pemohon` (
  `id_pemohon` int(4) NOT NULL,
  `nik_pemohon` varchar(25) NOT NULL,
  `nama_pemohon` varchar(50) NOT NULL,
  `alamat_pemohon` text NOT NULL,
  `telp_pemohon` varchar(25) NOT NULL,
  `keterangan_pemohon` text,
  `status_pemohon` enum('Active','Non Active') NOT NULL,
  `createdBy` varchar(250) DEFAULT NULL,
  `createdTime` date DEFAULT NULL,
  `updatedBy` varchar(250) DEFAULT NULL,
  `updatedTime` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ms_pemohon`
--

INSERT INTO `ms_pemohon` (`id_pemohon`, `nik_pemohon`, `nama_pemohon`, `alamat_pemohon`, `telp_pemohon`, `keterangan_pemohon`, `status_pemohon`, `createdBy`, `createdTime`, `updatedBy`, `updatedTime`) VALUES
(2, '1', 'isi Nama Pemohon', 'isi Alamat Pemohon', '081220081918', 'isi Keterangan pemohon', 'Active', '1', '2020-10-22', '1', '2020-10-23'),
(3, '2', 'Diana Lestari', 'Bandung', '0', '-', 'Active', '1', '2020-10-22', '1', '2020-10-23'),
(4, '3', 'Tifa Helissa', '-', '1', '-', 'Active', '1', '2020-10-22', '1', '2020-10-23'),
(6, '3273230201890015', 'Erza', 'Margahayu Raya', '081220081918', 'tes', 'Active', '1', '2020-10-23', '1', '2020-10-23'),
(7, '123456', 'Saya Pemohon', 'alamat saya', '0', '-', 'Active', '1', '2020-10-26', NULL, NULL),
(8, '3273050301900001', 'Patrick Wijaya', 'Jl.H.Durasid No.08', '08', '-', 'Active', '33', '2020-11-03', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ms_provinsi`
--

CREATE TABLE `ms_provinsi` (
  `id_provinsi` int(11) NOT NULL,
  `nama_provinsi` varchar(100) NOT NULL,
  `keterangan_provinsi` text,
  `createdBy` varchar(250) NOT NULL,
  `createdTime` date DEFAULT NULL,
  `updatedBy` varchar(250) DEFAULT NULL,
  `updatedTime` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ms_provinsi`
--

INSERT INTO `ms_provinsi` (`id_provinsi`, `nama_provinsi`, `keterangan_provinsi`, `createdBy`, `createdTime`, `updatedBy`, `updatedTime`) VALUES
(1, 'Jawa Barat', '-', 'Active', NULL, '1', '2020-10-20');

-- --------------------------------------------------------

--
-- Table structure for table `ms_satker`
--

CREATE TABLE `ms_satker` (
  `id_satker` int(11) NOT NULL,
  `nama_satker` varchar(250) NOT NULL,
  `keterangan_satker` varchar(250) DEFAULT NULL,
  `createdBy` varchar(250) DEFAULT NULL,
  `createdTime` date DEFAULT NULL,
  `updatedBy` varchar(250) DEFAULT NULL,
  `updatedTime` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_satker`
--

INSERT INTO `ms_satker` (`id_satker`, `nama_satker`, `keterangan_satker`, `createdBy`, `createdTime`, `updatedBy`, `updatedTime`) VALUES
(3, 'Seksi Infrastruktur Pertanahan', 'IP', NULL, NULL, '1', '2020-10-21'),
(4, 'Seksi Hubungan Hukum Pertanahan', 'tesss', '1', '2020-10-28', '1', '2020-10-28');

-- --------------------------------------------------------

--
-- Table structure for table `ms_seksi`
--

CREATE TABLE `ms_seksi` (
  `nama_seksi` varchar(100) NOT NULL,
  `moto_seksi` varchar(100) NOT NULL,
  `alamat_seksi` text NOT NULL,
  `telp_seksi` varchar(50) NOT NULL,
  `email_seksi` varchar(50) NOT NULL,
  `keterangan_seksi` text NOT NULL,
  `website_seksi` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ms_seksi`
--

INSERT INTO `ms_seksi` (`nama_seksi`, `moto_seksi`, `alamat_seksi`, `telp_seksi`, `email_seksi`, `keterangan_seksi`, `website_seksi`) VALUES
('Seksi Infrastruktur Pertanahan', '-', 'Jl. Soekarno Hatta No.586 - Bandung', '081220081918', 'erzafikry@gmail.com', 'Seksi Infrastruktur Pertanahan', '-');

-- --------------------------------------------------------

--
-- Table structure for table `ms_user`
--

CREATE TABLE `ms_user` (
  `id_user` int(11) NOT NULL,
  `username_user` varchar(50) NOT NULL,
  `password_user` varchar(150) NOT NULL,
  `status_user` enum('Active','Non Active') NOT NULL,
  `user_group` int(3) NOT NULL,
  `default_user` enum('Y','N') NOT NULL DEFAULT 'N',
  `id_pegawai` int(11) NOT NULL,
  `createdBy` varchar(250) DEFAULT NULL,
  `createdTime` date DEFAULT NULL,
  `updatedBy` varchar(250) DEFAULT NULL,
  `updatedTime` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ms_user`
--

INSERT INTO `ms_user` (`id_user`, `username_user`, `password_user`, `status_user`, `user_group`, `default_user`, `id_pegawai`, `createdBy`, `createdTime`, `updatedBy`, `updatedTime`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Active', 1, 'N', 9, NULL, NULL, '1', '2020-10-20'),
(23, '198612222009121002', '0cc175b9c0f1b6a831c399e269772661', 'Active', 9, 'N', 13, '1', '2020-10-22', '1', '2020-10-22'),
(22, '197808102003121004', '0cc175b9c0f1b6a831c399e269772661', 'Active', 10, 'N', 12, '1', '2020-10-22', '1', '2020-10-22'),
(24, '196402011984031002', '0cc175b9c0f1b6a831c399e269772661', 'Active', 9, 'N', 14, '1', '2020-10-22', '1', '2020-10-22'),
(25, '910200156', '0cc175b9c0f1b6a831c399e269772661', 'Active', 8, 'N', 30, '1', '2020-10-22', '1', '2020-10-22'),
(26, '196912082014081001', '0cc175b9c0f1b6a831c399e269772661', 'Active', 11, 'N', 25, '1', '2020-10-22', '1', '2020-11-13'),
(27, '910200130', '0cc175b9c0f1b6a831c399e269772661', 'Active', 12, 'N', 28, '1', '2020-10-22', '1', '2020-11-15'),
(28, '910200053', '0cc175b9c0f1b6a831c399e269772661', 'Active', 13, 'N', 32, '1', '2020-10-22', NULL, NULL),
(29, '196904301995031002', '0cc175b9c0f1b6a831c399e269772661', 'Active', 14, 'N', 21, '1', '2020-10-22', NULL, NULL),
(30, '196906111991031010', '0cc175b9c0f1b6a831c399e269772661', 'Active', 15, 'N', 16, '1', '2020-10-22', NULL, NULL),
(31, '199006272011011001', '0cc175b9c0f1b6a831c399e269772661', 'Active', 14, 'N', 24, '1', '2020-10-22', NULL, NULL),
(32, '2020914', '0cc175b9c0f1b6a831c399e269772661', 'Active', 11, 'N', 33, '1', '2020-10-23', NULL, NULL),
(33, '910200125', '0cc175b9c0f1b6a831c399e269772661', 'Active', 8, 'N', 34, '1', '2020-11-03', '1', '2020-11-03'),
(34, '910200021', '0cc175b9c0f1b6a831c399e269772661', 'Active', 12, 'N', 29, '1', '2020-11-03', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sys_akses`
--

CREATE TABLE `sys_akses` (
  `akses_id` int(4) NOT NULL,
  `akses_group` int(3) NOT NULL,
  `akses_submenu` int(3) NOT NULL,
  `akses_dibuat` datetime NOT NULL,
  `akses_diubah` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;

--
-- Dumping data for table `sys_akses`
--

INSERT INTO `sys_akses` (`akses_id`, `akses_group`, `akses_submenu`, `akses_dibuat`, `akses_diubah`) VALUES
(5, 0, 0, '2017-11-27 00:00:00', '0000-00-00 00:00:00'),
(6, 0, 0, '2017-11-27 00:00:00', '0000-00-00 00:00:00'),
(7, 0, 0, '2017-11-27 00:00:00', '0000-00-00 00:00:00'),
(8, 0, 0, '2017-11-27 00:00:00', '0000-00-00 00:00:00'),
(9, 0, 0, '2017-11-27 00:00:00', '0000-00-00 00:00:00'),
(10, 0, 0, '2017-11-27 00:00:00', '0000-00-00 00:00:00'),
(215, 4, 17, '2020-04-18 00:00:00', '0000-00-00 00:00:00'),
(590, 1, 15, '2021-06-16 00:00:00', '0000-00-00 00:00:00'),
(589, 1, 14, '2021-06-16 00:00:00', '0000-00-00 00:00:00'),
(588, 1, 35, '2021-06-16 00:00:00', '0000-00-00 00:00:00'),
(587, 1, 11, '2021-06-16 00:00:00', '0000-00-00 00:00:00'),
(586, 1, 32, '2021-06-16 00:00:00', '0000-00-00 00:00:00'),
(585, 1, 31, '2021-06-16 00:00:00', '0000-00-00 00:00:00'),
(584, 1, 8, '2021-06-16 00:00:00', '0000-00-00 00:00:00'),
(583, 1, 7, '2021-06-16 00:00:00', '0000-00-00 00:00:00'),
(582, 1, 33, '2021-06-16 00:00:00', '0000-00-00 00:00:00'),
(581, 1, 30, '2021-06-16 00:00:00', '0000-00-00 00:00:00'),
(580, 1, 29, '2021-06-16 00:00:00', '0000-00-00 00:00:00'),
(252, 3, 23, '2020-04-18 00:00:00', '0000-00-00 00:00:00'),
(251, 3, 17, '2020-04-18 00:00:00', '0000-00-00 00:00:00'),
(250, 3, 15, '2020-04-18 00:00:00', '0000-00-00 00:00:00'),
(579, 1, 6, '2021-06-16 00:00:00', '0000-00-00 00:00:00'),
(214, 4, 11, '2020-04-18 00:00:00', '0000-00-00 00:00:00'),
(578, 1, 5, '2021-06-16 00:00:00', '0000-00-00 00:00:00'),
(311, 2, 15, '2020-10-19 00:00:00', '0000-00-00 00:00:00'),
(249, 3, 14, '2020-04-18 00:00:00', '0000-00-00 00:00:00'),
(248, 3, 26, '2020-04-18 00:00:00', '0000-00-00 00:00:00'),
(247, 3, 27, '2020-04-18 00:00:00', '0000-00-00 00:00:00'),
(246, 3, 12, '2020-04-18 00:00:00', '0000-00-00 00:00:00'),
(245, 3, 11, '2020-04-18 00:00:00', '0000-00-00 00:00:00'),
(244, 3, 8, '2020-04-18 00:00:00', '0000-00-00 00:00:00'),
(243, 3, 7, '2020-04-18 00:00:00', '0000-00-00 00:00:00'),
(216, 4, 23, '2020-04-18 00:00:00', '0000-00-00 00:00:00'),
(242, 3, 6, '2020-04-18 00:00:00', '0000-00-00 00:00:00'),
(241, 3, 5, '2020-04-18 00:00:00', '0000-00-00 00:00:00'),
(240, 3, 13, '2020-04-18 00:00:00', '0000-00-00 00:00:00'),
(310, 2, 14, '2020-10-19 00:00:00', '0000-00-00 00:00:00'),
(309, 2, 28, '2020-10-19 00:00:00', '0000-00-00 00:00:00'),
(308, 2, 11, '2020-10-19 00:00:00', '0000-00-00 00:00:00'),
(253, 3, 25, '2020-04-18 00:00:00', '0000-00-00 00:00:00'),
(307, 2, 6, '2020-10-19 00:00:00', '0000-00-00 00:00:00'),
(431, 7, 14, '2020-10-21 00:00:00', '0000-00-00 00:00:00'),
(430, 7, 28, '2020-10-21 00:00:00', '0000-00-00 00:00:00'),
(377, 6, 11, '2020-10-20 00:00:00', '0000-00-00 00:00:00'),
(429, 7, 11, '2020-10-21 00:00:00', '0000-00-00 00:00:00'),
(577, 1, 13, '2021-06-16 00:00:00', '0000-00-00 00:00:00'),
(576, 1, 4, '2021-06-16 00:00:00', '0000-00-00 00:00:00'),
(575, 1, 3, '2021-06-16 00:00:00', '0000-00-00 00:00:00'),
(432, 7, 15, '2020-10-21 00:00:00', '0000-00-00 00:00:00'),
(560, 8, 28, '2020-11-03 00:00:00', '0000-00-00 00:00:00'),
(559, 8, 11, '2020-11-03 00:00:00', '0000-00-00 00:00:00'),
(558, 8, 8, '2020-11-03 00:00:00', '0000-00-00 00:00:00'),
(557, 8, 7, '2020-11-03 00:00:00', '0000-00-00 00:00:00'),
(556, 8, 33, '2020-11-03 00:00:00', '0000-00-00 00:00:00'),
(555, 8, 6, '2020-11-03 00:00:00', '0000-00-00 00:00:00'),
(554, 8, 5, '2020-11-03 00:00:00', '0000-00-00 00:00:00'),
(545, 9, 14, '2020-11-03 00:00:00', '0000-00-00 00:00:00'),
(544, 9, 28, '2020-11-03 00:00:00', '0000-00-00 00:00:00'),
(543, 9, 34, '2020-11-03 00:00:00', '0000-00-00 00:00:00'),
(572, 10, 14, '2020-11-16 00:00:00', '0000-00-00 00:00:00'),
(571, 10, 28, '2020-11-16 00:00:00', '0000-00-00 00:00:00'),
(570, 10, 34, '2020-11-16 00:00:00', '0000-00-00 00:00:00'),
(542, 9, 11, '2020-11-03 00:00:00', '0000-00-00 00:00:00'),
(569, 10, 11, '2020-11-16 00:00:00', '0000-00-00 00:00:00'),
(563, 11, 11, '2020-11-13 00:00:00', '0000-00-00 00:00:00'),
(565, 12, 11, '2020-11-15 00:00:00', '0000-00-00 00:00:00'),
(567, 13, 11, '2020-11-15 00:00:00', '0000-00-00 00:00:00'),
(491, 14, 11, '2020-10-22 00:00:00', '0000-00-00 00:00:00'),
(492, 15, 11, '2020-10-22 00:00:00', '0000-00-00 00:00:00'),
(574, 1, 2, '2021-06-16 00:00:00', '0000-00-00 00:00:00'),
(546, 9, 15, '2020-11-03 00:00:00', '0000-00-00 00:00:00'),
(561, 8, 14, '2020-11-03 00:00:00', '0000-00-00 00:00:00'),
(562, 8, 15, '2020-11-03 00:00:00', '0000-00-00 00:00:00'),
(564, 11, 34, '2020-11-13 00:00:00', '0000-00-00 00:00:00'),
(566, 12, 34, '2020-11-15 00:00:00', '0000-00-00 00:00:00'),
(568, 13, 34, '2020-11-15 00:00:00', '0000-00-00 00:00:00'),
(573, 10, 15, '2020-11-16 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sys_group`
--

CREATE TABLE `sys_group` (
  `group_id` int(3) NOT NULL,
  `group_nama` varchar(35) NOT NULL,
  `group_keterangan` text NOT NULL,
  `group_status` enum('Active','Non Active') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `sys_group`
--

INSERT INTO `sys_group` (`group_id`, `group_nama`, `group_keterangan`, `group_status`) VALUES
(1, 'Superadmin', 'superadmin', 'Active'),
(13, 'Petugas Textual', 'PT', 'Active'),
(12, 'Petugas Grafis', 'PG', 'Active'),
(11, 'Petugas Ukur', 'PU', 'Active'),
(10, 'Kasie', 'Kepala Seksi', 'Active'),
(9, 'Kasubsie', 'Kepala Subseksi', 'Active'),
(8, 'Administrator', 'Admin', 'Active'),
(14, 'Kordinator Pemetaan', 'Kordi Pemetaan', 'Active'),
(15, 'Kordinator Pengukuran', 'Kordi Pengukuran', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `sys_menu`
--

CREATE TABLE `sys_menu` (
  `menu_id` int(3) NOT NULL,
  `menu_nama` varchar(40) NOT NULL,
  `menu_icon` varchar(50) NOT NULL,
  `menu_urutan` int(2) NOT NULL,
  `menu_dibuat` datetime NOT NULL,
  `menu_diubah` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `sys_menu`
--

INSERT INTO `sys_menu` (`menu_id`, `menu_nama`, `menu_icon`, `menu_urutan`, `menu_dibuat`, `menu_diubah`) VALUES
(1, 'Pengaturan', 'icon-settings', 1, '2017-11-26 00:00:00', '2017-11-26 00:00:00'),
(2, 'Master Data', 'icon-wallet', 2, '2017-11-26 00:00:00', '2017-11-26 00:00:00'),
(3, 'Wilayah', 'icon-map', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Berkas', 'icon-folder', 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Dokumen', 'icon-folder', 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Laporan', 'icon-pie-chart', 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sys_submenu`
--

CREATE TABLE `sys_submenu` (
  `submenu_id` int(3) NOT NULL,
  `submenu_nama` varchar(50) NOT NULL,
  `submenu_menu` int(3) NOT NULL,
  `submenu_link` varchar(100) NOT NULL,
  `submenu_urutan` int(3) NOT NULL,
  `submenu_dibuat` datetime NOT NULL,
  `submenu_diubah` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `sys_submenu`
--

INSERT INTO `sys_submenu` (`submenu_id`, `submenu_nama`, `submenu_menu`, `submenu_link`, `submenu_urutan`, `submenu_dibuat`, `submenu_diubah`) VALUES
(2, 'Data User', 1, '?page=datauser', 3, '2017-11-26 00:00:00', '2020-10-22 00:00:00'),
(3, 'Data Menu & Modul', 1, '?page=datamodul', 4, '2017-11-26 00:00:00', '2020-03-12 00:00:00'),
(4, 'Level Group Akses', 1, '?page=datagroup', 2, '2017-11-26 00:00:00', '2020-10-22 00:00:00'),
(5, 'Data Pegawai', 2, '?page=datapegawai', 3, '2017-11-26 00:00:00', '2020-10-20 00:00:00'),
(6, 'Data Pemohon', 2, '?page=datapemohon', 4, '2017-11-26 00:00:00', '2020-10-20 00:00:00'),
(7, 'Data Kecamatan', 3, '?page=datakec', 3, '2017-11-26 00:00:00', '2020-10-20 00:00:00'),
(8, 'Data Kelurahan', 3, '?page=datakel', 4, '2017-12-24 00:00:00', '2020-10-20 00:00:00'),
(11, 'Daftar Berkas', 4, '?page=databerkas', 1, '2017-12-24 00:00:00', '2020-10-22 00:00:00'),
(13, 'Pengaturan Seksi', 1, '?page=confseksi', 1, '2017-12-24 00:00:00', '0000-00-00 00:00:00'),
(14, 'Berkas Masuk', 6, '?page=lapberkas', 1, '2017-12-29 00:00:00', '2020-10-20 00:00:00'),
(15, 'Daftar Pemohon', 6, '?page=lappemohon', 2, '2017-12-29 00:00:00', '2020-10-21 00:00:00'),
(29, 'Data Jabatan', 2, '?page=datajab', 2, '2020-10-19 00:00:00', '2020-10-20 00:00:00'),
(30, 'Data Satker', 2, '?page=datasatker', 1, '2020-10-19 00:00:00', '2020-10-20 00:00:00'),
(31, 'Data Provinsi', 3, '?page=dataprov', 1, '2020-10-20 00:00:00', '2020-10-20 00:00:00'),
(32, 'Data Kota', 3, '?page=datakot', 2, '2020-10-20 00:00:00', '0000-00-00 00:00:00'),
(33, 'Data Layanan', 2, '?page=datalay', 5, '2020-10-21 00:00:00', '0000-00-00 00:00:00'),
(35, 'Berkas Masuk', 4, '?page=databerkasmasuk', 2, '2021-06-16 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `trx_history`
--

CREATE TABLE `trx_history` (
  `id_shitory` int(11) NOT NULL,
  `id_berkas` int(11) DEFAULT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `catatan` varchar(250) DEFAULT NULL,
  `createdBy` varchar(250) DEFAULT NULL,
  `createdTime` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trx_history`
--

INSERT INTO `trx_history` (`id_shitory`, `id_berkas`, `id_pegawai`, `catatan`, `createdBy`, `createdTime`, `status`) VALUES
(1, 1, 30, 'Surat tugas dibuat oleh admin', '25', '2020-11-06 07:03:18', 'Dibuat'),
(2, 1, 30, 'Kirim kasubsie', '25', '2020-11-06 10:03:18', 'Kirim'),
(3, 1, 13, 'kembali ke admin', '23', '2020-11-08 14:55:35', 'Batal'),
(4, 1, 30, 'kirim ulang kasubsie', '25', '2020-11-08 14:58:05', 'Kirim'),
(5, 1, 13, 'masih belum lengkap kembali ke admin', '23', '2020-11-08 14:59:15', 'Batal'),
(6, 1, 30, 'Kirim ulang kasubsie', '25', '2020-11-08 15:10:37', 'Kirim'),
(7, 1, 13, 'Dikirim ke Kasie', '23', '2020-11-08 15:11:21', 'Kirim'),
(8, 1, 12, 'Kirim ke petugas ukur', '22', '2020-11-13 06:53:11', 'Kirim'),
(9, 1, 25, 'kembalikan ke kasi', '26', '2020-11-13 10:14:56', 'Batal'),
(10, 1, 12, 'Kirim kembali ke petugas ukur dengan penggatian petugas ukur', '22', '2020-11-13 10:16:58', 'Kirim'),
(11, 1, 25, 'test', '26', '2020-11-14 07:38:50', 'Kirim'),
(12, 1, 25, 'kembali ke kasi', '26', '2020-11-15 04:56:24', 'Batal'),
(13, 1, 12, 'Kirim petugas ukur', '22', '2020-11-15 04:58:07', 'Kirim'),
(14, 1, 33, 'kirim ke petugas grafis', '32', '2020-11-15 05:07:26', 'Kirim'),
(15, 1, 28, 'Kirim ke petugas textual', '27', '2020-11-15 05:12:14', 'Kirim'),
(16, 1, 32, 'Kembalikan ke petugas grafis', '28', '2020-11-15 05:17:51', 'Batal'),
(17, 1, 28, 'Sudah lemngkap kirim ke putugas textual', '27', '2020-11-15 05:19:05', 'Kirim'),
(18, 1, 32, 'Kirim Ke kasubsie untuk verifikasi dari petugas textual', '28', '2020-11-15 06:31:51', 'Kirim'),
(19, 1, 13, 'kurang lengkap data dikembalikan ke petugas textual', '23', '2020-11-15 17:35:41', 'Kirim'),
(20, 1, 13, 'htrhtrh', '23', '2020-11-16 07:04:40', 'Batal'),
(21, 1, 32, 'kirim kasubsie', '28', '2020-11-16 07:07:49', 'Kirim'),
(22, 1, 13, 'kembali ke petugas tektual', '23', '2020-11-16 07:12:01', 'Batal'),
(23, 1, 32, 'Kirim kembali ke kasubsie', '28', '2020-11-16 07:12:29', 'Kirim'),
(24, 1, 13, 'Kirim ke kasie', '23', '2020-11-16 07:12:52', 'Kirim'),
(25, 1, 13, 'kirim ke kasie', '23', '2020-11-16 07:16:45', 'Kirim'),
(26, 1, 12, 'Kembali ke kasubsie', '22', '2020-11-16 07:23:33', 'Batal'),
(27, 1, 13, 'Kirim ulang ke kasie', '23', '2020-11-16 07:23:59', 'Kirim'),
(28, 1, 12, 'dikemmbalikan ke kasubsie', '22', '2020-11-16 07:49:47', 'Batal'),
(29, 1, 13, 'Kirim ke kasie', '23', '2020-11-16 07:51:07', 'Kirim'),
(30, 1, 12, 'selesai', '22', '2020-11-16 08:07:05', 'Selesai'),
(32, 3, 30, 'Surat tugas dibuat oleh admin', '25', '2020-11-16 08:41:43', 'Dibuat'),
(33, 3, 30, 'Kirim Kasubsie', '25', '2020-11-16 08:42:28', 'Kirim'),
(34, 3, 13, 'Kirim Ke kasie', '23', '2020-11-16 08:43:14', 'Kirim'),
(35, 3, 12, 'Kirim ke petugas ukur', '22', '2020-11-16 08:45:49', 'Kirim'),
(36, 3, 25, 'Kirim Petugas Grafis', '26', '2020-11-16 08:46:56', 'Kirim'),
(37, 3, 28, 'Kirim petugas textual', '27', '2020-11-16 08:49:00', 'Kirim'),
(38, 3, 32, 'Kirim Kasubsie', '28', '2020-11-16 08:49:24', 'Kirim'),
(39, 3, 13, 'Kirim Kasie', '23', '2020-11-16 08:49:50', 'Kirim'),
(40, 3, 12, 'Berkas Selesai', '22', '2020-11-16 08:50:16', 'Selesai'),
(41, 4, 30, 'Surat tugas dibuat oleh admin', '25', '2020-11-21 11:03:42', 'Dibuat'),
(42, 4, 30, 'kirim', '25', '2020-11-21 11:04:13', 'Kirim'),
(43, 4, 13, 'kirim kasi', '23', '2020-11-21 11:04:34', 'Kirim'),
(44, 4, 12, 'fsdfdsf', '22', '2020-11-21 11:05:04', 'Kirim'),
(45, 4, 25, 'dsfdsfdsf', '26', '2020-11-21 11:09:09', 'Kirim'),
(46, 4, 28, 'dsfsdfds', '27', '2020-11-21 11:09:34', 'Kirim'),
(47, 4, 32, 'sadasfdfds', '28', '2020-11-21 11:09:55', 'Kirim'),
(48, 4, 13, 'dfdsfdgfd', '23', '2020-11-21 11:10:19', 'Kirim'),
(49, 4, 12, 'hjgjhg', '22', '2020-11-22 15:23:01', 'Selesai'),
(50, 5, 30, 'Surat tugas dibuat oleh admin', '25', '2020-11-22 15:29:52', 'Dibuat'),
(51, 5, 30, 'surat tugas dikirim kasubsie', '25', '2020-11-22 15:30:13', 'Kirim'),
(52, 5, 13, 'Surat tugas belum lengkap dikembalikan ke admin', '23', '2020-11-22 15:30:56', 'Batal'),
(53, 5, 30, 'Kirim kembali ke kasubsie', '25', '2020-11-22 15:32:05', 'Kirim'),
(54, 5, 13, 'Kirim ke kasie', '23', '2020-11-22 15:32:35', 'Kirim'),
(55, 5, 12, 'ok, kirim ke petugas ukur', '22', '2020-11-22 15:33:08', 'Kirim'),
(56, 5, 25, 'hgfhgfh', '26', '2020-11-22 16:02:38', 'Kirim'),
(57, 6, 30, 'Surat tugas dibuat oleh admin', '25', '2020-11-22 16:04:16', 'Dibuat'),
(58, 6, 30, 'kirim kasubsie', '25', '2020-11-22 16:04:33', 'Kirim'),
(59, 6, 13, 'kembali ke admin', '23', '2020-11-22 16:05:15', 'Batal');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ms_berkas`
--
ALTER TABLE `ms_berkas`
  ADD PRIMARY KEY (`id_berkas`) USING BTREE;

--
-- Indexes for table `ms_jabatan`
--
ALTER TABLE `ms_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `ms_kecamatan`
--
ALTER TABLE `ms_kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`) USING BTREE;

--
-- Indexes for table `ms_kelurahan`
--
ALTER TABLE `ms_kelurahan`
  ADD PRIMARY KEY (`id_kelurahan`) USING BTREE;

--
-- Indexes for table `ms_kota`
--
ALTER TABLE `ms_kota`
  ADD PRIMARY KEY (`id_kota`) USING BTREE;

--
-- Indexes for table `ms_layanan`
--
ALTER TABLE `ms_layanan`
  ADD PRIMARY KEY (`id_layanan`) USING BTREE;

--
-- Indexes for table `ms_pegawai`
--
ALTER TABLE `ms_pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `ms_pemohon`
--
ALTER TABLE `ms_pemohon`
  ADD PRIMARY KEY (`id_pemohon`) USING BTREE;

--
-- Indexes for table `ms_provinsi`
--
ALTER TABLE `ms_provinsi`
  ADD PRIMARY KEY (`id_provinsi`) USING BTREE;

--
-- Indexes for table `ms_satker`
--
ALTER TABLE `ms_satker`
  ADD PRIMARY KEY (`id_satker`);

--
-- Indexes for table `ms_user`
--
ALTER TABLE `ms_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `sys_akses`
--
ALTER TABLE `sys_akses`
  ADD PRIMARY KEY (`akses_id`) USING BTREE;

--
-- Indexes for table `sys_group`
--
ALTER TABLE `sys_group`
  ADD PRIMARY KEY (`group_id`) USING BTREE;

--
-- Indexes for table `sys_menu`
--
ALTER TABLE `sys_menu`
  ADD PRIMARY KEY (`menu_id`) USING BTREE;

--
-- Indexes for table `sys_submenu`
--
ALTER TABLE `sys_submenu`
  ADD PRIMARY KEY (`submenu_id`) USING BTREE;

--
-- Indexes for table `trx_history`
--
ALTER TABLE `trx_history`
  ADD PRIMARY KEY (`id_shitory`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ms_berkas`
--
ALTER TABLE `ms_berkas`
  MODIFY `id_berkas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ms_jabatan`
--
ALTER TABLE `ms_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `ms_kecamatan`
--
ALTER TABLE `ms_kecamatan`
  MODIFY `id_kecamatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `ms_kelurahan`
--
ALTER TABLE `ms_kelurahan`
  MODIFY `id_kelurahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `ms_kota`
--
ALTER TABLE `ms_kota`
  MODIFY `id_kota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ms_layanan`
--
ALTER TABLE `ms_layanan`
  MODIFY `id_layanan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ms_pegawai`
--
ALTER TABLE `ms_pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `ms_pemohon`
--
ALTER TABLE `ms_pemohon`
  MODIFY `id_pemohon` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ms_provinsi`
--
ALTER TABLE `ms_provinsi`
  MODIFY `id_provinsi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ms_satker`
--
ALTER TABLE `ms_satker`
  MODIFY `id_satker` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ms_user`
--
ALTER TABLE `ms_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `sys_akses`
--
ALTER TABLE `sys_akses`
  MODIFY `akses_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=591;

--
-- AUTO_INCREMENT for table `sys_group`
--
ALTER TABLE `sys_group`
  MODIFY `group_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sys_menu`
--
ALTER TABLE `sys_menu`
  MODIFY `menu_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sys_submenu`
--
ALTER TABLE `sys_submenu`
  MODIFY `submenu_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `trx_history`
--
ALTER TABLE `trx_history`
  MODIFY `id_shitory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
