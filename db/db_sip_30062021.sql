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

 Date: 30/06/2021 13:13:55
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
  `status_berkas` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keterangan_berkas` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `createdBy` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdTime` date NULL DEFAULT NULL,
  `updatedBy` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updatedTime` date NULL DEFAULT NULL,
  `no_surtug` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_mulai_surtug` date NULL DEFAULT NULL,
  `tgl_terbit_surtug` date NULL DEFAULT NULL,
  `id_petugas_ukur` int(6) NULL DEFAULT NULL,
  `posisi_berkas` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_pegawai` int(6) NULL DEFAULT NULL,
  `tgl_awal` date NULL DEFAULT NULL,
  `tgl_akhir` date NULL DEFAULT NULL,
  PRIMARY KEY (`id_berkas`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ms_berkas
-- ----------------------------
INSERT INTO `ms_berkas` VALUES (1, '1212', 2021, 6, 3, 1, 3, 3131, '3434', '  3434 ', 'Diproses', 'dsfdsf', '1', '2021-06-28', '1', '2021-06-28', '345343', '2021-06-30', '2021-06-23', NULL, 'Kordinator Pemetaan', 22, '2021-06-29', '2021-06-30');
INSERT INTO `ms_berkas` VALUES (2, '45345', 2020, 8, 2, 20, 106, 343, '454', '  546', 'Diproses', 'sdsas', '1', '2021-06-30', NULL, '2021-06-30', '3453534', '2021-06-30', '2021-06-30', NULL, 'Petugas Grafis', 29, '2021-06-30', '2021-06-29');

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
) ENGINE = MyISAM AUTO_INCREMENT = 31 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ms_kecamatan
-- ----------------------------
INSERT INTO `ms_kecamatan` VALUES (1, 1, 'Andir', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kecamatan` VALUES (2, 1, 'Antapani', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kecamatan` VALUES (3, 1, 'Arcamanik', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kecamatan` VALUES (4, 1, 'Astanaanyar', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kecamatan` VALUES (5, 1, 'Babakan Ciparay', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kecamatan` VALUES (6, 1, 'Bandung Kidul', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kecamatan` VALUES (7, 1, 'Bandung Kulon', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kecamatan` VALUES (8, 1, 'Bandung Wetan', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kecamatan` VALUES (9, 1, 'Batununggal', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kecamatan` VALUES (10, 1, 'Bojongloa Kaler', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kecamatan` VALUES (11, 1, 'Bojongloa Kidul', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kecamatan` VALUES (12, 1, 'Buahbatu', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kecamatan` VALUES (13, 1, 'Cibeunying Kaler', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kecamatan` VALUES (14, 1, 'Cibeunying Kidul', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kecamatan` VALUES (15, 1, 'Cibiru', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kecamatan` VALUES (16, 1, 'Cicendo', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kecamatan` VALUES (17, 1, 'Cidadap', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kecamatan` VALUES (18, 1, 'Cinambo', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kecamatan` VALUES (19, 1, 'Coblong', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kecamatan` VALUES (20, 1, 'Gedebage', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kecamatan` VALUES (21, 1, 'Kiara Condong', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kecamatan` VALUES (22, 1, 'Lengkong', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kecamatan` VALUES (23, 1, 'Mandalajati', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kecamatan` VALUES (24, 1, 'Panyileukan', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kecamatan` VALUES (25, 1, 'Rancasari', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kecamatan` VALUES (26, 1, 'Regol', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kecamatan` VALUES (27, 1, 'Sukajadi', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kecamatan` VALUES (28, 1, 'Sukasari', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kecamatan` VALUES (29, 1, 'Sumur Bandung', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kecamatan` VALUES (30, 1, 'Ujungberung', '-', 'Active', '', '0000-00-00', '', '0000-00-00');

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
) ENGINE = MyISAM AUTO_INCREMENT = 162 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ms_kelurahan
-- ----------------------------
INSERT INTO `ms_kelurahan` VALUES (1, 1, 'Campaka', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (2, 1, 'Ciroyom', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (3, 1, 'Dunguscariang', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (4, 1, 'Garuda', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (5, 1, 'Kebon Jeruk', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (6, 1, 'Maleber', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (7, 2, 'Antapani', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (8, 2, 'Antapani Kidul', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (9, 2, 'Antapani Kulon', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (10, 2, 'Antapani Tengah', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (11, 2, 'Antapani Wetan', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (12, 2, 'Karang Pamulang', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (13, 2, 'Mandalajati', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (14, 3, 'Cisaranten Bina Harapan', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (15, 3, 'Cisaranten Endah', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (16, 3, 'Cisaranten Kulon', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (17, 3, 'Sindang Jaya', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (18, 3, 'Sukamiskin', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (19, 4, 'Cibadak', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (20, 4, 'Karanganyar', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (21, 4, 'Karasak', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (22, 4, 'Nyengseret', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (23, 4, 'Panjunan', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (24, 4, 'Pelindung Hewan', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (25, 5, 'Babakan', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (26, 5, 'Babakan Ciparay', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (27, 5, 'Cirangrang', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (28, 5, 'Margahayu Utara', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (29, 5, 'Margasuka', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (30, 5, 'Sukahaji', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (31, 6, 'Batununggal', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (32, 6, 'Kujang Sari', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (33, 6, 'Mengger', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (34, 6, 'Wates', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (35, 7, 'Caringin', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (36, 7, 'Cibuntu', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (37, 7, 'Cigondewah Kaler', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (38, 7, 'Cigondewah Kidul', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (39, 7, 'Cigondewah Rahayu', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (40, 7, 'Cijerah', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (41, 7, 'Gempol Sari', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (42, 7, 'Warung Muncang', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (43, 8, 'Cihapit', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (44, 8, 'Citarum', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (45, 8, 'Taman Sari', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (46, 9, 'Binong', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (47, 9, 'Cibangkong', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (48, 9, 'Gumuruh', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (49, 9, 'Kacapiring', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (50, 9, 'Kebon Gedang', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (51, 9, 'Kebon Waru', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (52, 9, 'Maleer', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (53, 9, 'Samoja', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (54, 10, 'Babakan Asih', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (55, 10, 'Babakan Tarogong', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (56, 10, 'Jamika', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (57, 10, 'Kopo', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (58, 10, 'Sukaasih', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (59, 11, 'Cibaduyut', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (60, 11, 'Cibaduyut Kidul', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (61, 11, 'Cibaduyut Wetan', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (62, 11, 'Kebon Lega', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (63, 11, 'Mekarwangi', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (64, 11, 'Situsaeur', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (65, 12, 'Cijawura', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (66, 12, 'Jati Sari', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (67, 12, 'Margasari', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (68, 12, 'Margasenang', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (69, 12, 'Sekejati', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (70, 13, 'Cigadung', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (71, 13, 'Cihaurgeulis', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (72, 13, 'Neglasari', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (73, 13, 'Sukaluyu', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (74, 14, 'Cicadas', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (75, 14, 'Cikutra', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (76, 14, 'Padasuka', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (77, 14, 'Pasirlayung', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (78, 14, 'Sukamaju', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (79, 14, 'Sukapada', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (80, 15, 'Cipadung', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (81, 15, 'Cipadung Kidul', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (82, 15, 'Cipadung Kulon', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (83, 15, 'Cisurupan', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (84, 15, 'Palasari', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (85, 15, 'Pasir Biru', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (86, 16, 'Arjuna', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (87, 16, 'Husen Sastranegara', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (88, 16, 'Pajajaran', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (89, 16, 'Pamoyanan', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (90, 16, 'Pasirkaliki', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (91, 16, 'Sukaraja', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (92, 17, 'Ciumbuleuit', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (93, 17, 'Hegarmanah', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (94, 17, 'Ledeng', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (95, 18, 'Babakan Penghulu', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (96, 18, 'Cisaranten Wetan', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (97, 18, 'Pakemitan', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (98, 18, 'Sukamulya', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (99, 19, 'Cipaganti', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (100, 19, 'Dago', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (101, 19, 'Lebak Siliwangi', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (102, 19, 'Lebakgede', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (103, 19, 'Sadang Serang', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (104, 19, 'Sekeloa', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (105, 20, 'Cimincrang', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (106, 20, 'Cisaranten Kidul', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (107, 20, 'Rancabolang', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (108, 20, 'Rancanumpang', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (109, 21, 'Babakan Sari', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (110, 21, 'Babakan Surabaya', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (111, 21, 'Cicaheum', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (112, 21, 'Kebon Jayanti', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (113, 21, 'Kebon Kangkung', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (114, 21, 'Sukapura', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (115, 22, 'Burangrang', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (116, 22, 'Cijagra', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (117, 22, 'Cikawao', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (118, 22, 'Lingkar Selatan', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (119, 22, 'Malabar', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (120, 22, 'Paledang', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (121, 22, 'Turangga', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (122, 23, 'Jatihandap', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (123, 23, 'Karang Pamulang', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (124, 23, 'Pasir Impun', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (125, 23, 'Sindang Jaya', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (126, 24, 'Cipadung Kidul', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (127, 24, 'Cipadung Kulon', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (128, 24, 'Cipadung Wetan', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (129, 24, 'Mekar Mulya', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (130, 25, 'Cipamokolan', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (131, 25, 'Cisaranten Kidul', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (132, 25, 'Derwati', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (133, 25, 'Manjahlega', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (134, 25, 'Mekar Jaya', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (135, 25, 'Mekar Mulya', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (136, 26, 'Ancol', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (137, 26, 'Balonggede', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (138, 26, 'Ciateul', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (139, 26, 'Cigereleng', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (140, 26, 'Ciseureuh', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (141, 26, 'Pasirluyu', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (142, 26, 'Pungkur', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (143, 27, 'Cipedes', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (144, 27, 'Pasteur', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (145, 27, 'Sukabungah', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (146, 27, 'Sukagalih', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (147, 27, 'Sukawarna', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (148, 28, 'Gegerkalong', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (149, 28, 'Isola', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (150, 28, 'Sarijadi', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (151, 28, 'Sukarasa', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (152, 29, 'Babakan Ciamis', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (153, 29, 'Braga', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (154, 29, 'Kebon Pisang', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (155, 29, 'Merdeka', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (156, 30, 'Cigending', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (157, 30, 'Pasanggrahan', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (158, 30, 'Pasir Endah', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (159, 30, 'Pasir Jati', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (160, 30, 'Pasir Wangi', '-', 'Active', '', '0000-00-00', '', '0000-00-00');
INSERT INTO `ms_kelurahan` VALUES (161, 30, 'Ujung Berung', '-', 'Active', '', '0000-00-00', '', '0000-00-00');

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
INSERT INTO `ms_user` VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Active', 1, 'N', 9, NULL, NULL, '1', '2020-10-20');
INSERT INTO `ms_user` VALUES (23, '198612222009121002', '0cc175b9c0f1b6a831c399e269772661', 'Active', 9, 'N', 13, '1', '2020-10-22', '1', '2020-10-22');
INSERT INTO `ms_user` VALUES (22, '197808102003121004', '0cc175b9c0f1b6a831c399e269772661', 'Active', 10, 'N', 12, '1', '2020-10-22', '1', '2020-10-22');
INSERT INTO `ms_user` VALUES (24, '196402011984031002', '0cc175b9c0f1b6a831c399e269772661', 'Active', 9, 'N', 14, '1', '2020-10-22', '1', '2020-10-22');
INSERT INTO `ms_user` VALUES (25, '910200156', '0cc175b9c0f1b6a831c399e269772661', 'Active', 8, 'N', 30, '1', '2020-10-22', '1', '2020-10-22');
INSERT INTO `ms_user` VALUES (26, '196912082014081001', '0cc175b9c0f1b6a831c399e269772661', 'Active', 11, 'N', 25, '1', '2020-10-22', '1', '2020-11-13');
INSERT INTO `ms_user` VALUES (27, '910200130', '0cc175b9c0f1b6a831c399e269772661', 'Active', 12, 'N', 28, '1', '2020-10-22', '1', '2020-11-15');
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
) ENGINE = MyISAM AUTO_INCREMENT = 591 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Fixed;

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
INSERT INTO `sys_akses` VALUES (590, 1, 15, '2021-06-16 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (589, 1, 14, '2021-06-16 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (588, 1, 35, '2021-06-16 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (587, 1, 11, '2021-06-16 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (586, 1, 32, '2021-06-16 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (585, 1, 31, '2021-06-16 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (584, 1, 8, '2021-06-16 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (583, 1, 7, '2021-06-16 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (582, 1, 33, '2021-06-16 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (581, 1, 30, '2021-06-16 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (580, 1, 29, '2021-06-16 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (252, 3, 23, '2020-04-18 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (251, 3, 17, '2020-04-18 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (250, 3, 15, '2020-04-18 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (579, 1, 6, '2021-06-16 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (214, 4, 11, '2020-04-18 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (578, 1, 5, '2021-06-16 00:00:00', '0000-00-00 00:00:00');
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
INSERT INTO `sys_akses` VALUES (577, 1, 13, '2021-06-16 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (576, 1, 4, '2021-06-16 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (575, 1, 3, '2021-06-16 00:00:00', '0000-00-00 00:00:00');
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
INSERT INTO `sys_akses` VALUES (572, 10, 14, '2020-11-16 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (571, 10, 28, '2020-11-16 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (570, 10, 34, '2020-11-16 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (542, 9, 11, '2020-11-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (569, 10, 11, '2020-11-16 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (563, 11, 11, '2020-11-13 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (565, 12, 11, '2020-11-15 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (567, 13, 11, '2020-11-15 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (491, 14, 11, '2020-10-22 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (492, 15, 11, '2020-10-22 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (574, 1, 2, '2021-06-16 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (546, 9, 15, '2020-11-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (561, 8, 14, '2020-11-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (562, 8, 15, '2020-11-03 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (564, 11, 34, '2020-11-13 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (566, 12, 34, '2020-11-15 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (568, 13, 34, '2020-11-15 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_akses` VALUES (573, 10, 15, '2020-11-16 00:00:00', '0000-00-00 00:00:00');

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
INSERT INTO `sys_menu` VALUES (3, 'Wilayah', 'icon-map', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
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
) ENGINE = MyISAM AUTO_INCREMENT = 36 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

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
INSERT INTO `sys_submenu` VALUES (15, 'Daftar Pemohon', 6, '?page=lappemohon', 2, '2017-12-29 00:00:00', '2020-10-21 00:00:00');
INSERT INTO `sys_submenu` VALUES (29, 'Data Jabatan', 2, '?page=datajab', 2, '2020-10-19 00:00:00', '2020-10-20 00:00:00');
INSERT INTO `sys_submenu` VALUES (30, 'Data Satker', 2, '?page=datasatker', 1, '2020-10-19 00:00:00', '2020-10-20 00:00:00');
INSERT INTO `sys_submenu` VALUES (31, 'Data Provinsi', 3, '?page=dataprov', 1, '2020-10-20 00:00:00', '2020-10-20 00:00:00');
INSERT INTO `sys_submenu` VALUES (32, 'Data Kota', 3, '?page=datakot', 2, '2020-10-20 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `sys_submenu` VALUES (33, 'Data Layanan', 2, '?page=datalay', 5, '2020-10-21 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for trx_history
-- ----------------------------
DROP TABLE IF EXISTS `trx_history`;
CREATE TABLE `trx_history`  (
  `id_history` int(11) NOT NULL AUTO_INCREMENT,
  `id_berkas` int(11) NULL DEFAULT NULL,
  `id_pegawai` int(11) NULL DEFAULT NULL,
  `catatan` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdBy` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdTime` datetime(0) NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lama_berkas` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_mulai` date NULL DEFAULT NULL,
  `tgl_selesai` date NULL DEFAULT NULL,
  `posisi` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_kembali` date NULL DEFAULT NULL,
  PRIMARY KEY (`id_history`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of trx_history
-- ----------------------------
INSERT INTO `trx_history` VALUES (1, 1, 22, 'Kirim kepetugas ukur', '1', '2021-06-28 10:55:49', 'Dikirim', '-', NULL, NULL, 'Operator', NULL);
INSERT INTO `trx_history` VALUES (2, 1, NULL, 'Dikembalikan ke oprator', '1', '2021-06-28 10:56:40', 'Dikembalikan', '-', NULL, NULL, 'Petugas Ukur', '2021-06-27');
INSERT INTO `trx_history` VALUES (3, 1, 22, 'Dikirim kembali ke petugas ukur', '1', '2021-06-28 10:57:20', 'Dikirim', '-', NULL, NULL, 'Operator', NULL);
INSERT INTO `trx_history` VALUES (4, 1, 34, 'diterima petugas ukur dan akan dikirim ke petugas grafis', '1', '2021-06-28 10:58:11', 'Dikirim', '3 Days', '2021-06-25', '2021-06-28', 'Petugas Grafis', NULL);
INSERT INTO `trx_history` VALUES (6, 1, NULL, 'dikembalikan ke petugas ukur', '1', '2021-06-28 11:01:44', 'Dikembalikan', '-', NULL, NULL, 'Petugas Grafis', '2021-06-28');
INSERT INTO `trx_history` VALUES (7, 1, 12, 'diterima petugas grafis dan dikirim ke petugas textual', '1', '2021-06-28 11:04:32', 'Dikirim', '1 Day', '2021-06-28', '2021-06-29', 'Petugas Grafis', NULL);
INSERT INTO `trx_history` VALUES (8, 1, NULL, 'dikembalikan ke petugas ukur', '1', '2021-06-28 11:08:41', 'Dikembalikan', '-', NULL, NULL, 'Petugas Grafis', '2021-06-23');
INSERT INTO `trx_history` VALUES (9, 1, 31, 'dikirim ke petugas grafis', '1', '2021-06-28 11:09:12', 'Dikirim', '', '2021-06-23', '2021-06-23', 'Petugas Grafis', NULL);
INSERT INTO `trx_history` VALUES (10, 1, 20, 'dikirim petugas textual', '1', '2021-06-28 11:10:03', 'Dikirim', '3 Days', '2021-06-23', '2021-06-26', 'Petugas Grafis', NULL);
INSERT INTO `trx_history` VALUES (11, 1, NULL, 'dikembalikan ke petugas grafis', '1', '2021-06-28 11:15:29', 'Dikembalikan', '-', NULL, NULL, 'Petugas Grafis', '2021-06-23');
INSERT INTO `trx_history` VALUES (12, 1, 17, 'kirim ke petugas tektual', '1', '2021-06-28 11:16:07', 'Dikirim', '6 Days', '2021-06-23', '2021-06-29', 'Petugas Grafis', NULL);
INSERT INTO `trx_history` VALUES (13, 1, 14, 'kirim ke kordinator pemetaan', '1', '2021-06-28 11:16:30', 'Dikirim', '2 Days', '2021-06-28', '2021-06-30', 'Petugas Textual', NULL);
INSERT INTO `trx_history` VALUES (14, 1, 22, 'dsfdsf', '1', '2021-06-30 13:01:38', 'Dikirim', '1 Day', '2021-06-29', '2021-06-30', 'Kordinator Pemetaan', NULL);
INSERT INTO `trx_history` VALUES (15, 2, 29, 'test', '1', '2021-06-30 13:06:10', 'Dikirim', '-', NULL, NULL, 'Operator', NULL);
INSERT INTO `trx_history` VALUES (16, 2, 29, 'sdsas', '1', '2021-06-30 13:13:24', 'Dikirim', '1 Day', '2021-06-30', '2021-06-29', 'Petugas Grafis', NULL);

SET FOREIGN_KEY_CHECKS = 1;
