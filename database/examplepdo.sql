-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-06-2020 a las 06:54:48
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `examplepdo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf32_spanish2_ci NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish2_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `status_id`) VALUES
(1, 'Terror', 1),
(2, 'drama', 1),
(3, 'Comedia', 1),
(4, 'Infantil', 1),
(5, 'Suspenso', 1),
(6, 'Macabra', 1),
(7, 'Romantica', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category_movie`
--

CREATE TABLE `category_movie` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `category_movie`
--

INSERT INTO `category_movie` (`id`, `movie_id`, `category_id`, `status_id`) VALUES
(3, 1, 5, 1),
(4, 2, 4, 1),
(5, 2, 3, 1),
(6, 3, 4, 1),
(7, 3, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf32_spanish2_ci NOT NULL,
  `description` text COLLATE utf32_spanish2_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish2_ci;

--
-- Volcado de datos para la tabla `movies`
--

INSERT INTO `movies` (`id`, `name`, `description`, `user_id`, `status_id`) VALUES
(1, 'Los piratas de caribe', 'Navengando aguas', 2, 1),
(2, 'Up', 'Una aventura en lo aires', 2, 1),
(3, 'Kunfu panda', 'El guerrero Dragon', 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movie_rental`
--

CREATE TABLE `movie_rental` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `rental_id` int(11) NOT NULL,
  `unit_price` bigint(20) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `movie_rental`
--

INSERT INTO `movie_rental` (`id`, `movie_id`, `rental_id`, `unit_price`, `status_id`) VALUES
(1, 1, 1, 10000, 1),
(2, 2, 1, 10000, 1),
(3, 3, 1, 10000, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rentals`
--

CREATE TABLE `rentals` (
  `id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  `total` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rentals`
--

INSERT INTO `rentals` (`id`, `start_date`, `end_date`, `status_id`, `total`, `user_id`) VALUES
(1, '2020-06-03', '2020-07-07', 1, 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `status_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `status_id`) VALUES
(1, 'Administrador', 1),
(2, 'Empleado', 1),
(3, 'Cliente', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `statuses`
--

CREATE TABLE `statuses` (
  `id` int(11) NOT NULL,
  `status` varchar(50) COLLATE utf32_spanish2_ci NOT NULL,
  `type_status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish2_ci;

--
-- Volcado de datos para la tabla `statuses`
--

INSERT INTO `statuses` (`id`, `status`, `type_status_id`) VALUES
(1, 'Activo', 3),
(2, 'Inactivo', 3),
(7, 'reservado', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type_status`
--

CREATE TABLE `type_status` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `type_status`
--

INSERT INTO `type_status` (`id`, `name`) VALUES
(1, 'General'),
(2, 'Pelicula'),
(3, 'usuarios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf32_spanish2_ci NOT NULL,
  `email` varchar(150) COLLATE utf32_spanish2_ci NOT NULL,
  `password` varchar(100) COLLATE utf32_spanish2_ci NOT NULL,
  `status_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish2_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `status_id`, `rol_id`) VALUES
(1, 'Sergio Rodriguez ', 'SRodrigues@gmail.com', 'ksjdlk324', 1, 2),
(2, 'Jesus rodriguez', 'JdRodiguer@gmail.com', 'ksljfdaslk12312', 1, 1),
(3, 'federico', 'federico@hotmail.com', 'dasdkjl4343', 1, 1),
(4, 'Walteros Dominguez', 'WDominguez@gmail.com', 'dominguez08', 1, 1),
(5, 'juan manuel vel', 'jmanuel@gmial.com', '234sd', 1, 1),
(6, 'Gabriel Stiven Velandia Ochoa', 'Gs@gmail.com', '12345', 1, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indices de la tabla `category_movie`
--
ALTER TABLE `category_movie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indices de la tabla `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indices de la tabla `movie_rental`
--
ALTER TABLE `movie_rental`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `rental_id` (`rental_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indices de la tabla `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indices de la tabla `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_status_id` (`type_status_id`);

--
-- Indices de la tabla `type_status`
--
ALTER TABLE `type_status`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `rol_id` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `category_movie`
--
ALTER TABLE `category_movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `movie_rental`
--
ALTER TABLE `movie_rental`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `rentals`
--
ALTER TABLE `rentals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `type_status`
--
ALTER TABLE `type_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`);

--
-- Filtros para la tabla `category_movie`
--
ALTER TABLE `category_movie`
  ADD CONSTRAINT `category_movie_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`),
  ADD CONSTRAINT `category_movie_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`),
  ADD CONSTRAINT `category_movie_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `category_movie_ibfk_4` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`);

--
-- Filtros para la tabla `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `movies_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`);

--
-- Filtros para la tabla `movie_rental`
--
ALTER TABLE `movie_rental`
  ADD CONSTRAINT `movie_rental_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`),
  ADD CONSTRAINT `movie_rental_ibfk_2` FOREIGN KEY (`rental_id`) REFERENCES `rentals` (`id`),
  ADD CONSTRAINT `movie_rental_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`);

--
-- Filtros para la tabla `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `rentals_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`),
  ADD CONSTRAINT `rentals_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`);

--
-- Filtros para la tabla `statuses`
--
ALTER TABLE `statuses`
  ADD CONSTRAINT `statuses_ibfk_1` FOREIGN KEY (`type_status_id`) REFERENCES `type_status` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
