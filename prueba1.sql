-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 04-04-2018 a las 16:09:29
-- Versión del servidor: 5.6.35
-- Versión de PHP: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `prueba1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Clientes`
--

CREATE TABLE `Clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `telefono` varchar(10) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `Clientes`
--

INSERT INTO `Clientes` (`id`, `nombre`, `telefono`) VALUES
(1, 'Diego Villaverde Prado', '6757473717'),
(2, 'Roberto Andres Ledesma', '645678954'),
(3, 'Educardo Ponce Moraga', '654321987'),
(4, 'Cristina Martín', '645678954'),
(5, 'prueba modificacion', '987654321'),
(9, 'Prueba alta', '123123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Contactos`
--

CREATE TABLE `Contactos` (
  `id_contacto` int(11) NOT NULL,
  `id_referente` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `telefono` varchar(10) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `Contactos`
--

INSERT INTO `Contactos` (`id_contacto`, `id_referente`, `nombre`, `telefono`) VALUES
(1, 2, 'MANUEL CALDERON ESTRADA', '123456789'),
(2, 3, 'TERESA IBAÑEZ DE DIEGO', '987654321'),
(3, 2, 'ANA MARIA CARREIRA GEORGIEVA', '984502393'),
(4, 1, 'ANTONIO MARIÑO CARRION', '123456789'),
(5, 1, 'TERESA BERTRAN PAREJO', '876543987'),
(6, 1, 'ALBA MUÑOZ MONTSERRAT', '564387267'),
(7, 1, 'DANIEL BERNAT SOBRINO', '904858234');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Clientes`
--
ALTER TABLE `Clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Contactos`
--
ALTER TABLE `Contactos`
  ADD PRIMARY KEY (`id_contacto`),
  ADD KEY `contactos_ibfk_1` (`id_referente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Clientes`
--
ALTER TABLE `Clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `Contactos`
--
ALTER TABLE `Contactos`
  MODIFY `id_contacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Contactos`
--
ALTER TABLE `Contactos`
  ADD CONSTRAINT `contactos_ibfk_1` FOREIGN KEY (`id_referente`) REFERENCES `Clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
