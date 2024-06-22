-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-11-2023 a las 15:50:34
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `personas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `ID` int(11) NOT NULL,
  `ID_usuario` int(11) DEFAULT NULL,
  `titulo` varchar(100) NOT NULL,
  `contenido` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `imagen_pregunta` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`ID`, `ID_usuario`, `titulo`, `contenido`, `fecha`, `imagen_pregunta`) VALUES
(1, 1, '¿Cómo aprender SQL?', 'Estoy interesado en aprender SQL. ¿Alguien tiene algún consejo?', '2023-11-16 14:40:14', 'imagen1.jpg'),
(2, 2, 'Problema con JOIN en SQL', 'Estoy teniendo dificultades con una consulta SQL que utiliza JOIN. ¿Alguien puede ayudarme?', '2023-11-16 14:40:14', 'imagen2.jpg'),
(3, 3, 'Recomendaciones de libros de programación', '¿Cuáles son algunos buenos libros de programación que recomiendan?', '2023-11-16 14:40:14', 'imagen3.jpg'),
(4, 4, 'kjiglhou', 'u0p8yugyu', '2023-11-16 14:45:29', 'imagen/65562b09b46f5_Lizzy.webp'),
(5, 5, 'o90jki9jh', 'jiji9jui', '2023-11-16 14:48:32', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `ID` int(11) NOT NULL,
  `ID_preguntas` int(11) DEFAULT NULL,
  `ID_usuario` int(11) DEFAULT NULL,
  `contenido` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`ID`, `ID_preguntas`, `ID_usuario`, `contenido`, `fecha`) VALUES
(1, 1, 2, 'Puedes comenzar por aprender los fundamentos de SQL y practicar con ejercicios.', '2023-11-16 14:40:14'),
(2, 2, 3, '¿Puedes proporcionar más detalles sobre el problema que estás experimentando con JOIN?', '2023-11-16 14:40:14'),
(3, 3, 1, 'Te recomiendo \"Clean Code\" de Robert C. Martin y \"The Pragmatic Programmer\" de Andrew Hunt y David Thomas.', '2023-11-16 14:40:14'),
(4, 1, 4, 'el richi si es mayate o nel?', '2023-11-16 14:45:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `fecha_nacimiento` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `edad` int(11) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `fecha_nacimiento`, `email`, `contrasena`, `edad`, `avatar`) VALUES
(1, 'Usuario1', '1990-01-01', 'usuario1@email.com', 'contrasena1', 32, 'avatar1.jpg'),
(2, 'Usuario2', '1985-05-15', 'usuario2@email.com', 'contrasena2', 37, 'avatar2.jpg'),
(3, 'Usuario3', '2000-08-20', 'usuario3@email.com', 'contrasena3', 22, 'avatar3.jpg'),
(4, 'Gamalielm', '2023-11-08', 'chilaquilespapy@gmail.com', 'a', NULL, NULL),
(5, 'Gamalielm', '2023-11-30', 'mili@gmail.com', 'd', NULL, 'perfil/contenedor.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_usuario` (`ID_usuario`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_preguntas` (`ID_preguntas`),
  ADD KEY `ID_usuario` (`ID_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `preguntas_ibfk_1` FOREIGN KEY (`ID_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD CONSTRAINT `respuestas_ibfk_1` FOREIGN KEY (`ID_preguntas`) REFERENCES `preguntas` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `respuestas_ibfk_2` FOREIGN KEY (`ID_usuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
