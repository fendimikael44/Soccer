/*
SQLyog Enterprise - MySQL GUI v8.05 
MySQL - 5.6.26 : Database - futsal
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`futsal` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `futsal`;

/*Table structure for table `t_arena_futsal` */

DROP TABLE IF EXISTS `t_arena_futsal`;

CREATE TABLE `t_arena_futsal` (
  `id_arena` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(15) NOT NULL,
  `id_owner` int(11) NOT NULL,
  `jam_operational` varchar(11) NOT NULL,
  `info` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id_arena`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `t_arena_futsal` */

insert  into `t_arena_futsal`(`id_arena`,`nama`,`alamat`,`telp`,`id_owner`,`jam_operational`,`info`,`status`) values (1,'Bandengan Sport','Jl. Bandengan Raya\r\n','021988722',4,'08:00-23:00','Lapangan Futsal',1),(2,'Orion','Jl. Bandengan Raya','021987633',5,'09:00-22:00','Lapangan Futsal',1),(3,'Plaza Futsal','Jl. Tubagus Angke','021676553',6,'07:00-19:00','Lapangan Futsal',1);

/*Table structure for table `t_booking` */

DROP TABLE IF EXISTS `t_booking`;

CREATE TABLE `t_booking` (
  `id_booking` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_create` datetime NOT NULL,
  `id_lapangan` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `tanggal_booking` datetime NOT NULL,
  `durasi` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_booking`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `t_booking` */

insert  into `t_booking`(`id_booking`,`tanggal_create`,`id_lapangan`,`id_customer`,`tanggal_booking`,`durasi`,`status`) values (5,'2018-08-13 10:23:49',1,1,'2018-08-13 12:00:00',120,1),(6,'2018-08-14 10:52:37',3,2,'2018-08-14 14:00:00',240,1);

/*Table structure for table `t_lapangan` */

DROP TABLE IF EXISTS `t_lapangan`;

CREATE TABLE `t_lapangan` (
  `id_lapangan` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `id_arena` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id_lapangan`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `t_lapangan` */

insert  into `t_lapangan`(`id_lapangan`,`nama`,`id_arena`,`harga`,`foto`,`deskripsi`,`status`) values (1,'Lapangan 1',1,200000,'images/lapangan/lapangan_1.jpg','Lapangan Kecil',1),(2,'Lapangan 2',1,250000,'images/lapangan/lapangan_2.jpg','Lapangan Besar',1),(3,'Lapangan A',2,178000,'images/lapangan/lapangan_3.jpg','test',1),(4,'Lapangan B',2,220000,'images/lapangan/lapangan_4.jpg','',1),(5,'LP 1',3,230000,'images/lapangan/lapangan_5.jpg','',1),(6,'LP2',3,200000,'images/lapangan/lapangan_6.jpg','',1);

/*Table structure for table `t_pembayaran` */

DROP TABLE IF EXISTS `t_pembayaran`;

CREATE TABLE `t_pembayaran` (
  `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT,
  `id_booking` int(11) NOT NULL,
  `tanggal_bayar` datetime NOT NULL,
  `atas_nama` varchar(100) NOT NULL,
  `bank` varchar(30) NOT NULL,
  `no_rek` varchar(15) NOT NULL,
  `foto_upload` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_pembayaran`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `t_pembayaran` */

insert  into `t_pembayaran`(`id_pembayaran`,`id_booking`,`tanggal_bayar`,`atas_nama`,`bank`,`no_rek`,`foto_upload`,`status`) values (4,5,'2018-08-13 13:27:50','5','vdcsa','13221321','images/pembayaran/pembayaran_5.jpg',1),(5,6,'2018-08-14 11:23:01','6','BCA','5555555','images/pembayaran/pembayaran_6.jpg',1);

/*Table structure for table `t_promo` */

DROP TABLE IF EXISTS `t_promo`;

CREATE TABLE `t_promo` (
  `id_promo` int(11) NOT NULL AUTO_INCREMENT,
  `id_arena` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal_created` datetime NOT NULL,
  `periode_awal` date NOT NULL,
  `periode_akhir` date NOT NULL,
  `diskon` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_promo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `t_promo` */

insert  into `t_promo`(`id_promo`,`id_arena`,`judul`,`deskripsi`,`tanggal_created`,`periode_awal`,`periode_akhir`,`diskon`,`status`) values (1,1,'Promo 1','Vestibulum malesuada nisi sit amet justo ullamcorper, non convallis justo consequat Integer et urna bibendum elit accumsan interdum.\r\n\r\n','2018-02-20 00:00:00','2018-03-15','2018-03-20',0,1),(2,2,'Promo 2','Vestibulum malesuada nisi sit amet justo ullamcorper, non convallis justo consequat Integer et urna bibendum elit accumsan interdum.','2018-02-20 00:00:00','2018-03-15','2018-03-21',0,0),(3,2,'Promo 3','Ini adalah deskripsi atau keterangan dari promo 3','2018-02-20 00:00:00','2018-03-16','2018-03-18',10,1),(4,3,'Promo 4','Vestibulum malesuada nisi sit amet justo ullamcorper, non convallis justo consequat Integer et urna bibendum elit accumsan interdum.','2018-02-20 00:00:00','2018-03-16','2018-03-26',0,0),(5,3,'adfadsfasdfasdfa','sdfasdfasdfsfwerwrqrqdfkasldfadksfkasdk\r\nfjksdjfkjsdfksdmsacx,czm,cmz,xmc,z,xcm,zmsdfasdf','2018-03-15 15:11:02','2018-03-17','2018-03-19',0,0),(6,3,'cccvcvcvcv','asfaewrwrasdfasdfxzcvcxzvzxvsdfafewrrqawrar','2018-03-15 15:11:40','2018-03-22','2018-03-23',0,0),(7,3,'cccvcvcvcv','asfaewrwrasdfasdfxzcvcxzvzxvsdfafewrrqawrar','2018-03-15 15:11:44','2018-03-22','2018-03-23',0,0),(8,3,'cccvcvcvcv','asfaewrwrasdfasdfxzcvcxzvzxvsdfafewrrqawrar','2018-03-15 15:11:45','2018-03-22','2018-03-23',0,0),(9,3,'cccvcvcvcv','asfaewrwrasdfasdfxzcvcxzvzxvsdfafewrrqawrar','2018-03-15 15:11:46','2018-03-22','2018-03-23',0,0);

/*Table structure for table `t_role` */

DROP TABLE IF EXISTS `t_role`;

CREATE TABLE `t_role` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(15) NOT NULL,
  `deskripsi` text NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `t_role` */

insert  into `t_role`(`id_role`,`role`,`deskripsi`) values (1,'Admin','Administrator\r\n'),(2,'Owner','Pemilik Arena Futsal'),(3,'Customer','Customer\r\n');

/*Table structure for table `t_user` */

DROP TABLE IF EXISTS `t_user`;

CREATE TABLE `t_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `role` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `t_user` */

insert  into `t_user`(`id_user`,`nama`,`telp`,`role`,`status`) values (1,'Agus Toni','08126533728',3,1),(2,'Hadrianus Rio','021887629222',3,1),(3,'Susanto Raya','087899887654',3,1),(4,'Martin Aditya','098272626512',2,1),(5,'Sandi','098626553212',2,1),(6,'Edi','098276121331',2,1),(7,'Super Admin','',1,1);

/*Table structure for table `t_user_login` */

DROP TABLE IF EXISTS `t_user_login`;

CREATE TABLE `t_user_login` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_user_login` */

insert  into `t_user_login`(`id_user`,`username`,`password`) values (1,'agus@gmail.com','e10adc3949ba59abbe56e057f20f883e'),(2,'rio@gmail.com','e10adc3949ba59abbe56e057f20f883e'),(3,'santo@gmail.com','e10adc3949ba59abbe56e057f20f883e'),(4,'futsal1','e10adc3949ba59abbe56e057f20f883e'),(5,'futsal2','e10adc3949ba59abbe56e057f20f883e'),(6,'futsal3','e10adc3949ba59abbe56e057f20f883e'),(7,'admin','e10adc3949ba59abbe56e057f20f883e');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
