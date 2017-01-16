-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-01-2017 a las 19:32:47
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;

--
-- Base de datos: `social_football`
--
CREATE DATABASE IF NOT EXISTS `social_football` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `social_football`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE IF NOT EXISTS `equipo` (
  `id_equipo` int(11) NOT NULL,
  `nombre_equipo` varchar(150) NOT NULL,
  `anio_fundacion` varchar(6) NOT NULL,
  `foto_equipo` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

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

CREATE TABLE IF NOT EXISTS `estadio` (
  `id_estadio` int(11) NOT NULL,
  `nombre_estadio` varchar(150) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `ciudad` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estadio`
--

INSERT INTO `estadio` (`id_estadio`, `nombre_estadio`, `direccion`, `ciudad`) VALUES
(1, 'Polideportivo Montequinto', 'C/ rey baltasar, 99', 'Sevilla'),
(2, 'Pista futbol sala Olivar de Quintos', 'C/ Papá Noel, 1', 'Sevilla');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE IF NOT EXISTS `mensaje` (
  `id_mensaje` int(11) NOT NULL,
  `texto` varchar(500) NOT NULL,
  `leido` varchar(2) NOT NULL,
  `id_usuario_envia` int(11) NOT NULL,
  `id_usuario_recibe` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mensaje`
--

INSERT INTO `mensaje` (`id_mensaje`, `texto`, `leido`, `id_usuario_envia`, `id_usuario_recibe`) VALUES
(1, 'Hola que ase', 'no', 40, 45),
(2, 'Po na, aqui', 'no', 45, 40);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

CREATE TABLE IF NOT EXISTS `noticia` (
  `id_noticia` int(11) NOT NULL,
  `fecha_noticia` varchar(10) NOT NULL,
  `titular_noticia` varchar(500) NOT NULL,
  `texto_noticia` varchar(10000) NOT NULL,
  `id_equipo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `noticia`
--

INSERT INTO `noticia` (`id_noticia`, `fecha_noticia`, `titular_noticia`, `texto_noticia`, `id_equipo`) VALUES
(1, '25/12/2016', 'El Betis arrasa en la Liga Promises', 'El conjunto andaluz, liderado por Alfonso, ha sido campeón de la Liga Promises por delante de equipos como el Barcelona o real Madrid. Todo ello gracias al entrenador Alberto que ha tenido a sus jugadores enchufadísimos durante todo el torneo.', 2),
(2, '26/12/2016', 'El Sevilla se hace con el central Clement.', 'Finalmente fue el equipo de Nervión el que se hizo con los servicios del jugador. Todo parecía indicar que el galo acabaría jugando en el equipo colchonero debido a que la oferta era mayor, pero para sorpresa de todos, el jugador del Nantes decidió irse a Sevilla.', 1),
(3, '10/09/2017', 'Lucas sufre una sobrecarga muscular', 'El Atlético de Madrid confirmó que la lesión del defensor francés Lucas Hernández, sustituido ayer en el descanso del partido de la Copa del Rey contra la Unión Deportiva Las Palmas, es una "sobrecarga muscular en el recto anterior del muslo derecho". Las pruebas realizadas este miércoles en la Clínica FREMAP de Majadahonda han determinado que la lesión es muscular y afecta al recto anterior del muslo derecho, por lo que el jugador tendrá que someterse a un tratamiento de fisioterapia y entrenamiento en el gimnasio. No se ha precisado tiempo de baja. Lucas, que salió al césped como lateral izquierdo titular en el partido de vuelta de octavos de final de la Copa del Rey que terminó con victoria visitante 2-3 y clasificación local a cuartos, fue cambiado en el intermedio por Gabi Fernández.', 5),
(4, '09/01/2017', 'El Betis buscará el sábado vencer por primera vez al Atlético de Simeone', 'El Real Betis, que el sábado visitará el Vicente Calderón (18.30 horas), sólo ha ganado uno de sus diez últimos partidos oficiales contra el Atlético de Madrid, al que no vence desde un 0-2 en diciembre de 2011 que propició la llegada al banquillo colchonero del argentino Diego Simeone. En aquella decimoséptima jornada de la Liga 2011-12, el Betis ganó en Madrid por 0-2, con goles de Pozuelo y el paraguayo Roque Santa Cruz, resultado que provocó la destitución de Gregorio Manzano como entrenador atlético y el fichaje de Simeone. El preparador argentino empató a dos en el partido de vuelta de aquel campeonato (Pozuelo y Pereira marcaron para los locales y Koke y Falcao hicieron los goles visitantes) y, desde entonces, ha encadenado siete victorias y un empate en sus enfrentamientos con el Betis.', 2),
(5, '10/09/2017', 'Jovetic entra en la lista y Lenglet será titular', 'El Sevilla se mide este jueves al Real Madrid en la vuelta copera, una cita para la que ha estado trabajando hoy en la ciudad deportiva. Y lo ha hecho con la novedad de Stevan Jovetic, que se ha ejercitado por primera vez junto a sus nuevos compañeros para, instantes después, entrar en la convocatoria para dicho encuentro. El delantero montenegrino se ha unido así al francés Lenglet, la otra incorporación del Sevilla en el presente mercado invernal. El defensa tiene muchas posibilidades de estrenarse como titular ante el Madrid, como ha confirmado el propio Jorge Sampaoli: "Tenemos la posibilidad con la llegada de Lenglet de tener tres centrales y el equipo se siente cómodo con ese dibujo. Sería ilógico cambiarlo". Los 18 jugadores que ha citado el entrenador argentino son Sergio Rico, David Soria, Kranevitter, Lenglet, Iborra, Vietto, Nasri, Correa, Ben Yedder, Kiyotake, Jovetic, Sarabia, Escudero, Ganso, Vitolo, Nico Pareja, Rami y Mercado.', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partido`
--

CREATE TABLE IF NOT EXISTS `partido` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peticion_amistad`
--

CREATE TABLE IF NOT EXISTS `peticion_amistad` (
  `id_peticion` int(11) NOT NULL,
  `estado_peticion` int(11) NOT NULL,
  `fecha_peticion` varchar(15) NOT NULL,
  `id_usuario_peticion` int(11) NOT NULL,
  `id_usuario_recibe` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `peticion_amistad`
--

INSERT INTO `peticion_amistad` (`id_peticion`, `estado_peticion`, `fecha_peticion`, `id_usuario_peticion`, `id_usuario_recibe`) VALUES
(1, 0, '10/01/2017', 40, 45);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre_usuario`, `apellido1_usuario`, `apellido2_usuario`, `correo_usuario`, `pass_usuario`, `foto_usuario`, `ciudad_usuario`, `equipo_id`, `admin`) VALUES
(40, 'Ricardo', 'Montero', 'Recuero', 'ricardo@gmail.com', '6720720054e9d24fbf6c20a831ff287e', 'userImgs/1484150470carnetRicardo.jpg', 'MÃ¡laga', 5, 1),
(42, 'User', 'User1', 'User2', 'user@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee', 'userImgs/1484151189user.png', 'A CoruÃ±a', 20, 1),
(43, 'Admin', 'Admin1', 'Admin2', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'userImgs/1484151218admin.png', 'A CoruÃ±a', 20, 0),
(44, 'Francisco', 'Araque', 'Fri­as', 'francisco@gmail.com', '117735823fadae51db091c7d63e60eb0', 'userImgs/1484151339fran.jpg', 'Sevilla', 1, 1),
(45, 'Alberto', 'Garrido', 'Pacheco', 'alberto@gmail.com', '177dacb14b34103960ec27ba29bd686b', 'userImgs/1484151621alberto.jpg', 'Sevilla', 2, 1);

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
  MODIFY `id_equipo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `estadio`
--
ALTER TABLE `estadio`
  MODIFY `id_estadio` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `noticia`
--
ALTER TABLE `noticia`
  MODIFY `id_noticia` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `partido`
--
ALTER TABLE `partido`
  MODIFY `id_partido` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `peticion_amistad`
--
ALTER TABLE `peticion_amistad`
  MODIFY `id_peticion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
