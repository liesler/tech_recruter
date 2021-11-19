/*
SQLyog Community v13.1.5  (64 bit)
MySQL - 5.6.40 : Database - db_teste_backend
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_teste_backend` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_teste_backend`;

/*Table structure for table `abelhas` */

DROP TABLE IF EXISTS `abelhas`;

CREATE TABLE `abelhas` (
  `codabelha` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`codabelha`),
  KEY `nome` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `abelhas` */

LOCK TABLES `abelhas` WRITE;

insert  into `abelhas`(`codabelha`,`nome`) values 
(3,'Guarupu (Melipona bicolor)'),
(4,'IraÃ­ (Nannotrigona testaceicornes)'),
(1,'UruÃ§u (Melipona scutellaris)'),
(2,'UruÃ§u-Amarela (Melipona rufiventris)');

UNLOCK TABLES;

/*Table structure for table `plantas` */

DROP TABLE IF EXISTS `plantas`;

CREATE TABLE `plantas` (
  `codplanta` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `mes_floracao` char(2) NOT NULL,
  `codabelha` int(10) NOT NULL,
  PRIMARY KEY (`codplanta`),
  KEY `nome` (`nome`),
  KEY `mes_floracao` (`mes_floracao`),
  KEY `codabelha` (`codabelha`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `plantas` */

LOCK TABLES `plantas` WRITE;

insert  into `plantas`(`codplanta`,`nome`,`mes_floracao`,`codabelha`) values 
(1,'planta1','05',1);

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
