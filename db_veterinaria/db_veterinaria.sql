-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-10-2025 a las 02:45:56
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_veterinaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gatos`
--

CREATE TABLE `gatos` (
  `id_gato` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `edad_meses` int(11) DEFAULT NULL,
  `raza` varchar(50) NOT NULL,
  `color` varchar(20) NOT NULL,
  `peso_kg` float DEFAULT NULL,
  `observaciones` varchar(256) NOT NULL,
  `id_peluquero` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `gatos`
--

INSERT INTO `gatos` (`id_gato`, `nombre`, `edad_meses`, `raza`, `color`, `peso_kg`, `observaciones`, `id_peluquero`) VALUES
(1, 'Canelo', 15, 'Gato naranja', 'Naranja', 4, 'Ligera cautela: fanatico de saltar hacia las cortinas, conocido por ser muy lloron', 1),
(3, 'Luna', 15, 'Gato cafe', 'cafe', 5, 'Hermana calmada de Canelo', 1),
(4, 'Tito', 26, 'Siames', 'Crema', 5, 'Callejero', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peluqueros`
--

CREATE TABLE `peluqueros` (
  `id_peluquero` int(11) NOT NULL,
  `nombre_apellido` varchar(100) NOT NULL,
  `telefono` varchar(16) NOT NULL,
  `edad` int(100) NOT NULL,
  `turno` varchar(20) NOT NULL,
  `especialidad` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `peluqueros`
--

INSERT INTO `peluqueros` (`id_peluquero`, `nombre_apellido`, `telefono`, `edad`, `turno`, `especialidad`) VALUES
(1, 'Rodrigo Membrilla', '2494329912', 23, 'Tarde', 'Especializado en paciencia y cuidado de gatos naranjas con dudosa cantidad de inteligencia\''),
(2, 'Agustin F.', '24941', 22, 'Mañana', 'Pasante.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`) VALUES
(1, 'UserEjemplo', '$2y$10$2zKVZiStZpsiBVrzzu1NOusQtE5oSWOc3SNIxFHRWBnoQd0TtJism');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `gatos`
--
ALTER TABLE `gatos`
  ADD PRIMARY KEY (`id_gato`),
  ADD KEY `fk_peluquero` (`id_peluquero`);

--
-- Indices de la tabla `peluqueros`
--
ALTER TABLE `peluqueros`
  ADD PRIMARY KEY (`id_peluquero`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `gatos`
--
ALTER TABLE `gatos`
  MODIFY `id_gato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `peluqueros`
--
ALTER TABLE `peluqueros`
  MODIFY `id_peluquero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `gatos`
--
ALTER TABLE `gatos`
  ADD CONSTRAINT `fk_peluquero` FOREIGN KEY (`id_peluquero`) REFERENCES `peluqueros` (`id_peluquero`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
