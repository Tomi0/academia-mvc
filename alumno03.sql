-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: mysql
-- Tiempo de generación: 07-06-2018 a las 17:38:39
-- Versión del servidor: 8.0.3-rc-log
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `academia`
--
CREATE DATABASE IF NOT EXISTS `alumno03` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `alumno03`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(110) DEFAULT NULL,
  `category_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `category_id`) VALUES
(1, 'PAU', 'pau-1', NULL),
(25, 'Universidad', 'universidad-25', NULL),
(26, 'Primero de carrera', 'primero-de-carrera-26', 25),
(28, 'Primaria', 'primaria-28', NULL),
(29, 'Primero de primaria', 'primero-de-primaria-29', 28),
(30, 'Segundo de primaria', 'segundo-de-primaria-30', 28),
(31, 'Tercero de primaria', 'tercero-de-primaria-31', 28);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documents`
--

CREATE TABLE `documents` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(300) NOT NULL,
  `slug` varchar(102) NOT NULL,
  `url` varchar(150) NOT NULL,
  `subject_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `documents`
--

INSERT INTO `documents` (`id`, `name`, `description`, `slug`, `url`, `subject_id`) VALUES
(15, 'Tema 1 Test', 'Prueba 1', '1527941426test.pdf', '/var/www/academia/storage/documents/1527941426test.pdf', 1),
(16, 'Tema 2 test 2', 'Esto es una prueba', '1528214086test.pdf', '/var/www/academia/storage/documents/1528214086test.pdf', 1),
(22, 'Sinfonía número 9 de Beethoven', 'Beethoven comenzó a componerla en 1818 y finalizó su composición a principios de 1824', '1528391648test.pdf', '/var/www/academia/storage/documents/1528391648test.pdf', 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriculas`
--

CREATE TABLE `matriculas` (
  `id` int(10) NOT NULL,
  `subject_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `matriculas`
--

INSERT INTO `matriculas` (`id`, `subject_id`, `user_id`) VALUES
(13, 1, 1),
(26, 16, 4),
(27, 1, 4),
(28, 21, 4),
(29, 1, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'profesor'),
(3, 'alumno'),
(4, 'invitado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `matricula` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `slug`, `category_id`, `user_id`, `matricula`) VALUES
(1, 'Lengua', 'lengua-1', 1, 9, 'fDcr3Z2EMQ'),
(3, 'Química', 'quimica-3', 1, 7, 'hdYyC4Vo9K'),
(16, 'Conocimiento del medio', 'conocimiento-del-medio-16', 1, 7, '7kSQi81sMw'),
(17, 'Lengua', 'lengua-17', 29, 9, 'ZI7lprTmuv'),
(18, 'Mates', 'mates-18', 29, 7, 'ewYKlp4zkq'),
(19, 'Lengua', 'lengua-19', 30, 7, 'geQazDJ5FR'),
(20, 'Matematicas', 'matematicas-20', 30, 9, 'Ooi8pUkxwm'),
(21, 'Musica', 'musica-21', 31, 9, '8tFP3HY1Kz');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `rol_id` int(10) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `rol_id`, `password`) VALUES
(4, 'Alumno', 'alu@gmail.com', 3, '5ebe2294ecd0e0f08eab7690d2a6ee69'),
(6, 'Invitado', 'invitado@gmail.com', 4, '5ebe2294ecd0e0f08eab7690d2a6ee69'),
(7, 'Profesor', 'profesor@gmail.com', 2, '5ebe2294ecd0e0f08eab7690d2a6ee69'),
(8, 'Admin', 'admin@gmail.com', 1, '5ebe2294ecd0e0f08eab7690d2a6ee69'),
(9, 'Profe', 'profe@gmail.com', 2, '5ebe2294ecd0e0f08eab7690d2a6ee69'),
(10, 'Tomi', 'prueba@gmail.com', 3, '5ebe2294ecd0e0f08eab7690d2a6ee69');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indices de la tabla `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
