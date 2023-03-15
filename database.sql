/*Table structure for table `dosen` */

DROP TABLE IF EXISTS `dosen`;

CREATE TABLE `dosen` (
  `id_dosen` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `nidn_dosen` varchar(255) DEFAULT NULL,
  `nm_dosen` varchar(255) DEFAULT NULL,
  `id_fakultas` int(11) DEFAULT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_dosen`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `dosen` */

insert  into `dosen`(`id_dosen`,`id_user`,`nidn_dosen`,`nm_dosen`,`id_fakultas`,`no_telp`) values 
(1,2,'2222222','Okta Veza',2,'111111');

/*Table structure for table `fakultas` */

DROP TABLE IF EXISTS `fakultas`;

CREATE TABLE `fakultas` (
  `id_fakultas` int(11) NOT NULL AUTO_INCREMENT,
  `nm_fakultas` varchar(255) DEFAULT NULL,
  `form_fakultas` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_fakultas`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `fakultas` */

insert  into `fakultas`(`id_fakultas`,`nm_fakultas`,`form_fakultas`) values 
(1,'Teknik','FT-UIS'),
(2,'Kesehatan','FK-UIS'),
(3,'Ekonomi & Bisnis','FEB-UIS');

/*Table structure for table `judul` */

DROP TABLE IF EXISTS `judul`;

CREATE TABLE `judul` (
  `id_judul` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengajuan` int(11) DEFAULT NULL,
  `nm_judul` varchar(255) DEFAULT NULL,
  `nm_perusahaan` varchar(255) DEFAULT NULL,
  `id_pimpinan` int(11) DEFAULT NULL,
  `latar_belakang` text,
  `gambaran_judul` text,
  `kelebihan_judul` text,
  PRIMARY KEY (`id_judul`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `judul` */

/*Table structure for table `jurnal` */

DROP TABLE IF EXISTS `jurnal`;

CREATE TABLE `jurnal` (
  `id_jurnal` int(11) NOT NULL AUTO_INCREMENT,
  `id_judul` int(11) DEFAULT NULL,
  `file_jurnal` text,
  PRIMARY KEY (`id_jurnal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `jurnal` */

/*Table structure for table `konsentrasi` */

DROP TABLE IF EXISTS `konsentrasi`;

CREATE TABLE `konsentrasi` (
  `id_konsentrasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_prodi` int(11) DEFAULT NULL,
  `nm_konsentrasi` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_konsentrasi`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `konsentrasi` */

insert  into `konsentrasi`(`id_konsentrasi`,`id_prodi`,`nm_konsentrasi`) values 
(1,2,'Software Engineering'),
(2,2,'Networking'),
(3,2,'Multimedia');

/*Table structure for table `mahasiswa` */

DROP TABLE IF EXISTS `mahasiswa`;

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `nim_mahasiswa` varchar(255) DEFAULT NULL,
  `nm_mahasiswa` varchar(255) DEFAULT NULL,
  `email_mahasiswa` varchar(255) DEFAULT NULL,
  `id_prodi` int(11) DEFAULT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_mahasiswa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `mahasiswa` */

insert  into `mahasiswa`(`id_mahasiswa`,`id_user`,`nim_mahasiswa`,`nm_mahasiswa`,`email_mahasiswa`,`id_prodi`,`no_telp`) values 
(1,3,'1710128262272','Bakhrul Huda Soolihin','1710128262272@uis.ac.id',1,'081374684696');

/*Table structure for table `panduan` */

DROP TABLE IF EXISTS `panduan`;

CREATE TABLE `panduan` (
  `id_panduan` int(11) NOT NULL AUTO_INCREMENT,
  `nm_panduan` varchar(255) DEFAULT NULL,
  `file_panduan` text,
  PRIMARY KEY (`id_panduan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `panduan` */

insert  into `panduan`(`id_panduan`,`nm_panduan`,`file_panduan`) values 
(1,'Panduan Mahasiswa','041.pdf'),
(2,'Panduan Dosen','SURAT_PERNYATAAN_BELUM_BEKERJA.pdf');

/*Table structure for table `pengajuan` */

DROP TABLE IF EXISTS `pengajuan`;

CREATE TABLE `pengajuan` (
  `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT,
  `id_mahasiswa` int(11) DEFAULT NULL,
  `id_konsentrasi` int(11) DEFAULT NULL,
  `tgl_pengajuan` date DEFAULT NULL,
  `tgl_pengecekan` date DEFAULT NULL,
  `stt_pengajuan` enum('input','proses','terima','tolak') DEFAULT NULL,
  `ket_pengajuan` text,
  `id_judul` int(11) DEFAULT NULL,
  `nm_judul` varchar(255) DEFAULT NULL,
  `no_sk` varchar(255) DEFAULT NULL,
  `pemb_1` int(11) DEFAULT NULL,
  `pemb_2` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pengajuan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pengajuan` */

/*Table structure for table `pimpinan` */

DROP TABLE IF EXISTS `pimpinan`;

CREATE TABLE `pimpinan` (
  `id_pimpinan` int(11) NOT NULL AUTO_INCREMENT,
  `unsur_pimpinan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pimpinan`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `pimpinan` */

insert  into `pimpinan`(`id_pimpinan`,`unsur_pimpinan`) values 
(1,'Pimpinan'),
(2,'Manager'),
(3,'Direktur Utama'),
(4,'Kepala Sekolah'),
(5,'HRD'),
(6,'PSDM'),
(7,'Ketua'),
(8,'Rektor'),
(9,'Sekda'),
(10,'Kepala Bagian'),
(11,'Kepala Devisi'),
(12,'Kepala Cabang'),
(13,'Bagian Umum');

/*Table structure for table `prodi` */

DROP TABLE IF EXISTS `prodi`;

CREATE TABLE `prodi` (
  `id_prodi` int(11) NOT NULL AUTO_INCREMENT,
  `nm_prodi` varchar(255) DEFAULT NULL,
  `id_fakultas` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_prodi`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `prodi` */

insert  into `prodi`(`id_prodi`,`nm_prodi`,`id_fakultas`) values 
(1,'Teknik Informatika',1),
(2,'Teknik Industri',1);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nm_user` varchar(255) DEFAULT NULL,
  `foto_user` text,
  `akses` enum('dosen','admin','mahasiswa') DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id_user`,`username`,`password`,`nm_user`,`foto_user`,`akses`) values 
(1,'admin','admin','admin','789290_penguin_512x5121.png','admin'),
(2,'dosen','dosen',NULL,'279a5ef0333f1bac1b0be7983d193c6c.png','dosen'),
(3,'user','user',NULL,'istockphoto-1287426625-612x612.jpg','mahasiswa');