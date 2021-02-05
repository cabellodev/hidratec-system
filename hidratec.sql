-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-02-2021 a las 03:52:42
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hidratec`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `brand`
--

CREATE TABLE `brand` (
  `id_brand` int(11) NOT NULL,
  `name` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  `states` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `brand`
--

INSERT INTO `brand` (`id_brand`, `name`, `states`) VALUES
(0, 'VALVOY', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `component`
--

CREATE TABLE `component` (
  `id_component` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `description` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `states` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `component`
--

INSERT INTO `component` (`id_component`, `name`, `description`, `states`) VALUES
(1, 'Drenador', 'filtro de agua ', 1),
(2, 'Tornos', 'tornos que para agujerear', 1),
(3, 'Valvula', 'válulas de distintos tipos de motores  oleohidraulicos', 1),
(4, 'Bomba', 'asdada444432222', 1),
(5, 'Cilindros', 'cilindros para sistemas de aceits', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL,
  `nombre_estado` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  `sigla` varchar(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_estado`, `nombre_estado`, `sigla`) VALUES
(1, 'Espera de cotización', 'EC'),
(2, 'En evaluación', 'EE'),
(3, 'Espera de aprobación', 'EA'),
(4, 'Dado de baja ', 'DD'),
(5, 'En desarrollo', 'ED');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locations`
--

CREATE TABLE `locations` (
  `id_location` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `description` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `states` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `locations`
--

INSERT INTO `locations` (`id_location`, `name`, `description`, `states`) VALUES
(0, 'Bodega 4', 'ubicada en la repisa 3 de bodega ', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subtask`
--

CREATE TABLE `subtask` (
  `id_subtask` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `description` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `states` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `subtask`
--

INSERT INTO `subtask` (`id_subtask`, `name`, `description`, `states`) VALUES
(1, 'LAVAR ', 'lavar piezas de componentes en reparación', 0),
(2, 'REPARAR', 'reparar un componente en etapa de reparación', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nombre` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `password_hash` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `range` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `rut` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `nombre`, `password_hash`, `estado`, `range`, `rut`, `email`) VALUES
(1, 'Sebastian Cabello Cortes', '$2y$13$fKDMytwWHcU8sd5EgriKceiVUAWlvHZWg8PApUvSEPXbK4r4EWqbq', 1, 'Administrador', '18.001.987-1', 'scabello58@gmail.com'),
(2, 'Hugo Sebastián Carvajal Guajardo', '$2y$13$Keu5Ybr0c6fI2VXgPEC.8eZ/kN1ukYv.h3pE30W7rO0BR8q4QkdJi', 1, 'Administrador', '18.317.053-8', 'hugo.dev10@gmail.com'),
(3, 'Graciela cortes', '$2y$13$0bA4qFOUi0gJ.Z45Y0CFqOEG8XSHmC1hqwEF/D5CCQUkqtcp7jQ2m', 1, 'Administrador', '8.742.789-7', 'gracielacortes12@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id_brand`);

--
-- Indices de la tabla `component`
--
ALTER TABLE `component`
  ADD PRIMARY KEY (`id_component`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id_location`);

--
-- Indices de la tabla `subtask`
--
ALTER TABLE `subtask`
  ADD PRIMARY KEY (`id_subtask`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `component`
--
ALTER TABLE `component`
  MODIFY `id_component` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `subtask`
--
ALTER TABLE `subtask`
  MODIFY `id_subtask` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
