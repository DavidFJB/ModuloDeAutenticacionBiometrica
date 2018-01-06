-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-01-2018 a las 12:29:46
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biofacvoz`
--
CREATE DATABASE IF NOT EXISTS `biofacvoz` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `biofacvoz`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `huellas_faciales`
--

CREATE TABLE `huellas_faciales` (
  `HF_ID` int(10) NOT NULL,
  `HuellaFacial` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `huellas_faciales`
--

INSERT INTO `huellas_faciales` (`HF_ID`, `HuellaFacial`) VALUES
(0, 'media/eliminar.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `huellas_vocales`
--

CREATE TABLE `huellas_vocales` (
  `HV_ID` int(10) NOT NULL,
  `HuellaVocal` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `EnrollmentID` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `huellas_vocales`
--

INSERT INTO `huellas_vocales` (`HV_ID`, `HuellaVocal`, `EnrollmentID`) VALUES
(0, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso_fallido`
--

CREATE TABLE `ingreso_fallido` (
  `IngresoFallidoID` int(15) NOT NULL,
  `UserID` int(15) NOT NULL,
  `FechaHora` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `RolID` int(10) NOT NULL,
  `Tipo` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`RolID`, `Tipo`) VALUES
(1, 'Usuario'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `UserID` int(15) NOT NULL,
  `Nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `Apellido` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `Password` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `Telefono` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `Email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `IntentosFallidos` int(10) NOT NULL,
  `Estado` tinyint(1) NOT NULL,
  `Rol` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_huella`
--

CREATE TABLE `usuario_huella` (
  `Usuario_Huella_ID` int(10) NOT NULL,
  `UserID` int(10) NOT NULL,
  `HF_ID` int(10) NOT NULL,
  `HV1_ID` int(10) NOT NULL,
  `HV2_ID` int(10) NOT NULL,
  `HV3_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `huellas_faciales`
--
ALTER TABLE `huellas_faciales`
  ADD PRIMARY KEY (`HF_ID`);

--
-- Indices de la tabla `huellas_vocales`
--
ALTER TABLE `huellas_vocales`
  ADD PRIMARY KEY (`HV_ID`);

--
-- Indices de la tabla `ingreso_fallido`
--
ALTER TABLE `ingreso_fallido`
  ADD PRIMARY KEY (`IngresoFallidoID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`RolID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`UserID`),
  ADD KEY `Rol` (`Rol`);

--
-- Indices de la tabla `usuario_huella`
--
ALTER TABLE `usuario_huella`
  ADD PRIMARY KEY (`Usuario_Huella_ID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `HF_ID` (`HF_ID`),
  ADD KEY `HV1_ID` (`HV1_ID`),
  ADD KEY `HV2_ID` (`HV2_ID`),
  ADD KEY `HV3_ID` (`HV3_ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `huellas_faciales`
--
ALTER TABLE `huellas_faciales`
  MODIFY `HF_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `huellas_vocales`
--
ALTER TABLE `huellas_vocales`
  MODIFY `HV_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `ingreso_fallido`
--
ALTER TABLE `ingreso_fallido`
  MODIFY `IngresoFallidoID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `RolID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `UserID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `usuario_huella`
--
ALTER TABLE `usuario_huella`
  MODIFY `Usuario_Huella_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ingreso_fallido`
--
ALTER TABLE `ingreso_fallido`
  ADD CONSTRAINT `ingreso_fallido_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `usuarios` (`UserID`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`Rol`) REFERENCES `rol` (`RolID`);

--
-- Filtros para la tabla `usuario_huella`
--
ALTER TABLE `usuario_huella`
  ADD CONSTRAINT `usuario_huella_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `usuarios` (`UserID`),
  ADD CONSTRAINT `usuario_huella_ibfk_2` FOREIGN KEY (`HF_ID`) REFERENCES `huellas_faciales` (`HF_ID`),
  ADD CONSTRAINT `usuario_huella_ibfk_3` FOREIGN KEY (`HV1_ID`) REFERENCES `huellas_vocales` (`HV_ID`),
  ADD CONSTRAINT `usuario_huella_ibfk_4` FOREIGN KEY (`HV2_ID`) REFERENCES `huellas_vocales` (`HV_ID`),
  ADD CONSTRAINT `usuario_huella_ibfk_5` FOREIGN KEY (`HV3_ID`) REFERENCES `huellas_vocales` (`HV_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
