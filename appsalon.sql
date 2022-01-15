-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.33 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para appsalon_mvc
CREATE DATABASE IF NOT EXISTS `appsalon_mvc` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `appsalon_mvc`;

-- Volcando estructura para tabla appsalon_mvc.citas
CREATE TABLE IF NOT EXISTS `citas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `usuarioId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuarioId` (`usuarioId`),
  CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`usuarioId`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla appsalon_mvc.citas: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `citas` DISABLE KEYS */;
INSERT INTO `citas` (`id`, `fecha`, `hora`, `usuarioId`) VALUES
	(1, '2021-12-22', '22:36:30', NULL);
/*!40000 ALTER TABLE `citas` ENABLE KEYS */;

-- Volcando estructura para tabla appsalon_mvc.citasservicios
CREATE TABLE IF NOT EXISTS `citasservicios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `citaId` int(11) DEFAULT NULL,
  `servicioId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `citaId` (`citaId`),
  KEY `servicioId` (`servicioId`),
  CONSTRAINT `citasservicios_ibfk_3` FOREIGN KEY (`citaId`) REFERENCES `citas` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `citasservicios_ibfk_4` FOREIGN KEY (`servicioId`) REFERENCES `servicios` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla appsalon_mvc.citasservicios: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `citasservicios` DISABLE KEYS */;
/*!40000 ALTER TABLE `citasservicios` ENABLE KEYS */;

-- Volcando estructura para tabla appsalon_mvc.servicios
CREATE TABLE IF NOT EXISTS `servicios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL DEFAULT '',
  `precio` decimal(5,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla appsalon_mvc.servicios: ~11 rows (aproximadamente)
/*!40000 ALTER TABLE `servicios` DISABLE KEYS */;
INSERT INTO `servicios` (`id`, `nombre`, `precio`) VALUES
	(1, 'Corte de Cabello Mujer', 90.00),
	(2, 'Corte de Cabello Hombre', 80.00),
	(3, 'Corte de Cabello Niño', 60.00),
	(4, 'Peinado Mujer', 80.00),
	(5, 'Peinado Hombre', 60.00),
	(6, 'Corte de Barba', 60.00),
	(7, 'Tinte Mujer', 300.00),
	(8, 'Uñas', 400.00),
	(9, 'Lavado de Cabello', 50.00),
	(10, 'Tratamiento Capilar', 150.00),
	(11, 'Peinado Nino', 60.00);
/*!40000 ALTER TABLE `servicios` ENABLE KEYS */;

-- Volcando estructura para tabla appsalon_mvc.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) DEFAULT NULL,
  `apellido` varchar(60) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `confirmado` tinyint(1) DEFAULT NULL,
  `token` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla appsalon_mvc.usuarios: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `password`, `telefono`, `admin`, `confirmado`, `token`) VALUES
	(88, ' Mally', 'Flores', 'maryf7348@gmail.com', '$2y$10$ja51DFSJHSYiNMcNS9vaVu/M8OpEDxFrHnEFtPnVpG5ywezb00BWG', '97432397', 0, 1, '61e0d1f6168e1'),
	(90, ' Lonchi', 'Torres', 'ratorresc@unicah.edu', '$2y$10$VbwWyutmyUIhYPVp0tN0zOgrlPgA.U.Qae4mbwWPuqyOO3dOcQ7Se', '983468723', 0, 0, '61dfa6a87c4c2 '),
	(93, ' Luis', 'Rodriguez', 'luisnoe.rodriguez09@gmail.com', '$2y$10$Njw.z5b9Fdm7F1RsgbIws.2LDR21/DGzFJWKJI2w9KLuTDYdDnGF6', '97432397', 1, 1, ''),
	(101, ' Luis', 'Rodriguez', 'lnrodriguezm@unicah.edu', '$2y$10$UYfK68aSiDKnh3iYA1FSMumCtxfakQMfxcS5bFBmPnIM4DC/NAMHS', '97432397', 0, 0, '61e0f2e1b10ea '),
	(102, ' Luis', 'Rodriguez', 'medinalucho044@gmail.com', '$2y$10$JTxTpOo5ujn2cMy/3F/9d.Yipvdl8U4KXkpccaf59Y/7MWPnm.JUa', '97432397', 0, 0, '61e101bcaf85e ');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
