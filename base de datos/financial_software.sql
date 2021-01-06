-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 06-01-2021 a las 23:20:29
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
-- Estructura de tabla para la tabla `catalogo_activos`
--

DROP TABLE IF EXISTS `catalogo_activos`;
CREATE TABLE IF NOT EXISTS `catalogo_activos` (
  `id_catalogo_activos` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` text NOT NULL,
  `categoria` text NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `fecha_ingreso` timestamp NOT NULL,
  `estado` varchar(8) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_catalogo_activos`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `catalogo_activos`
--

INSERT INTO `catalogo_activos` (`id_catalogo_activos`, `codigo`, `categoria`, `tipo`, `fecha_ingreso`, `estado`, `id_usuario`) VALUES
(1, 'AcT', 'Baterias', 'Otros Bienes Muebles', '2020-11-28 03:37:59', 'Activo', 1),
(2, 'uj78', 'laptop', 'Otros Bienes Muebles', '2020-12-23 18:46:59', 'Activo', 1);

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
  `fecha_ingreso` timestamp NOT NULL,
  `estado` varchar(8) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre`, `apellido`, `dui`, `nit`, `fecha_nac`, `genero`, `direccion`, `correo`, `telefono`, `fecha_ingreso`, `estado`, `id_usuario`) VALUES
(1, 'juan', 'molina', '78456165-6', '1005-856584-964-5', '2001-06-10', 'Masculino', 'san vicente', 'molina@gmail.com', '7896-8574', '2020-12-25 20:11:12', 'Activo', 1);

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
  `fecha_ingreso` timestamp NOT NULL,
  `estado` varchar(9) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'v15', 'Ventas', 'Ventas de art', '2020-11-28 00:24:15', 'Activo', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Disparadores `detalle_compra`
--
DROP TRIGGER IF EXISTS `update_producto`;
DELIMITER $$
CREATE TRIGGER `update_producto` AFTER INSERT ON `detalle_compra` FOR EACH ROW UPDATE producto SET cantidad=cantidad+NEW.cantidad, precio=(((cantidad-NEW.cantidad)*precio)+(NEW.cantidad*NEW.precio))/(cantidad) WHERE id_producto=NEW.id_producto
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
  `fecha_ingreso` timestamp NOT NULL,
  `estado` varchar(8) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_empleado`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_empleado`, `nombre`, `apellido`, `dui`, `nit`, `fecha_nac`, `genero`, `puesto`, `direccion`, `correo`, `telefono`, `fecha_ingreso`, `estado`, `id_usuario`) VALUES
(1, 'juan', 'vega', '84984948-4', '4456-546546-546-5', '2000-07-02', 'Masculino', 'Vendedor', 'San Vicente', 'juan@gmail.com', '(503) 7896-8574', '2020-11-23 00:23:31', 'Activo', 1);

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
  `categoria` text NOT NULL,
  `proveedor` int(11) NOT NULL,
  `fecha_ingreso` timestamp NOT NULL,
  `estado` varchar(8) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `codigo`, `nombre`, `marca`, `modelo`, `margen_ganancia`, `stock_minimo`, `cantidad`, `precio`, `descripcion`, `categoria`, `proveedor`, `fecha_ingreso`, `estado`, `id_usuario`) VALUES
(1, 'la0001', 'lavadora', 'cetro', 'eco', 10, 5, 0, '0.00', 'lavadora blanca', 'Lavadoras', 1, '2021-01-06 17:27:39', 'Activo', 1);

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
(1, 'ABC', '5484-856123-123-1', 'Juan', 'Vega', 'San Vicente', 'abc@gmail.com', '', '', '2020-11-28 15:44:48', 'Activo', 1),
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

INSERT INTO `sucursal` (`id_sucursal`, `nombre`, `codigo`, `nit`, `giro`, `iva`, `direccion`, `correo`, `telefono`, `logo`, `fecha_update`) VALUES
(1, 'sucursal', 'su0001', '4755-555555-555-5', 'Ventas', '13.00', 'San Vicente', 'su@gmail.com', '2258-9684', '', '2021-01-06 15:45:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(30) NOT NULL,
  `password` varchar(130) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(80) NOT NULL,
  `last_session` datetime DEFAULT NULL,
  `activacion` int(11) NOT NULL DEFAULT '0',
  `token` varchar(40) NOT NULL,
  `token_password` varchar(100) DEFAULT NULL,
  `password_request` int(11) DEFAULT '0',
  `id_tipo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `usuario`, `password`, `nombre`, `correo`, `last_session`, `activacion`, `token`, `token_password`, `password_request`, `id_tipo`) VALUES
(1, 'Magda', '$2y$10$2G9tGEYDdZ5v.zGmC9tz3.dGwRb/CqMYwebFlaAEn2VKWhdErsXwa', 'Magdalena', 'magdacordova2@gmail.com', '2020-09-10 16:59:52', 1, '93e23525a4ad5ae54a43c89ba48cea5a', '', 0, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
