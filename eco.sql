-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2021 a las 18:50:44
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `eco`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_asigimagenesprod`
--

CREATE TABLE `tbl_asigimagenesprod` (
  `idasigimagenprod` int(255) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `idimagenesprod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_categorias`
--

CREATE TABLE `tbl_categorias` (
  `idcategoria` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cliente`
--

CREATE TABLE `tbl_cliente` (
  `idcliente` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  `correo` varchar(100) DEFAULT '',
  `pass` varchar(50) DEFAULT NULL,
  `fechanacimiento` date DEFAULT NULL,
  `fecharegistro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_cliente`
--

INSERT INTO `tbl_cliente` (`idcliente`, `nombre`, `apellido`, `telefono`, `estado`, `correo`, `pass`, `fechanacimiento`, `fecharegistro`) VALUES
(14, 'Eduardo', 'Palacios', 11223344, 1, 'ea@gmail.com', NULL, '2021-08-18', '2021-11-10'),
(19, 'James', 'Roque', 22332211, 1, 'james@gmail.com', NULL, '2021-11-05', '2021-11-10'),
(21, 'David', 'Constanza', 22334455, 1, 'david@gmail.com', NULL, '2021-11-01', '2021-11-11'),
(30, 'Bryan Jose', 'Palacios', 7394, 1, 'bryannpalaciiozz@gmail.com', NULL, '2021-11-10', '2021-11-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_departamento`
--

CREATE TABLE `tbl_departamento` (
  `iddepartamento` int(11) NOT NULL,
  `nombre` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detallecarrito`
--

CREATE TABLE `tbl_detallecarrito` (
  `iddetallecarrito` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `idpresentacion` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detalleproducto`
--

CREATE TABLE `tbl_detalleproducto` (
  `iddetalleproducto` int(11) NOT NULL,
  `fechafabricacion` date DEFAULT NULL,
  `diasvidautil` int(11) DEFAULT NULL,
  `idproducto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detalleproductopedido`
--

CREATE TABLE `tbl_detalleproductopedido` (
  `iddetalleproductopedido` int(11) NOT NULL,
  `idpedido` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `presentacion` varchar(50) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_direccion`
--

CREATE TABLE `tbl_direccion` (
  `iddireccion` int(11) NOT NULL,
  `nombrerecibe` varchar(200) DEFAULT NULL,
  `direccionentrega` varchar(350) DEFAULT NULL,
  `referenciadireccion` varchar(200) DEFAULT NULL,
  `telefono` varchar(9) DEFAULT NULL,
  `idmunicipio` int(11) DEFAULT NULL,
  `idcliente` int(11) DEFAULT NULL,
  `predeterminada` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_empleado`
--

CREATE TABLE `tbl_empleado` (
  `idempleado` int(11) NOT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `apellido` varchar(60) DEFAULT NULL,
  `correo` varchar(60) DEFAULT NULL,
  `pass` varchar(60) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  `administrador` tinyint(4) DEFAULT NULL,
  `idempresa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_empresa`
--

CREATE TABLE `tbl_empresa` (
  `idempresa` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `telefono` varchar(9) DEFAULT NULL,
  `horario` varchar(200) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_imagenesprod`
--

CREATE TABLE `tbl_imagenesprod` (
  `idimagenesprod` int(255) NOT NULL,
  `urlimagen` varchar(255) DEFAULT NULL,
  `tipoimagen` varchar(255) DEFAULT NULL,
  `nombreimagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_municipio`
--

CREATE TABLE `tbl_municipio` (
  `idmunicipio` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `costoenvio` float DEFAULT NULL,
  `iddepartamento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pedido`
--

CREATE TABLE `tbl_pedido` (
  `Idpedido` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `fecharealizacion` date NOT NULL,
  `fechaentrega` date DEFAULT NULL,
  `formadepago` varchar(50) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `idestado` int(11) DEFAULT NULL,
  `idencargado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_presentacion`
--

CREATE TABLE `tbl_presentacion` (
  `idpresentacion` int(11) NOT NULL,
  `idproducto` int(11) DEFAULT NULL,
  `Tamanio` varchar(100) DEFAULT '',
  `Precio` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_productos`
--

CREATE TABLE `tbl_productos` (
  `idproducto` int(11) NOT NULL,
  `idcategoria` int(11) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `tiempoprocesamiento` int(11) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  `idimagen` int(11) DEFAULT NULL,
  `idrelleno` int(11) DEFAULT NULL,
  `idremojo` int(11) DEFAULT NULL,
  `idsabortorta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_relleno`
--

CREATE TABLE `tbl_relleno` (
  `idrelleno` int(11) NOT NULL,
  `saborrelleno` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_remojo`
--

CREATE TABLE `tbl_remojo` (
  `idremojo` int(11) NOT NULL,
  `saborremojo` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_sabortorta`
--

CREATE TABLE `tbl_sabortorta` (
  `idsabortorta` int(11) NOT NULL,
  `sabortorta` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_asigimagenesprod`
--
ALTER TABLE `tbl_asigimagenesprod`
  ADD PRIMARY KEY (`idasigimagenprod`),
  ADD KEY `fkidproducto` (`idproducto`),
  ADD KEY `fkidimagenesprod` (`idimagenesprod`);

--
-- Indices de la tabla `tbl_categorias`
--
ALTER TABLE `tbl_categorias`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `tbl_cliente`
--
ALTER TABLE `tbl_cliente`
  ADD PRIMARY KEY (`idcliente`);

--
-- Indices de la tabla `tbl_departamento`
--
ALTER TABLE `tbl_departamento`
  ADD PRIMARY KEY (`iddepartamento`);

--
-- Indices de la tabla `tbl_detallecarrito`
--
ALTER TABLE `tbl_detallecarrito`
  ADD PRIMARY KEY (`iddetallecarrito`),
  ADD KEY `fk_idpresentaciond` (`idpresentacion`),
  ADD KEY `fk_idclientec` (`idcliente`);

--
-- Indices de la tabla `tbl_detalleproducto`
--
ALTER TABLE `tbl_detalleproducto`
  ADD PRIMARY KEY (`iddetalleproducto`),
  ADD KEY `fk_idprod` (`idproducto`);

--
-- Indices de la tabla `tbl_detalleproductopedido`
--
ALTER TABLE `tbl_detalleproductopedido`
  ADD PRIMARY KEY (`iddetalleproductopedido`),
  ADD KEY `fk_idpedido` (`idpedido`);

--
-- Indices de la tabla `tbl_direccion`
--
ALTER TABLE `tbl_direccion`
  ADD PRIMARY KEY (`iddireccion`),
  ADD KEY `fk_idmunicipio` (`idmunicipio`),
  ADD KEY `fk_idclientedir` (`idcliente`);

--
-- Indices de la tabla `tbl_empleado`
--
ALTER TABLE `tbl_empleado`
  ADD PRIMARY KEY (`idempleado`),
  ADD KEY `fk_idempresa` (`idempresa`);

--
-- Indices de la tabla `tbl_empresa`
--
ALTER TABLE `tbl_empresa`
  ADD PRIMARY KEY (`idempresa`);

--
-- Indices de la tabla `tbl_imagenesprod`
--
ALTER TABLE `tbl_imagenesprod`
  ADD PRIMARY KEY (`idimagenesprod`);

--
-- Indices de la tabla `tbl_municipio`
--
ALTER TABLE `tbl_municipio`
  ADD PRIMARY KEY (`idmunicipio`),
  ADD KEY `fk_iddepartamento` (`iddepartamento`);

--
-- Indices de la tabla `tbl_pedido`
--
ALTER TABLE `tbl_pedido`
  ADD PRIMARY KEY (`Idpedido`),
  ADD KEY `fk_idclientepedido` (`idcliente`),
  ADD KEY `fk_idencargado` (`idencargado`);

--
-- Indices de la tabla `tbl_presentacion`
--
ALTER TABLE `tbl_presentacion`
  ADD PRIMARY KEY (`idpresentacion`),
  ADD KEY `fk_idproductop` (`idproducto`);

--
-- Indices de la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  ADD PRIMARY KEY (`idproducto`),
  ADD KEY `fk_idsabortorta` (`idsabortorta`),
  ADD KEY `fk_idsaborrelleno` (`idrelleno`),
  ADD KEY `fk_idsaborremojo` (`idremojo`),
  ADD KEY `fk_categoria` (`idcategoria`);

--
-- Indices de la tabla `tbl_relleno`
--
ALTER TABLE `tbl_relleno`
  ADD PRIMARY KEY (`idrelleno`);

--
-- Indices de la tabla `tbl_remojo`
--
ALTER TABLE `tbl_remojo`
  ADD PRIMARY KEY (`idremojo`);

--
-- Indices de la tabla `tbl_sabortorta`
--
ALTER TABLE `tbl_sabortorta`
  ADD PRIMARY KEY (`idsabortorta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_categorias`
--
ALTER TABLE `tbl_categorias`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_cliente`
--
ALTER TABLE `tbl_cliente`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `tbl_departamento`
--
ALTER TABLE `tbl_departamento`
  MODIFY `iddepartamento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_detallecarrito`
--
ALTER TABLE `tbl_detallecarrito`
  MODIFY `iddetallecarrito` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_detalleproducto`
--
ALTER TABLE `tbl_detalleproducto`
  MODIFY `iddetalleproducto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_detalleproductopedido`
--
ALTER TABLE `tbl_detalleproductopedido`
  MODIFY `iddetalleproductopedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_direccion`
--
ALTER TABLE `tbl_direccion`
  MODIFY `iddireccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_empleado`
--
ALTER TABLE `tbl_empleado`
  MODIFY `idempleado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_empresa`
--
ALTER TABLE `tbl_empresa`
  MODIFY `idempresa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_imagenesprod`
--
ALTER TABLE `tbl_imagenesprod`
  MODIFY `idimagenesprod` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_municipio`
--
ALTER TABLE `tbl_municipio`
  MODIFY `idmunicipio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_pedido`
--
ALTER TABLE `tbl_pedido`
  MODIFY `Idpedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_presentacion`
--
ALTER TABLE `tbl_presentacion`
  MODIFY `idpresentacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  MODIFY `idproducto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_relleno`
--
ALTER TABLE `tbl_relleno`
  MODIFY `idrelleno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_remojo`
--
ALTER TABLE `tbl_remojo`
  MODIFY `idremojo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_sabortorta`
--
ALTER TABLE `tbl_sabortorta`
  MODIFY `idsabortorta` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_asigimagenesprod`
--
ALTER TABLE `tbl_asigimagenesprod`
  ADD CONSTRAINT `fkidimagenesprod` FOREIGN KEY (`idimagenesprod`) REFERENCES `tbl_imagenesprod` (`idimagenesprod`),
  ADD CONSTRAINT `fkidproducto` FOREIGN KEY (`idproducto`) REFERENCES `tbl_productos` (`idproducto`);

--
-- Filtros para la tabla `tbl_detallecarrito`
--
ALTER TABLE `tbl_detallecarrito`
  ADD CONSTRAINT `fk_idclientec` FOREIGN KEY (`idcliente`) REFERENCES `tbl_cliente` (`idcliente`),
  ADD CONSTRAINT `fk_idpresentaciond` FOREIGN KEY (`idpresentacion`) REFERENCES `tbl_presentacion` (`idpresentacion`);

--
-- Filtros para la tabla `tbl_detalleproducto`
--
ALTER TABLE `tbl_detalleproducto`
  ADD CONSTRAINT `fk_idprod` FOREIGN KEY (`idproducto`) REFERENCES `tbl_productos` (`idproducto`);

--
-- Filtros para la tabla `tbl_detalleproductopedido`
--
ALTER TABLE `tbl_detalleproductopedido`
  ADD CONSTRAINT `fk_idpedido` FOREIGN KEY (`idpedido`) REFERENCES `tbl_pedido` (`Idpedido`);

--
-- Filtros para la tabla `tbl_direccion`
--
ALTER TABLE `tbl_direccion`
  ADD CONSTRAINT `fk_idclientedir` FOREIGN KEY (`idcliente`) REFERENCES `tbl_cliente` (`idcliente`),
  ADD CONSTRAINT `fk_idmunicipio` FOREIGN KEY (`idmunicipio`) REFERENCES `tbl_municipio` (`idmunicipio`);

--
-- Filtros para la tabla `tbl_empleado`
--
ALTER TABLE `tbl_empleado`
  ADD CONSTRAINT `fk_idempresa` FOREIGN KEY (`idempresa`) REFERENCES `tbl_empresa` (`idempresa`);

--
-- Filtros para la tabla `tbl_municipio`
--
ALTER TABLE `tbl_municipio`
  ADD CONSTRAINT `fk_iddepartamento` FOREIGN KEY (`iddepartamento`) REFERENCES `tbl_departamento` (`iddepartamento`);

--
-- Filtros para la tabla `tbl_pedido`
--
ALTER TABLE `tbl_pedido`
  ADD CONSTRAINT `fk_idclientepedido` FOREIGN KEY (`idcliente`) REFERENCES `tbl_cliente` (`idcliente`),
  ADD CONSTRAINT `fk_idencargado` FOREIGN KEY (`idencargado`) REFERENCES `tbl_empleado` (`idempleado`);

--
-- Filtros para la tabla `tbl_presentacion`
--
ALTER TABLE `tbl_presentacion`
  ADD CONSTRAINT `fk_idproductop` FOREIGN KEY (`idproducto`) REFERENCES `tbl_productos` (`idproducto`);

--
-- Filtros para la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`idcategoria`) REFERENCES `tbl_categorias` (`idcategoria`),
  ADD CONSTRAINT `fk_idsaborrelleno` FOREIGN KEY (`idrelleno`) REFERENCES `tbl_relleno` (`idrelleno`),
  ADD CONSTRAINT `fk_idsaborremojo` FOREIGN KEY (`idremojo`) REFERENCES `tbl_remojo` (`idremojo`),
  ADD CONSTRAINT `fk_idsabortorta` FOREIGN KEY (`idsabortorta`) REFERENCES `tbl_sabortorta` (`idsabortorta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
