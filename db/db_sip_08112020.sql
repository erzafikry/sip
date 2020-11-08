/*
 Navicat Premium Data Transfer

 Source Server         : Local
 Source Server Type    : MySQL
 Source Server Version : 100136
 Source Host           : localhost:3306
 Source Schema         : db_sip

 Target Server Type    : MySQL
 Target Server Version : 100136
 File Encoding         : 65001

 Date: 08/11/2020 17:07:46
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ms_berkas
-- ----------------------------
DROP TABLE IF EXISTS `ms_berkas`;
CREATE TABLE `ms_berkas`  (
  `id_berkas` int(11) NOT NULL AUTO_INCREMENT,
  `no_berkas` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tahun_berkas` int(4) NOT NULL,
  `id_pemohon` int(11) NOT NULL,
  `id_layanan` int(11) NOT NULL,
  `id_kecamatan` int(11) NOT NULL,
  `id_kelurahan` int(11) NOT NULL,
  `volume` int(4) NOT NULL,
  `di_305` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `di_302` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_status_berkas` int(11) NOT NULL,
  `keterangan_berkas` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `createdBy` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdTime` date NULL DEFAULT NULL,
  `updatedBy` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updatedTime` date NULL DEFAULT NULL,
  PRIMARY KEY (`id_berkas`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ms_berkas
-- ----------------------------
INSERT INTO `ms_berkas` VALUES (1, '0001', 2010, 3, 2, 1, 6, 232, ' 1212', ' 332434', 2, 'sdsd', '1', '2020-11-04', NULL, NULL);

-- ----------------------------
-- Table structure for ms_jabatan
-- ----------------------------
DROP TABLE IF EXISTS `ms_jabatan`;
CREATE TABLE `ms_jabatan`  (
  `id_jabatan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tipe_jabatan` enum('Struktural','Jabatan Fungsional Umum','Jabatan Fungsional Tertentu','PPNPN','Petugas Ukur','SKB','ASKB','Pembantu Ukur') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `eselon` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdBy` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdTime` date NULL DEFAULT NULL,
  `updatedBy` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updatedTime` date NULL DEFAULT NULL,
  PRIMARY KEY (`id_jabatan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 58 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ms_jabatan
-- ----------------------------
INSERT INTO `ms_jabatan` VALUES (19, 'Kepala Seksi Infrastruktur Pertanahan ', 'Struktural', 'IV', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_jabatan` VALUES (20, 'Kepala Subseksi Pengukuran dan Pemetaan Dasar dan Tematik', 'Struktural', 'V', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_jabatan` VALUES (21, 'Kepala Subseksi Pengukuran dan Pemetaan Kadastral ', 'Struktural', 'V', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_jabatan` VALUES (37, 'Petugas Ukur', 'Jabatan Fungsional Umum', '-', '', '0000-00-00', '1', '2020-10-22');
INSERT INTO `ms_jabatan` VALUES (50, 'Surveyor Pemetaan Penyelia', 'Jabatan Fungsional Tertentu', '-', '1', '2020-10-22', NULL, NULL);
INSERT INTO `ms_jabatan` VALUES (51, 'Pengadministrasi Pertanahan', 'Jabatan Fungsional Umum', '-', '1', '2020-10-22', NULL, NULL);
INSERT INTO `ms_jabatan` VALUES (52, 'Analis Survei, Pengukuran Dan Pemetaan', 'Jabatan Fungsional Umum', '-', '1', '2020-10-22', NULL, NULL);
INSERT INTO `ms_jabatan` VALUES (53, 'Surveyor Pemetaan Pelaksana', 'Jabatan Fungsional Tertentu', '-', '1', '2020-10-22', NULL, NULL);
INSERT INTO `ms_jabatan` VALUES (54, 'Asisten Surveyor Kadaster Berlisensi', 'ASKB', '-', '1', '2020-10-22', NULL, NULL);
INSERT INTO `ms_jabatan` VALUES (55, 'Pembantu Ukur', 'Pembantu Ukur', '-', '1', '2020-10-22', NULL, NULL);
INSERT INTO `ms_jabatan` VALUES (56, 'PPNPN', 'PPNPN', '-', '1', '2020-10-22', NULL, NULL);
INSERT INTO `ms_jabatan` VALUES (57, 'Pengelola Aplikasi', 'PPNPN', '-', '', '0000-00-00', '', '0000-00-00');

-- ----------------------------
-- Table structure for ms_kecamatan
-- ----------------------------
DROP TABLE IF EXISTS `ms_kecamatan`;
CREATE TABLE `ms_kecamatan`  (
  `id_kecamatan` int(11) NOT NULL AUTO_INCREMENT,
  `id_kota` int(11) NOT NULL,
  `nama_kecamatan` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keterangan_kecamatan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `status_kecamatan` enum('Active','Non Active') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `createdBy` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdTime` date NULL DEFAULT NULL,
  `updatedBy` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updatedTime` date NULL DEFAULT NULL,
  PRIMARY KEY (`id_kecamatan`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ms_kecamatan
-- ----------------------------
INSERT INTO `ms_kecamatan` VALUES (1, 1, 'Andir', NULL, 'Active', NULL, NULL, NULL, NULL);
INSERT INTO `ms_kecamatan` VALUES (4, 1, 'Antapani', '-', 'Active', '1', '2020-10-21', '1', '2020-10-21');
INSERT INTO `ms_kecamatan` VALUES (10, 1, 'Arcamanik', '-', 'Active', '1', '2020-10-21', NULL, NULL);

-- ----------------------------
-- Table structure for ms_kelurahan
-- ----------------------------
DROP TABLE IF EXISTS `ms_kelurahan`;
CREATE TABLE `ms_kelurahan`  (
  `id_kelurahan` int(11) NOT NULL AUTO_INCREMENT,
  `id_kecamatan` int(11) NOT NULL,
  `nama_kelurahan` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keterangan_kelurahan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `status_kelurahan` enum('Active','Non Active') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `createdBy` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdTime` date NULL DEFAULT NULL,
  `updatedBy` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updatedTime` date NULL DEFAULT NULL,
  PRIMARY KEY (`id_kelurahan`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ms_kelurahan
-- ----------------------------
INSERT INTO `ms_kelurahan` VALUES (1, 1, 'Campaka', '-', 'Active', '1', '2020-10-21', NULL, NULL);
INSERT INTO `ms_kelurahan` VALUES (2, 1, 'Ciroyom', '-', 'Active', '1', '2020-10-21', NULL, NULL);
INSERT INTO `ms_kelurahan` VALUES (6, 4, 'Antapani', '', 'Active', '1', '2020-10-21', NULL, NULL);
INSERT INTO `ms_kelurahan` VALUES (4, 4, 'Antapani Kidul', '-', 'Active', '1', '2020-10-21', '1', '2020-10-21');
INSERT INTO `ms_kelurahan` VALUES (5, 1, 'Dunguscariang', '-', 'Active', '1', '2020-10-21', NULL, NULL);

-- ----------------------------
-- Table structure for ms_kota
-- ----------------------------
DROP TABLE IF EXISTS `ms_kota`;
CREATE TABLE `ms_kota`  (
  `id_kota` int(11) NOT NULL AUTO_INCREMENT,
  `id_provinsi` int(11) NOT NULL,
  `nama_kota` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keterangan_kota` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `status_kota` enum('Active','Non Active') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `createdBy` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdTime` date NULL DEFAULT NULL,
  `updatedBy` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updatedTime` date NULL DEFAULT NULL,
  PRIMARY KEY (`id_kota`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ms_kota
-- ----------------------------
INSERT INTO `ms_kota` VALUES (1, 1, 'Kota Bandung', '-', 'Active', '1', '2020-10-21', NULL, NULL);

-- ----------------------------
-- Table structure for ms_layanan
-- ----------------------------
DROP TABLE IF EXISTS `ms_layanan`;
CREATE TABLE `ms_layanan`  (
  `id_layanan` int(4) NOT NULL AUTO_INCREMENT,
  `nama_layanan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keterangan_layanan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `status_layanan` enum('Active','Non Active') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `createdBy` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdTime` date NULL DEFAULT NULL,
  `updatedBy` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updatedTime` date NULL DEFAULT NULL,
  PRIMARY KEY (`id_layanan`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ms_layanan
-- ----------------------------
INSERT INTO `ms_layanan` VALUES (2, 'Pemecahan Bidang', 'Pengukuran dan Pemetaan', 'Active', '1', '2020-10-22', '1', '2020-10-23');
INSERT INTO `ms_layanan` VALUES (3, 'Pemisahan Bidang', 'Pengukuran dan Pemetaan', 'Active', '1', '2020-10-22', NULL, NULL);
INSERT INTO `ms_layanan` VALUES (4, 'Penggabungan Bidang', 'Pengukuran dan Pemetaan', 'Active', '1', '2020-10-22', NULL, NULL);
INSERT INTO `ms_layanan` VALUES (5, 'Pengakuan Hak', 'Pengukuran dan Pemetaan', 'Active', '1', '2020-10-22', NULL, NULL);

-- ----------------------------
-- Table structure for ms_pegawai
-- ----------------------------
DROP TABLE IF EXISTS `ms_pegawai`;
CREATE TABLE `ms_pegawai`  (
  `id_pegawai` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_pegawai` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat_pegawai` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tempat_lahir_pegawai` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_lahir_pegawai` date NULL DEFAULT NULL,
  `kelamin_pegawai` enum('Laki-laki','Perempuan') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status_pegawai` enum('Active','Non Active') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_satker` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `createdBy` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdTime` date NULL DEFAULT NULL,
  `updatedBy` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updatedTime` date NULL DEFAULT NULL,
  PRIMARY KEY (`id_pegawai`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ms_pegawai
-- ----------------------------
INSERT INTO `ms_pegawai` VALUES (9, '910200107', 'Erza Fikry', 'Jl. Saturnus Utara II - Margahayu Raya', 'Jakarta', '1989-01-02', 'Laki-laki', 'Active', 3, 57, NULL, NULL, '1', '2020-10-23');
INSERT INTO `ms_pegawai` VALUES (12, '197808102003121004', 'Popie Hagy Gusmartin, S.T.', '-', 'Surabaya', '1978-08-10', 'Laki-laki', 'Active', 3, 19, '1', '2020-10-22', '1', '2020-10-23');
INSERT INTO `ms_pegawai` VALUES (13, '198612222009121002', 'Muhammad Luthfi, S.T., M.Sc.', 'Antapani', 'Bandung', '1986-12-22', 'Laki-laki', 'Active', 3, 20, '1', '2020-10-22', '1', '2020-10-23');
INSERT INTO `ms_pegawai` VALUES (14, '196402011984031002', 'Dani Syamsul Purnama, A.Ptnh., M.H.', 'Jalan jurang', 'Bandung', '1964-02-01', 'Laki-laki', 'Active', 3, 21, '1', '2020-10-22', NULL, NULL);
INSERT INTO `ms_pegawai` VALUES (15, '196801031994031006', 'Tommi Rahmadi', 'Komp. Griya Asri', 'Garut', '1968-01-03', 'Laki-laki', 'Active', 3, 50, '1', '2020-10-22', NULL, NULL);
INSERT INTO `ms_pegawai` VALUES (16, '196906111991031010', 'Asep Tatang', 'Margahayu Raya', 'Sumedang', '1969-06-11', 'Laki-laki', 'Active', 3, 50, '1', '2020-10-22', NULL, NULL);
INSERT INTO `ms_pegawai` VALUES (17, '196401201989031007', 'Undang Dedi Mulyadi', 'Jl. Riung Saluyu', 'Bandung', '1964-01-20', 'Laki-laki', 'Active', 3, 50, '1', '2020-10-22', NULL, NULL);
INSERT INTO `ms_pegawai` VALUES (18, '196407111989031016', 'Windarsah', 'Jl. Cilacap', 'Bandung', '1964-07-11', 'Laki-laki', 'Active', 3, 50, '1', '2020-10-22', NULL, NULL);
INSERT INTO `ms_pegawai` VALUES (19, '196409231989031004', 'Nenden Adi Harsana', 'Komplek Setra Dago Timur', 'Majalengka', '1964-09-23', 'Laki-laki', 'Active', 3, 51, '1', '2020-10-22', NULL, NULL);
INSERT INTO `ms_pegawai` VALUES (20, '197107251995031001', 'Elan', 'Jl. Permai 23', 'Ciamis', '1971-07-25', 'Laki-laki', 'Active', 3, 51, '1', '2020-10-22', NULL, NULL);
INSERT INTO `ms_pegawai` VALUES (21, '196904301995031002', 'Isa Alamsyah Undayat', 'Jl. Aria Timur', 'Bandung', '1969-04-03', 'Laki-laki', 'Active', 3, 51, '1', '2020-10-22', NULL, NULL);
INSERT INTO `ms_pegawai` VALUES (22, '196503131993031003', 'Aceng Margakusumah', 'Jl. Pager Betis', 'Sumedang', '1965-03-13', 'Laki-laki', 'Active', 3, 51, '1', '2020-10-22', NULL, NULL);
INSERT INTO `ms_pegawai` VALUES (23, '196409091989102001', 'Siti Balilah', 'Jl Podang', 'Bandung', '1964-09-09', 'Perempuan', 'Active', 3, 51, '1', '2020-10-22', NULL, NULL);
INSERT INTO `ms_pegawai` VALUES (24, '199006272011011001', 'Hanggas Wirapradeksa S.Tr.', 'Margahayu Raya ', 'Purbalingga', '1990-06-27', 'Laki-laki', 'Active', 3, 52, '1', '2020-10-22', NULL, NULL);
INSERT INTO `ms_pegawai` VALUES (25, '196912082014081001', 'Asep Muljana', 'Cilisung', 'Bandung', '1969-12-18', 'Laki-laki', 'Active', 3, 53, '1', '2020-10-22', NULL, NULL);
INSERT INTO `ms_pegawai` VALUES (26, '196811012014081001', 'Dadang Suherman', 'JL. Lengkong Tengah I', 'Bandung', '1968-11-01', 'Laki-laki', 'Active', 3, 51, '1', '2020-10-22', NULL, NULL);
INSERT INTO `ms_pegawai` VALUES (27, '197001152014081001', 'Deni Suryana', 'Jl. Nyengseret', 'Bandung', '1970-01-15', 'Laki-laki', 'Active', 3, 53, '1', '2020-10-22', NULL, NULL);
INSERT INTO `ms_pegawai` VALUES (28, '910200130', 'Asep Abdul Kohar', 'Bandung', 'Bandung', '2020-10-22', 'Laki-laki', 'Active', 3, 56, '1', '2020-10-22', NULL, NULL);
INSERT INTO `ms_pegawai` VALUES (29, '910200021', 'Arief HIdayat Sumpena', 'Bandung', 'Bandung', '2020-10-22', 'Laki-laki', 'Active', 3, 56, '1', '2020-10-22', NULL, NULL);
INSERT INTO `ms_pegawai` VALUES (30, '910200156', 'Aprialdi Dwi Putra', 'Bandung', 'Bandung', '2020-10-22', 'Laki-laki', 'Active', 3, 56, '1', '2020-10-22', NULL, NULL);
INSERT INTO `ms_pegawai` VALUES (31, '910200018', 'Ade Achmad Saputra', 'Bandung', 'Bandung', '2020-10-22', 'Laki-laki', 'Active', 3, 56, '1', '2020-10-22', NULL, NULL);
INSERT INTO `ms_pegawai` VALUES (32, '910200053', 'Rivan Halen Satriani', 'Bandung', 'Bandung', '2020-10-22', 'Laki-laki', 'Active', 3, 56, '1', '2020-10-22', NULL, NULL);
INSERT INTO `ms_pegawai` VALUES (33, '2020914', 'Asep Rudi Ruhimat', '-', 'Bandung', '2020-10-23', 'Laki-laki', 'Active', 3, 54, '1', '2020-10-23', NULL, NULL);
INSERT INTO `ms_pegawai` VALUES (34, '910200125', 'Arif Rahman Hakim', '-', 'Bandung', '2020-11-03', 'Laki-laki', 'Active', 3, 56, '1', '2020-11-03', '1', '2020-11-03');

-- ----------------------------
-- Table structure for ms_pemohon
-- ----------------------------
DROP TABLE IF EXISTS `ms_pemohon`;
CREATE TABLE `ms_pemohon`  (
  `id_pemohon` int(4) NOT NULL AUTO_INCREMENT,
  `nik_pemohon` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_pemohon` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat_pemohon` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `telp_pemohon` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keterangan_pemohon` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `status_pemohon` enum('Active','Non Active') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `createdBy` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdTime` date NULL DEFAULT NULL,
  `updatedBy` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updatedTime` date NULL DEFAULT NULL,
  PRIMARY KEY (`id_pemohon`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ms_pemohon
-- ----------------------------
INSERT INTO `ms_pemohon` VALUES (2, '1', 'isi Nama Pemohon', 'isi Alamat Pemohon', '081220081918', 'isi Keterangan pemohon', 'Active', '1', '2020-10-22', '1', '2020-10-23');
INSERT INTO `ms_pemohon` VALUES (3, '2', 'Diana Lestari', 'Bandung', '0', '-', 'Active', '1', '2020-10-22', '1', '2020-10-23');
INSERT INTO `ms_pemohon` VALUES (4, '3', 'Tifa Helissa', '-', '1', '-', 'Active', '1', '2020-10-22', '1', '2020-10-23');
INSERT INTO `ms_pemohon` VALUES (6, '3273230201890015', 'Erza', 'Margahayu Raya', '081220081918', 'tes', 'Active', '1', '2020-10-23', '1', '2020-10-23');
INSERT INTO `ms_pemohon` VALUES (7, '123456', 'Saya Pemohon', 'alamat saya', '0', '-', 'Active', '1', '2020-10-26', NULL, NULL);
INSERT INTO `ms_pemohon` VALUES (8, '3273050301900001', 'Patrick Wijaya', 'Jl.H.Durasid No.08', '08', '-', 'Active', '33', '2020-11-03', NULL, NULL);

-- ----------------------------
-- Table structure for ms_provinsi
-- ----------------------------
DROP TABLE IF EXISTS `ms_provinsi`;
CREATE TABLE `ms_provinsi`  (
  `id_provinsi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_provinsi` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keterangan_provinsi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `createdBy` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `createdTime` date NULL DEFAULT NULL,
  `updatedBy` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updatedTime` date NULL DEFAULT NULL,
  PRIMARY KEY (`id_provinsi`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ms_provinsi
-- ----------------------------
INSERT INTO `ms_provinsi` VALUES (1, 'Jawa Barat', '-', 'Active', NULL, '1', '2020-10-20');

-- ----------------------------
-- Table structure for ms_satker
-- ----------------------------
DROP TABLE IF EXISTS `ms_satker`;
CREATE TABLE `ms_satker`  (
  `id_satker` int(11) NOT NULL AUTO_INCREMENT,
  `nama_satker` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keterangan_satker` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdBy` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdTime` date NULL DEFAULT NULL,
  `updatedBy` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updatedTime` date NULL DEFAULT NULL,
  PRIMARY KEY (`id_satker`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ms_satker
-- ----------------------------
INSERT INTO `ms_satker` VALUES (3, 'Seksi Infrastruktur Pertanahan', 'IP', NULL, NULL, '1', '2020-10-21');
INSERT INTO `ms_satker` VALUES (4, 'Seksi Hubungan Hukum Pertanahan', 'tesss', '1', '2020-10-28', '1', '2020-10-28');

-- ----------------------------
-- Table structure for ms_seksi
-- ----------------------------
DROP TABLE IF EXISTS `ms_seksi`;
CREATE TABLE `ms_seksi`  (
  `nama_seksi` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `moto_seksi` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat_seksi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `telp_seksi` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email_seksi` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keterangan_seksi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `website_seksi` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE = MyISAM CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ms_seksi
-- ----------------------------
INSERT INTO `ms_seksi` VALUES ('Seksi Infrastruktur Pertanahan', '-', 'Jl. Soekarno Hatta No.586 - Bandung', '081220081918', 'erzafikry@gmail.com', 'Seksi Infrastruktur Pertanahan', '-');

-- ----------------------------
-- Table structure for ms_status_berkas
-- ----------------------------
DROP TABLE IF EXISTS `ms_status_berkas`;
CREATE TABLE `ms_status_berkas`  (
  `id_status_berkas` int(11) NOT NULL AUTO_INCREMENT,
  `status_berkas` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keterangan_status_berkas` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `createdBy` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdTime` date NULL DEFAULT NULL,
  `updatedBy` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updatedTime` date NULL DEFAULT NULL,
  PRIMARY KEY (`id_status_berkas`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ms_status_berkas
-- ----------------------------
INSERT INTO `ms_status_berkas` VALUES (1, 'Proses', '', NULL, NULL, NULL, NULL);
INSERT INTO `ms_status_berkas` VALUES (2, 'Selesai', '', NULL, NULL, NULL, NULL);
INSERT INTO `ms_status_berkas` VALUES (3, 'Batal', '', NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for ms_surtug
-- ----------------------------
DROP TABLE IF EXISTS `ms_surtug`;
CREATE TABLE `ms_surtug`  (
  `id_surtug` int(11) NOT NULL AUTO_INCREMENT,
  `no_surtug` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_mulai_surtug` date NOT NULL,
  `tgl_terbit_surtug` date NOT NULL,
  `keterangan_surtug` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_berkas` int(11) NOT NULL,
  `id_pegawai` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `createdBy` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdTime` date NULL DEFAULT NULL,
  `updatedBy` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updatedTime` date NULL DEFAULT NULL,
  `group_id` int(6) NULL DEFAULT NULL,
  PRIMARY KEY (`id_surtug`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ms_surtug
-- ----------------------------
INSERT INTO `ms_surtug` VALUES (1, '45454656', '2020-11-04', '2020-11-06', 'dsafdsfdsf', 1, '17', '25', '2020-11-06', '23', '2020-11-08', 10);

-- ----------------------------
-- Table structure for ms_user
-- ----------------------------
DROP TABLE IF EXISTS `ms_user`;
CREATE TABLE `ms_user`  (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username_user` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password_user` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status_user` enum('Active','Non Active') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user_group` int(3) NOT NULL,
  `default_user` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'N',
  `id_pegawai` int(11) NOT NULL,
  `createdBy` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdTime` date NULL DEFAULT NULL,
  `updatedBy` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updatedTime` date NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 35 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ms_user
-- ----------------------------
INSERT INTO `ms_user` VALUES (1, 'erzafikry', '0cc175b9c0f1b6a831c399e269772661', 'Active', 1, 'N', 9, NULL, NULL, '1', '2020-10-20');
INSERT INTO `ms_user` VALUES (23, '198612222009121002', '0cc175b9c0f1b6a831c399e269772661', 'Active', 9, 'N', 13, '1', '2020-10-22', '1', '2020-10-22');
INSERT INTO `ms_user` VALUES (22, '197808102003121004', '0cc175b9c0f1b6a831c399e269772661', 'Active', 10, 'N', 12, '1', '2020-10-22', '1', '2020-10-22');
INSERT INTO `ms_user` VALUES (24, '196402011984031002', '0cc175b9c0f1b6a831c399e269772661', 'Active', 9, 'N', 14, '1', '2020-10-22', '1', '2020-10-22');
INSERT INTO `ms_user` VALUES (25, '910200156', '0cc175b9c0f1b6a831c399e269772661', 'Active', 8, 'N', 30, '1', '2020-10-22', '1', '2020-10-22');
INSERT INTO `ms_user` VALUES (26, '196912082014081001', '7fc56270e7a70fa81a5935b72eacbe29', 'Active', 11, 'N', 25, '1', '2020-10-22', NULL, NULL);
INSERT INTO `ms_user` VALUES (27, '910200130', '7fc56270e7a70fa81a5935b72eacbe29', 'Active', 12, 'N', 28, '1', '2020-10-22', NULL, NULL);
INSERT INTO `ms_user` VALUES (28, '910200053', '0cc175b9c0f1b6a831c399e269772661', 'Active', 13, 'N', 32, '1', '2020-10-22', NULL, NULL);
INSERT INTO `ms_user` VALUES (29, '196904301995031002', '0cc175b9c0f1b6a831c399e269772661', 'Active', 14, 'N', 21, '1', '2020-10-22', NULL, NULL);
INSERT INTO `ms_user` VALUES (30, '196906111991031010', '0cc175b9c0f1b6a831c399e269772661', 'Active', 15, 'N', 16, '1', '2020-10-22', NULL, NULL);
INSERT INTO `ms_user` VALUES (31, '199006272011011001', '0cc175b9c0f1b6a831c399e269772661', 'Active', 14, 'N', 24, '1', '2020-10-22', NULL, NULL);
INSERT INTO `ms_user` VALUES (32, '2020914', '0cc175b9c0f1b6a831c399e269772661', 'Active', 11, 'N', 33, '1', '2020-10-23', NULL, NULL);
INSERT INTO `ms_user` VALUES (33, '910200125', '0cc175b9c0f1b6a831c399e269772661', 'Active', 8, 'N', 34, '1', '2020-11-03', '1', '2020-11-03');
INSERT INTO `ms_user` VALUES (34, '910200021', '0cc175b9c0f1b6a831c399e269772661', 'Active', 12, 'N', 29, '1', '2020-11-03', NULL, NULL);

-- ----------------------------
-- Table structure for sys_akses
-- ----------------------------
DROP TABLE IF EXISTS `sys_akses`;
CREATE TABLE `sys_akses`  (
  `akses_id` int(4) NOT NULL AUTO_INCREMENT,
  `akses_group` int(3) NOT NULL,
  `akses_submenu` int(3) NOT NULL,
  `akses_dibuat` datetime(0) NOT NULL,
  `akses_diubah` datetime(0) NOT NULL,
  PRIMARY KEY (`akses_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 563 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of sys_akses
-- ----------------------------
INSERT INTO `sys_akses` VALUES (5, 0, 0, '2017-11-27 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (6, 0, 0, '2017-11-27 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (7, 0, 0, '2017-11-27 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (8, 0, 0, '2017-11-27 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (9, 0, 0, '2017-11-27 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (10, 0, 0, '2017-11-27 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (215, 4, 17, '2020-04-18 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (540, 1, 14, '2020-11-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (539, 1, 28, '2020-11-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (538, 1, 34, '2020-11-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (537, 1, 11, '2020-11-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (536, 1, 32, '2020-11-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (535, 1, 31, '2020-11-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (534, 1, 8, '2020-11-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (533, 1, 7, '2020-11-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (532, 1, 33, '2020-11-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (531, 1, 30, '2020-11-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (530, 1, 29, '2020-11-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (252, 3, 23, '2020-04-18 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (251, 3, 17, '2020-04-18 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (250, 3, 15, '2020-04-18 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (529, 1, 6, '2020-11-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (214, 4, 11, '2020-04-18 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (528, 1, 5, '2020-11-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (311, 2, 15, '2020-10-19 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (249, 3, 14, '2020-04-18 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (248, 3, 26, '2020-04-18 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (247, 3, 27, '2020-04-18 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (246, 3, 12, '2020-04-18 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (245, 3, 11, '2020-04-18 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (244, 3, 8, '2020-04-18 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (243, 3, 7, '2020-04-18 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (216, 4, 23, '2020-04-18 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (242, 3, 6, '2020-04-18 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (241, 3, 5, '2020-04-18 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (240, 3, 13, '2020-04-18 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (310, 2, 14, '2020-10-19 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (309, 2, 28, '2020-10-19 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (308, 2, 11, '2020-10-19 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (253, 3, 25, '2020-04-18 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (307, 2, 6, '2020-10-19 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (431, 7, 14, '2020-10-21 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (430, 7, 28, '2020-10-21 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (377, 6, 11, '2020-10-20 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (429, 7, 11, '2020-10-21 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (527, 1, 4, '2020-11-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (526, 1, 3, '2020-11-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (525, 1, 2, '2020-11-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (432, 7, 15, '2020-10-21 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (560, 8, 28, '2020-11-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (559, 8, 11, '2020-11-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (558, 8, 8, '2020-11-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (557, 8, 7, '2020-11-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (556, 8, 33, '2020-11-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (555, 8, 6, '2020-11-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (554, 8, 5, '2020-11-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (545, 9, 14, '2020-11-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (544, 9, 28, '2020-11-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (543, 9, 34, '2020-11-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (486, 10, 14, '2020-10-22 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (485, 10, 28, '2020-10-22 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (484, 10, 11, '2020-10-22 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (542, 9, 11, '2020-11-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (487, 10, 15, '2020-10-22 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (488, 11, 11, '2020-10-22 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (489, 12, 11, '2020-10-22 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (490, 13, 11, '2020-10-22 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (491, 14, 11, '2020-10-22 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (492, 15, 11, '2020-10-22 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (541, 1, 15, '2020-11-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (546, 9, 15, '2020-11-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (561, 8, 14, '2020-11-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (562, 8, 15, '2020-11-03 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for sys_group
-- ----------------------------
DROP TABLE IF EXISTS `sys_group`;
CREATE TABLE `sys_group`  (
  `group_id` int(3) NOT NULL AUTO_INCREMENT,
  `group_nama` varchar(35) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `group_keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `group_status` enum('Active','Non Active') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`group_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 16 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sys_group
-- ----------------------------
INSERT INTO `sys_group` VALUES (1, 'Superadmin', 'superadmin', 'Active');
INSERT INTO `sys_group` VALUES (13, 'Petugas Textual', 'PT', 'Active');
INSERT INTO `sys_group` VALUES (12, 'Petugas Grafis', 'PG', 'Active');
INSERT INTO `sys_group` VALUES (11, 'Petugas Ukur', 'PU', 'Active');
INSERT INTO `sys_group` VALUES (10, 'Kasie', 'Kepala Seksi', 'Active');
INSERT INTO `sys_group` VALUES (9, 'Kasubsie', 'Kepala Subseksi', 'Active');
INSERT INTO `sys_group` VALUES (8, 'Administrator', 'Admin', 'Active');
INSERT INTO `sys_group` VALUES (14, 'Kordinator Pemetaan', 'Kordi Pemetaan', 'Active');
INSERT INTO `sys_group` VALUES (15, 'Kordinator Pengukuran', 'Kordi Pengukuran', 'Active');

-- ----------------------------
-- Table structure for sys_menu
-- ----------------------------
DROP TABLE IF EXISTS `sys_menu`;
CREATE TABLE `sys_menu`  (
  `menu_id` int(3) NOT NULL AUTO_INCREMENT,
  `menu_nama` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `menu_icon` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `menu_urutan` int(2) NOT NULL,
  `menu_dibuat` datetime(0) NOT NULL,
  `menu_diubah` datetime(0) NOT NULL,
  PRIMARY KEY (`menu_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sys_menu
-- ----------------------------
INSERT INTO `sys_menu` VALUES (1, 'Pengaturan', 'icon-settings', 1, '2017-11-26 00:00:00', '2017-11-26 00:00:00');
INSERT INTO `sys_menu` VALUES (2, 'Master Data', 'icon-wallet', 2, '2017-11-26 00:00:00', '2017-11-26 00:00:00');
INSERT INTO `sys_menu` VALUES (3, 'Master Wilayah', 'icon-folder', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_menu` VALUES (4, 'Berkas', 'icon-folder', 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_menu` VALUES (5, 'Dokumen', 'icon-folder', 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_menu` VALUES (6, 'Laporan', 'icon-pie-chart', 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for sys_submenu
-- ----------------------------
DROP TABLE IF EXISTS `sys_submenu`;
CREATE TABLE `sys_submenu`  (
  `submenu_id` int(3) NOT NULL AUTO_INCREMENT,
  `submenu_nama` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `submenu_menu` int(3) NOT NULL,
  `submenu_link` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `submenu_urutan` int(3) NOT NULL,
  `submenu_dibuat` datetime(0) NOT NULL,
  `submenu_diubah` datetime(0) NOT NULL,
  PRIMARY KEY (`submenu_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 35 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sys_submenu
-- ----------------------------
INSERT INTO `sys_submenu` VALUES (2, 'Data User', 1, '?page=datauser', 3, '2017-11-26 00:00:00', '2020-10-22 00:00:00');
INSERT INTO `sys_submenu` VALUES (3, 'Data Menu & Modul', 1, '?page=datamodul', 4, '2017-11-26 00:00:00', '2020-03-12 00:00:00');
INSERT INTO `sys_submenu` VALUES (4, 'Level Group Akses', 1, '?page=datagroup', 2, '2017-11-26 00:00:00', '2020-10-22 00:00:00');
INSERT INTO `sys_submenu` VALUES (5, 'Data Pegawai', 2, '?page=datapegawai', 3, '2017-11-26 00:00:00', '2020-10-20 00:00:00');
INSERT INTO `sys_submenu` VALUES (6, 'Data Pemohon', 2, '?page=datapemohon', 4, '2017-11-26 00:00:00', '2020-10-20 00:00:00');
INSERT INTO `sys_submenu` VALUES (7, 'Data Kecamatan', 3, '?page=datakec', 3, '2017-11-26 00:00:00', '2020-10-20 00:00:00');
INSERT INTO `sys_submenu` VALUES (8, 'Data Kelurahan', 3, '?page=datakel', 4, '2017-12-24 00:00:00', '2020-10-20 00:00:00');
INSERT INTO `sys_submenu` VALUES (11, 'Daftar Berkas', 4, '?page=databerkas', 1, '2017-12-24 00:00:00', '2020-10-22 00:00:00');
INSERT INTO `sys_submenu` VALUES (13, 'Pengaturan Seksi', 1, '?page=confseksi', 1, '2017-12-24 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_submenu` VALUES (14, 'Berkas Masuk', 6, '?page=lapberkas', 1, '2017-12-29 00:00:00', '2020-10-20 00:00:00');
INSERT INTO `sys_submenu` VALUES (15, 'Daftar Pemohon', 6, '?page=lappemohon', 2, '2017-12-29 00:00:00', '2020-10-21 00:00:00');
INSERT INTO `sys_submenu` VALUES (28, 'Surat Tugas', 5, '?page=datasurtug', 1, '0000-00-00 00:00:00', '2020-10-22 00:00:00');
INSERT INTO `sys_submenu` VALUES (29, 'Data Jabatan', 2, '?page=datajab', 2, '2020-10-19 00:00:00', '2020-10-20 00:00:00');
INSERT INTO `sys_submenu` VALUES (30, 'Data Satker', 2, '?page=datasatker', 1, '2020-10-19 00:00:00', '2020-10-20 00:00:00');
INSERT INTO `sys_submenu` VALUES (31, 'Data Provinsi', 3, '?page=dataprov', 1, '2020-10-20 00:00:00', '2020-10-20 00:00:00');
INSERT INTO `sys_submenu` VALUES (32, 'Data Kota', 3, '?page=datakot', 2, '2020-10-20 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_submenu` VALUES (33, 'Data Layanan', 2, '?page=datalay', 5, '2020-10-21 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_submenu` VALUES (34, 'Berkas Masuk', 4, '?page=berkasmasuk', 2, '2020-11-03 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for trx_surtug
-- ----------------------------
DROP TABLE IF EXISTS `trx_surtug`;
CREATE TABLE `trx_surtug`  (
  `id_trx_surtug` int(11) NOT NULL AUTO_INCREMENT,
  `id_surtug` int(11) NULL DEFAULT NULL,
  `id_pegawai` int(11) NULL DEFAULT NULL,
  `tgl_kirim` date NULL DEFAULT NULL,
  `catatan` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdBy` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdTime` datetime(0) NULL DEFAULT NULL,
  `updatedBy` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updatedTime` datetime(0) NULL DEFAULT NULL,
  `group_id` int(5) NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_trx_surtug`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of trx_surtug
-- ----------------------------
INSERT INTO `trx_surtug` VALUES (1, 1, 30, '2020-11-06', 'Kirim kasubsie', '25', '2020-11-06 10:03:18', NULL, NULL, 9, 'Kirim');
INSERT INTO `trx_surtug` VALUES (2, 1, 13, '2020-11-08', 'kembali ke admin', '23', '2020-11-08 14:55:35', NULL, NULL, 8, 'Batal');
INSERT INTO `trx_surtug` VALUES (3, 1, 30, '2020-11-08', 'kirim ulang kasubsie', '25', '2020-11-08 14:58:05', NULL, NULL, 9, 'Kirim');
INSERT INTO `trx_surtug` VALUES (4, 1, 13, '2020-11-08', 'masih belum lengkap kembali ke admin', '23', '2020-11-08 14:59:15', NULL, NULL, 8, 'Batal');
INSERT INTO `trx_surtug` VALUES (5, 1, 30, '2020-11-08', 'Kirim ulang kasubsie', '25', '2020-11-08 15:10:37', NULL, NULL, 9, 'Kirim');
INSERT INTO `trx_surtug` VALUES (6, 1, 13, '2020-11-08', 'Dikirim ke Kasie', '23', '2020-11-08 15:11:21', NULL, NULL, 10, 'Kirim');

SET FOREIGN_KEY_CHECKS = 1;
