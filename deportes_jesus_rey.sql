-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-06-2019 a las 12:33:09
-- Versión del servidor: 10.1.40-MariaDB
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `deportes_jesus_rey`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id_admin` int(10) UNSIGNED NOT NULL,
  `nombreAdmin` varchar(30) NOT NULL,
  `apellidosAdmin` varchar(30) NOT NULL,
  `correoAdmin` varchar(30) NOT NULL,
  `contrAdmin` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id_admin`, `nombreAdmin`, `apellidosAdmin`, `correoAdmin`, `contrAdmin`) VALUES
(2, 'Juan David', 'Mosquera MuÃ±oz', 'juan@gmail.com', '$2y$10$kpbwcYXGFMreo/UfFg3JA.2DobU.0HS/cIF1cUjMoE1M8yL8z4zcK');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capitanes`
--

CREATE TABLE `capitanes` (
  `id_capitan` int(10) UNSIGNED NOT NULL,
  `correoCapitan` varchar(30) NOT NULL,
  `contrCapitan` varchar(60) NOT NULL,
  `id_equipo_cap` int(10) UNSIGNED NOT NULL,
  `id_jugador_cap` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `capitanes`
--

INSERT INTO `capitanes` (`id_capitan`, `correoCapitan`, `contrCapitan`, `id_equipo_cap`, `id_jugador_cap`) VALUES
(1, 'andres@gmail.com', '$2y$10$pa3da6CKK5LFuaEIESCxculJjsU3Wyujs6tyw1LfvQPvWdyHogduW', 1, 1),
(2, 'andres@gmail.com', '$2y$10$LGo3GYsc99CMJzoaGzLYaOcwQSg1oSzqw9aI6bMx5kZRKR3JhQV0.', 2, 8),
(3, 'andres@gmail.com', '$2y$10$tOF1A//zS5N8xTy.lP0ep.2cciZfTGVEDtHzdnZOrGRDKeEKskq0.', 3, 15),
(5, 'dario3@gmail.com', '$2y$10$QiPzZeRriEHQlWlkHZqCBeEGE8GEwGwASbQn/Kd6eYlO79kOUKn0S', 5, 29);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id_equipo` int(10) UNSIGNED NOT NULL,
  `nombreEquipo` varchar(30) NOT NULL,
  `puntos` int(11) NOT NULL DEFAULT '0',
  `escudo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id_equipo`, `nombreEquipo`, `puntos`, `escudo`) VALUES
(1, 'Once Uno', 1, 'escudos/Once Uno.png'),
(2, 'Manchester', 0, 'escudos/Manchester.png'),
(3, 'Noveno Dos', 0, 'escudos/Noveno Dos.png'),
(5, 'Once Dos', 1, 'escudos/Once Dos.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `goles`
--

CREATE TABLE `goles` (
  `id_gol` int(10) UNSIGNED NOT NULL,
  `id_partido_g` int(10) UNSIGNED NOT NULL,
  `id_jugador_g` int(10) UNSIGNED NOT NULL,
  `numeroGoles` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `goles`
--

INSERT INTO `goles` (`id_gol`, `id_partido_g`, `id_jugador_g`, `numeroGoles`) VALUES
(3, 3, 1, 4),
(4, 3, 34, 2),
(5, 3, 35, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores`
--

CREATE TABLE `jugadores` (
  `id_jugador` int(10) UNSIGNED NOT NULL,
  `nombreJugador` varchar(30) NOT NULL,
  `apellidosJugador` varchar(30) NOT NULL,
  `grupoJugador` varchar(30) NOT NULL,
  `id_equipo_jug` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `jugadores`
--

INSERT INTO `jugadores` (`id_jugador`, `nombreJugador`, `apellidosJugador`, `grupoJugador`, `id_equipo_jug`) VALUES
(1, 'Juan David', 'Mosquera MuÃ±oz', '11-1', 1),
(2, 'Juan Pablo', 'Gallego Valencia', '11-1', 1),
(3, 'Brandon', 'PatiÃ±o Gutierrez', '11-1', 1),
(4, 'Sebastian', 'Velez Correa', '11-1', 1),
(5, 'Alejandro', 'Quintero Charlock', '11-1', 1),
(6, 'Sebastian', 'Rivera Cardona', '11-1', 1),
(7, 'Cristian', 'Usuga Ardila', '11-1', 1),
(8, 'nicolas', 'Herrera', '10-1', 2),
(9, 'Jose', 'Gallego Valencia', '10-1', 2),
(10, 'Brandon', 'Valencia', '10-1', 2),
(11, 'Miguel Angel', 'Velazquez', '10-1', 2),
(12, 'Alejandro', 'Quintero Charlock', '10-1', 2),
(13, 'Sebastian', 'Rivera Cardona', '10-1', 2),
(14, 'Janier', 'Usuga Ardila', '10-1', 2),
(15, 'Andres', 'Gomez', '9-4', 3),
(16, 'Juan Pablo', 'Giraldo Vergara', '9-4', 3),
(17, 'Juan Manuel', 'PatiÃ±o Gutierrez', '9-4', 3),
(18, 'Miguel Angel', 'Velazquez', '9-4', 3),
(19, 'Jose Daniel', 'Quintero Charlock', '9-4', 3),
(20, 'Sebastian', 'Rivera', '9-4', 3),
(21, 'Cristian', 'Diaz', '9-4', 3),
(29, 'Dario', 'Ospina', '11-2', 5),
(30, 'Juan Pablo', 'Gallego Valencia', '11-2', 5),
(31, 'Juan Manuel', 'Valencia', '11-2', 5),
(32, 'Miguel Angel', 'Velazquez', '11-2', 5),
(33, 'Jose Daniel', 'Quintero Charlock', '11-2', 5),
(34, 'Sebastian', 'Rivera Cardona', '11-2', 5),
(35, 'Cristian', 'Usuga Ardila', '11-2', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidos`
--

CREATE TABLE `partidos` (
  `id_partido` int(10) UNSIGNED NOT NULL,
  `fechaPartido` date NOT NULL,
  `id_equipoLocal` int(10) UNSIGNED NOT NULL,
  `id_equipoVisitante` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `partidos`
--

INSERT INTO `partidos` (`id_partido`, `fechaPartido`, `id_equipoLocal`, `id_equipoVisitante`) VALUES
(1, '2019-06-13', 1, 3),
(3, '2019-06-05', 1, 5),
(4, '2019-05-23', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `porteros`
--

CREATE TABLE `porteros` (
  `id_portero` int(10) UNSIGNED NOT NULL,
  `nombrePortero` varchar(30) NOT NULL,
  `apellidosPortero` varchar(30) NOT NULL,
  `gradoPortero` varchar(20) NOT NULL,
  `id_equipo_por` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `porteros`
--

INSERT INTO `porteros` (`id_portero`, `nombrePortero`, `apellidosPortero`, `gradoPortero`, `id_equipo_por`) VALUES
(1, 'Sebastian', 'Rivera Cardona', '11-1', 1),
(2, '', '', '', 2),
(3, 'Juan Manuel', 'PatiÃ±o Gutierrez', '9-4', 3),
(5, 'Juan Manuel', 'Valencia', '11-2', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultados`
--

CREATE TABLE `resultados` (
  `id_resultado` int(10) UNSIGNED NOT NULL,
  `golesLocal` int(11) NOT NULL,
  `golesVisitante` int(11) NOT NULL,
  `id_partido_res` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `resultados`
--

INSERT INTO `resultados` (`id_resultado`, `golesLocal`, `golesVisitante`, `id_partido_res`) VALUES
(1, 4, 4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sanciones`
--

CREATE TABLE `sanciones` (
  `id_sancion` int(10) UNSIGNED NOT NULL,
  `colorTarjeta` varchar(20) NOT NULL,
  `dobleAmarilla` tinyint(1) NOT NULL,
  `id_jugador_san` int(10) UNSIGNED NOT NULL,
  `id_partido_f` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sanciones`
--

INSERT INTO `sanciones` (`id_sancion`, `colorTarjeta`, `dobleAmarilla`, `id_jugador_san`, `id_partido_f`) VALUES
(1, 'roja', 0, 5, 3),
(2, 'amarilla', 0, 33, 3),
(3, 'amarilla', 0, 34, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indices de la tabla `capitanes`
--
ALTER TABLE `capitanes`
  ADD PRIMARY KEY (`id_capitan`),
  ADD KEY `fk_equipoCap` (`id_equipo_cap`),
  ADD KEY `fk_jugCap` (`id_jugador_cap`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id_equipo`),
  ADD KEY `id_equipo` (`id_equipo`);

--
-- Indices de la tabla `goles`
--
ALTER TABLE `goles`
  ADD PRIMARY KEY (`id_gol`),
  ADD KEY `fk_partGol` (`id_partido_g`),
  ADD KEY `fk_jugGol` (`id_jugador_g`);

--
-- Indices de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD PRIMARY KEY (`id_jugador`),
  ADD KEY `fk_equipojug` (`id_equipo_jug`);

--
-- Indices de la tabla `partidos`
--
ALTER TABLE `partidos`
  ADD PRIMARY KEY (`id_partido`),
  ADD KEY `fk_equipoLocal` (`id_equipoLocal`),
  ADD KEY `fk_equipoVisitante` (`id_equipoVisitante`);

--
-- Indices de la tabla `porteros`
--
ALTER TABLE `porteros`
  ADD PRIMARY KEY (`id_portero`),
  ADD KEY `fk_equiport` (`id_equipo_por`);

--
-- Indices de la tabla `resultados`
--
ALTER TABLE `resultados`
  ADD PRIMARY KEY (`id_resultado`),
  ADD KEY `fk_resPart` (`id_partido_res`);

--
-- Indices de la tabla `sanciones`
--
ALTER TABLE `sanciones`
  ADD PRIMARY KEY (`id_sancion`),
  ADD KEY `fk_partidoF` (`id_partido_f`),
  ADD KEY `fk_jugSan` (`id_jugador_san`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id_admin` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `capitanes`
--
ALTER TABLE `capitanes`
  MODIFY `id_capitan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id_equipo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `goles`
--
ALTER TABLE `goles`
  MODIFY `id_gol` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  MODIFY `id_jugador` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `partidos`
--
ALTER TABLE `partidos`
  MODIFY `id_partido` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `porteros`
--
ALTER TABLE `porteros`
  MODIFY `id_portero` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `resultados`
--
ALTER TABLE `resultados`
  MODIFY `id_resultado` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `sanciones`
--
ALTER TABLE `sanciones`
  MODIFY `id_sancion` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `capitanes`
--
ALTER TABLE `capitanes`
  ADD CONSTRAINT `fk_equipoCap` FOREIGN KEY (`id_equipo_cap`) REFERENCES `equipos` (`id_equipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jugCap` FOREIGN KEY (`id_jugador_cap`) REFERENCES `jugadores` (`id_jugador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `goles`
--
ALTER TABLE `goles`
  ADD CONSTRAINT `fk_jugGol` FOREIGN KEY (`id_jugador_g`) REFERENCES `jugadores` (`id_jugador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_partGol` FOREIGN KEY (`id_partido_g`) REFERENCES `partidos` (`id_partido`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD CONSTRAINT `fk_equipojug` FOREIGN KEY (`id_equipo_jug`) REFERENCES `equipos` (`id_equipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `partidos`
--
ALTER TABLE `partidos`
  ADD CONSTRAINT `fk_equipoLocal` FOREIGN KEY (`id_equipoLocal`) REFERENCES `equipos` (`id_equipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_equipoVisitante` FOREIGN KEY (`id_equipoVisitante`) REFERENCES `equipos` (`id_equipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `porteros`
--
ALTER TABLE `porteros`
  ADD CONSTRAINT `fk_equiport` FOREIGN KEY (`id_equipo_por`) REFERENCES `equipos` (`id_equipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `resultados`
--
ALTER TABLE `resultados`
  ADD CONSTRAINT `fk_resPart` FOREIGN KEY (`id_partido_res`) REFERENCES `partidos` (`id_partido`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sanciones`
--
ALTER TABLE `sanciones`
  ADD CONSTRAINT `fk_jugSan` FOREIGN KEY (`id_jugador_san`) REFERENCES `jugadores` (`id_jugador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_partidoF` FOREIGN KEY (`id_partido_f`) REFERENCES `partidos` (`id_partido`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
