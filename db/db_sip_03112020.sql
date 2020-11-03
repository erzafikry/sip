/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.38-MariaDB : Database - db_sip
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
USE `db_sip`;

/*Table structure for table `ms_berkas` */

DROP TABLE IF EXISTS `ms_berkas`;

CREATE TABLE `ms_berkas` (
  `id_berkas` int(11) NOT NULL AUTO_INCREMENT,
  `no_berkas` varchar(25) NOT NULL,
  `tahun_berkas` int(4) NOT NULL,
  `id_pemohon` int(11) NOT NULL,
  `id_layanan` int(11) NOT NULL,
  `id_kecamatan` int(11) NOT NULL,
  `id_kelurahan` int(11) NOT NULL,
  `volume` int(4) NOT NULL,
  `di_305` varchar(25) NOT NULL,
  `di_302` varchar(25) NOT NULL,
  `id_status_berkas` int(11) NOT NULL,
  `keterangan_berkas` text NOT NULL,
  `createdBy` varchar(250) DEFAULT NULL,
  `createdTime` date DEFAULT NULL,
  `updatedBy` varchar(250) DEFAULT NULL,
  `updatedTime` date DEFAULT NULL,
  PRIMARY KEY (`id_berkas`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `ms_berkas` */

/*Table structure for table `ms_jabatan` */

DROP TABLE IF EXISTS `ms_jabatan`;

CREATE TABLE `ms_jabatan` (
  `id_jabatan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(250) NOT NULL,
  `tipe_jabatan` enum('Struktural','Jabatan Fungsional Umum','Jabatan Fungsional Tertentu','PPNPN','Petugas Ukur','SKB','ASKB','Pembantu Ukur') NOT NULL,
  `eselon` varchar(4) DEFAULT NULL,
  `createdBy` varchar(250) DEFAULT NULL,
  `createdTime` date DEFAULT NULL,
  `updatedBy` varchar(250) DEFAULT NULL,
  `updatedTime` date DEFAULT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

/*Data for the table `ms_jabatan` */

insert  into `ms_jabatan`(`id_jabatan`,`nama_jabatan`,`tipe_jabatan`,`eselon`,`createdBy`,`createdTime`,`updatedBy`,`updatedTime`) values (19,'Kepala Seksi Infrastruktur Pertanahan ','Struktural','IV','','0000-00-00','','0000-00-00'),(20,'Kepala Subseksi Pengukuran dan Pemetaan Dasar dan Tematik','Struktural','V','','0000-00-00','','0000-00-00'),(21,'Kepala Subseksi Pengukuran dan Pemetaan Kadastral ','Struktural','V','','0000-00-00','','0000-00-00'),(37,'Petugas Ukur','Jabatan Fungsional Umum','-','','0000-00-00','1','2020-10-22'),(50,'Surveyor Pemetaan Penyelia','Jabatan Fungsional Tertentu','-','1','2020-10-22',NULL,NULL),(51,'Pengadministrasi Pertanahan','Jabatan Fungsional Umum','-','1','2020-10-22',NULL,NULL),(52,'Analis Survei, Pengukuran Dan Pemetaan','Jabatan Fungsional Umum','-','1','2020-10-22',NULL,NULL),(53,'Surveyor Pemetaan Pelaksana','Jabatan Fungsional Tertentu','-','1','2020-10-22',NULL,NULL),(54,'Asisten Surveyor Kadaster Berlisensi','ASKB','-','1','2020-10-22',NULL,NULL),(55,'Pembantu Ukur','Pembantu Ukur','-','1','2020-10-22',NULL,NULL),(56,'PPNPN','PPNPN','-','1','2020-10-22',NULL,NULL),(57,'Pengelola Aplikasi','PPNPN','-','','0000-00-00','','0000-00-00');

/*Table structure for table `ms_kecamatan` */

DROP TABLE IF EXISTS `ms_kecamatan`;

CREATE TABLE `ms_kecamatan` (
  `id_kecamatan` int(11) NOT NULL AUTO_INCREMENT,
  `id_kota` int(11) NOT NULL,
  `nama_kecamatan` varchar(100) NOT NULL,
  `keterangan_kecamatan` text,
  `status_kecamatan` enum('Active','Non Active') NOT NULL,
  `createdBy` varchar(250) DEFAULT NULL,
  `createdTime` date DEFAULT NULL,
  `updatedBy` varchar(250) DEFAULT NULL,
  `updatedTime` date DEFAULT NULL,
  PRIMARY KEY (`id_kecamatan`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `ms_kecamatan` */

insert  into `ms_kecamatan`(`id_kecamatan`,`id_kota`,`nama_kecamatan`,`keterangan_kecamatan`,`status_kecamatan`,`createdBy`,`createdTime`,`updatedBy`,`updatedTime`) values (1,1,'Andir',NULL,'Active',NULL,NULL,NULL,NULL),(4,1,'Antapani','-','Active','1','2020-10-21','1','2020-10-21'),(10,1,'Arcamanik','-','Active','1','2020-10-21',NULL,NULL);

/*Table structure for table `ms_kelurahan` */

DROP TABLE IF EXISTS `ms_kelurahan`;

CREATE TABLE `ms_kelurahan` (
  `id_kelurahan` int(11) NOT NULL AUTO_INCREMENT,
  `id_kecamatan` int(11) NOT NULL,
  `nama_kelurahan` varchar(100) NOT NULL,
  `keterangan_kelurahan` text,
  `status_kelurahan` enum('Active','Non Active') NOT NULL,
  `createdBy` varchar(250) DEFAULT NULL,
  `createdTime` date DEFAULT NULL,
  `updatedBy` varchar(250) DEFAULT NULL,
  `updatedTime` date DEFAULT NULL,
  PRIMARY KEY (`id_kelurahan`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `ms_kelurahan` */

insert  into `ms_kelurahan`(`id_kelurahan`,`id_kecamatan`,`nama_kelurahan`,`keterangan_kelurahan`,`status_kelurahan`,`createdBy`,`createdTime`,`updatedBy`,`updatedTime`) values (1,1,'Campaka','-','Active','1','2020-10-21',NULL,NULL),(2,1,'Ciroyom','-','Active','1','2020-10-21',NULL,NULL),(6,4,'Antapani','','Active','1','2020-10-21',NULL,NULL),(4,4,'Antapani Kidul','-','Active','1','2020-10-21','1','2020-10-21'),(5,1,'Dunguscariang','-','Active','1','2020-10-21',NULL,NULL);

/*Table structure for table `ms_kota` */

DROP TABLE IF EXISTS `ms_kota`;

CREATE TABLE `ms_kota` (
  `id_kota` int(11) NOT NULL AUTO_INCREMENT,
  `id_provinsi` int(11) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `keterangan_kota` text,
  `status_kota` enum('Active','Non Active') NOT NULL,
  `createdBy` varchar(250) DEFAULT NULL,
  `createdTime` date DEFAULT NULL,
  `updatedBy` varchar(250) DEFAULT NULL,
  `updatedTime` date DEFAULT NULL,
  PRIMARY KEY (`id_kota`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `ms_kota` */

insert  into `ms_kota`(`id_kota`,`id_provinsi`,`nama_kota`,`keterangan_kota`,`status_kota`,`createdBy`,`createdTime`,`updatedBy`,`updatedTime`) values (1,1,'Kota Bandung','-','Active','1','2020-10-21',NULL,NULL);

/*Table structure for table `ms_layanan` */

DROP TABLE IF EXISTS `ms_layanan`;

CREATE TABLE `ms_layanan` (
  `id_layanan` int(4) NOT NULL AUTO_INCREMENT,
  `nama_layanan` varchar(50) NOT NULL,
  `keterangan_layanan` text,
  `status_layanan` enum('Active','Non Active') NOT NULL,
  `createdBy` varchar(250) DEFAULT NULL,
  `createdTime` date DEFAULT NULL,
  `updatedBy` varchar(250) DEFAULT NULL,
  `updatedTime` date DEFAULT NULL,
  PRIMARY KEY (`id_layanan`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `ms_layanan` */

insert  into `ms_layanan`(`id_layanan`,`nama_layanan`,`keterangan_layanan`,`status_layanan`,`createdBy`,`createdTime`,`updatedBy`,`updatedTime`) values (2,'Pemecahan Bidang','Pengukuran dan Pemetaan','Active','1','2020-10-22','1','2020-10-23'),(3,'Pemisahan Bidang','Pengukuran dan Pemetaan','Active','1','2020-10-22',NULL,NULL),(4,'Penggabungan Bidang','Pengukuran dan Pemetaan','Active','1','2020-10-22',NULL,NULL),(5,'Pengakuan Hak','Pengukuran dan Pemetaan','Active','1','2020-10-22',NULL,NULL);

/*Table structure for table `ms_pegawai` */

DROP TABLE IF EXISTS `ms_pegawai`;

CREATE TABLE `ms_pegawai` (
  `id_pegawai` int(11) NOT NULL AUTO_INCREMENT,
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
  `updatedTime` date DEFAULT NULL,
  PRIMARY KEY (`id_pegawai`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

/*Data for the table `ms_pegawai` */

insert  into `ms_pegawai`(`id_pegawai`,`nip`,`nama_pegawai`,`alamat_pegawai`,`tempat_lahir_pegawai`,`tgl_lahir_pegawai`,`kelamin_pegawai`,`status_pegawai`,`id_satker`,`id_jabatan`,`createdBy`,`createdTime`,`updatedBy`,`updatedTime`) values (9,'910200107','Erza Fikry','Jl. Saturnus Utara II - Margahayu Raya','Jakarta','1989-01-02','Laki-laki','Active',3,57,NULL,NULL,'1','2020-10-23'),(12,'197808102003121004','Popie Hagy Gusmartin, S.T.','-','Surabaya','1978-08-10','Laki-laki','Active',3,19,'1','2020-10-22','1','2020-10-23'),(13,'198612222009121002','Muhammad Luthfi, S.T., M.Sc.','Antapani','Bandung','1986-12-22','Laki-laki','Active',3,20,'1','2020-10-22','1','2020-10-23'),(14,'196402011984031002','Dani Syamsul Purnama, A.Ptnh., M.H.','Jalan jurang','Bandung','1964-02-01','Laki-laki','Active',3,21,'1','2020-10-22',NULL,NULL),(15,'196801031994031006','Tommi Rahmadi','Komp. Griya Asri','Garut','1968-01-03','Laki-laki','Active',3,50,'1','2020-10-22',NULL,NULL),(16,'196906111991031010','Asep Tatang','Margahayu Raya','Sumedang','1969-06-11','Laki-laki','Active',3,50,'1','2020-10-22',NULL,NULL),(17,'196401201989031007','Undang Dedi Mulyadi','Jl. Riung Saluyu','Bandung','1964-01-20','Laki-laki','Active',3,50,'1','2020-10-22',NULL,NULL),(18,'196407111989031016','Windarsah','Jl. Cilacap','Bandung','1964-07-11','Laki-laki','Active',3,50,'1','2020-10-22',NULL,NULL),(19,'196409231989031004','Nenden Adi Harsana','Komplek Setra Dago Timur','Majalengka','1964-09-23','Laki-laki','Active',3,51,'1','2020-10-22',NULL,NULL),(20,'197107251995031001','Elan','Jl. Permai 23','Ciamis','1971-07-25','Laki-laki','Active',3,51,'1','2020-10-22',NULL,NULL),(21,'196904301995031002','Isa Alamsyah Undayat','Jl. Aria Timur','Bandung','1969-04-03','Laki-laki','Active',3,51,'1','2020-10-22',NULL,NULL),(22,'196503131993031003','Aceng Margakusumah','Jl. Pager Betis','Sumedang','1965-03-13','Laki-laki','Active',3,51,'1','2020-10-22',NULL,NULL),(23,'196409091989102001','Siti Balilah','Jl Podang','Bandung','1964-09-09','Perempuan','Active',3,51,'1','2020-10-22',NULL,NULL),(24,'199006272011011001','Hanggas Wirapradeksa S.Tr.','Margahayu Raya ','Purbalingga','1990-06-27','Laki-laki','Active',3,52,'1','2020-10-22',NULL,NULL),(25,'196912082014081001','Asep Muljana','Cilisung','Bandung','1969-12-18','Laki-laki','Active',3,53,'1','2020-10-22',NULL,NULL),(26,'196811012014081001','Dadang Suherman','JL. Lengkong Tengah I','Bandung','1968-11-01','Laki-laki','Active',3,51,'1','2020-10-22',NULL,NULL),(27,'197001152014081001','Deni Suryana','Jl. Nyengseret','Bandung','1970-01-15','Laki-laki','Active',3,53,'1','2020-10-22',NULL,NULL),(28,'910200130','Asep Abdul Kohar','Bandung','Bandung','2020-10-22','Laki-laki','Active',3,56,'1','2020-10-22',NULL,NULL),(29,'910200021','Arief HIdayat Sumpena','Bandung','Bandung','2020-10-22','Laki-laki','Active',3,56,'1','2020-10-22',NULL,NULL),(30,'910200156','Aprialdi Dwi Putra','Bandung','Bandung','2020-10-22','Laki-laki','Active',3,56,'1','2020-10-22',NULL,NULL),(31,'910200018','Ade Achmad Saputra','Bandung','Bandung','2020-10-22','Laki-laki','Active',3,56,'1','2020-10-22',NULL,NULL),(32,'910200053','Rivan Halen Satriani','Bandung','Bandung','2020-10-22','Laki-laki','Active',3,56,'1','2020-10-22',NULL,NULL),(33,'2020914','Asep Rudi Ruhimat','-','Bandung','2020-10-23','Laki-laki','Active',3,54,'1','2020-10-23',NULL,NULL),(34,'910200125','Arif Rahman Hakim','-','Bandung','2020-11-03','Laki-laki','Active',3,56,'1','2020-11-03','1','2020-11-03');

/*Table structure for table `ms_pemohon` */

DROP TABLE IF EXISTS `ms_pemohon`;

CREATE TABLE `ms_pemohon` (
  `id_pemohon` int(4) NOT NULL AUTO_INCREMENT,
  `nik_pemohon` varchar(25) NOT NULL,
  `nama_pemohon` varchar(50) NOT NULL,
  `alamat_pemohon` text NOT NULL,
  `telp_pemohon` varchar(25) NOT NULL,
  `keterangan_pemohon` text,
  `status_pemohon` enum('Active','Non Active') NOT NULL,
  `createdBy` varchar(250) DEFAULT NULL,
  `createdTime` date DEFAULT NULL,
  `updatedBy` varchar(250) DEFAULT NULL,
  `updatedTime` date DEFAULT NULL,
  PRIMARY KEY (`id_pemohon`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `ms_pemohon` */

insert  into `ms_pemohon`(`id_pemohon`,`nik_pemohon`,`nama_pemohon`,`alamat_pemohon`,`telp_pemohon`,`keterangan_pemohon`,`status_pemohon`,`createdBy`,`createdTime`,`updatedBy`,`updatedTime`) values (2,'1','isi Nama Pemohon','isi Alamat Pemohon','081220081918','isi Keterangan pemohon','Active','1','2020-10-22','1','2020-10-23'),(3,'2','Diana Lestari','Bandung','0','-','Active','1','2020-10-22','1','2020-10-23'),(4,'3','Tifa Helissa','-','1','-','Active','1','2020-10-22','1','2020-10-23'),(6,'3273230201890015','Erza','Margahayu Raya','081220081918','tes','Active','1','2020-10-23','1','2020-10-23'),(7,'123456','Saya Pemohon','alamat saya','0','-','Active','1','2020-10-26',NULL,NULL),(8,'3273050301900001','Patrick Wijaya','Jl.H.Durasid No.08','08','-','Active','33','2020-11-03',NULL,NULL);

/*Table structure for table `ms_provinsi` */

DROP TABLE IF EXISTS `ms_provinsi`;

CREATE TABLE `ms_provinsi` (
  `id_provinsi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_provinsi` varchar(100) NOT NULL,
  `keterangan_provinsi` text,
  `createdBy` varchar(250) NOT NULL,
  `createdTime` date DEFAULT NULL,
  `updatedBy` varchar(250) DEFAULT NULL,
  `updatedTime` date DEFAULT NULL,
  PRIMARY KEY (`id_provinsi`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `ms_provinsi` */

insert  into `ms_provinsi`(`id_provinsi`,`nama_provinsi`,`keterangan_provinsi`,`createdBy`,`createdTime`,`updatedBy`,`updatedTime`) values (1,'Jawa Barat','-','Active',NULL,'1','2020-10-20');

/*Table structure for table `ms_satker` */

DROP TABLE IF EXISTS `ms_satker`;

CREATE TABLE `ms_satker` (
  `id_satker` int(11) NOT NULL AUTO_INCREMENT,
  `nama_satker` varchar(250) NOT NULL,
  `keterangan_satker` varchar(250) DEFAULT NULL,
  `createdBy` varchar(250) DEFAULT NULL,
  `createdTime` date DEFAULT NULL,
  `updatedBy` varchar(250) DEFAULT NULL,
  `updatedTime` date DEFAULT NULL,
  PRIMARY KEY (`id_satker`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `ms_satker` */

insert  into `ms_satker`(`id_satker`,`nama_satker`,`keterangan_satker`,`createdBy`,`createdTime`,`updatedBy`,`updatedTime`) values (3,'Seksi Infrastruktur Pertanahan','IP',NULL,NULL,'1','2020-10-21'),(4,'Seksi Hubungan Hukum Pertanahan','tesss','1','2020-10-28','1','2020-10-28');

/*Table structure for table `ms_seksi` */

DROP TABLE IF EXISTS `ms_seksi`;

CREATE TABLE `ms_seksi` (
  `nama_seksi` varchar(100) NOT NULL,
  `moto_seksi` varchar(100) NOT NULL,
  `alamat_seksi` text NOT NULL,
  `telp_seksi` varchar(50) NOT NULL,
  `email_seksi` varchar(50) NOT NULL,
  `keterangan_seksi` text NOT NULL,
  `website_seksi` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `ms_seksi` */

insert  into `ms_seksi`(`nama_seksi`,`moto_seksi`,`alamat_seksi`,`telp_seksi`,`email_seksi`,`keterangan_seksi`,`website_seksi`) values ('Seksi Infrastruktur Pertanahan','-','Jl. Soekarno Hatta No.586 - Bandung','081220081918','erzafikry@gmail.com','Seksi Infrastruktur Pertanahan','-');

/*Table structure for table `ms_status_berkas` */

DROP TABLE IF EXISTS `ms_status_berkas`;

CREATE TABLE `ms_status_berkas` (
  `id_status_berkas` int(11) NOT NULL AUTO_INCREMENT,
  `status_berkas` varchar(25) NOT NULL,
  `keterangan_status_berkas` text NOT NULL,
  `createdBy` varchar(250) DEFAULT NULL,
  `createdTime` date DEFAULT NULL,
  `updatedBy` varchar(250) DEFAULT NULL,
  `updatedTime` date DEFAULT NULL,
  PRIMARY KEY (`id_status_berkas`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `ms_status_berkas` */

insert  into `ms_status_berkas`(`id_status_berkas`,`status_berkas`,`keterangan_status_berkas`,`createdBy`,`createdTime`,`updatedBy`,`updatedTime`) values (1,'Proses','',NULL,NULL,NULL,NULL),(2,'Selesai','',NULL,NULL,NULL,NULL),(3,'Batal','',NULL,NULL,NULL,NULL);

/*Table structure for table `ms_surtug` */

DROP TABLE IF EXISTS `ms_surtug`;

CREATE TABLE `ms_surtug` (
  `id_surtug` int(11) NOT NULL AUTO_INCREMENT,
  `no_surtug` varchar(25) NOT NULL,
  `tgl_mulai_surtug` date NOT NULL,
  `tgl_terbit_surtug` date NOT NULL,
  `keterangan_surtug` text NOT NULL,
  `id_berkas` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `createdBy` varchar(250) DEFAULT NULL,
  `createdTime` date DEFAULT NULL,
  `updatedBy` varchar(250) DEFAULT NULL,
  `updatedTime` date DEFAULT NULL,
  PRIMARY KEY (`id_surtug`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `ms_surtug` */

/*Table structure for table `ms_user` */

DROP TABLE IF EXISTS `ms_user`;

CREATE TABLE `ms_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username_user` varchar(50) NOT NULL,
  `password_user` varchar(150) NOT NULL,
  `status_user` enum('Active','Non Active') NOT NULL,
  `user_group` int(3) NOT NULL,
  `default_user` enum('Y','N') NOT NULL DEFAULT 'N',
  `id_pegawai` int(11) NOT NULL,
  `createdBy` varchar(250) DEFAULT NULL,
  `createdTime` date DEFAULT NULL,
  `updatedBy` varchar(250) DEFAULT NULL,
  `updatedTime` date DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `ms_user` */

insert  into `ms_user`(`id_user`,`username_user`,`password_user`,`status_user`,`user_group`,`default_user`,`id_pegawai`,`createdBy`,`createdTime`,`updatedBy`,`updatedTime`) values (1,'erzafikry','0cc175b9c0f1b6a831c399e269772661','Active',1,'N',9,NULL,NULL,'1','2020-10-20'),(23,'198612222009121002','0cc175b9c0f1b6a831c399e269772661','Active',9,'N',13,'1','2020-10-22','1','2020-10-22'),(22,'197808102003121004','0cc175b9c0f1b6a831c399e269772661','Active',10,'N',12,'1','2020-10-22','1','2020-10-22'),(24,'196402011984031002','0cc175b9c0f1b6a831c399e269772661','Active',9,'N',14,'1','2020-10-22','1','2020-10-22'),(25,'910200156','0cc175b9c0f1b6a831c399e269772661','Active',8,'N',30,'1','2020-10-22','1','2020-10-22'),(26,'196912082014081001','7fc56270e7a70fa81a5935b72eacbe29','Active',11,'N',25,'1','2020-10-22',NULL,NULL),(27,'910200130','7fc56270e7a70fa81a5935b72eacbe29','Active',12,'N',28,'1','2020-10-22',NULL,NULL),(28,'910200053','0cc175b9c0f1b6a831c399e269772661','Active',13,'N',32,'1','2020-10-22',NULL,NULL),(29,'196904301995031002','0cc175b9c0f1b6a831c399e269772661','Active',14,'N',21,'1','2020-10-22',NULL,NULL),(30,'196906111991031010','0cc175b9c0f1b6a831c399e269772661','Active',15,'N',16,'1','2020-10-22',NULL,NULL),(31,'199006272011011001','0cc175b9c0f1b6a831c399e269772661','Active',14,'N',24,'1','2020-10-22',NULL,NULL),(32,'2020914','0cc175b9c0f1b6a831c399e269772661','Active',11,'N',33,'1','2020-10-23',NULL,NULL),(33,'910200125','0cc175b9c0f1b6a831c399e269772661','Active',8,'N',34,'1','2020-11-03','1','2020-11-03'),(34,'910200021','0cc175b9c0f1b6a831c399e269772661','Active',12,'N',29,'1','2020-11-03',NULL,NULL);

/*Table structure for table `sys_akses` */

DROP TABLE IF EXISTS `sys_akses`;

CREATE TABLE `sys_akses` (
  `akses_id` int(4) NOT NULL AUTO_INCREMENT,
  `akses_group` int(3) NOT NULL,
  `akses_submenu` int(3) NOT NULL,
  `akses_dibuat` datetime NOT NULL,
  `akses_diubah` datetime NOT NULL,
  PRIMARY KEY (`akses_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=563 DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;

/*Data for the table `sys_akses` */

insert  into `sys_akses`(`akses_id`,`akses_group`,`akses_submenu`,`akses_dibuat`,`akses_diubah`) values (5,0,0,'2017-11-27 00:00:00','0000-00-00 00:00:00'),(6,0,0,'2017-11-27 00:00:00','0000-00-00 00:00:00'),(7,0,0,'2017-11-27 00:00:00','0000-00-00 00:00:00'),(8,0,0,'2017-11-27 00:00:00','0000-00-00 00:00:00'),(9,0,0,'2017-11-27 00:00:00','0000-00-00 00:00:00'),(10,0,0,'2017-11-27 00:00:00','0000-00-00 00:00:00'),(215,4,17,'2020-04-18 00:00:00','0000-00-00 00:00:00'),(540,1,14,'2020-11-03 00:00:00','0000-00-00 00:00:00'),(539,1,28,'2020-11-03 00:00:00','0000-00-00 00:00:00'),(538,1,34,'2020-11-03 00:00:00','0000-00-00 00:00:00'),(537,1,11,'2020-11-03 00:00:00','0000-00-00 00:00:00'),(536,1,32,'2020-11-03 00:00:00','0000-00-00 00:00:00'),(535,1,31,'2020-11-03 00:00:00','0000-00-00 00:00:00'),(534,1,8,'2020-11-03 00:00:00','0000-00-00 00:00:00'),(533,1,7,'2020-11-03 00:00:00','0000-00-00 00:00:00'),(532,1,33,'2020-11-03 00:00:00','0000-00-00 00:00:00'),(531,1,30,'2020-11-03 00:00:00','0000-00-00 00:00:00'),(530,1,29,'2020-11-03 00:00:00','0000-00-00 00:00:00'),(252,3,23,'2020-04-18 00:00:00','0000-00-00 00:00:00'),(251,3,17,'2020-04-18 00:00:00','0000-00-00 00:00:00'),(250,3,15,'2020-04-18 00:00:00','0000-00-00 00:00:00'),(529,1,6,'2020-11-03 00:00:00','0000-00-00 00:00:00'),(214,4,11,'2020-04-18 00:00:00','0000-00-00 00:00:00'),(528,1,5,'2020-11-03 00:00:00','0000-00-00 00:00:00'),(311,2,15,'2020-10-19 00:00:00','0000-00-00 00:00:00'),(249,3,14,'2020-04-18 00:00:00','0000-00-00 00:00:00'),(248,3,26,'2020-04-18 00:00:00','0000-00-00 00:00:00'),(247,3,27,'2020-04-18 00:00:00','0000-00-00 00:00:00'),(246,3,12,'2020-04-18 00:00:00','0000-00-00 00:00:00'),(245,3,11,'2020-04-18 00:00:00','0000-00-00 00:00:00'),(244,3,8,'2020-04-18 00:00:00','0000-00-00 00:00:00'),(243,3,7,'2020-04-18 00:00:00','0000-00-00 00:00:00'),(216,4,23,'2020-04-18 00:00:00','0000-00-00 00:00:00'),(242,3,6,'2020-04-18 00:00:00','0000-00-00 00:00:00'),(241,3,5,'2020-04-18 00:00:00','0000-00-00 00:00:00'),(240,3,13,'2020-04-18 00:00:00','0000-00-00 00:00:00'),(310,2,14,'2020-10-19 00:00:00','0000-00-00 00:00:00'),(309,2,28,'2020-10-19 00:00:00','0000-00-00 00:00:00'),(308,2,11,'2020-10-19 00:00:00','0000-00-00 00:00:00'),(253,3,25,'2020-04-18 00:00:00','0000-00-00 00:00:00'),(307,2,6,'2020-10-19 00:00:00','0000-00-00 00:00:00'),(431,7,14,'2020-10-21 00:00:00','0000-00-00 00:00:00'),(430,7,28,'2020-10-21 00:00:00','0000-00-00 00:00:00'),(377,6,11,'2020-10-20 00:00:00','0000-00-00 00:00:00'),(429,7,11,'2020-10-21 00:00:00','0000-00-00 00:00:00'),(527,1,4,'2020-11-03 00:00:00','0000-00-00 00:00:00'),(526,1,3,'2020-11-03 00:00:00','0000-00-00 00:00:00'),(525,1,2,'2020-11-03 00:00:00','0000-00-00 00:00:00'),(432,7,15,'2020-10-21 00:00:00','0000-00-00 00:00:00'),(560,8,28,'2020-11-03 00:00:00','0000-00-00 00:00:00'),(559,8,11,'2020-11-03 00:00:00','0000-00-00 00:00:00'),(558,8,8,'2020-11-03 00:00:00','0000-00-00 00:00:00'),(557,8,7,'2020-11-03 00:00:00','0000-00-00 00:00:00'),(556,8,33,'2020-11-03 00:00:00','0000-00-00 00:00:00'),(555,8,6,'2020-11-03 00:00:00','0000-00-00 00:00:00'),(554,8,5,'2020-11-03 00:00:00','0000-00-00 00:00:00'),(545,9,14,'2020-11-03 00:00:00','0000-00-00 00:00:00'),(544,9,28,'2020-11-03 00:00:00','0000-00-00 00:00:00'),(543,9,34,'2020-11-03 00:00:00','0000-00-00 00:00:00'),(486,10,14,'2020-10-22 00:00:00','0000-00-00 00:00:00'),(485,10,28,'2020-10-22 00:00:00','0000-00-00 00:00:00'),(484,10,11,'2020-10-22 00:00:00','0000-00-00 00:00:00'),(542,9,11,'2020-11-03 00:00:00','0000-00-00 00:00:00'),(487,10,15,'2020-10-22 00:00:00','0000-00-00 00:00:00'),(488,11,11,'2020-10-22 00:00:00','0000-00-00 00:00:00'),(489,12,11,'2020-10-22 00:00:00','0000-00-00 00:00:00'),(490,13,11,'2020-10-22 00:00:00','0000-00-00 00:00:00'),(491,14,11,'2020-10-22 00:00:00','0000-00-00 00:00:00'),(492,15,11,'2020-10-22 00:00:00','0000-00-00 00:00:00'),(541,1,15,'2020-11-03 00:00:00','0000-00-00 00:00:00'),(546,9,15,'2020-11-03 00:00:00','0000-00-00 00:00:00'),(561,8,14,'2020-11-03 00:00:00','0000-00-00 00:00:00'),(562,8,15,'2020-11-03 00:00:00','0000-00-00 00:00:00');

/*Table structure for table `sys_group` */

DROP TABLE IF EXISTS `sys_group`;

CREATE TABLE `sys_group` (
  `group_id` int(3) NOT NULL AUTO_INCREMENT,
  `group_nama` varchar(35) NOT NULL,
  `group_keterangan` text NOT NULL,
  `group_status` enum('Active','Non Active') NOT NULL,
  PRIMARY KEY (`group_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `sys_group` */

insert  into `sys_group`(`group_id`,`group_nama`,`group_keterangan`,`group_status`) values (1,'Superadmin','superadmin','Active'),(13,'Petugas Textual','PT','Active'),(12,'Petugas Grafis','PG','Active'),(11,'Petugas Ukur','PU','Active'),(10,'Kasie','Kepala Seksi','Active'),(9,'Kasubsie','Kepala Subseksi','Active'),(8,'Administrator','Admin','Active'),(14,'Kordinator Pemetaan','Kordi Pemetaan','Active'),(15,'Kordinator Pengukuran','Kordi Pengukuran','Active');

/*Table structure for table `sys_menu` */

DROP TABLE IF EXISTS `sys_menu`;

CREATE TABLE `sys_menu` (
  `menu_id` int(3) NOT NULL AUTO_INCREMENT,
  `menu_nama` varchar(40) NOT NULL,
  `menu_icon` varchar(50) NOT NULL,
  `menu_urutan` int(2) NOT NULL,
  `menu_dibuat` datetime NOT NULL,
  `menu_diubah` datetime NOT NULL,
  PRIMARY KEY (`menu_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `sys_menu` */

insert  into `sys_menu`(`menu_id`,`menu_nama`,`menu_icon`,`menu_urutan`,`menu_dibuat`,`menu_diubah`) values (1,'Pengaturan','icon-settings',1,'2017-11-26 00:00:00','2017-11-26 00:00:00'),(2,'Master Data','icon-wallet',2,'2017-11-26 00:00:00','2017-11-26 00:00:00'),(3,'Master Wilayah','icon-folder',3,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,'Berkas','icon-folder',4,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(5,'Dokumen','icon-folder',5,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(6,'Laporan','icon-pie-chart',6,'0000-00-00 00:00:00','0000-00-00 00:00:00');

/*Table structure for table `sys_submenu` */

DROP TABLE IF EXISTS `sys_submenu`;

CREATE TABLE `sys_submenu` (
  `submenu_id` int(3) NOT NULL AUTO_INCREMENT,
  `submenu_nama` varchar(50) NOT NULL,
  `submenu_menu` int(3) NOT NULL,
  `submenu_link` varchar(100) NOT NULL,
  `submenu_urutan` int(3) NOT NULL,
  `submenu_dibuat` datetime NOT NULL,
  `submenu_diubah` datetime NOT NULL,
  PRIMARY KEY (`submenu_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `sys_submenu` */

insert  into `sys_submenu`(`submenu_id`,`submenu_nama`,`submenu_menu`,`submenu_link`,`submenu_urutan`,`submenu_dibuat`,`submenu_diubah`) values (2,'Data User',1,'?page=datauser',3,'2017-11-26 00:00:00','2020-10-22 00:00:00'),(3,'Data Menu & Modul',1,'?page=datamodul',4,'2017-11-26 00:00:00','2020-03-12 00:00:00'),(4,'Level Group Akses',1,'?page=datagroup',2,'2017-11-26 00:00:00','2020-10-22 00:00:00'),(5,'Data Pegawai',2,'?page=datapegawai',3,'2017-11-26 00:00:00','2020-10-20 00:00:00'),(6,'Data Pemohon',2,'?page=datapemohon',4,'2017-11-26 00:00:00','2020-10-20 00:00:00'),(7,'Data Kecamatan',3,'?page=datakec',3,'2017-11-26 00:00:00','2020-10-20 00:00:00'),(8,'Data Kelurahan',3,'?page=datakel',4,'2017-12-24 00:00:00','2020-10-20 00:00:00'),(11,'Daftar Berkas',4,'?page=databerkas',1,'2017-12-24 00:00:00','2020-10-22 00:00:00'),(13,'Pengaturan Seksi',1,'?page=confseksi',1,'2017-12-24 00:00:00','0000-00-00 00:00:00'),(14,'Berkas Masuk',6,'?page=lapberkas',1,'2017-12-29 00:00:00','2020-10-20 00:00:00'),(15,'Daftar Pemohon',6,'?page=lappemohon',2,'2017-12-29 00:00:00','2020-10-21 00:00:00'),(28,'Surat Tugas',5,'?page=datasurtug',1,'0000-00-00 00:00:00','2020-10-22 00:00:00'),(29,'Data Jabatan',2,'?page=datajab',2,'2020-10-19 00:00:00','2020-10-20 00:00:00'),(30,'Data Satker',2,'?page=datasatker',1,'2020-10-19 00:00:00','2020-10-20 00:00:00'),(31,'Data Provinsi',3,'?page=dataprov',1,'2020-10-20 00:00:00','2020-10-20 00:00:00'),(32,'Data Kota',3,'?page=datakot',2,'2020-10-20 00:00:00','0000-00-00 00:00:00'),(33,'Data Layanan',2,'?page=datalay',5,'2020-10-21 00:00:00','0000-00-00 00:00:00'),(34,'Berkas Masuk',4,'?page=berkasmasuk',2,'2020-11-03 00:00:00','0000-00-00 00:00:00');

/*Table structure for table `trx_surtug` */

DROP TABLE IF EXISTS `trx_surtug`;

CREATE TABLE `trx_surtug` (
  `id_trx_surtug` int(11) NOT NULL AUTO_INCREMENT,
  `id_surtug` int(11) DEFAULT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `tgl_kirim` date DEFAULT NULL,
  `catatan` varchar(250) DEFAULT NULL,
  `createdBy` varchar(250) DEFAULT NULL,
  `createdTime` date DEFAULT NULL,
  `updatedBy` varchar(250) DEFAULT NULL,
  `updatedTime` date DEFAULT NULL,
  PRIMARY KEY (`id_trx_surtug`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `trx_surtug` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
