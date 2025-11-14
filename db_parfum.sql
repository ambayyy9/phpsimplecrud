/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 8.0.30 : Database - db_parfum
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_parfum` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `db_parfum`;

/*Table structure for table `tb_aroma` */

DROP TABLE IF EXISTS `tb_aroma`;

CREATE TABLE `tb_aroma` (
  `id_aroma` int NOT NULL AUTO_INCREMENT,
  `nama_aroma` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id_aroma`),
  UNIQUE KEY `nama_aroma` (`nama_aroma`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tb_aroma` */

insert  into `tb_aroma`(`id_aroma`,`nama_aroma`) values 
(6,'aquatic'),
(7,'citrus'),
(1,'floral'),
(8,'fruity'),
(2,'oriental'),
(10,'woody');

/*Table structure for table `tb_jenis` */

DROP TABLE IF EXISTS `tb_jenis`;

CREATE TABLE `tb_jenis` (
  `id_jenis` int NOT NULL AUTO_INCREMENT,
  `nama_jenis` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id_jenis`),
  UNIQUE KEY `nama_jenis` (`nama_jenis`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tb_jenis` */

insert  into `tb_jenis`(`id_jenis`,`nama_jenis`) values 
(3,'Eau de Cologne'),
(2,'Eau de Parfum'),
(9,'Eau De Toilette'),
(6,'Eau Fraiche'),
(10,'Extrait de Parfume');

/*Table structure for table `tb_parfum` */

DROP TABLE IF EXISTS `tb_parfum`;

CREATE TABLE `tb_parfum` (
  `id_parfum` int NOT NULL AUTO_INCREMENT,
  `kode_parfum` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nama_parfum` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_jenis` int DEFAULT NULL,
  `id_aroma` int DEFAULT NULL,
  `deskripsi` text,
  `harga` decimal(10,2) DEFAULT NULL,
  `stok` int DEFAULT NULL,
  PRIMARY KEY (`id_parfum`),
  UNIQUE KEY `kode_parfum` (`kode_parfum`),
  KEY `tb_parfum_ibfk_2` (`id_aroma`),
  KEY `tb_parfum_ibfk_1` (`id_jenis`),
  CONSTRAINT `tb_parfum_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `tb_jenis` (`id_jenis`) ON DELETE CASCADE,
  CONSTRAINT `tb_parfum_ibfk_2` FOREIGN KEY (`id_aroma`) REFERENCES `tb_aroma` (`id_aroma`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tb_parfum` */

insert  into `tb_parfum`(`id_parfum`,`kode_parfum`,`nama_parfum`,`id_jenis`,`id_aroma`,`deskripsi`,`harga`,`stok`) values 
(8,'PRF001','Amber',9,1,'manis wanginya ',1230000.00,3),
(13,'PRF002','Joyce Latte',10,8,'Perpaduan antar caramel dan latte ditambah dengan manis dari banana',65000.00,16),
(15,'PRF003','Keonholovely',10,6,'wanginya manis kayak ayang keonho',5634298.00,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
