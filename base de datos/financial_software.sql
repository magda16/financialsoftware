-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 09-01-2021 a las 02:02:51
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

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id_compra`, `tipo_pago`, `monto`, `fecha`, `fecha_ingreso`, `estado`, `id_usuario`) VALUES
(1, 'Contado', '7000.00', '2021-01-03', '2021-01-07 00:59:49', 'Cancelado', 1),
(2, 'Contado', '8000.00', '2021-01-03', '2021-01-07 22:58:25', 'Cancelado', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_compra`
--

INSERT INTO `detalle_compra` (`id_d_c`, `cantidad`, `precio`, `id_producto`, `id_compra`) VALUES
(1, 20, '350.00', 1, 1),
(2, 20, '400.00', 2, 2);

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
(1, 'la0001', 'lavadora', 'cetro', 'eco', 10, 5, 0, '350.00', 'lavadora blanca', 'Lavadoras', 1, '2021-01-06 17:27:39', 'Activo', 1),
(2, 'ca0002', 'camarote', 'cetro', 'eco', 15, 3, 2, '400.00', 'color cafe', 'Muebles', 1, '2021-01-07 22:56:54', 'Activo', 1);

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
