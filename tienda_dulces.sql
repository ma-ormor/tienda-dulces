-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-12-2022 a las 02:37:10
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_dulces`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito_compras`
--

CREATE TABLE `carrito_compras` (
  `u_clave` int(11) NOT NULL,
  `p_clave` int(11) NOT NULL,
  `p_cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `v_clave` int(11) NOT NULL,
  `p_clave` int(11) NOT NULL,
  `p_cantidad` int(11) NOT NULL,
  `p_costo` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`v_clave`, `p_clave`, `p_cantidad`, `p_costo`) VALUES
(1, 10, 10, 10),
(1, 17, 10, 10),
(2, 11, 1, 50),
(2, 15, 3, 15),
(3, 13, 5, 15),
(3, 15, 5, 15),
(4, 8, 5, 10),
(4, 14, 5, 15),
(5, 12, 5, 15),
(5, 16, 15, 10);
(6, 17, 20, 10);//Apartir de aqui
(6, 18, 30, 7);
(7, 19, 50, 10);
(7, 20, 100, 1);
(7, 21, 100, 1);
(8, 22, 5, 75);
(9, 23, 5, 150);
(9, 24, 5, 55);
(10, 25, 5, 239);
(10, 26, 10, 129);
(10, 27, 10, 115);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `pe_clave` int(11) NOT NULL,
  `pe_fecha_env` date NOT NULL,
  `pe_fecha_ent` date NOT NULL,
  `pe_direccion` varchar(60) NOT NULL,
  `pe_estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`pe_clave`, `pe_fecha_env`, `pe_fecha_ent`, `pe_direccion`, `pe_estado`) VALUES
(1, '2022-12-05', '2022-12-06', '9365 Heaney Tunnel, Suite 820, 59586-3339, Roelstad', 'Enviado'),
(2, '2022-12-05', '2022-12-06', '6226 Armstrong Heights, Apt. 473, 94149, Alexzanderstad', 'Enviado'),
(3, '2022-12-05', '2022-12-06', '6781 Cristopher Fields, Apt. 754, 41873-3590, Magaliview', 'Enviado'),
(4, '2022-12-04', '2022-12-05', '629 Haag Harbor, Suite 328, 07278-2259, South Daisytown', 'Entregado'),
(5, '2022-12-04', '2022-12-05', '384 Rebeca Landing, Apt. 902, 30032, New Fatima, Wisconsin', 'Entregado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `p_clave` int(11) NOT NULL,
  `p_nombre` varchar(30) NOT NULL,
  `p_descripcion` varchar(255) NOT NULL,
  `p_cantidad` int(11) NOT NULL,
  `p_costo` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`p_clave`, `p_nombre`, `p_descripcion`, `p_cantidad`, `p_costo`) VALUES
(8, 'Mazapan', '1 pieza', 100, 10),
(9, 'M&M', 'Paquete 50g', 100, 10),
(10, 'Cacahuates', 'Paquete 100g', 100, 10),
(11, 'Cajeta de leche', 'Bote 1 litro', 100, 50),
(12, 'Rockaleta', '1 pieza', 100, 15),
(13, 'KitKat', '1 pieza', 100, 15),
(14, 'Snickers', '1 pieza', 100, 15),
(15, 'Lucas', '1 pieza', 100, 15),
(16, 'Pulparindo', '1 pieza', 100, 10),
(17, 'Alegrias', '1 pieza', 100, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `u_clave` int(11) NOT NULL,
  `u_alias` varchar(30) NOT NULL,
  `u_contrasena` varchar(30) NOT NULL,
  `u_rol` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`u_clave`, `u_alias`, `u_contrasena`, `u_rol`) VALUES
(6, 'Marco', 'pass', 'cliente'),
(9, 'Sandra', 'pass', 'cliente'),
(10, 'Pedro', 'pass', 'cliente'),
(11, 'Carlos', 'pass', 'cliente'),
(12, 'Enrique', 'pass', 'cliente'),
(13, 'Maria', 'pass', 'cliente'),
(14, 'admin', 'pass', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `v_clave` int(11) NOT NULL,
  `v_fecha` date NOT NULL,
  `v_estado` varchar(20) NOT NULL,
  `u_clave` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`v_clave`, `v_fecha`, `v_estado`, `u_clave`) VALUES
(1, '2022-12-05', 'Abierta', 11),
(2, '2022-12-05', 'Abierta', 12),
(3, '2022-12-05', 'Abierta', 12),
(4, '2022-12-04', 'Terminada', 13),
(5, '2022-12-04', 'Terminada', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_pedido`
--

CREATE TABLE `venta_pedido` (
  `v_clave` int(11) NOT NULL,
  `pe_clave` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta_pedido`
--

INSERT INTO `venta_pedido` (`v_clave`, `pe_clave`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito_compras`
--
ALTER TABLE `carrito_compras`
  ADD PRIMARY KEY (`u_clave`,`p_clave`),
  ADD KEY `p_clave` (`p_clave`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`v_clave`,`p_clave`),
  ADD KEY `p_clave` (`p_clave`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`pe_clave`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`p_clave`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`u_clave`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`v_clave`),
  ADD KEY `u_clave` (`u_clave`);

--
-- Indices de la tabla `venta_pedido`
--
ALTER TABLE `venta_pedido`
  ADD PRIMARY KEY (`v_clave`),
  ADD UNIQUE KEY `pe_clave` (`pe_clave`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `pe_clave` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `p_clave` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `u_clave` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `v_clave` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito_compras`
--
ALTER TABLE `carrito_compras`
  ADD CONSTRAINT `carrito_compras_ibfk_1` FOREIGN KEY (`u_clave`) REFERENCES `usuario` (`u_clave`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carrito_compras_ibfk_2` FOREIGN KEY (`p_clave`) REFERENCES `producto` (`p_clave`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`v_clave`) REFERENCES `venta` (`v_clave`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`p_clave`) REFERENCES `producto` (`p_clave`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`u_clave`) REFERENCES `usuario` (`u_clave`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta_pedido`
--
ALTER TABLE `venta_pedido`
  ADD CONSTRAINT `venta_pedido_ibfk_1` FOREIGN KEY (`pe_clave`) REFERENCES `pedido` (`pe_clave`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_pedido_ibfk_2` FOREIGN KEY (`v_clave`) REFERENCES `venta` (`v_clave`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;