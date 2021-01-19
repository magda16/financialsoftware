-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 19-01-2021 a las 21:47:39
-- Versión del servidor: 5.7.21
-- Versión de PHP: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `financial_software`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activo_categoria`
--

DROP TABLE IF EXISTS `activo_categoria`;
CREATE TABLE IF NOT EXISTS `activo_categoria` (
  `id_activo_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` text NOT NULL,
  `categoria` text NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `fecha_ingreso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `estado` varchar(8) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_activo_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `activo_categoria`
--

INSERT INTO `activo_categoria` (`id_activo_categoria`, `codigo`, `categoria`, `tipo`, `fecha_ingreso`, `estado`, `id_usuario`) VALUES
(1, 'AcT', 'Baterias', 'Otros Bienes Muebles', '2020-11-28 03:37:59', 'Activo', 1),
(2, 'uj78', 'laptop', 'Otros Bienes Muebles', '2020-12-23 18:46:59', 'Activo', 1),
(3, 'vh0001', 'vehiculo', 'Vehiculo', '2021-01-18 02:27:11', 'Activo', 1),
(4, 'mq0001', 'desktop', 'Maquinaria', '2021-01-14 13:17:47', 'Activo', 1),
(5, 'lp0001', 'laptop', 'Maquinaria', '2021-01-14 13:18:18', 'Activo', 1),
(6, 'vh0002', 'pc escritorio', 'Maquinaria', '2021-01-15 02:21:30', 'Activo', 1),
(7, 'mb0001', 'muebles', 'Otros Bienes Muebles', '2021-01-15 03:48:32', 'Activo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activo_fijo`
--

DROP TABLE IF EXISTS `activo_fijo`;
CREATE TABLE IF NOT EXISTS `activo_fijo` (
  `id_activo_fijo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` text NOT NULL,
  `descripcion` text NOT NULL,
  `observacion` text NOT NULL,
  `calidad` varchar(8) NOT NULL,
  `marca` text NOT NULL,
  `modelo` text NOT NULL,
  `num_serie` text NOT NULL,
  `lote` text NOT NULL,
  `fecha_adquisicion` date NOT NULL,
  `financiamiento` varchar(200) NOT NULL,
  `anios_uso` int(11) NOT NULL,
  `valor_adquisicion` decimal(10,2) NOT NULL,
  `valor_estimado` varchar(2) NOT NULL,
  `valor_residual` decimal(10,2) NOT NULL,
  `vida_util` int(11) NOT NULL,
  `doc_adquisicion` text NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_subcategoria` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `fecha_ingreso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `estado` varchar(8) NOT NULL,
  `motivo` text NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_activo_fijo`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `activo_fijo`
--

INSERT INTO `activo_fijo` (`id_activo_fijo`, `codigo`, `descripcion`, `observacion`, `calidad`, `marca`, `modelo`, `num_serie`, `lote`, `fecha_adquisicion`, `financiamiento`, `anios_uso`, `valor_adquisicion`, `valor_estimado`, `valor_residual`, `vida_util`, `doc_adquisicion`, `id_categoria`, `id_subcategoria`, `id_proveedor`, `fecha_ingreso`, `estado`, `motivo`, `id_usuario`) VALUES
(1, 'su0001-vh0001-vh0001-000001', 'camioneta color rojo, cuatro puertas,  placa p123-123', 'no hay', 'Bueno', 'Kia', 'sportage', 'ms01231', '', '2020-12-27', 'Nuevo', 0, '27000.00', 'Si', '0.00', 5, 'fixed_asset/1/documento_adquisicion.pdf', 3, 7, 2, '2021-01-17 10:33:40', 'Activo', '', 1),
(2, 'su0001-lp0001-hp0001-000001', 'pantalla 14 pulgadas,  8 gb ram drr3, 128gb ssd, procesador i5 4ta generacion', '', 'Bueno', 'Hewlett Packard', 'probook', 'e5440', '', '2020-12-27', 'Nuevo', 0, '800.00', 'Si', '0.00', 0, '', 5, 8, 2, '2021-01-15 03:05:14', 'Activo', '', 1),
(3, 'su0001-lp0001-de0001-000001', 'pantalla 14 pulgadas, 8gb ram, 500gb hdd', 'no hay', 'Regular', 'dell', 'Refurbished', '', 'lote-3-12', '2020-12-27', 'Usado', 1, '645.00', 'Si', '0.00', 2, '', 5, 4, 2, '2021-01-19 15:26:01', 'Activo', '', 1),
(4, 'su0001-lp0001-de0001-000002', 'pantalla 14 pulgadas, 8gb ram, 500gb hdd', 'no hay', 'Regular', 'dell', 'Refurbished', '', 'lote-3-12', '2020-12-27', 'Usado', 0, '645.00', 'Si', '0.00', 0, '', 5, 4, 2, '2021-01-19 15:16:09', 'Activo', '', 1),
(5, 'su0001-lp0001-de0001-000003', 'pantalla 14 pulgadas, 8gb ram, 500gb hdd', 'no hay', 'Regular', 'dell', 'Refurbished', '', 'lote-3-12', '2020-12-27', 'Usado', 0, '645.00', 'Si', '0.00', 0, '', 5, 4, 2, '2021-01-19 15:15:54', 'Activo', '', 1),
(6, 'su0001-lp0001-de0001-000004', 'pantalla 14 pulgadas, 8gb ram, 500gb hdd', 'no hay', 'Regular', 'dell', 'Refurbished', '', 'lote-3-12', '2020-12-27', 'Usado', 0, '645.00', 'Si', '0.00', 0, '', 5, 4, 2, '2021-01-19 15:15:33', 'Activo', '', 1),
(7, 'su0001-lp0001-de0001-000005', 'pantalla 14 pulgadas, 8gb ram, 500gb hdd', 'no hay', 'Regular', 'dell', 'Refurbished', '', 'lote-3-12', '2020-12-27', 'Usado', 0, '645.00', 'Si', '0.00', 0, '', 5, 4, 2, '2021-01-19 15:15:15', 'Activo', '', 1),
(8, 'su0001-lp0001-de0001-000006', 'pantalla 14 pulgadas, 8gb ram, 500gb hdd', 'no hay', 'Regular', 'dell', 'Refurbished', '', 'lote-3-12', '2020-12-27', 'Usado', 0, '645.00', 'Si', '0.00', 0, '', 5, 4, 2, '2021-01-19 15:14:58', 'Activo', '', 1),
(9, 'su0001-lp0001-de0001-000007', 'pantalla 14 pulgadas, 8gb ram, 500gb hdd', 'no hay', 'Regular', 'dell', 'Refurbished', '', 'lote-3-12', '2020-12-27', 'Usado', 0, '645.00', 'Si', '0.00', 0, '', 5, 4, 2, '2021-01-19 15:14:40', 'Activo', '', 1),
(10, 'su0001-lp0001-de0001-000008', 'pantalla 14 pulgadas, 8gb ram, 500gb hdd', 'no hay', 'Regular', 'dell', 'Refurbished', '', 'lote-3-12', '2020-12-27', 'Usado', 0, '645.00', 'Si', '0.00', 0, '', 5, 4, 2, '2021-01-15 03:11:08', 'Activo', '', 1),
(11, 'su0001-lp0001-de0001-000009', 'pantalla 14 pulgadas, 8gb ram, 500gb hdd', 'no hay', 'Regular', 'dell', 'Refurbished', '', 'lote-3-12', '2020-12-27', 'Usado', 0, '645.00', 'Si', '0.00', 0, '', 5, 4, 2, '2021-01-15 03:11:08', 'Activo', '', 1),
(12, 'su0001-lp0001-de0001-000010', 'pantalla 14 pulgadas, 8gb ram, 500gb hdd', 'no hay', 'Regular', 'dell', 'Refurbished', '', 'lote-3-12', '2020-12-27', 'Usado', 0, '645.00', 'Si', '0.00', 0, '', 5, 4, 2, '2021-01-15 03:11:08', 'Activo', '', 1),
(13, 'su0001-vh0002-cv0001-000001', 'monitor 19 pulgadas, 8 gb ram drr3, 250gb hdd', 'ninguno', 'Bueno', 'dell', 'oficina', '', 'lote-13-27', '2020-12-27', 'Usado', 0, '800.00', 'Si', '100.00', 2, '', 6, 3, 1, '2021-01-17 14:21:35', 'Activo', '', 1),
(14, 'su0001-vh0002-cv0001-000002', 'monitor 19 pulgadas, 8 gb ram drr3, 250gb hdd', 'ninguno', 'Bueno', 'dell', 'oficina', '', 'lote-13-27', '2020-12-27', 'Usado', 0, '800.00', 'Si', '0.00', 2, '', 6, 3, 1, '2021-01-17 14:24:24', 'Activo', '', 1),
(15, 'su0001-vh0002-cv0001-000003', 'monitor 19 pulgadas, 8 gb ram drr3, 250gb hdd', 'ninguno', 'Bueno', 'dell', 'oficina', '', 'lote-13-27', '2020-12-27', 'Usado', 0, '800.00', 'Si', '0.00', 0, '', 6, 3, 1, '2021-01-15 03:15:38', 'Activo', '', 1),
(16, 'su0001-vh0002-cv0001-000004', 'monitor 19 pulgadas, 8 gb ram drr3, 250gb hdd', 'ninguno', 'Bueno', 'dell', 'oficina', '', 'lote-13-27', '2020-12-27', 'Usado', 0, '800.00', 'Si', '0.00', 0, '', 6, 3, 1, '2021-01-15 03:15:38', 'Activo', '', 1),
(17, 'su0001-vh0002-cv0001-000005', 'monitor 19 pulgadas, 8 gb ram drr3, 250gb hdd', 'ninguno', 'Bueno', 'dell', 'oficina', '', 'lote-13-27', '2020-12-27', 'Usado', 0, '800.00', 'Si', '0.00', 0, '', 6, 3, 1, '2021-01-15 03:15:38', 'Activo', '', 1),
(18, 'su0001-vh0002-cv0001-000006', 'monitor 19 pulgadas, 8 gb ram drr3, 250gb hdd', 'ninguno', 'Bueno', 'dell', 'oficina', '', 'lote-13-27', '2020-12-27', 'Usado', 0, '800.00', 'Si', '0.00', 0, '', 6, 3, 1, '2021-01-15 03:15:38', 'Activo', '', 1),
(19, 'su0001-vh0002-cv0001-000007', 'monitor 19 pulgadas, 8 gb ram drr3, 250gb hdd', 'ninguno', 'Bueno', 'dell', 'oficina', '', 'lote-13-27', '2020-12-27', 'Usado', 0, '800.00', 'Si', '0.00', 0, '', 6, 3, 1, '2021-01-15 03:15:38', 'Activo', '', 1),
(20, 'su0001-vh0002-cv0001-000008', 'monitor 19 pulgadas, 8 gb ram drr3, 250gb hdd', 'ninguno', 'Bueno', 'dell', 'oficina', '', 'lote-13-27', '2020-12-27', 'Usado', 0, '800.00', 'Si', '0.00', 0, '', 6, 3, 1, '2021-01-15 03:15:38', 'Activo', '', 1),
(21, 'su0001-vh0002-cv0001-000009', 'monitor 19 pulgadas, 8 gb ram drr3, 250gb hdd', 'ninguno', 'Bueno', 'dell', 'oficina', '', 'lote-13-27', '2020-12-27', 'Usado', 0, '800.00', 'Si', '0.00', 0, '', 6, 3, 1, '2021-01-15 03:15:38', 'Activo', '', 1),
(22, 'su0001-vh0002-cv0001-000010', 'monitor 19 pulgadas, 8 gb ram drr3, 250gb hdd', 'ninguno', 'Bueno', 'dell', 'oficina', '', 'lote-13-27', '2020-12-27', 'Usado', 0, '800.00', 'Si', '0.00', 0, '', 6, 3, 1, '2021-01-15 03:15:38', 'Activo', '', 1),
(23, 'su0001-vh0002-cv0001-000011', 'monitor 19 pulgadas, 8 gb ram drr3, 250gb hdd', 'ninguno', 'Bueno', 'dell', 'oficina', '', 'lote-13-27', '2020-12-27', 'Usado', 0, '800.00', 'Si', '0.00', 0, '', 6, 3, 1, '2021-01-15 03:15:38', 'Activo', '', 1),
(24, 'su0001-vh0002-cv0001-000012', 'monitor 19 pulgadas, 8 gb ram drr3, 250gb hdd', 'ninguno', 'Bueno', 'dell', 'oficina', '', 'lote-13-27', '2020-12-27', 'Usado', 0, '800.00', 'Si', '0.00', 0, '', 6, 3, 1, '2021-01-15 03:15:38', 'Activo', '', 1),
(25, 'su0001-vh0002-cv0001-000013', 'monitor 19 pulgadas, 8 gb ram drr3, 250gb hdd', 'ninguno', 'Bueno', 'dell', 'oficina', '', 'lote-13-27', '2020-12-27', 'Usado', 0, '800.00', 'Si', '0.00', 0, '', 6, 3, 1, '2021-01-15 03:15:38', 'Activo', '', 1),
(26, 'su0001-vh0002-cv0001-000014', 'monitor 19 pulgadas, 8 gb ram drr3, 250gb hdd', 'ninguno', 'Bueno', 'dell', 'oficina', '', 'lote-13-27', '2020-12-27', 'Usado', 0, '800.00', 'Si', '0.00', 0, '', 6, 3, 1, '2021-01-15 03:15:38', 'Activo', '', 1),
(27, 'su0001-vh0002-cv0001-000015', 'monitor 19 pulgadas, 8 gb ram drr3, 250gb hdd', 'ninguno', 'Bueno', 'dell', 'oficina', '', 'lote-13-27', '2020-12-27', 'Usado', 0, '800.00', 'Si', '0.00', 0, '', 6, 3, 1, '2021-01-15 03:15:38', 'Activo', '', 1),
(28, 'su0001-vh0001-cam0001-000001', 'motor de 2.7/3.1L, potencia de 79@4000', 'ninguna', 'Bueno', 'Kia', 'seriek', 'k2700', '', '2020-12-30', 'Nuevo', 0, '27000.00', 'Si', '0.00', 0, 'fixed_asset/28/documento_adquisicion.pdf', 3, 5, 1, '2021-01-15 03:40:32', 'Activo', '', 1),
(29, 'su0001-mb0001-mb0001-000001', 'Vidrio Templado 10mm en acabado nevado con soportes de aluminio.\r\nEscritorio de 1.60ï¿½0.70m.\r\nMesa ï¿½ con base metï¿½lica color Plata independiente.', 'ninguno', 'Bueno', 'nevada', 'vidrio', 'nv0123', '', '2020-12-30', 'Nuevo', 0, '700.00', 'Si', '0.00', 5, '', 7, 6, 2, '2021-01-17 13:43:26', 'Activo', '', 1),
(30, 'su0001-mb0001-mb0001-000002', 'Top de melamina color madera oscura y estructura en color combinado blanco\r\nIncluye depósitos y espacios en la extensión lateral\r\nModerno pasacables con cepillo\r\nMedidas Totales del Escritorio 140 cms x 70 cms', 'ninguno', 'Bueno', 'acses', 'ejecutivo', '', 'lote-30-44', '2020-12-30', 'Nuevo', 0, '267.00', 'Si', '0.00', 0, '', 7, 6, 2, '2021-01-15 05:46:14', 'Activo', '', 1),
(31, 'su0001-mb0001-mb0001-000003', 'Top de melamina color madera oscura y estructura en color combinado blanco\r\nIncluye depósitos y espacios en la extensión lateral\r\nModerno pasacables con cepillo\r\nMedidas Totales del Escritorio 140 cms x 70 cms', 'ninguno', 'Bueno', 'acses', 'ejecutivo', '', 'lote-30-44', '2020-12-30', 'Nuevo', 0, '267.00', 'Si', '0.00', 0, '', 7, 6, 2, '2021-01-15 05:46:14', 'Activo', '', 1),
(32, 'su0001-mb0001-mb0001-000004', 'Top de melamina color madera oscura y estructura en color combinado blanco\r\nIncluye depósitos y espacios en la extensión lateral\r\nModerno pasacables con cepillo\r\nMedidas Totales del Escritorio 140 cms x 70 cms', 'ninguno', 'Bueno', 'acses', 'ejecutivo', '', 'lote-30-44', '2020-12-30', 'Nuevo', 0, '267.00', 'Si', '0.00', 0, '', 7, 6, 2, '2021-01-15 05:46:14', 'Activo', '', 1),
(33, 'su0001-mb0001-mb0001-000005', 'Top de melamina color madera oscura y estructura en color combinado blanco\r\nIncluye depósitos y espacios en la extensión lateral\r\nModerno pasacables con cepillo\r\nMedidas Totales del Escritorio 140 cms x 70 cms', 'ninguno', 'Bueno', 'acses', 'ejecutivo', '', 'lote-30-44', '2020-12-30', 'Nuevo', 0, '267.00', 'Si', '0.00', 0, '', 7, 6, 2, '2021-01-15 05:46:14', 'Activo', '', 1),
(34, 'su0001-mb0001-mb0001-000006', 'Top de melamina color madera oscura y estructura en color combinado blanco\r\nIncluye depósitos y espacios en la extensión lateral\r\nModerno pasacables con cepillo\r\nMedidas Totales del Escritorio 140 cms x 70 cms', 'ninguno', 'Bueno', 'acses', 'ejecutivo', '', 'lote-30-44', '2020-12-30', 'Nuevo', 0, '267.00', 'Si', '0.00', 0, '', 7, 6, 2, '2021-01-15 05:46:14', 'Activo', '', 1),
(35, 'su0001-mb0001-mb0001-000007', 'Top de melamina color madera oscura y estructura en color combinado blanco\r\nIncluye depósitos y espacios en la extensión lateral\r\nModerno pasacables con cepillo\r\nMedidas Totales del Escritorio 140 cms x 70 cms', 'ninguno', 'Bueno', 'acses', 'ejecutivo', '', 'lote-30-44', '2020-12-30', 'Nuevo', 0, '267.00', 'Si', '0.00', 0, '', 7, 6, 2, '2021-01-15 05:46:14', 'Activo', '', 1),
(36, 'su0001-mb0001-mb0001-000008', 'Top de melamina color madera oscura y estructura en color combinado blanco\r\nIncluye depósitos y espacios en la extensión lateral\r\nModerno pasacables con cepillo\r\nMedidas Totales del Escritorio 140 cms x 70 cms', 'ninguno', 'Bueno', 'acses', 'ejecutivo', '', 'lote-30-44', '2020-12-30', 'Nuevo', 0, '267.00', 'Si', '0.00', 0, '', 7, 6, 2, '2021-01-15 05:46:14', 'Activo', '', 1),
(37, 'su0001-mb0001-mb0001-000009', 'Top de melamina color madera oscura y estructura en color combinado blanco\r\nIncluye depósitos y espacios en la extensión lateral\r\nModerno pasacables con cepillo\r\nMedidas Totales del Escritorio 140 cms x 70 cms', 'ninguno', 'Bueno', 'acses', 'ejecutivo', '', 'lote-30-44', '2020-12-30', 'Nuevo', 0, '267.00', 'Si', '0.00', 0, '', 7, 6, 2, '2021-01-15 05:46:14', 'Activo', '', 1),
(38, 'su0001-mb0001-mb0001-000010', 'Top de melamina color madera oscura y estructura en color combinado blanco\r\nIncluye depósitos y espacios en la extensión lateral\r\nModerno pasacables con cepillo\r\nMedidas Totales del Escritorio 140 cms x 70 cms', 'ninguno', 'Bueno', 'acses', 'ejecutivo', '', 'lote-30-44', '2020-12-30', 'Nuevo', 0, '267.00', 'Si', '0.00', 0, '', 7, 6, 2, '2021-01-15 05:46:14', 'Activo', '', 1),
(39, 'su0001-mb0001-mb0001-000011', 'Top de melamina color madera oscura y estructura en color combinado blanco\r\nIncluye depósitos y espacios en la extensión lateral\r\nModerno pasacables con cepillo\r\nMedidas Totales del Escritorio 140 cms x 70 cms', 'ninguno', 'Bueno', 'acses', 'ejecutivo', '', 'lote-30-44', '2020-12-30', 'Nuevo', 0, '267.00', 'Si', '0.00', 0, '', 7, 6, 2, '2021-01-15 05:46:14', 'Activo', '', 1),
(40, 'su0001-mb0001-mb0001-000012', 'Top de melamina color madera oscura y estructura en color combinado blanco\r\nIncluye depósitos y espacios en la extensión lateral\r\nModerno pasacables con cepillo\r\nMedidas Totales del Escritorio 140 cms x 70 cms', 'ninguno', 'Bueno', 'acses', 'ejecutivo', '', 'lote-30-44', '2020-12-30', 'Nuevo', 0, '267.00', 'Si', '0.00', 0, '', 7, 6, 2, '2021-01-15 05:46:14', 'Activo', '', 1),
(41, 'su0001-mb0001-mb0001-000013', 'Top de melamina color madera oscura y estructura en color combinado blanco\r\nIncluye depósitos y espacios en la extensión lateral\r\nModerno pasacables con cepillo\r\nMedidas Totales del Escritorio 140 cms x 70 cms', 'ninguno', 'Bueno', 'acses', 'ejecutivo', '', 'lote-30-44', '2020-12-30', 'Nuevo', 0, '267.00', 'Si', '0.00', 0, '', 7, 6, 2, '2021-01-15 05:46:14', 'Activo', '', 1),
(42, 'su0001-mb0001-mb0001-000014', 'Top de melamina color madera oscura y estructura en color combinado blanco\r\nIncluye depósitos y espacios en la extensión lateral\r\nModerno pasacables con cepillo\r\nMedidas Totales del Escritorio 140 cms x 70 cms', 'ninguno', 'Bueno', 'acses', 'ejecutivo', '', 'lote-30-44', '2020-12-30', 'Nuevo', 0, '267.00', 'Si', '0.00', 0, '', 7, 6, 2, '2021-01-15 05:46:14', 'Activo', '', 1),
(43, 'su0001-mb0001-mb0001-000015', 'Top de melamina color madera oscura y estructura en color combinado blanco\r\nIncluye depósitos y espacios en la extensión lateral\r\nModerno pasacables con cepillo\r\nMedidas Totales del Escritorio 140 cms x 70 cms', 'ninguno', 'Bueno', 'acses', 'ejecutivo', '', 'lote-30-44', '2020-12-30', 'Nuevo', 0, '267.00', 'Si', '0.00', 0, '', 7, 6, 2, '2021-01-15 05:46:14', 'Activo', '', 1),
(44, 'su0001-mb0001-mb0001-000016', 'Top de melamina color madera oscura y estructura en color combinado blanco\r\nIncluye depósitos y espacios en la extensión lateral\r\nModerno pasacables con cepillo\r\nMedidas Totales del Escritorio 140 cms x 70 cms', 'ninguno', 'Bueno', 'acses', 'ejecutivo', '', 'lote-30-44', '2020-12-30', 'Nuevo', 0, '267.00', 'Si', '0.00', 0, '', 7, 6, 2, '2021-01-15 05:46:14', 'Activo', '', 1),
(45, 'su0001-mb0001-sl0001-000001', 'Asiento de tela color negro y respaldo y estructura color Gris.\r\nRespaldo reclinable con ajuste de tensión', 'ninguna', 'Bueno', 'Eurotek', 'ejecutivo', '', 'lote-45-59', '2020-12-30', 'Nuevo', 0, '154.00', 'Si', '0.00', 0, '', 7, 10, 2, '2021-01-15 05:52:32', 'Activo', '', 1),
(46, 'su0001-mb0001-sl0001-000002', 'Asiento de tela color negro y respaldo y estructura color Gris.\r\nRespaldo reclinable con ajuste de tensión', 'ninguna', 'Bueno', 'Eurotek', 'ejecutivo', '', 'lote-45-59', '2020-12-30', 'Nuevo', 0, '154.00', 'Si', '0.00', 0, '', 7, 10, 2, '2021-01-15 05:52:32', 'Activo', '', 1),
(47, 'su0001-mb0001-sl0001-000003', 'Asiento de tela color negro y respaldo y estructura color Gris.\r\nRespaldo reclinable con ajuste de tensión', 'ninguna', 'Bueno', 'Eurotek', 'ejecutivo', '', 'lote-45-59', '2020-12-30', 'Nuevo', 0, '154.00', 'Si', '0.00', 0, '', 7, 10, 2, '2021-01-15 05:52:32', 'Activo', '', 1),
(48, 'su0001-mb0001-sl0001-000004', 'Asiento de tela color negro y respaldo y estructura color Gris.\r\nRespaldo reclinable con ajuste de tensión', 'ninguna', 'Bueno', 'Eurotek', 'ejecutivo', '', 'lote-45-59', '2020-12-30', 'Nuevo', 0, '154.00', 'Si', '0.00', 0, '', 7, 10, 2, '2021-01-15 05:52:32', 'Activo', '', 1),
(49, 'su0001-mb0001-sl0001-000005', 'Asiento de tela color negro y respaldo y estructura color Gris.\r\nRespaldo reclinable con ajuste de tensión', 'ninguna', 'Bueno', 'Eurotek', 'ejecutivo', '', 'lote-45-59', '2020-12-30', 'Nuevo', 0, '154.00', 'Si', '0.00', 0, '', 7, 10, 2, '2021-01-15 05:52:32', 'Activo', '', 1),
(50, 'su0001-mb0001-sl0001-000006', 'Asiento de tela color negro y respaldo y estructura color Gris.\r\nRespaldo reclinable con ajuste de tensión', 'ninguna', 'Bueno', 'Eurotek', 'ejecutivo', '', 'lote-45-59', '2020-12-30', 'Nuevo', 0, '154.00', 'Si', '0.00', 0, '', 7, 10, 2, '2021-01-15 05:52:32', 'Activo', '', 1),
(51, 'su0001-mb0001-sl0001-000007', 'Asiento de tela color negro y respaldo y estructura color Gris.\r\nRespaldo reclinable con ajuste de tensión', 'ninguna', 'Bueno', 'Eurotek', 'ejecutivo', '', 'lote-45-59', '2020-12-30', 'Nuevo', 0, '154.00', 'Si', '0.00', 0, '', 7, 10, 2, '2021-01-15 05:52:32', 'Activo', '', 1),
(52, 'su0001-mb0001-sl0001-000008', 'Asiento de tela color negro y respaldo y estructura color Gris.\r\nRespaldo reclinable con ajuste de tensión', 'ninguna', 'Bueno', 'Eurotek', 'ejecutivo', '', 'lote-45-59', '2020-12-30', 'Nuevo', 0, '154.00', 'Si', '0.00', 0, '', 7, 10, 2, '2021-01-15 05:52:32', 'Activo', '', 1),
(53, 'su0001-mb0001-sl0001-000009', 'Asiento de tela color negro y respaldo y estructura color Gris.\r\nRespaldo reclinable con ajuste de tensión', 'ninguna', 'Bueno', 'Eurotek', 'ejecutivo', '', 'lote-45-59', '2020-12-30', 'Nuevo', 0, '154.00', 'Si', '0.00', 0, '', 7, 10, 2, '2021-01-15 05:52:32', 'Activo', '', 1),
(54, 'su0001-mb0001-sl0001-000010', 'Asiento de tela color negro y respaldo y estructura color Gris.\r\nRespaldo reclinable con ajuste de tensión', 'ninguna', 'Bueno', 'Eurotek', 'ejecutivo', '', 'lote-45-59', '2020-12-30', 'Nuevo', 0, '154.00', 'Si', '0.00', 0, '', 7, 10, 2, '2021-01-15 05:52:32', 'Activo', '', 1),
(55, 'su0001-mb0001-sl0001-000011', 'Asiento de tela color negro y respaldo y estructura color Gris.\r\nRespaldo reclinable con ajuste de tensión', 'ninguna', 'Bueno', 'Eurotek', 'ejecutivo', '', 'lote-45-59', '2020-12-30', 'Nuevo', 0, '154.00', 'Si', '0.00', 0, '', 7, 10, 2, '2021-01-15 05:52:32', 'Activo', '', 1),
(56, 'su0001-mb0001-sl0001-000012', 'Asiento de tela color negro y respaldo y estructura color Gris.\r\nRespaldo reclinable con ajuste de tensión', 'ninguna', 'Bueno', 'Eurotek', 'ejecutivo', '', 'lote-45-59', '2020-12-30', 'Nuevo', 0, '154.00', 'Si', '0.00', 0, '', 7, 10, 2, '2021-01-15 05:52:32', 'Activo', '', 1),
(57, 'su0001-mb0001-sl0001-000013', 'Asiento de tela color negro y respaldo y estructura color Gris.\r\nRespaldo reclinable con ajuste de tensión', 'ninguna', 'Bueno', 'Eurotek', 'ejecutivo', '', 'lote-45-59', '2020-12-30', 'Nuevo', 0, '154.00', 'Si', '0.00', 0, '', 7, 10, 2, '2021-01-15 05:52:32', 'Activo', '', 1),
(58, 'su0001-mb0001-sl0001-000014', 'Asiento de tela color negro y respaldo y estructura color Gris.\r\nRespaldo reclinable con ajuste de tensión', 'ninguna', 'Bueno', 'Eurotek', 'ejecutivo', '', 'lote-45-59', '2020-12-30', 'Nuevo', 0, '154.00', 'Si', '0.00', 0, '', 7, 10, 2, '2021-01-15 05:52:32', 'Activo', '', 1),
(59, 'su0001-mb0001-sl0001-000015', 'Asiento de tela color negro y respaldo y estructura color Gris.\r\nRespaldo reclinable con ajuste de tensión', 'ninguna', 'Bueno', 'Eurotek', 'ejecutivo', '', 'lote-45-59', '2020-12-30', 'Nuevo', 0, '154.00', 'Si', '0.00', 0, '', 7, 10, 2, '2021-01-15 05:52:32', 'Activo', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activo_subcategoria`
--

DROP TABLE IF EXISTS `activo_subcategoria`;
CREATE TABLE IF NOT EXISTS `activo_subcategoria` (
  `id_activo_subcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` text NOT NULL,
  `subcategoria` text NOT NULL,
  `id_activo_categoria` int(11) NOT NULL,
  `fecha_ingreso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `estado` varchar(8) NOT NULL,
  PRIMARY KEY (`id_activo_subcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `activo_subcategoria`
--

INSERT INTO `activo_subcategoria` (`id_activo_subcategoria`, `codigo`, `subcategoria`, `id_activo_categoria`, `fecha_ingreso`, `estado`) VALUES
(1, 'ba0001', 'baterias', 1, '2021-01-09 20:24:40', 'Activo'),
(2, 'bt0002', 'baterias para pc de escritorio', 1, '2021-01-11 22:38:29', 'Activo'),
(3, 'cv0001', 'computadora oficina', 6, '2021-01-15 09:35:24', 'Activo'),
(4, 'de0001', 'dell', 5, '2020-12-07 23:00:00', 'Activo'),
(5, 'cam0001', 'transporte producto', 3, '2020-12-28 23:00:00', 'Activo'),
(6, 'mb0001', 'escritorio ', 7, '2021-01-03 23:00:00', 'Activo'),
(7, 'vh0001', 'camioneta kia', 3, '2021-01-15 09:42:21', 'Activo'),
(8, 'hp0001', 'HP probook', 5, '2021-01-15 09:56:51', 'Activo'),
(9, 'le0001', 'lenovo ', 5, '2020-12-22 23:00:00', 'Activo'),
(10, 'sl0001', 'silla', 7, '2021-01-15 05:23:25', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `apellido` varchar(150) NOT NULL,
  `dui` varchar(10) NOT NULL,
  `nit` varchar(17) NOT NULL,
  `fecha_nac` date NOT NULL,
  `genero` varchar(9) NOT NULL,
  `direccion` text NOT NULL,
  `correo` varchar(150) NOT NULL,
  `telefono` text NOT NULL,
  `fotografia` text NOT NULL,
  `fecha_ingreso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `estado` varchar(8) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre`, `apellido`, `dui`, `nit`, `fecha_nac`, `genero`, `direccion`, `correo`, `telefono`, `fotografia`, `fecha_ingreso`, `estado`, `id_usuario`) VALUES
(1, 'juan jose', 'molina', '78456165-6', '1005-856584-964-6', '2001-06-10', 'Masculino', 'san vicente', 'molina@gmail.com', '7896-8575', '', '2021-01-18 03:24:46', 'Activo', 1),
(2, 'Luna', 'Molero', '79526542-6', '1165-161111-111-1', '1994-11-30', 'Femenino', '7898 Dejuan Dam', 'ewasuffujy-7892@yopmail.com', '7412-6985', '', '2021-01-18 03:25:22', 'Activo', 1),
(3, 'Paula', 'Castillo', '41256854-1', '1476-526516-516-5', '1989-07-13', 'Femenino', '332 Kautzer Ramp Apt. 698', 'acylesix-8847@yopmail.com', '7410-2695', '', '2021-01-18 03:26:15', 'Activo', 1),
(4, 'Matias', 'Moreno', '41259502-5', '', '1994-04-19', 'Masculino', '8747 Hauck Lights Apt. 695', 'yffossussenn-4239@yopmail.com', '7412-9652', '', '2021-01-15 06:21:34', 'Activo', 1),
(5, 'Andres', 'Morales', '05952025-9', '', '1992-07-22', 'Masculino', '1154 Princess Crossing Suite 294', 'zimofekiv-8501@yopmail.com', '7410-5950', '', '2021-01-15 06:24:52', 'Activo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_institucion`
--

DROP TABLE IF EXISTS `cliente_institucion`;
CREATE TABLE IF NOT EXISTS `cliente_institucion` (
  `id_cliente_institucion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text NOT NULL,
  `nit` varchar(17) NOT NULL,
  `nrc` varchar(10) NOT NULL,
  `direccion` text NOT NULL,
  `correo` varchar(150) NOT NULL,
  `telefono` text NOT NULL,
  `fotografia` text NOT NULL,
  `fecha_ingreso` timestamp NOT NULL,
  `estado` varchar(8) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_cliente_institucion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente_institucion`
--

INSERT INTO `cliente_institucion` (`id_cliente_institucion`, `nombre`, `nit`, `nrc`, `direccion`, `correo`, `telefono`, `fotografia`, `fecha_ingreso`, `estado`, `id_usuario`) VALUES
(1, 'xbfgbdfgbdgfndfbdf', '7854-444444-444-4', '516111-2', 'masfnfgbkh', 'lnwrje@gmail.com', '7896-2225', 'institution_client/1/fotografia.png', '2021-01-14 18:18:47', 'Activo', 1),
(2, 'siete sv', '7777-777744-888-8', '985744-4', 'san vicente', 'sv@gmail.com', '7896-8574', '', '2021-01-14 18:20:38', 'Activo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

DROP TABLE IF EXISTS `compra`;
CREATE TABLE IF NOT EXISTS `compra` (
  `id_compra` int(11) NOT NULL,
  `tipo_pago` varchar(7) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL,
  `fecha_ingreso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `estado` varchar(9) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id_compra`, `tipo_pago`, `monto`, `fecha`, `fecha_ingreso`, `estado`, `id_usuario`) VALUES
(1, 'Contado', '7000.00', '2021-01-03', '2021-01-07 00:59:49', 'Cancelado', 1),
(2, 'Contado', '8000.00', '2021-01-03', '2021-01-07 22:58:25', 'Cancelado', 1),
(3, 'Credito', '26820.00', '2020-12-27', '2021-01-17 08:09:36', 'Pendiente', 1),
(4, 'Contado', '17750.00', '2020-12-29', '2021-01-17 08:14:12', 'Cancelado', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

DROP TABLE IF EXISTS `departamento`;
CREATE TABLE IF NOT EXISTS `departamento` (
  `id_departamento` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` text NOT NULL,
  `nombre` text NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_ingreso` timestamp NOT NULL,
  `estado` varchar(8) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_departamento`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id_departamento`, `codigo`, `nombre`, `descripcion`, `fecha_ingreso`, `estado`, `id_usuario`) VALUES
(1, 'v155', 'Ventas', 'Ventas de articulos', '2020-11-28 00:24:15', 'Activo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `depto_activo_fijo`
--

DROP TABLE IF EXISTS `depto_activo_fijo`;
CREATE TABLE IF NOT EXISTS `depto_activo_fijo` (
  `id_depto_activo_fijo` int(11) NOT NULL AUTO_INCREMENT,
  `id_departamento` int(11) NOT NULL,
  `id_activo_fijo` int(11) NOT NULL,
  PRIMARY KEY (`id_depto_activo_fijo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

DROP TABLE IF EXISTS `detalle_compra`;
CREATE TABLE IF NOT EXISTS `detalle_compra` (
  `id_d_c` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  PRIMARY KEY (`id_d_c`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_compra`
--

INSERT INTO `detalle_compra` (`id_d_c`, `cantidad`, `precio`, `id_producto`, `id_compra`) VALUES
(1, 20, '350.00', 1, 1),
(2, 20, '400.00', 2, 2),
(3, 10, '450.00', 12, 3),
(4, 10, '560.00', 10, 3),
(5, 10, '1672.00', 16, 3),
(6, 10, '455.00', 6, 4),
(7, 10, '560.00', 9, 4),
(8, 10, '760.00', 15, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta_contado`
--

DROP TABLE IF EXISTS `detalle_venta_contado`;
CREATE TABLE IF NOT EXISTS `detalle_venta_contado` (
  `id_d_v_c` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_venta_contado` int(11) NOT NULL,
  PRIMARY KEY (`id_d_v_c`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_venta_contado`
--

INSERT INTO `detalle_venta_contado` (`id_d_v_c`, `cantidad`, `precio`, `id_producto`, `id_venta_contado`) VALUES
(2, 1, '385.00', 1, 1),
(3, 2, '460.00', 2, 2),
(5, 1, '385.00', 1, 3),
(6, 1, '385.00', 1, 4),
(7, 1, '460.00', 2, 5),
(8, 1, '460.00', 2, 6),
(9, 1, '385.00', 1, 7),
(10, 1, '385.00', 1, 8),
(11, 1, '460.00', 2, 9),
(13, 1, '460.00', 2, 10),
(14, 1, '460.00', 2, 11),
(15, 2, '460.00', 2, 12),
(16, 1, '460.00', 2, 13);

--
-- Disparadores `detalle_venta_contado`
--
DROP TRIGGER IF EXISTS `update_producto_venta`;
DELIMITER $$
CREATE TRIGGER `update_producto_venta` AFTER INSERT ON `detalle_venta_contado` FOR EACH ROW UPDATE producto SET cantidad=cantidad-NEW.cantidad WHERE id_producto=NEW.id_producto
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

DROP TABLE IF EXISTS `empleado`;
CREATE TABLE IF NOT EXISTS `empleado` (
  `id_empleado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `apellido` varchar(150) NOT NULL,
  `dui` varchar(10) NOT NULL,
  `nit` varchar(17) NOT NULL,
  `fecha_nac` date NOT NULL,
  `genero` varchar(9) NOT NULL,
  `puesto` varchar(150) NOT NULL,
  `direccion` text NOT NULL,
  `correo` varchar(150) NOT NULL,
  `telefono` text NOT NULL,
  `fotografia` text NOT NULL,
  `fecha_ingreso` timestamp NOT NULL,
  `estado` varchar(8) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_empleado`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_empleado`, `nombre`, `apellido`, `dui`, `nit`, `fecha_nac`, `genero`, `puesto`, `direccion`, `correo`, `telefono`, `fotografia`, `fecha_ingreso`, `estado`, `id_usuario`) VALUES
(1, 'juan', 'vega', '84984948-4', '4456-546546-546-5', '2000-07-02', 'Masculino', 'Vendedor', 'San Vicente', 'juan@gmail.com', '(503) 7896-8574', '', '2020-11-23 00:23:31', 'Inactivo', 1),
(2, 'maria', 'vega', '78451626-1', '1000-556498-499-9', '1999-02-08', 'Femenino', 'Vendedor', 'San Esteban Catarina', 'maria@gmail.com', '7896-8574', 'employee/2/fotografia.png', '2021-01-12 04:04:33', 'Inactivo', 1),
(3, 'Sofia', 'Duran', '78968574-4', '1005-446465-165-1', '1999-05-16', 'Femenino', 'Vendedor', 'San Vicente', 'sofia@gmail.com', '7859-6857', 'employee/3/fotografia.png', '2021-01-12 04:32:11', 'Inactivo', 1),
(4, 'maria cristina', 'vega escamilla', '78451626-2', '1000-556498-499-2', '1998-02-08', 'Masculino', 'Administrador', 'San Esteban Catarinaa', 'mariaa@gmail.com', '7896-8572', 'employee/4/fotografia.png', '2021-01-13 17:48:06', 'Activo', 1),
(5, 'maria julia', 'vega martinez', '78451626-5', '1000-556498-499-5', '1995-02-08', 'Masculino', 'Administrador', 'San Esteban Catarinaa', 'mariajulia@gmail.com', '7896-8575', 'employee/5/fotografia.png', '2021-01-13 17:51:26', 'Activo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `id_producto` int(11) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `nombre` text NOT NULL,
  `marca` text NOT NULL,
  `modelo` text NOT NULL,
  `margen_ganancia` int(11) NOT NULL,
  `stock_minimo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `descripcion` text NOT NULL,
  `fotografia` text NOT NULL,
  `categoria` text NOT NULL,
  `proveedor` int(11) NOT NULL,
  `fecha_ingreso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `estado` varchar(8) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `codigo`, `nombre`, `marca`, `modelo`, `margen_ganancia`, `stock_minimo`, `cantidad`, `precio`, `descripcion`, `fotografia`, `categoria`, `proveedor`, `fecha_ingreso`, `estado`, `id_usuario`) VALUES
(1, 'la0001', 'lavadora', 'cetro', 'eco', 10, 5, 0, '350.00', 'lavadora blanca', 'product/1/producto.png', 'Cocinas', 1, '2021-01-06 17:27:39', 'Activo', 1),
(2, 'ca0002', 'camarote', 'cetro', 'eco', 15, 3, 2, '400.00', 'color cafe', '', 'Muebles', 1, '2021-01-07 22:56:54', 'Activo', 1),
(3, 'la0003', 'lampara', 'economica', 'reciente', 6, 3, 0, '0.00', 'color negro y blanco', 'product/3/producto.png', 'Muebles', 2, '2021-01-14 21:16:31', 'Inactivo', 1),
(4, 'Re0004', 'Revestidero y porta papeles', 'Sandisk', '4892', 30, 5, 0, '0.00', 'Decora los espacios de tu baño con este útil y práctico revistero y porta papel metálico, organiza tus revistas y coloca el papel higiénico para que se vea ordenado.', '', 'Hogar', 2, '2021-01-16 13:40:33', 'Activo', 1),
(5, 'Re0005', 'Reloj de pared', 'Bulova', 'C3542', 30, 5, 0, '0.00', 'Caja de madera y acentos decorativos, acabado nogal vintage. Carátula metálica. Cristal decorativo. 3 melodías: Westminster, ave-maría o bim-bam cada hora. Westminster o campanada cada cuarto de hora.', '', 'Hogar', 2, '2021-01-16 13:44:59', 'Activo', 1),
(6, 'So0006', 'Sofa Cama', ' Home Furniture', 'Nicky', 30, 5, 10, '455.00', 'Las tendencias de la moda en el diseño de muebles están recuperando los días de líneas audaces, formas discretas y acentos de madera.', '', 'Muebles', 1, '2021-01-17 15:14:12', 'Activo', 1),
(7, 'So0007', 'Sofá gris oscuro Synthia', 'Home Furniture', 'SYNTHIA', 30, 5, 0, '0.00', 'Consigue la mayor comodidad, combinada con un diseño moderno, gracias a este sofá que te ofrecerá horas de descanso y desconexión. ', '', 'Muebles', 2, '2021-01-16 13:53:26', 'Activo', 1),
(8, 'Ca0008', 'Camarote individual', 'Home Furniture', '8434', 30, 5, 0, '0.00', 'Camarote para colchones de tamaño individual, color blanco. En su frente se encuentra una escalera de 3 peldaños para acceder al 2 nivel.', '', 'Muebles', 1, '2021-01-16 13:59:35', 'Activo', 1),
(9, 'Me0009', 'Mesa comedor rectangular', 'Home Furniture', 'Rectangular', 30, 5, 10, '560.00', 'Mesa rectangular para comedor que transforma tu área de comedor en un lugar sofisticado y exclusivo hecha de vidrio, y completa tu juego con la cantidad de sillas que mas te convenga.', '', 'Muebles', 2, '2021-01-17 15:14:12', 'Activo', 1),
(10, 'Co0010', 'Cocina eléctrica ', 'Whirlpool', '102858260', 30, 5, 10, '560.00', 'Este horno de convección eléctrico Whirlpool® con ventilador de convección le ayuda a llevar la cena a la mesa. Omita el precalentamiento para favoritos como la pizza con la tecnología Frozen Bake ™.', '', 'Cocinas', 2, '2021-01-17 15:09:36', 'Activo', 1),
(11, 'Co0011', 'Cocina Samsung', 'Samsung', 'NX52T5311LS', 30, 5, 0, '0.00', 'Cocine de manera rápida y eficiente con un quemador Rapido, que permite una cocción más rápida y un control de temperatura fácilmente ajustable. Con solo girar un dial, ', '', 'Cocinas', 1, '2021-01-17 07:27:53', 'Activo', 1),
(12, 'Co0012', 'Cocina a gas de mesa', 'Whirlpool', 'WP2420S', 30, 5, 10, '450.00', 'Cocina a gas de mesa 24 Whirlpool con rejillas de hierro fundido con bisagras.', '', 'Cocinas', 1, '2021-01-17 15:09:36', 'Activo', 1),
(13, 'La0013', 'Lavadora carga superior', 'Whirlpool', '8MWTWLA31WJG', 30, 5, 0, '0.00', 'avadora Carga Superior con gran capacidad de 22 kg Whirlpool color Gun Metal con panel Shadow grey, cuenta con sistema de lavado Xpert System,', '', 'Lavadoras', 1, '2021-01-17 07:37:56', 'Activo', 1),
(14, 'La0014', 'Lavadora carga frontal', 'Whirlpool', '7MWFW6621HC', 30, 5, 0, '0.00', 'LAVADORA GRIS 21 KG', '', 'Lavadoras', 1, '2021-01-17 07:40:26', 'Activo', 1),
(15, 'La0015', 'Lavadora automática', ' General Electric', 'LGH72201WBAB0', 30, 5, 10, '760.00', 'Lavadora automática con capacidad de carga de 22 Kg; Gran capacidad: Ahorra tiempo lavando más en menos cargas. ', '', 'Lavadoras', 2, '2021-01-17 15:14:12', 'Activo', 1),
(16, 'La0016', 'Laptop gaming Acer Predator ', ' Acer', 'NH.Q53AL.003', 30, 5, 10, '1672.00', 'La computadora portátil para juegos Acer Predator Helios 300 viene con especificaciones de alto nivel, un procesador Intel Core i7-9750H de 6 núcleos de novena generación 2 6 GHz con tecnología Turbo Boost, pantalla \"Full HD (1920 x 1080) LED de pantalla.', '', 'Computo', 2, '2021-01-17 15:09:36', 'Activo', 1),
(17, 'La0017', 'Laptop HP gaming Omen ', 'Hewlett Packard', '15-EK0007LA', 30, 5, 0, '0.00', 'LA laptop para juegos. La OMEN 15 posee un potente procesador Intel Core i7 10ma generacióny gráficos Intel UHD en un marco compacto. ', '', 'Computo', 1, '2021-01-17 07:56:25', 'Activo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
CREATE TABLE IF NOT EXISTS `proveedor` (
  `id_proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text NOT NULL,
  `nit` varchar(17) NOT NULL,
  `nombre_responsable` text NOT NULL,
  `apellido_responsable` text NOT NULL,
  `direccion` text NOT NULL,
  `correo` varchar(150) NOT NULL,
  `telefono` text NOT NULL,
  `observaciones` text NOT NULL,
  `fecha_ingreso` timestamp NOT NULL,
  `estado` varchar(8) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `nombre`, `nit`, `nombre_responsable`, `apellido_responsable`, `direccion`, `correo`, `telefono`, `observaciones`, `fecha_ingreso`, `estado`, `id_usuario`) VALUES
(1, 'ABC', '5484-856123-123-1', 'Juan', 'Vega', 'San Vicente', 'abc@gmail.com', '7857-4444', '', '2020-11-28 15:44:48', 'Activo', 1),
(2, 'gte', '5154-986468-646-5', 'Maria', 'Duran', 'San Vicente', 'gte@gmail.com', '7896-8574', 'Ninguna', '2020-11-28 18:38:53', 'Activo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

DROP TABLE IF EXISTS `sucursal`;
CREATE TABLE IF NOT EXISTS `sucursal` (
  `id_sucursal` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `nit` varchar(17) NOT NULL,
  `nrc` varchar(10) NOT NULL,
  `giro` varchar(200) NOT NULL,
  `iva` decimal(10,2) NOT NULL,
  `direccion` text NOT NULL,
  `correo` varchar(150) NOT NULL,
  `telefono` text NOT NULL,
  `logo` text NOT NULL,
  `fecha_update` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`id_sucursal`, `nombre`, `codigo`, `nit`, `nrc`, `giro`, `iva`, `direccion`, `correo`, `telefono`, `logo`, `fecha_update`) VALUES
(1, 'sucursal casa matriz', 'su0001', '4755-555555-555-5', '755645-6', 'Ventas', '13.00', 'San Vicente', 'sucursal@gmail.com', '2258-9684', 'files/logo.png', '2021-01-09 01:56:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `apellido` text COLLATE utf8_spanish_ci NOT NULL,
  `dui` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `nit` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(75) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(75) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `nivel` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `respuesta_secreta` text COLLATE utf8_spanish_ci NOT NULL,
  `id_jefe` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `dui`, `nit`, `usuario`, `clave`, `correo`, `nivel`, `estado`, `respuesta_secreta`, `id_jefe`) VALUES
(1, 'Suyapa ', 'Martinez', '789685-8', '', 'Suyapa', '123456', 'suyapa@gmail.com', 'Administrador', 'Activo', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_contado`
--

DROP TABLE IF EXISTS `venta_contado`;
CREATE TABLE IF NOT EXISTS `venta_contado` (
  `id_venta_contado` int(11) NOT NULL,
  `tipo_comprobante` varchar(200) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `cliente` text NOT NULL,
  `fecha_ingreso` timestamp NOT NULL,
  `estado` varchar(9) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_venta_contado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta_contado`
--

INSERT INTO `venta_contado` (`id_venta_contado`, `tipo_comprobante`, `codigo`, `monto`, `cliente`, `fecha_ingreso`, `estado`, `id_usuario`) VALUES
(1, 'Ticket', '000001', '385.00', 'marcos vega', '2021-01-08 02:24:46', 'Cancelado', 1),
(2, 'Ticket', '000002', '920.00', '', '2021-01-08 12:10:14', 'Cancelado', 1),
(3, 'Ticket', '000003', '385.00', '', '2021-01-08 12:15:41', 'Cancelado', 1),
(4, 'Ticket', '000003', '385.00', '', '2021-01-08 12:15:41', 'Cancelado', 1),
(5, 'Ticket', '000005', '460.00', '', '2021-01-08 12:19:45', 'Cancelado', 1),
(6, 'Ticket', '000006', '460.00', 'samuel', '2021-01-08 13:28:29', 'Cancelado', 1),
(7, 'Ticket', '000007', '385.00', 'maria vega', '2021-01-08 13:34:24', 'Cancelado', 1),
(8, 'Ticket', '000007', '385.00', 'maria vega', '2021-01-08 13:34:24', 'Cancelado', 1),
(9, 'Ticket', '000009', '460.00', '', '2021-01-08 14:26:33', 'Cancelado', 1),
(10, 'Ticket', '000010', '460.00', '', '2021-01-08 22:32:49', 'Cancelado', 1),
(11, 'Ticket', '000011', '460.00', '', '2021-01-08 22:52:09', 'Cancelado', 1),
(12, 'Ticket', '000012', '920.00', '', '2021-01-09 01:08:40', 'Cancelado', 1),
(13, 'Ticket', '000013', '460.00', '', '2021-01-09 01:17:34', 'Cancelado', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
