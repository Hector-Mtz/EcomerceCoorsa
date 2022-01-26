-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-01-2022 a las 17:03:37
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ecomerce`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idCate` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idCate`, `categoria`, `parent_id`) VALUES
(1, 'Bolleria', 1),
(2, 'Pan Dulce', 1),
(3, 'Donas', 1),
(4, 'Manzanas', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `idDept` int(11) NOT NULL,
  `departamento` varchar(50) NOT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`idDept`, `departamento`, `parent_id`) VALUES
(1, 'Panaderia', NULL),
(3, 'Fruteria', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `idImg` int(10) NOT NULL,
  `link` varchar(200) NOT NULL,
  `idProducto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`idImg`, `link`, `idProducto`) VALUES
(1, '2267284.jpg', 1),
(2, '4184768.jpg', 1),
(4, '14903812785686.jpg', NULL),
(5, 'manzana_roja.jpg', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pivot_precios_productos`
--

CREATE TABLE `pivot_precios_productos` (
  `idPrecio` int(11) NOT NULL,
  `Precio` int(11) NOT NULL,
  `idTipoPrecio` int(11) NOT NULL,
  `idProduc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pivot_precios_productos`
--

INSERT INTO `pivot_precios_productos` (`idPrecio`, `Precio`, `idTipoPrecio`, `idProduc`) VALUES
(1, 20, 1, 1),
(2, 35, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProd` int(11) NOT NULL,
  `producto` varchar(50) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `idImg` int(10) DEFAULT NULL,
  `idPrecio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProd`, `producto`, `parent_id`, `idImg`, `idPrecio`) VALUES
(1, 'Cruasan', 1, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoprecios`
--

CREATE TABLE `tipoprecios` (
  `idTipoPrecio` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipoprecios`
--

INSERT INTO `tipoprecios` (`idTipoPrecio`, `nombre`) VALUES
(1, 'NORMAL'),
(2, 'TEMPORADA NARANJA');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idCate`),
  ADD KEY `categorias_departamentos` (`parent_id`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`idDept`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`idImg`),
  ADD KEY `imagenes_productos` (`idProducto`);

--
-- Indices de la tabla `pivot_precios_productos`
--
ALTER TABLE `pivot_precios_productos`
  ADD PRIMARY KEY (`idPrecio`),
  ADD KEY `precio_tipoprecio` (`idTipoPrecio`),
  ADD KEY `precio_producto` (`idProduc`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProd`),
  ADD KEY `productos_categorias` (`parent_id`),
  ADD KEY `pivotPrecio_productos` (`idPrecio`),
  ADD KEY `productos_imagenes` (`idImg`);

--
-- Indices de la tabla `tipoprecios`
--
ALTER TABLE `tipoprecios`
  ADD PRIMARY KEY (`idTipoPrecio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idCate` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `idDept` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `idImg` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pivot_precios_productos`
--
ALTER TABLE `pivot_precios_productos`
  MODIFY `idPrecio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipoprecios`
--
ALTER TABLE `tipoprecios`
  MODIFY `idTipoPrecio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `categorias_departamentos` FOREIGN KEY (`parent_id`) REFERENCES `departamentos` (`idDept`);

--
-- Filtros para la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `imagenes_productos` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProd`);

--
-- Filtros para la tabla `pivot_precios_productos`
--
ALTER TABLE `pivot_precios_productos`
  ADD CONSTRAINT `precio_producto` FOREIGN KEY (`idProduc`) REFERENCES `productos` (`idProd`),
  ADD CONSTRAINT `precio_tipoprecio` FOREIGN KEY (`idTipoPrecio`) REFERENCES `tipoprecios` (`idTipoPrecio`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `pivotPrecio_productos` FOREIGN KEY (`idPrecio`) REFERENCES `pivot_precios_productos` (`idPrecio`),
  ADD CONSTRAINT `productos_categorias` FOREIGN KEY (`parent_id`) REFERENCES `categorias` (`idCate`),
  ADD CONSTRAINT `productos_imagenes` FOREIGN KEY (`idImg`) REFERENCES `imagenes` (`idImg`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
