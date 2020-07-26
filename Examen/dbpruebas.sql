-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 25-07-2020 a las 04:26:26
-- Versión del servidor: 10.4.10-MariaDB
-- Versión de PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbpruebas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `estado` enum('Activo','Baja') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `estado`) VALUES
(1, 'Pinturas', 'Activo'),
(2, 'Cementos', 'Activo'),
(3, 'llaves', 'Activo'),
(4, 'alicates', 'Activo'),
(5, 'Destornilladores', 'Activo'),
(6, 'tubos', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle`
--

DROP TABLE IF EXISTS `detalle`;
CREATE TABLE IF NOT EXISTS `detalle` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `cantidad` int(7) NOT NULL,
  `precio` float NOT NULL,
  `producto_id` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `producto_id` (`producto_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle`
--

INSERT INTO `detalle` (`id`, `cantidad`, `precio`, `producto_id`) VALUES
(1, 1, 12, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

DROP TABLE IF EXISTS `factura`;
CREATE TABLE IF NOT EXISTS `factura` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nrofactura` int(10) NOT NULL,
  `nombrecliente` varchar(50) NOT NULL,
  `direccion` varchar(30) NOT NULL,
  `fecha` date NOT NULL,
  `total` float NOT NULL,
  `detalle_id` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `detalle_id` (`detalle_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id`, `nrofactura`, `nombrecliente`, `direccion`, `fecha`, `total`, `detalle_id`) VALUES
(1, 1, 'Angel', 'Santa', '2020-07-24', 14.16, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `denominacion` varchar(30) NOT NULL,
  `precio` float NOT NULL,
  `stock` float NOT NULL,
  `categoria_id` int(6) NOT NULL,
  `estado` enum('Activo','Baja') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categoria_id` (`categoria_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `denominacion`, `precio`, `stock`, `categoria_id`, `estado`) VALUES
(1, 'Pintura latex', 10, 100, 1, 'Activo'),
(2, 'Pintura patito', 12, 120, 1, 'Activo'),
(3, 'cemento pacasmayo', 12, 12, 2, 'Activo');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
