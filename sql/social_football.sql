-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-12-2016 a las 19:42:25
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `social_football`
--
CREATE DATABASE IF NOT EXISTS `social_football` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `social_football`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `id_equipo` int(11) NOT NULL,
  `nombre_equipo` varchar(150) NOT NULL,
  `anio_fundacion` varchar(6) NOT NULL,
  `foto_equipo` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`id_equipo`, `nombre_equipo`, `anio_fundacion`, `foto_equipo`) VALUES
(1, 'Sevilla', '1905', './img/sevilla.png'),
(2, 'Betis', '1907', './img/betis.png'),
(3, 'Alaves', '1921', './img/alaves.png'),
(4, 'Athletic', '1898', './img/athletic.png'),
(5, 'Atletico', '1903', './img/atletico.png'),
(6, 'Barcelona', '1899', './img/barcelona.png'),
(7, 'Celta', '1923', './img/celta.png'),
(8, 'Deportivo', '1906', './img/deportivo.png'),
(9, 'Eibar', '1940', './img/eibar.png'),
(10, 'Espanyol', '1900', './img/espanyol.png'),
(11, 'Granada', '1931', './img/granada.png'),
(12, 'Las Palmas', '1945', './img/laspalmas.png'),
(13, 'Leganes', '1928', './img/leganes.png'),
(14, 'Malaga', '1921', './img/malaga.png'),
(15, 'Osasuna', '1920', './img/osasuna.png'),
(16, 'Madrid', '1902', './img/realmadrid.png'),
(17, 'Real', '1920', './img/realsociedad.png'),
(18, 'Sporting', '1905', './img/sporting.png'),
(19, 'Valencia', '1919', './img/valencia.png'),
(20, 'Villarreal', '1923', './img/villarreal.png');
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadio`
--

CREATE TABLE `estadio` (
  `id_estadio` int(11) NOT NULL,
  `nombre_estadio` varchar(150) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `ciudad` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `id_mensaje` int(11) NOT NULL,
  `texto` varchar(200) NOT NULL,
  `leido` varchar(2) NOT NULL,
  `id_usuario_envia` int(11) NOT NULL,
  `id_usuario_recibe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `noticia`
--

CREATE TABLE `noticia` (
  `id_noticia` int(11) NOT NULL,
  `fecha_noticia` varchar(10) NOT NULL,
  `titular_noticia` varchar(200) NOT NULL,
  `texto_noticia` varchar(400) NOT NULL,
  `id_equipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `noticia`
--

INSERT INTO `noticia` (`id_noticia`, `fecha_noticia`, `titular_noticia`, `texto_noticia`, `id_equipo`) VALUES
(1, '25/12/2016', 'El Betis arrasa en la Liga Promises', 'El conjunto andaluz, liderado por Alfonso, ha sido campeón de la Liga Promises por delante de equipos como el Barcelona o real Madrid. Todo ello gracias al entrenador Alberto que ha tenido a sus jugadores enchufadísimos durante todo el torneo.', 2),
(2, '26/12/2016', 'El Sevilla se hace con el central Clement.', 'Finalmente fue el equipo de Nervión el que se hizo con los servicios del jugador. Todo parecía indicar que el galo acabaría jugando en el equipo colchonero debido a que la oferta era mayor, pero para sorpresa de todos, el jugador del Nantes decidió irse a Sevilla.', 1);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `partido`
--

CREATE TABLE `partido` (
  `id_partido` int(11) NOT NULL,
  `fecha_partido` varchar(20) NOT NULL,
  `hora_partido` varchar(10) NOT NULL,
  `id_estadio` int(11) NOT NULL,
  `id_usuario_creador` int(11) NOT NULL,
  `id_usuario_2` int(11) NOT NULL,
  `id_usuario_3` int(11) NOT NULL,
  `id_usuario_4` int(11) NOT NULL,
  `id_usuario_5` int(11) NOT NULL,
  `id_usuario_6` int(11) NOT NULL,
  `id_usuario_7` int(11) NOT NULL,
  `id_usuario_8` int(11) NOT NULL,
  `id_usuario_9` int(11) NOT NULL,
  `id_usuario_10` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peticion_amistad`
--

CREATE TABLE `peticion_amistad` (
  `id_peticion` int(11) NOT NULL,
  `estado_peticion` int(11) NOT NULL,
  `fecha_peticion` varchar(15) NOT NULL,
  `id_usuario_peticion` int(11) NOT NULL,
  `id_usuario_recibe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(150) NOT NULL,
  `apellido1_usuario` varchar(100) NOT NULL,
  `apellido2_usuario` varchar(150) NOT NULL,
  `correo_usuario` varchar(100) NOT NULL,
  `pass_usuario` varchar(50) NOT NULL,
  `foto_usuario` varchar(150) NOT NULL,
  `ciudad_usuario` varchar(150) NOT NULL,
  `equipo_id` int(11) NOT NULL,
  `admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre_usuario`, `apellido1_usuario`, `apellido2_usuario`, `correo_usuario`, `pass_usuario`, `foto_usuario`, `ciudad_usuario`, `equipo_id`, `admin`) VALUES
(1, 'User', 'Social', 'Football', 'user@gmail.com', 'user', 'C:\\\\xampp\\\\tmp\\\\php7955.tmp', 'Sevilla', 1, 1),
(2, 'Admin', 'Social', 'Football', 'admin@gmail.com', 'admin', 'C:\\\\xampp\\\\tmp\\\\php7955.tmp', 'Sevilla', 2, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`id_equipo`);

--
-- Indices de la tabla `estadio`
--
ALTER TABLE `estadio`
  ADD PRIMARY KEY (`id_estadio`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`id_mensaje`);

--
-- Indices de la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`id_noticia`);

--
-- Indices de la tabla `partido`
--
ALTER TABLE `partido`
  ADD PRIMARY KEY (`id_partido`);

--
-- Indices de la tabla `peticion_amistad`
--
ALTER TABLE `peticion_amistad`
  ADD PRIMARY KEY (`id_peticion`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `id_equipo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estadio`
--
ALTER TABLE `estadio`
  MODIFY `id_estadio` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `noticia`
--
ALTER TABLE `noticia`
  MODIFY `id_noticia` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `partido`
--
ALTER TABLE `partido`
  MODIFY `id_partido` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `peticion_amistad`
--
ALTER TABLE `peticion_amistad`
  MODIFY `id_peticion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
