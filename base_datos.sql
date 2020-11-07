-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

CREATE DATABASE `db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db`;

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_cliente` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cedula` int NOT NULL,
  `perfil` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `clientes` (`id`, `nombre_cliente`, `cedula`, `perfil`, `correo`, `telefono`, `direccion`) VALUES
(1,	'Carlos Alberto Correa',	1233333,	'Profesor',	'carlos@sample.com',	'3217889087',	'Calle 123 # 55-55'),
(2,	'Maria Meneses',	12345,	'Empresaria',	'maria@sample.com',	'3102233',	'Cartagena'),
(3,	'Poncho Zuleta',	1036648559,	'Humorista',	'micorreo@coreo.com',	'2314433',	'Carrera 63D con calle 102'),
(4,	'Heriberto Sandoval',	12312312,	'Humorista',	'micorreo@coreo.com',	'2314433',	'Carrera 63D con calle 102');

DROP TABLE IF EXISTS `empresas`;
CREATE TABLE `empresas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nit` varchar(20) NOT NULL,
  `nombre_empresa` varchar(255) NOT NULL,
  `telefono_empresa` varchar(255) NOT NULL,
  `direccion_empresa` varchar(255) NOT NULL,
  `ciudad` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `empresas` (`id`, `nit`, `nombre_empresa`, `telefono_empresa`, `direccion_empresa`, `ciudad`) VALUES
(1,	'1231',	'Rappi',	'31254312',	'cra12',	'mede');

DROP TABLE IF EXISTS `estudios`;
CREATE TABLE `estudios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hojadevida` int NOT NULL,
  `nivel` enum('basico','secundario','complementario') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nombre_estudio` varchar(255) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hojadevida` (`hojadevida`),
  CONSTRAINT `estudios_ibfk_1` FOREIGN KEY (`hojadevida`) REFERENCES `hojasdevida` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `estudios` (`id`, `hojadevida`, `nivel`, `nombre_estudio`, `fecha_inicio`, `fecha_fin`) VALUES
(37,	2,	'basico',	'asda',	'2020-11-03',	'2020-11-10'),
(38,	2,	'basico',	'asda',	'2020-11-03',	'2020-11-10'),
(40,	1,	'basico',	'hola',	'2020-11-11',	'2020-11-09');

DROP TABLE IF EXISTS `hojasdevida`;
CREATE TABLE `hojasdevida` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cliente` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente` (`cliente`),
  CONSTRAINT `hojasdevida_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `hojasdevida` (`id`, `cliente`) VALUES
(1,	1),
(2,	1),
(3,	1);

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `empresa` int DEFAULT NULL,
  `cliente` int DEFAULT NULL,
  `id` smallint NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `clave` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente` (`cliente`),
  KEY `empresa` (`empresa`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `clientes` (`id`) ON DELETE SET NULL,
  CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`empresa`) REFERENCES `empresas` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `usuarios` (`empresa`, `cliente`, `id`, `nombre_usuario`, `clave`) VALUES
(1,	1,	1,	'ramiro',	'12345'),
(NULL,	2,	2,	'carlos',	'1234');

DROP TABLE IF EXISTS `vacantes`;
CREATE TABLE `vacantes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `empresa` int NOT NULL,
  `perfil` varchar(255) NOT NULL,
  `fecha_apertura` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `empresa` (`empresa`),
  CONSTRAINT `vacantes_ibfk_1` FOREIGN KEY (`empresa`) REFERENCES `empresas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `vacantes` (`id`, `empresa`, `perfil`, `fecha_apertura`) VALUES
(2,	1,	'Domiciliario',	'2020-11-06'),
(3,	1,	'Domiciliario con Moto',	'2020-11-06');

-- 2020-11-07 03:07:50
