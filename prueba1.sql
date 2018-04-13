-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 13-04-2018 a las 13:36:30
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
(1, 'Diego Villaverde Prado', '776648373'),
(2, 'Roberto Andres Ledesma', '645678954'),
(3, 'Educardo Ponce Moraga', '654321987'),
(4, 'Cristina Martín', '645678954'),
(5, 'remodificado', '456'),
(9, 'Alta modificada - 5 Abril 2018', '555777999'),
(11, 'Prueba alta - 5 Abril 2018', '00009999'),
(13, 'Alta modificada sin errores', '20189596'),
(14, 'Alta 6 de Abril de 2018', '87767766'),
(26, 'Hola que tal', '123'),
(27, 'prueba contacto refresh ', '242432'),
(28, 'qweqwe', '132123'),
(29, 'Victor 2123', '123123');

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
(7, 1, 'DANIEL BERNAT SOBRINO', '904858234'),
(19, 4, '123', '123'),
(20, 4, 'Probando alta de contactos', '1231321321'),
(21, 4, 'Añadiendo contactos', '13123123'),
(22, 4, 'Contacto nuevo', '123'),
(25, 4, 'prueba contacto refresh ', '242432'),
(27, 4, 'qwerty', '12341234'),
(28, 4, 'prueba contacto refresg', '123123123'),
(33, 3, 'Prueba modificacion de campos', '12313'),
(36, 5, '123', '2123'),
(37, 5, '123132', '123123'),
(38, 1, 'María Navarro Velazquez', '634576838'),
(40, 3, 'Marty McFly', '555555555'),
(41, 3, 'adsad', '12123'),
(42, 3, 'contacto añadido', '123123');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT de la tabla `Contactos`
--
ALTER TABLE `Contactos`
  MODIFY `id_contacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Contactos`
--
ALTER TABLE `Contactos`
  ADD CONSTRAINT `contactos_ibfk_1` FOREIGN KEY (`id_referente`) REFERENCES `Clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
