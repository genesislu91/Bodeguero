-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 02-11-2011 a las 06:48:18
-- Versión del servidor: 5.5.8
-- Versión de PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `bodeguero`
--
CREATE DATABASE `bodeguero` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bodeguero`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `categoriaId` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `usuarioId` int(11) NOT NULL,
  PRIMARY KEY (`categoriaId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcar la base de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`categoriaId`, `nombre`, `descripcion`, `usuarioId`) VALUES
(1, 'yogures', 'yogures', 1),
(2, 'leche', 'leche', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `clienteId` int(11) NOT NULL AUTO_INCREMENT,
  `fechaRegistro` date NOT NULL,
  `personaId` int(11) NOT NULL,
  `usuarioId` int(11) NOT NULL,
  PRIMARY KEY (`clienteId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`clienteId`, `fechaRegistro`, `personaId`, `usuarioId`) VALUES
(1, '2011-10-30', 2, 1),
(2, '2011-10-12', 4, 1),
(3, '2011-10-12', 6, 1),
(4, '2011-10-03', 8, 1),
(5, '2011-10-03', 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE IF NOT EXISTS `compra` (
  `compraId` int(11) NOT NULL AUTO_INCREMENT,
  `montoTotal` float NOT NULL,
  `fechaCompra` date NOT NULL,
  `proveedorId` int(11) NOT NULL,
  `usuarioId` int(11) NOT NULL,
  PRIMARY KEY (`compraId`),
  KEY `venta_proveedor_fk` (`proveedorId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `compra`
--

INSERT INTO `compra` (`compraId`, `montoTotal`, `fechaCompra`, `proveedorId`, `usuarioId`) VALUES
(1, 120, '2011-10-13', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallecompra`
--

CREATE TABLE IF NOT EXISTS `detallecompra` (
  `detalleCompraId` int(11) NOT NULL AUTO_INCREMENT,
  `compraId` int(11) NOT NULL,
  `productoId` int(11) NOT NULL,
  `precioCompra` float NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  PRIMARY KEY (`detalleCompraId`),
  KEY `detalleCompra_compra_fk` (`compraId`),
  KEY `detalleCompra_producto_fk` (`productoId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `detallecompra`
--

INSERT INTO `detallecompra` (`detalleCompraId`, `compraId`, `productoId`, `precioCompra`, `cantidad`, `subtotal`) VALUES
(1, 1, 1, 1.2, 100, 120);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleventa`
--

CREATE TABLE IF NOT EXISTS `detalleventa` (
  `detalleVentaId` int(11) NOT NULL AUTO_INCREMENT,
  `ventaId` int(11) NOT NULL,
  `productoId` int(11) NOT NULL,
  `precioVenta` float NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  PRIMARY KEY (`detalleVentaId`),
  KEY `detalleventa_venta_fk` (`ventaId`),
  KEY `detalleventa_producto_fk` (`productoId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `detalleventa`
--

INSERT INTO `detalleventa` (`detalleVentaId`, `ventaId`, `productoId`, `precioVenta`, `cantidad`, `subtotal`) VALUES
(1, 1, 1, 1.5, 10, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE IF NOT EXISTS `marca` (
  `marcaId` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `usuarioId` int(11) NOT NULL,
  PRIMARY KEY (`marcaId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `marca`
--

INSERT INTO `marca` (`marcaId`, `nombre`, `usuarioId`) VALUES
(1, 'gloria', 1),
(2, 'laive', 1),
(3, 'milkito', 1),
(4, 'sbelt', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcacategoria`
--

CREATE TABLE IF NOT EXISTS `marcacategoria` (
  `marcaCategoriaId` int(11) NOT NULL AUTO_INCREMENT,
  `marcaId` int(11) NOT NULL,
  `categoriaId` int(11) NOT NULL,
  PRIMARY KEY (`marcaCategoriaId`),
  KEY `marcacategoria_categoria_fk` (`categoriaId`),
  KEY `marcacategoria_marca_fk` (`marcaId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `marcacategoria`
--

INSERT INTO `marcacategoria` (`marcaCategoriaId`, `marcaId`, `categoriaId`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacion`
--

CREATE TABLE IF NOT EXISTS `notificacion` (
  `notificacionId` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(120) NOT NULL,
  `fecha` date NOT NULL,
  `usuarioId` int(11) NOT NULL,
  PRIMARY KEY (`notificacionId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `notificacion`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE IF NOT EXISTS `persona` (
  `personaId` int(11) NOT NULL AUTO_INCREMENT,
  `telefono` varchar(20) NOT NULL,
  `correoElectronico` varchar(30) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  PRIMARY KEY (`personaId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcar la base de datos para la tabla `persona`
--

INSERT INTO `persona` (`personaId`, `telefono`, `correoElectronico`, `direccion`) VALUES
(1, '4724698', 'genesislu91@hotmail.com', 'psje manuel castañeda 284 Santa Beatriz'),
(2, '991305067', 'vygthor_7@hotmail.com', 'jr ruy diaz 163 callao'),
(3, '2647898', 'josemgu@hotmail.com', ''),
(4, '2647897', 'yazmin-lopez.u@hotmail.com', ''),
(5, '2647896', 'juanperez@hotmail.com', ''),
(6, '2647895', 'pepevazques@hotmail.com', ''),
(7, '2647894', 'gianella@hotmail.com', ''),
(8, '2647893', 'camila@hotmail.com', ''),
(9, '2647892', 'wendy@hotmail.com', ''),
(10, '2647891', 'carolina@hotmail.com', ''),
(11, '2647899', 'milagros@hotmail.com', ''),
(12, '2647890', 'marialopez@hotmail.com', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personajuridica`
--

CREATE TABLE IF NOT EXISTS `personajuridica` (
  `personaJuridicaId` int(11) NOT NULL AUTO_INCREMENT,
  `razonSocial` varchar(40) NOT NULL,
  `ruc` varchar(11) NOT NULL,
  PRIMARY KEY (`personaJuridicaId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcar la base de datos para la tabla `personajuridica`
--

INSERT INTO `personajuridica` (`personaJuridicaId`, `razonSocial`, `ruc`) VALUES
(1, 'la bodeguita S.A.C', '20545186684'),
(3, 'DISTRIBUIDORA GLORIA E.I.R.L.', '20281541197'),
(5, 'LAIVE S A', '20100095450'),
(7, 'COCA-COLA SERVICIOS DE PERU S.A', '20415932376'),
(9, 'AJEPER S.A.', '20331061655'),
(8, 'Empresa de Galletas S.A', '12345678'),
(11, 'Fiestas Infantiles S.A', '12345679');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personanatural`
--

CREATE TABLE IF NOT EXISTS `personanatural` (
  `personaNaturalId` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `apellidoPaterno` varchar(30) NOT NULL,
  `apellidoMaterno` varchar(30) NOT NULL,
  `dni` varchar(8) NOT NULL,
  PRIMARY KEY (`personaNaturalId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcar la base de datos para la tabla `personanatural`
--

INSERT INTO `personanatural` (`personaNaturalId`, `nombre`, `apellidoPaterno`, `apellidoMaterno`, `dni`) VALUES
(2, 'victor', 'salazar', 'cuya', '47132461'),
(4, 'jose', 'garcia', 'perez', '45678930'),
(6, 'juana', 'perez', 'lopez', '45678931'),
(10, 'ana', 'calderon', 'perez', '45671930');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `productoId` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(80) NOT NULL,
  `precioVenta` float NOT NULL,
  `precioCompra` float NOT NULL,
  `cantidad` int(11) NOT NULL,
  `unidadMedidaId` int(11) NOT NULL,
  `marcaCategoriaId` int(11) NOT NULL,
  `proveedorId` int(11) NOT NULL,
  `usuarioId` int(11) NOT NULL,
  PRIMARY KEY (`productoId`),
  KEY `producto_unidadMedida_fk` (`unidadMedidaId`),
  KEY `producto_marcacategoria_fk` (`marcaCategoriaId`),
  KEY `producto_proveedor_fk` (`proveedorId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `producto`
--

INSERT INTO `producto` (`productoId`, `nombre`, `descripcion`, `precioVenta`, `precioCompra`, `cantidad`, `unidadMedidaId`, `marcaCategoriaId`, `proveedorId`, `usuarioId`) VALUES
(1, 'milkito 100ml', 'yogurt milkito', 1.5, 1.2, 90, 1, 3, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE IF NOT EXISTS `proveedor` (
  `proveedorId` int(11) NOT NULL AUTO_INCREMENT,
  `personaJuridicaId` int(11) NOT NULL,
  `usuarioId` int(11) NOT NULL,
  PRIMARY KEY (`proveedorId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`proveedorId`, `personaJuridicaId`, `usuarioId`) VALUES
(1, 3, 1),
(2, 5, 1),
(3, 7, 1),
(4, 9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidadmedida`
--

CREATE TABLE IF NOT EXISTS `unidadmedida` (
  `unidadMedidaId` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  PRIMARY KEY (`unidadMedidaId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `unidadmedida`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `usuarioId` int(11) NOT NULL AUTO_INCREMENT,
  `nombreUsuario` varchar(30) NOT NULL,
  `contrasenia` varchar(50) NOT NULL,
  `fechaRegistro` date NOT NULL,
  `personaJuridicaId` int(11) NOT NULL,
  PRIMARY KEY (`usuarioId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuarioId`, `nombreUsuario`, `contrasenia`, `fechaRegistro`, `personaJuridicaId`) VALUES
(1, 'genesislu91', 'vyg4ever', '2011-10-27', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE IF NOT EXISTS `venta` (
  `ventaId` int(11) NOT NULL AUTO_INCREMENT,
  `montoTotal` float NOT NULL,
  `fechaVenta` date NOT NULL,
  `clienteId` int(11) NOT NULL,
  `usuarioId` int(11) NOT NULL,
  PRIMARY KEY (`ventaId`),
  KEY `venta_cliente_fk` (`clienteId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `venta`
--

INSERT INTO `venta` (`ventaId`, `montoTotal`, `fechaVenta`, `clienteId`, `usuarioId`) VALUES
(1, 15, '2011-10-06', 1, 1);
