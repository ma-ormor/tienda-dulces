
drop database if exists `tienda`;

create database tienda;

use tienda;

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
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `v_clave` int(11) NOT NULL,
  `p_clave` int(11) NOT NULL,
  `p_cantidad` int(11) NOT NULL,
  `p_costo` double NOT NULL
);

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
);

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
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `u_clave` int(11) NOT NULL,
  `u_alias` varchar(30) NOT NULL,
  `u_contrasena` varchar(30) NOT NULL,
  `u_rol` varchar(10) NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `v_clave` int(11) NOT NULL,
  `v_fecha` date NOT NULL,
  `v_estado` varchar(20) NOT NULL,
  `u_clave` int(11) NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_pedido`
--

CREATE TABLE `venta_pedido` (
  `v_clave` int(11) NOT NULL,
  `pe_clave` int(11) NOT NULL
);

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
  MODIFY `pe_clave` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `p_clave` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `u_clave` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `v_clave` int(11) NOT NULL AUTO_INCREMENT;

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
  
-- Registros --
INSERT INTO `usuario` (`u_alias`, `u_contrasena`, `u_rol`) VALUES
('Noe', '12345', 'A'),
('Jazmin', '12345', 'A'),
('Cesar', '12345', 'U'),
('Angel', '12345', 'U');

INSERT INTO `producto` (`p_nombre`, `p_descripcion`, `p_cantidad`, `p_costo` ) VALUES
('Gomitas', 'Gomitas de sabores variados', 50, 25),
('Paletas', 'Paletas de fresa y piña', 30, 35),
('Chicles', 'Chicles de sabores variados', 40, 10),
('Tamarindos', 'Tamarindos de la marca x', 10, 20);

Select * from `usuario`;
Select * from `producto`;

INSERT INTO `carrito_compras` (`u_clave`, `p_clave`, `p_cantidad`) VALUES
(1, 1, 2);

INSERT INTO `carrito_compras` (`u_clave`, `p_clave`, `p_cantidad`) VALUES
(2, 4, 6);



Select * from `carrito_compras`;

Select * from `carrito_compras` where u_clave= 1;



