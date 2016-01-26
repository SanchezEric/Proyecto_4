-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-01-2016 a las 08:55:15
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `bd_mycontacts`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE IF NOT EXISTS `contacto` (
`id_contacto` int(11) NOT NULL,
  `nombre_contacto` varchar(20) DEFAULT NULL,
  `apellidos_contacto` varchar(40) DEFAULT NULL,
  `id_ubicacion` int(11) DEFAULT NULL,
  `id_lista` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`id_contacto`, `nombre_contacto`, `apellidos_contacto`, `id_ubicacion`, `id_lista`) VALUES
(1, 'Brian', 'Flores Casco', 1, 1),
(2, 'Felipe', 'Iglesias', 2, 1),
(3, 'Alexis', 'Toledo Ruiz', 3, 2),
(4, 'Jordi', 'Cabrera Nieto', 4, 2),
(5, 'Pablo', 'López Tablero', 5, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista`
--

CREATE TABLE IF NOT EXISTS `lista` (
`id_lista` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `nombre_lista` varchar(30) DEFAULT NULL,
  `descripcion_lista` text
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lista`
--

INSERT INTO `lista` (`id_lista`, `id_usuario`, `nombre_lista`, `descripcion_lista`) VALUES
(1, 1, 'Colegas del barrio', 'Grupo de los amigos de toda la vida del barrio'),
(2, 1, 'Tetes', 'Mis tetes to rocosos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel`
--

CREATE TABLE IF NOT EXISTS `nivel` (
`id_nivel` int(11) NOT NULL,
  `nombre_nivel` varchar(10) DEFAULT NULL,
  `descripcion_nivel` text
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nivel`
--

INSERT INTO `nivel` (`id_nivel`, `nombre_nivel`, `descripcion_nivel`) VALUES
(1, 'root', 'Usuario máximo del sistema'),
(2, 'admin', 'Usuario con privilegios'),
(3, 'normal', 'Usuario básico del sistema');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion`
--

CREATE TABLE IF NOT EXISTS `ubicacion` (
`id_ubicacion` int(11) NOT NULL,
  `casa_lat` varchar(30) DEFAULT NULL,
  `casa_lon` varchar(30) DEFAULT NULL,
  `trabajo_lat` varchar(30) DEFAULT NULL,
  `trabajo_lon` varchar(30) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ubicacion`
--

INSERT INTO `ubicacion` (`id_ubicacion`, `casa_lat`, `casa_lon`, `trabajo_lat`, `trabajo_lon`) VALUES
(1, '41.356228', '2.111686', NULL, NULL),
(2, '41.352509', '2.111117', '41.349650', '2.107888'),
(3, '41.356157', '2.113381', NULL, NULL),
(4, '41.353443', '2.110946', NULL, NULL),
(5, '41.363445', '2.109712', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
`id_usuario` int(11) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nombre_usuario` varchar(20) DEFAULT NULL,
  `apellidos_usuario` varchar(40) DEFAULT NULL,
  `mail_usuario` varchar(50) DEFAULT NULL,
  `direccion_usuario` varchar(60) DEFAULT NULL,
  `telefono_usuario` varchar(9) DEFAULT NULL,
  `nivel_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `password`, `nombre_usuario`, `apellidos_usuario`, `mail_usuario`, `direccion_usuario`, `telefono_usuario`, `nivel_usuario`) VALUES
(1, '7df7c7fce24d21d2136719167a3743dc', 'Víctor', 'Cruz Lara', 'victor.cruz@gmail.com', 'Calle Francia', '933366987', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
 ADD PRIMARY KEY (`id_contacto`), ADD KEY `FK_Ubicacion_Contacto` (`id_ubicacion`), ADD KEY `FK_Lista_Contacto` (`id_lista`);

--
-- Indices de la tabla `lista`
--
ALTER TABLE `lista`
 ADD PRIMARY KEY (`id_lista`), ADD KEY `FK_Usuario_Lista` (`id_usuario`);

--
-- Indices de la tabla `nivel`
--
ALTER TABLE `nivel`
 ADD PRIMARY KEY (`id_nivel`);

--
-- Indices de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
 ADD PRIMARY KEY (`id_ubicacion`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`id_usuario`), ADD KEY `FK_Nivel_Usuario` (`nivel_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
MODIFY `id_contacto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `lista`
--
ALTER TABLE `lista`
MODIFY `id_lista` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `nivel`
--
ALTER TABLE `nivel`
MODIFY `id_nivel` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
MODIFY `id_ubicacion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contacto`
--
ALTER TABLE `contacto`
ADD CONSTRAINT `FK_Lista_Contacto` FOREIGN KEY (`id_lista`) REFERENCES `lista` (`id_lista`),
ADD CONSTRAINT `FK_Ubicacion_Contacto` FOREIGN KEY (`id_ubicacion`) REFERENCES `ubicacion` (`id_ubicacion`);

--
-- Filtros para la tabla `lista`
--
ALTER TABLE `lista`
ADD CONSTRAINT `FK_Usuario_Lista` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
ADD CONSTRAINT `FK_Nivel_Usuario` FOREIGN KEY (`nivel_usuario`) REFERENCES `nivel` (`id_nivel`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
