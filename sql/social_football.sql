-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-01-2017 a las 14:18:25
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

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
(19, 'Valencia', '1919', './img/valencia.png'),
(20, 'Villarreal', '1923', './img/villarreal.png'),
(23, 'Getafe', '1983', 'img/1484756163getafe.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadio`
--

CREATE TABLE IF NOT EXISTS `estadio` (
  `id_estadio` int(11) NOT NULL,
  `nombre_estadio` varchar(150) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `ciudad` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estadio`
--

INSERT INTO `estadio` (`id_estadio`, `nombre_estadio`, `direccion`, `ciudad`) VALUES
(1, 'Polideportivo Montequinto', 'C/ rey baltasar, 99', 'Sevilla'),
(2, 'Pista futbol sala Olivar de Quintos', 'C/ Papá Noel, 1', 'Sevilla'),
(3, 'Estadio Ricardo', 'C/ Josefa Bover, 1', 'Sevilla');

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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mensaje`
--

INSERT INTO `mensaje` (`id_mensaje`, `texto`, `leido`, `id_usuario_envia`, `id_usuario_recibe`) VALUES
(1, 'Hola que ase', 'si', 40, 45),
(4, 'hola fran!!', 'si', 40, 44),
(6, 'hola que pasa!', 'si', 40, 44),
(8, 'eeeee', 'si', 40, 45),
(13, 'ffffffffffffffffff', 'si', 40, 45),
(15, 'sgsg', 'no', 40, 45),
(17, 'hola', 'si', 43, 44),
(18, 'sgfsdfsdg', 'si', 43, 44),
(19, 'holaaa', 'no', 45, 44),
(21, 'probando si responde', 'no', 40, 44),
(22, 'aaaa', 'no', 40, 45),
(25, 'eooo tuu madre', 'no', 40, 45),
(27, 'pos nada weii', 'si', 40, 52),
(28, 'hola tiooo', 'no', 46, 48);

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
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `noticia`
--

INSERT INTO `noticia` (`id_noticia`, `fecha_noticia`, `titular_noticia`, `texto_noticia`, `id_equipo`) VALUES
(1, '25/12/2016', 'El Betis arrasa en la Liga Promises', 'El conjunto andaluz, liderado por Alfonso, ha sido campeón de la Liga Promises por delante de equipos como el Barcelona o real Madrid. Todo ello gracias al entrenador Alberto que ha tenido a sus jugadores enchufadísimos durante todo el torneo.', 2),
(2, '26/12/2016', 'El Sevilla se hace con el central Clement.', 'Finalmente fue el equipo de Nervión el que se hizo con los servicios del jugador. Todo parecía indicar que el galo acabaría jugando en el equipo colchonero debido a que la oferta era mayor, pero para sorpresa de todos, el jugador del Nantes decidió irse a Sevilla.', 1),
(3, '10/09/2017', 'Lucas sufre una sobrecarga muscular', 'El Atlético de Madrid confirmó que la lesión del defensor francés Lucas Hernández, sustituido ayer en el descanso del partido de la Copa del Rey contra la Unión Deportiva Las Palmas, es una "sobrecarga muscular en el recto anterior del muslo derecho". Las pruebas realizadas este miércoles en la Clínica FREMAP de Majadahonda han determinado que la lesión es muscular y afecta al recto anterior del muslo derecho, por lo que el jugador tendrá que someterse a un tratamiento de fisioterapia y entrenamiento en el gimnasio. No se ha precisado tiempo de baja. Lucas, que salió al césped como lateral izquierdo titular en el partido de vuelta de octavos de final de la Copa del Rey que terminó con victoria visitante 2-3 y clasificación local a cuartos, fue cambiado en el intermedio por Gabi Fernández.', 5),
(4, '09/01/2017', 'El Betis buscará el sábado vencer por primera vez al Atlético de Simeone', 'El Real Betis, que el sábado visitará el Vicente Calderón (18.30 horas), sólo ha ganado uno de sus diez últimos partidos oficiales contra el Atlético de Madrid, al que no vence desde un 0-2 en diciembre de 2011 que propició la llegada al banquillo colchonero del argentino Diego Simeone. En aquella decimoséptima jornada de la Liga 2011-12, el Betis ganó en Madrid por 0-2, con goles de Pozuelo y el paraguayo Roque Santa Cruz, resultado que provocó la destitución de Gregorio Manzano como entrenador atlético y el fichaje de Simeone. El preparador argentino empató a dos en el partido de vuelta de aquel campeonato (Pozuelo y Pereira marcaron para los locales y Koke y Falcao hicieron los goles visitantes) y, desde entonces, ha encadenado siete victorias y un empate en sus enfrentamientos con el Betis.', 2),
(5, '10/09/2017', 'Jovetic entra en la lista y Lenglet será titular', 'El Sevilla se mide este jueves al Real Madrid en la vuelta copera, una cita para la que ha estado trabajando hoy en la ciudad deportiva. Y lo ha hecho con la novedad de Stevan Jovetic, que se ha ejercitado por primera vez junto a sus nuevos compañeros para, instantes después, entrar en la convocatoria para dicho encuentro. El delantero montenegrino se ha unido así al francés Lenglet, la otra incorporación del Sevilla en el presente mercado invernal. El defensa tiene muchas posibilidades de estrenarse como titular ante el Madrid, como ha confirmado el propio Jorge Sampaoli: "Tenemos la posibilidad con la llegada de Lenglet de tener tres centrales y el equipo se siente cómodo con ese dibujo. Sería ilógico cambiarlo". Los 18 jugadores que ha citado el entrenador argentino son Sergio Rico, David Soria, Kranevitter, Lenglet, Iborra, Vietto, Nasri, Correa, Ben Yedder, Kiyotake, Jovetic, Sarabia, Escudero, Ganso, Vitolo, Nico Pareja, Rami y Mercado.', 1),
(6, '20/01/2017', 'Pellegrino: "El objetivo está aún muy lejano"', 'El entrenador del Deportivo Alavés, Mauricio Pellegrino, ha señalado este viernes que al equipo le quedan "muchos escalones por subir" y ha reconocido que está "muy lejos de cumplir" con el objetivo marcado.\r\nEl argentino ha recordado en la rueda de prensa previa al encuentro ante el Leganés que les queda "mucho por hacer" y que tienen que entregar "todo" para superar cada partido.\r\nHa considerado que el partido de mañana es "muy importante y muy difícil" y ha dicho que "es una buena noticia" que no queden entradas porque eso quiere decir que el equipo "está despertando algo para la ciudad" y para su gente. "El comportamiento de la afición con el equipo en momentos difíciles es increíble, ojalá que podamos transmitir lo mismo", ha insistido.', 3),
(7, '20/01/2017', 'Dani Torres se descalza sobre el hielo', 'El jugador del Alavés, Daniel Torres, es fiel a su ritual: caminar descalzo antes de los partidos. Así lo ha demostrado una vez más, pues el colombiano no se lo ha pensado ni dos veces a la hora de descalzarse sobre el césped del campo del Alcorcón, donde el termómetro marca tres grados.\r\nLa mítica costumbre se basa en una cita bíblica: ''Todo lugar donde pise la planta de vuestro pie será vuestro''. "Es algo que hacemos porque estamos convencidos de que Dios siempre nos ilumina y acompaña", ha explicado en alguna ocasión Torres.\r\nEl jugador, que sufrió problemas con el alcohol en 2011, se refugió en el cristianismo para salir del pozo en el que se encontraba. Además, durante esta época conoció a Sandra Merino, su auténtica "salvadora", que es la persona con la que habla por teléfono el jugador mientras camina descalzo.', 3),
(8, '20/01/2017', 'Los ''trucos'' de Valverde', 'En la pasada eliminatoria de Copa contra el Barça, Valverde tocó al equipo para plantar cara al afán de posesión de los azulgrana y a su interés por circular desde posiciones muy cercanas a su portero.\r\nEl técnico rojiblanco trabaja esta semana otra vertiente para hacer frente a un Atlético que en su concepto táctico tiene poco parecido con los azulgrana. La presión en tres cuartos de campo que propuso el Athletic en los dos primeros tiempos de cada duelo ante el Barcelona, con la defensa situada casi en el centro del campo, sería bien acogida por el Atlético, acostumbrado a moverse en espacio reducido para lanzar el balón a cualquiera de sus puntas. Valverde tiene otra oportunidad de enseñar su cuaderno.\r\nEl juego del Athletic depende mucho de la capacidad que tienen sus laterales para sumarse al ataque, que es la mejor forma para desatascar la presión que sufren en el centro del campo cuando el equipo está en necesidad de sacar juego. Valverde agradecerá entonces la vuelta de De Marcos y Lekue.', 4),
(9, '20/01/2017', 'Yeray: "No tengo miedo"', 'Yeray es uno más de la plantilla. El central ha recibido esta mañana el alta médica y está a disposición de Valverde, que ahora tiene que decidir si le convoca para el encuentro del domingo contra el Atlético o espera una semana más y le cita frente al Sporting. Operado el pasado 27 de diciembre de un tumor testicular, el futbolista ha destacado que "después de las noticias de los últimos días estoy muy contento. Las pruebas me han dado todo bien y es para estar contento".\r\nDiagnosticado del tumor el 22 de diciembre, el central ha dicho que "recibir la noticia fue duro, pero he tenido mucho apoyo de familia, amigos y todo el mundo del fútbol. Para nada esperas que tanta gente esté contigo y el ánimo que te dan es increíble. No puedo decir qué pensé cuándo me lo dijeron, pero sí hubo sensación de que era grave. No conocía a nadie con algo parecido y lo que más quería era estar con mi familia. Después ha habido ciclistas y futbolistas que se han puesto en contacto conmigo para ofrecerme su experiencia y estoy muy agradecido. Ha habido muchos que me han escrito".', 4),
(10, '20/01/2017', 'Gaitán, el ''fichaje'' que deja el invierno', 'No es la primera vez que un fichaje estrella del Atlético en el mercado veraniego necesita varios meses para encontrar su mejor nivel. Suele ser por varios motivos, pero especialmente afecta la adaptación. Tras superar esa etapa, muchos de ellos acaban por ser los grandes fichajes... del mercado de invierno. Esta temporada tengo esperanza de que puede ocurrir algo así con Nico Gaitán.\r\nEl argentino dio la victoria al Atlético el pasado sábado con su gol, algo que le sirvió para volver a sentirse importante, sensación que no tenía desde de su etapa en el Benfica... o con Argentina en la Copa América del pasado verano.\r\nGaitán necesitaba más que nadie un momento así. Cuando tu equipo gana con un gol tuyo, la confianza crece una barbaridad y estoy convencido de que a partir de ahora vamos ver al verdadero Nico. Ayer mismo volvió a jugar de inicio y cuajó una buena actuación desde la banda izquierda. Si hay un jugador con calidad y carácter que puede dar la vuelta a la tortilla y repetir lo que hicieron cracks como Radamel Falcao, ése es él.', 5),
(11, '20/01/2017', 'Piqué ahora no habla de los árbitros', 'Gerard Piqué tuvo un encuentro digital con sus fans este mediodía. En la charla, el defensa azulgrana no quiso hablar esta vez de los árbitros después de sus polémicas declaraciones de las últimas semanas tras los partidos frente al Athletic y el Villarreal.\r\n"Dejemos el tema de los árbitros que está muy caliente", dijo el central azulgrana cuando fue cuestionado al respecto. Solamente recalcó un tema que ya ha venido comentando en los últimos tiempos: "Soy partidario de que el fútbol se modernice y estoy convencido de que al final la tecnología acabará imponiéndose".\r\nPiqué sigue apostando por todos los títulos. "Estamos a dos puntos del Real Madrid aunque a ellos les queda un partido aplazado. Estamos convencidos de que podemos ganar esta Liga."', 6),
(12, '20/01/2017', 'Iniesta, baja para Ipurua', 'Andrés Iniesta sufre una pequeña lesión en el sóleo de la pierna izquierda. El capitán azulgrana será baja ante el Eibar y la evolución marcará la disponibilidad para los próximos partidos.\r\nIniesta tuvo que ser sustituido por André Gomes en el descanso ante la Real Sociedad. Hasta el momento, el manchego había disputado un total de 17 partido esta temporada, con un gol (contra el Celtic en la Liga de Campeones).', 6),
(13, '20/01/2017', 'Berizzo: "Es una victoria que nos obligará a jugar en Vigo mejor que hoy"', 'Eduardo Berizzo dio todo el mérito de la victoria a sus jugadores pero quiso dejar claro que no hay nada decidido ante la envergadura del Real Madrid.\r\nElogios a los suyos: "Ninguna victoria de mi equipo me sorprende. Nos medíamos al mejor equipo del mundo y la dificultad era enorme. La primera parte sufrimos la circulación del Real Madrid, pero en la segunda ajustamos el marcaje y encontramos quites que nos abrieron el ataque y encontramos goles. Se venía la avalancha con el gol del Madrid, pero nuestro segundo tanto nos dio tranquilidad. Tendremos que jugar en Vigo mejor que hoy y el Madrid nos va exigir un esfuerzo mayúsculo. Ningún resultado por más amplio que sea te dejará tranquilo contra el Madrid. Habrá que jugar con la misma o más exigencia que hoy".', 7),
(14, '20/01/2017', '''Matagigantes'' Aspas', 'El genio de Moaña. En Vigo y en España entera no se habla de otra cosa. Don Iago Aspas, el delantero capaz de mirar a los grandes a la cara y salir airoso del desplante. Sus goles son oro esta temporada, y el Celta amontona lingotes con ojos ambiciosos y grandes planes de futuro. Hoy le tocó al Madrid y hace no mucho al Barcelona. Nadie, ni siquiera los gigantes de nuestro fútbol, escapan al instinto del delantero de moda.\r\nEn plena ola de frío llegó Iago al Bernabéu para levantar una ventisca que asoló Concha Espina. No quedó nada del Madrid de Zidane, ni rastro del equipo de los 40 partidos invicto. Le bastó con aparecer dos veces en seis minutos. En el 64, recogió un despeje corto de Marcelo para fusilar a Casilla. Seis más tarde, dibujó un pase al espacio para que Jony adelantase de nuevo al Celta. Goleador y asistente, genio y figura.', 7),
(15, '21/01/2017', 'Apuesta al doble 9', 'El Deportivo afronta el último partido de la primera vuelta con la intención de lograr su primera victoria lejos de Riazor. Conseguir una segunda parte de la temporada cómoda pasa, entre otras cosas, por mejorar los resultados a domicilio. No ganar fuera obliga a no fallar nunca en Riazor, tarea siempre difícil de cumplir para los equipos de media tabla para abajo.\r\nGaritano apostará por jugar con dos delanteros. Joselu y Andone tendrán la misión de terminar las jugadas y de presionar la salida de balón del rival, misión muy importante teniendo en cuenta el estilo de Las Palmas.\r\nLos dos arietes ya han mostrado que se complementan bien. En el Bernabéu, ante el Real Madrid, la momentánea remontada de los coruñeses se basó en la conexión entre el gallego y el rumano.\r\nJoselu es capaz de jugar de espaldas a la portería contraria y baja la pelota en caso de que los blanquiazules tengan dificultades para sacarla desde atrás y deban optar por un fútbol más directo. Además, tiene un gran remate. Cualquier balón que haya en el área es capaz de cazarlo.', 8),
(16, '21/01/2017', 'Muere Carlos Alberto Silva, ex entrenador del Deportivo', 'El que fuera entrenador del Deportivo, Carlos Alberto Silva, ha fallecido a la edad de 77 años en la localidad brasileña de Belo Horizonte.\r\nSilva dirigió al Depor en el año 1997 y logró clasificar al conjunto herculino para la Copa de la UEFA. El técnico brasileño llegó para sustituir en su día a John Toshack y aunque acabó bien bien la temporada, luego le fue mal en el inicio de la 97/98, ya que fue eliminado por el Auxerre.\r\nCarlos Alberto Silva logró ser campeón brasileño en 1978 con el Guaraní y luego con Sao Paulo y Atlético Mineiro. En Europa en el Oporto logró dos ligas de Portugal y una Supercopa entre 1991 y 1993.', 8),
(17, '21/01/2017', 'Vuelta a la realidad', 'El 3-0 del pasado jueves en el Vicente Calderón puso fin al sueño copero de un Eibar al que no le queda otra que volver a poner todos sus sentidos en LaLiga Santander. Al fin y al cabo, la competición doméstica es la que permite a la entidad azulgrana continuar creciendo tanto en lo deportivo como en lo económico. Mantenerse en la máxima categoría se antoja fundamental en la consolidación de un proyecto que no parece tener fecha de caducidad.\r\nEl Eibar sigue siendo fiel a la sana costumbre de hacer buena parte de sus deberes en la primera vuelta. Con 26 puntos en el casillero, los puestos de descenso se miran desde la lejanía más absoluta. Pero en Ipurua son conscientes de que no está todo hecho, han aprendido la lección de sus dos anteriores campañas en Primera y no quieren esperar hasta las últimas jornadas para sellar la salvación', 9),
(18, '21/01/2017', 'Inui y el curioso ''gorro de natación''', 'Inui jugó parte del encuentro en El Molinón con una especie de ''gorro de natación'' en la cabeza. Un choque en un salto con Lillo provocó que tanto el japonés como el jugador del Sporting tuvieran que ser atendidos en la banda. Ambos habían sufrido un fuerte golpe y necesitaban cuidados médicos.\r\nEl armero tenía un corte en la cabeza, lo que provocó que tuvieran que vendarle para cerrar la hemorragia y encima le pusieran ese curioso ''gorro de natación''. Una anécdota, pero que llamaba la atención cada vez que el japonés tocaba la pelota. La herida, sin embargo, continuaba sangrando e Inui tuvo que salir del campo en un par de ocasiones para cambiarse la camiseta manchada de sangre.', 9),
(19, '21/01/2017', 'Caicedo sigue sin entrar en la convocatoria por un virus', 'Víctor Sánchez es la gran novedad en la lista de convocados que ha ofrecido este mediodía de viernes Quique Sánchez Flores de cara al encuentro de mañana ante el Granada en el RCDE Stadium. El catalán no pudo jugar ante el Valencia por culpa de una sobrecarga derivada del compromiso contra el Dépor. El futbolista ha probado esta mañana y ha tenido buenas sensaciones. David López, por su parte, también podrá jugar tras superar un golpe en la rodilla derecha. Además del de Rubí, el técnico recupera a Piatti, que no estuvo en Mestalla por la denominada cláusula del miedo.\r\nFelipe Caicedo, en cambio, sigue sin entrar en una lista por culpa de un virus que arrastra desde hace un par de semanas. También están en la enfermería Javi López y Leo Baptistao. Rubén Duarte y Andrés, ambos por decisión técnica, no se concentrarán hoy con el equipo.', 10),
(21, '21/01/2017', 'Quique coloca a Reyes por detrás del punta', 'Reyes podría ser la principal novedad en el once que presente el Espanyol contra el Granada. El técnico tiene previsto realizar algunos retoques respecto al equipo que jugó en Mestalla, dando muy mala imagen en la primera mitad. Quique ensayó ayer con varios equipos y variaciones, pero la que más fuerza cobra a día de hoy es la presencia del andaluz como mediapunta.\r\nAdemás, el madrileño está muy pendiente de la evolución de David López. El canterano dio el susto en la sesión tras un choque fortuito durante el partidillo. El futbolista intentó seguir, pero no pudo y se retiró antes de tiempo. Los galenos informaron que sólo se trata de un golpe en el lateral de la rodilla derecha que no debe revestir mayor gravedad. Incluso, no se han programado nuevas pruebas.\r\nCon la incursión en el once de Reyes, Jurado, que actuó por detrás de Gerard Moreno en Valencia, retrasaría su posición hasta el doble pivote, dejando en el banquillo a Salva Sevilla, titular en los dos últimos compromisos. En principio, formaría con Javi Fuego, la única pieza de la medular que parece tener el sitio garantizado. Todo apunta a que el asturiano jugará junto a Jurado, aunque Quique también quiso probar al ex del Valencia con Marc Roca y Salva Sevilla.', 10),
(22, '21/01/2017', 'Adrián Ramos se incorpora al Granada hasta el final de temporada', 'El Granada ha incorporado hasta final de temporada al delantero colombiano Adrián Ramos cedido por el Chongqing Lifan chino, al que pertenece y al que ha llegado procedente del Borussia Dortmund alemán.\r\nEl técnico del Granada, Lucas Alcaraz, se ha referido hoy a Adrián Ramos en la rueda de prensa previa al choque de mañana ante el Espanyol como nuevo futbolista del cuadro rojiblanco, que espera oficializar la incorporación en breve.\r\nEl hecho de que el chino John Jiang Lizhang sea máximo accionista y presidente del Granada y también uno de los dirigentes más importantes del Chongqing Lifan ha hecho posible que el atacante colombiano se convierta en el tercer refuerzo invernal del cuadro andaluz.\r\nAdrián Ramos, que tiene 30 años y mide 1,85 metros, se formó en el América de Cali de su país y es internacional absoluto con Colombia, con quien disputó la Copa América 2011 de Argentina y el Mundial 2014 de Brasil.', 11),
(23, '21/01/2017', 'Panagiotis Kone llega cedido al Granada', 'El centrocampista internacional griego Panagiotis Giorgios Kone se ha convertido este jueves en el segundo refuerzo invernal del Granada, conjunto al que llega hasta el final de la presente temporada cedido por el Udinese italiano.\r\nEl acuerdo entre los dos clubes y el futbolista se ha cerrado este mediodía tras varios días de negociaciones y contempla que Kone se incorpora al Granada en régimen de préstamo por parte del Udinese, conjunto propietario de sus derechos, según anunció la entidad andaluza a través de su página web\r\nKone, que nació en Tirana (Albania) hace 29 años y mide 1,84 metros, disputó el Mundial de Brasil 2014 con Grecia, combinado con el que ha jugado 19 encuentros desde su debut en 2005.', 11),
(24, '21/01/2017', 'El plan B es Gaku Shibasaki', 'Shibasaki se hizo notar en la final del Mundial de Clubes. Sus dos goles ante el Real Madrid le sirvieron como carta de presentación para los clubes de nuestro país. Se trata de un interior zurdo, con calidad. Entra dentro del perfil que está buscando la dirección deportiva para elevar la calidad de la plantilla.\r\nLos contactos con el jugador se llevan produciendo desde el mes de diciembre. La operación Jesé ha dejado a Shibasaki en un segundo plano, pero las negociaciones se han vuelto a reactivar. Miguel Ángel Ramírez, que levaba personalmente la negociación con Jesé, ha dado luz verde para activar el plan alternativo. Gaku finalizó el contrato con el Kashima el 31 de diciembre y quiere dar el salto a Europa.\r\nAdemás de un buen jugador, Las Palmas se aseguraría la entrada en un mercado japonés que está por explotar. El club vería en la incorporación de Shibasaki una opción económica interesante para desarrollar la marca UD Las Palmas en todo el continente.', 12),
(25, '21/01/2017', 'Artiles sale cedido al Cartagena', 'El canterano grancanario José Artiles jugará en el FC Cartagena hasta el final de esta temporada. La UD Las Palmas y el conjunto murciano llegaron a un acuerdo de cesión por el que centrocampista reforzará al equipo dirigido por Alberto Monteaguado.\r\nLos cartagineses, que marchan líderes del grupo IV de 2ªb, se hacen con un refuerzo de garantías. Artiles es considerado una de las perlas de la cantera amarilla aunque no estaba contando con la confianza del técnico, Quique Setién. Su vinculación con Las Palmas termina en junio de 2018.\r\nNo será la primera experiencia del jugador fuera de Gran Canaria ya que la pasada temporada militó en el Racing de Santander. Con los cántabros jugó la fase de ascenso a Segunda División, tras quedar primeros de grupo, y fue uno de los hombres más utilizados por Pedro Minutis.', 12),
(26, '21/01/2017', 'Mamadou Koné, aproximadamente seis semanas más de baja', 'Mamadou Koné, delantero del Leganés, estará aproximadamente seis semanas más de baja tal como ha anunciado su club después de que el punta fuera sometido a una artroscopia reparatoria de la sindesmosis que sufre en su tobillo izquierdo.\r\nKoné, que llegó a la entidad el pasado verano y ha saltado este curso al césped en cinco encuentros ligueros, disfrutó de sus últimos minutos en el choque ante el Sevilla disputado en el estadio de Butarque el pasado mes de octubre.', 13),
(27, '21/01/2017', 'Samu García refuerza al Leganés', 'El malagueño Samu García vuelve a la Liga española de la mano del Leganés. Su fichaje viene a paliar la falta de efectivos del equipo de Asier Garitano y una de sus principales peticiones, reforzar las bandas y el ataque.\r\nSamu García estará cedido por el Rubin Kazán hasta final de temporada y los pepineros pagarán buena parte de su ficha. El atacante llegó al equipo ruso por expreso deseo de su actual técnico, Javi Gracia, pero el deseo del futbolista de volver a España ha sido respetado por el extécnico malacitano.\r\nEn el Rubin Kazán, Samu ha jugado 15 partidos y marcado un tanto. Nada que ver con sus excelentes números en España, donde ha anotado, entre el Málaga y el Villarreal, 12 goles en 92 partidos. El jugador lucirá el dorsal número 16 y será presentado el viernes a las 14:00h en el stand de Royal Jordanian ubicado en el pabellón 4 de FITUR (Av. Partenón, 5, Madrid).', 13),
(28, '21/01/2017', 'Demichelis, al rescate del Málaga', 'Una defensa estable es lo que pretende Marcelo Romero para su equipo. Hacia esa dirección deambula un Málaga que sigue sin superar los problemas en la retaguardia. Para solventar esta carencia, el club andaluz ha decidido incorporar a Martín Demichelis. El argentino regresa a Martiricos con el aval del entrenador uruguayo, que sopesa colocarle hoy en la alineación, pese a haber completado tan sólo tres entrenamientos con el grupo.\r\nEl fichaje de Demichelis no ha sido una operación de consenso. Aunque su estado físico generó dudas en un primer momento, fue Romero el que ha defendido el retorno de quien lideró la zaga malaguista en la etapa más gloriosa del club, llegando a los cuartos de final de la Champions League.\r\nPara el actual cuerpo técnico, los 36 años del argentino no suponen un problema y sí una bendición, debido a la inexperiencia en la élite de algunos de los defensas blanquiazules, como Mikel Villanueva, que inició su carrera futbolística hace sólo cuatro años.', 14),
(29, '21/01/2017', 'Demichelis y Keko, novedades en la convocatoria para el Bernabéu', 'El defensa argentino Martín Demichelis y el centrocampista Keko Gontánson las novedades entre los dieciocho convocados con las que se presenta el Málaga para el encuentro del sábado ante el Real Madrid en el estadio Santiago Bernabéu.\r\nDemichelis, uno de los refuerzos en el mercado invernal y que fue presentado el pasado miércoles, entra en la lista debido a que Diego Llorente, perteneciente al club madridista, no puede jugar según establece el contrato. El nuevo refuerzo solo ha participado en tres entrenamientos a las órdenes de Marcelo Romero.\r\nKeko, tras algo más de tres meses de baja tras lesionarse en el calentamiento del encuentro ante el Real Betis disputado en el estadio Benito Villamarín, regresa a la convocatoria en sustitución del delantero Sandro Ramírez, quien padece una rotura fibrilar que se produjo la pasada jornada frente a la Real Sociedad.', 14),
(30, '21/01/2017', 'Unai García, "convencido" de ganar el domingo al Sevilla en El Sadar', 'El jugador de Osasuna Unai García se ha mostrado "convencido" de que el equipo navarro ganará al Sevilla en el partido del próximo domingo en el estadio El Sadar, a pesar de la diferencia en la clasificación entre ambos equipos y de que los ''rojillos'' todavía no han vencido en Liga en casa.\r\n"Estoy convencido de que el domingo vamos a sacar el partido adelante", ha afirmado Unai García en rueda de prensa tras el entrenamiento en las instalaciones de Tajonar.\r\nEl defensa central navarro se aferra a la mejoría del equipo tras la llegada del tercer entrenador de la temporada: el también director deportivo Petar Vasiljevic.\r\n"Se puede ganar. Llegamos con confianza después de dos buenos partidos y seguro que vamos a dar muchísima guerra", ha declarado el futbolista ''rojillo''.\r\n"El Sevilla viene en un momento increíble. Está con los dos grandes, pero intentaremos sacar el partido adelante en casa con la afición", ha señalado.\r\nUnai García ha dicho que Osasuna se ha merecido ganar ya esta temporada en El Sadar en LaLiga Santander y ha destacado que "sin dejar de ser autocríticos" podrían tener "cinco puntos más tranquilamente" en la clasificación.', 15),
(31, '21/01/2017', 'Vasiljevic: "Vamos por el buen camino"', 'Petar Vasiljevic indicó tras el empate logrado por su equipo en el Estadio Nuevo Los Cármenes contra el Granada (1-1) que van "por el buen camino" pero que el punto logrado se les queda "corto" a los dos equipos.\r\n"El equipo ha dado la cara, hemos salido a por el partido y hemos arriesgado mucho, el equipo ha tenido mucha entrega y sacrificio", explicó Vasiljevic en la rueda de prensa posterior al choque, añadiendo que "vamos por el buen camino, no es malo seguir sumando, pero se queda corto el punto para los dos equipos".', 15),
(32, '21/01/2017', 'Zidane gana ''su'' Liga', 'Zinedine Zidane completa mañana ante el Málaga su particular Liga, de la que ya es campeón pese a que suma un encuentro menos que el resto de sus rivales. El Madrid de ZZ lleva 37 partidos -le falta el aplazado ante el Valencia por el Mundial de Clubes-, de los que ha ganado 29, empatado seis y perdido sólo dos. En total, 93 puntos. Seis más que el Barcelona, que en los últimos 38 encuentros ha conseguido 87. Tercero en La Liga de Zizou sería el Atlético, con 81 puntos.\r\nZZ espera redondear su Liga triunfal con una victoria ante el Málaga mañana que serviría para coger confianza tras las dos últimas derrotas del equipo y para dejar en 96 los puntos conseguidos en sus primeros 38 encuentros de Liga. 96 puntos con los que el Madrid habría sido campeón en 16 de los últimos 19 campeonatos. "Yo sólo miro al siguiente partido, es la mejor manera de conseguir éxitos al final de temporada", dijo Zizou el día de su presentación, el 5 de enero de 2016. Una declaración de intenciones que su Madrid ha seguido a rajatabla, recuperando para el equipo blanco la pasión por la Liga, dejada de lado en los últimos tiempos. Sólo una Liga de las últimas ocho han conseguido los blancos, que por eso se han marcado el campeonato doméstico como objetivo prioritario esta temporada.\r\nEn La Liga de Zizou, el Madrid, en 37 partidos, ha marcado 109 goles y ha recibido 32. Números de campeón a los que hay que añadir su solidez ante los grandes. El Barcelona de Luis Enrique no ha sido capaz de batir aún al equipo de Zidane, que suma una victoria y un empate en los Clásicos, ambos en el Camp Nou. Atlético y Sevilla han sido los únicos equipos capaces de vencer a este nuevo Madrid.', 16),
(33, '21/01/2017', 'Danilo, ahora o nunca', 'Los pitos del Bernabéu a Danilo no son problema para Zidane. Cree que le sucede a todos. Le parece más injusto lo que se escribe de Danilo sobre su aportación al juego del Real Madrid, pero tampoco le van a condicionar sobre la elección del sustituto del lesionado Carvajal en el próximo mes.\r\nEn rueda de prensa ha sido tajante. "Es un placer ver como trabaja. Quiero su mejor versión porque es un jugador que me encanta, con el que no estoy al 100%, sino al 1.000%", ha dicho.', 16),
(34, '21/01/2017', 'Zaza se sube al tren en la primera convocatoria tras su llegada', 'Simone Zaza es la principal novedad del Valencia para el derbi en Villarreal. El delantero italiano no está en plenitud de forma dada la inactividad en el primer semestre de la temporada en la Premier con el West Ham, pero Voro quiere que esté integrado en el grupo lo más pronto posible y puede que tenga opciones en el segundo tiempo del choque en el estadio de la Cerámica.\r\nLa lista está conformada por 18 efectivos y solamente se queda fuera por decisión técnica Fede Cartabia: Alves, Jaume, Montoya, Cancelo, Santos, Garay, Gayá, Suárez, Parejo, Enzo, Soler, Munir, Bakkali, Medrán, Mangala, Nani, Zaza y Santi Mina.', 19),
(35, '21/01/2017', 'Ni el granizo detiene al Valencia', 'La plantilla del Valencia sufre la virulencia del temporal en la sesión previa al partido de LaLiga en Villarreal. El equipo se ha ejercitado bajo una cortina de agua intensa que no ha parado en ningún momento y que de hecho, por momentos, ha venido con piedra, pero el equipo ha permanecido sobre el terreno de juego como como el filial que ha decidido abandonar el campo anexo al miniestadio Antonio Puchades donde el primer equipo se estaba ejercitando.', 19),
(36, '21/01/2017', 'Samu Castillejo se retira del primer entrenamiento de la semana', 'Samu Castillejo se retiró de la sesión de entrenamiento del Villarreal, primera de la semana, debido a un golpe en el tobillo derecho por el que será a sometido a pruebas médicas.\r\nSamu Castillejo deberá a esperar a los resultados para conocer el alcance del problema y si llega al partido del sábado ante el Valencia, si bien en el cuerpo médico se confía en que no sea un problema mayor.\r\nAdemás, a la ausencia de los lesionados habituales como son Roberto Soldado, Denis Cheryshev y Mateo Musacchio, se sumó la del centrocampista Roberto Soriano, que sigue con sus problemas gastrointestinales.\r\nPor contra, ya estarán disponibles para el duelo autonómico con el Valencia el delantero Nicola Sansone y el defensa Jaume Costa tras cumplir con sus partidos de sanción en la pasada jornada.\r\nEl Villarreal tiene previsto entrenar todos los días de la semana hasta el viernes, y lo hará en horario matinal en sesiones de puertas abierta, a excepción de la sesión de este viernes que se llevará a cabo en el campo de La Cerámica a puerta cerrada.', 20),
(37, '21/01/2017', 'El Villarreal busca gol', 'El Villarreal evidenció en La Coruña este pasado fin de semana las dos caras de una misma moneda futbolística: la solidez defensiva de la que hecho gala el equipo amarillo esta temporada y que le ha permitido plantar cara a los mejores y la falta de producción ofensiva de la que ha adolecido en algunos encuentros. Tanto es así que desde el club, si bien no se considera una urgencia que paliar a cualquier precio, no se descarta la llegada de un ariete de características diferentes a los que actualmente tiene en la plantilla.\r\nLos problemas en forma de lesiones de jugadores clave para el ataque amarillo -caso de Soldado, Cheryshev o, en gran parte de la temporada, de Bakambu- han restado potencial a los castellonenses, si bien no han sido la única causa.\r\nLa irregularidad de jugadores como Alexander Pato o la poca producción ofensiva de otros delanteros en proceso de formación, como el colombiano Santos Borré, ha hecho que el ataque, en demasiados partidos, haya estado sostenido sólo por el buen trabajo de Sansone o la llegada de futbolistas de segunda linea, como Trigueros o Soriano. El propio Fran Escribá ya ha dejado claro que entre las carencias de la plantilla, pese a mostrarse contento con el material humano con el que puede trabajar, se encuentra la ausencia de un futbolista referente en el área.', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partido`
--

CREATE TABLE IF NOT EXISTS `partido` (
  `id_partido` int(11) NOT NULL,
  `fecha_partido` varchar(20) NOT NULL,
  `hora_partido` varchar(10) NOT NULL,
  `id_estadio` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `partido`
--

INSERT INTO `partido` (`id_partido`, `fecha_partido`, `hora_partido`, `id_estadio`) VALUES
(16, '16/01/2017', '20:00', 2),
(18, '28/01/2017', '10:00', 1),
(28, '29/01/2017', '10:00', 1),
(29, '20/02/2017', '10:00', 1),
(30, '20/01/2017', '10:00', 3),
(31, '08/01/2017', '10:00', 1),
(32, '21/01/2017', '10:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partido_usuario`
--

CREATE TABLE IF NOT EXISTS `partido_usuario` (
  `id_partido_usuario` int(5) NOT NULL,
  `id_partido` int(5) NOT NULL,
  `id_usuario` int(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `partido_usuario`
--

INSERT INTO `partido_usuario` (`id_partido_usuario`, `id_partido`, `id_usuario`) VALUES
(2, 18, 40),
(3, 16, 40),
(8, 18, 45),
(16, 28, 45),
(17, 16, 44),
(19, 18, 44),
(28, 29, 43),
(29, 18, 43),
(36, 28, 40),
(37, 28, 43),
(38, 30, 43),
(39, 31, 43),
(40, 32, 43),
(41, 29, 40);

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `peticion_amistad`
--

INSERT INTO `peticion_amistad` (`id_peticion`, `estado_peticion`, `fecha_peticion`, `id_usuario_peticion`, `id_usuario_recibe`) VALUES
(9, 0, '21/01/2017', 40, 45),
(10, 1, '21/01/2017', 40, 43),
(11, 0, '21/01/2017', 45, 44),
(12, 0, '21/01/2017', 45, 43),
(13, 0, '21/01/2017', 44, 40),
(14, 0, '21/01/2017', 44, 43),
(15, 0, '21/01/2017', 48, 46),
(17, 0, '21/01/2017', 40, 46),
(18, 0, '21/01/2017', 40, 48);

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
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre_usuario`, `apellido1_usuario`, `apellido2_usuario`, `correo_usuario`, `pass_usuario`, `foto_usuario`, `ciudad_usuario`, `equipo_id`, `admin`) VALUES
(40, 'Ricardo', 'Montero', 'Recuero', 'ricardo@gmail.com', '6720720054e9d24fbf6c20a831ff287e', 'userImgs/1484150470carnetRicardo.jpg', 'Sevilla', 2, 1),
(42, 'User', 'User1', 'User2', 'user@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee', 'userImgs/1484151189user.png', 'A CoruÃ±a', 20, 1),
(43, 'Admin', 'Admin1', 'Admin2', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'userImgs/1484151218admin.png', 'Soria', 13, 0),
(44, 'Francisco', 'Araque', 'Fri­as', 'francisco@gmail.com', '117735823fadae51db091c7d63e60eb0', 'userImgs/1484151339fran.jpg', 'Sevilla', 1, 1),
(45, 'Alberto', 'Garrido', 'Pacheco', 'alberto@gmail.com', '177dacb14b34103960ec27ba29bd686b', 'userImgs/1484151621alberto.jpg', 'Sevilla', 2, 1),
(46, 'Antonio', 'Recio', 'Matamoros', 'antonio@gmail.com', '4a181673429f0b6abbfd452f0f3b5950', 'userImgs/1485003568antonio.jpg', 'Madrid', 16, 1),
(47, 'Bill', 'Gates', 'William', 'bill@gmail.com', 'e8375d7cd983efcbf956da5937050ffc', 'userImgs/1485003633bill.jpeg', 'Vizcaya', 4, 1),
(48, 'Amador', 'Rivas', 'Borderline', 'amador@gmail.com', '299ad925b432e99fbc250cf7fde69c51', 'userImgs/1485003675amador.jpg', 'Madrid', 5, 1);

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
-- Indices de la tabla `partido_usuario`
--
ALTER TABLE `partido_usuario`
  ADD PRIMARY KEY (`id_partido_usuario`);

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
  MODIFY `id_equipo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `estadio`
--
ALTER TABLE `estadio`
  MODIFY `id_estadio` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de la tabla `noticia`
--
ALTER TABLE `noticia`
  MODIFY `id_noticia` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT de la tabla `partido`
--
ALTER TABLE `partido`
  MODIFY `id_partido` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `partido_usuario`
--
ALTER TABLE `partido_usuario`
  MODIFY `id_partido_usuario` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT de la tabla `peticion_amistad`
--
ALTER TABLE `peticion_amistad`
  MODIFY `id_peticion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
