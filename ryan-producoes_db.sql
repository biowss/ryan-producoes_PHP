/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 10.4.14-MariaDB : Database - ryan-producoes_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ryan-producoes_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `ryan-producoes_db`;

/*Table structure for table `eventos` */

DROP TABLE IF EXISTS `eventos`;

CREATE TABLE `eventos` (
  `evento_id` int(11) NOT NULL AUTO_INCREMENT,
  `evento_titulo` varchar(150) NOT NULL,
  `evento_descricao` varchar(300) DEFAULT NULL,
  `evento_inicio` datetime NOT NULL,
  `evento_termino` datetime DEFAULT NULL,
  `evento_situacao` varchar(45) DEFAULT NULL,
  `fk_usuario` int(11) NOT NULL,
  PRIMARY KEY (`evento_id`),
  KEY `fk_usuario` (`fk_usuario`),
  CONSTRAINT `eventos_ibfk_2` FOREIGN KEY (`fk_usuario`) REFERENCES `usuarios` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

/*Data for the table `eventos` */

insert  into `eventos`(`evento_id`,`evento_titulo`,`evento_descricao`,`evento_inicio`,`evento_termino`,`evento_situacao`,`fk_usuario`) values 
(1,'Villas Party','Festa em vilas para 45 pessoas, open bar e musica ao vivo','0000-00-00 00:00:00',NULL,'Aberto',4),
(9,'Bahia Café Hall','Evento do Bahia Café Hall','2020-11-30 02:24:00','2020-12-02 02:24:00','Aberto',4),
(11,'Gravação de CD - Anildo','Gravação de CD de Anildo','2020-11-01 11:05:00','2020-11-10 11:05:00','Finalizado',4),
(12,'Festa de Reveillon - Salvador','Festa para 150 pessoas, open bar, palco com apresentações','2019-12-31 13:00:00','2020-01-01 00:00:00','Finalizado',4);

/*Table structure for table `eventos_servicos` */

DROP TABLE IF EXISTS `eventos_servicos`;

CREATE TABLE `eventos_servicos` (
  `evento_id` int(11) NOT NULL,
  `servico_id` int(11) NOT NULL,
  KEY `evento_id` (`evento_id`),
  KEY `servico_id` (`servico_id`),
  CONSTRAINT `eventos_servicos_ibfk_1` FOREIGN KEY (`evento_id`) REFERENCES `eventos` (`evento_id`),
  CONSTRAINT `eventos_servicos_ibfk_2` FOREIGN KEY (`servico_id`) REFERENCES `servicos` (`servico_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `eventos_servicos` */

insert  into `eventos_servicos`(`evento_id`,`servico_id`) values 
(1,2),
(1,3),
(9,2),
(9,3),
(11,2),
(12,2),
(12,3);

/*Table structure for table `servicos` */

DROP TABLE IF EXISTS `servicos`;

CREATE TABLE `servicos` (
  `servico_id` int(11) NOT NULL AUTO_INCREMENT,
  `servico_titulo` varchar(150) NOT NULL,
  `servico_descricao` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`servico_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `servicos` */

insert  into `servicos`(`servico_id`,`servico_titulo`,`servico_descricao`) values 
(2,'Aluguel de Equipamentos','Serviço de aluguel de equipamentos para uso em eventos.'),
(3,'Prestação de serviços','Fornecimento de pessoal para eventos.'),
(4,'Gravação de CD','Gravação de CD e tratamento sonoro');

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_nome` varchar(150) NOT NULL,
  `usuario_senha` varchar(32) NOT NULL,
  `usuario_admin` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`usuario_id`),
  UNIQUE KEY `user` (`usuario_nome`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `usuarios` */

insert  into `usuarios`(`usuario_id`,`usuario_nome`,`usuario_senha`,`usuario_admin`) values 
(2,'admin@admin','admin',1),
(4,'cliente@cliente','cliente',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
