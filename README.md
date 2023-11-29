# SitioWebPHP

## Base de datos

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-11-2023 a las 07:44:17
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sitioweb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `imagen` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id`, `nombre`, `imagen`) VALUES
(41, 'Harry Potter y la Orden del Fénix', '1699830224_hp5.jpg'),
(42, 'Harry Potter y las Reliquias de la Muerte ', '1699830357_hp7.jpg'),
(45, 'Harry Potter y el Legado Maldito ', '1699830434_hp8.jpg'),
(46, 'Harry Potter y La Cámara Secreta', '1699848718_hp2.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

## Imágenes de Harry Potter

![hp8](https://github.com/GloriaCoralCerecedo/SitioWebPHP/assets/75102777/2a07309a-126d-45de-8820-79f8a5544607)
![hp7](https://github.com/GloriaCoralCerecedo/SitioWebPHP/assets/75102777/a362d94c-ea9b-4e98-ab42-27d83d335aab)
![hp6](https://github.com/GloriaCoralCerecedo/SitioWebPHP/assets/75102777/02cc5abc-2667-454b-86a3-70a41bdb8883)
![hp5](https://github.com/GloriaCoralCerecedo/SitioWebPHP/assets/75102777/b3fbe194-ef98-4447-a116-49890be61229)
![hp4](https://github.com/GloriaCoralCerecedo/SitioWebPHP/assets/75102777/13c29fcf-120d-4005-9fb3-109b25c0cb92)
![hp3](https://github.com/GloriaCoralCerecedo/SitioWebPHP/assets/75102777/a5afc5f2-412d-42ec-84d1-56d1c3e419b5)
![hp2](https://github.com/GloriaCoralCerecedo/SitioWebPHP/assets/75102777/704fd95f-79b9-4574-a3a5-8d1a5366fc69)
![hp1](https://github.com/GloriaCoralCerecedo/SitioWebPHP/assets/75102777/b2261a93-73e2-48d1-bfaf-15a038d82321)

