-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-07-2014 a las 18:41:23
-- Versión del servidor: 5.6.14
-- Versión de PHP: 5.5.6

--
-- Base de datos: `pena`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE IF NOT EXISTS `administrador` (
  `dni` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'dni del administrador',
  `pass` varchar(32) COLLATE utf8_spanish_ci NOT NULL COMMENT 'contraseña de administrador',
  PRIMARY KEY (`dni`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='datos del administrador';

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`dni`, `pass`) VALUES
('75486070R', '9fa35b3c0d13855027d2a46f8e301264');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuota`
--

CREATE TABLE IF NOT EXISTS `cuota` (
  `idcuota` int(2) NOT NULL COMMENT 'identificación de la cuota',
  `texto` text COLLATE utf8_spanish_ci NOT NULL COMMENT 'texto referente a la cuota',
  `precio` float NOT NULL DEFAULT '0' COMMENT 'precio de la cuota',
  PRIMARY KEY (`idcuota`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='referente a las cuotas de los jugadores';

--
-- Volcado de datos para la tabla `cuota`
--

INSERT INTO `cuota` (`idcuota`, `texto`, `precio`) VALUES
(0, 'mes', 10),
(1, 'Amarilla', 2),
(2, 'doble amarilla', 4),
(3, 'roja directa', 8),
(4, 'llegar tarde', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deudas`
--

CREATE TABLE IF NOT EXISTS `deudas` (
  `ideuda` int(4) NOT NULL AUTO_INCREMENT COMMENT 'identificación de la deuda',
  `fechapartido` date DEFAULT NULL COMMENT 'fecha del partido al que hace referencia la deuda',
  `fechadeuda` date NOT NULL COMMENT 'fecha en la que es contraída la deuda',
  `idcuota` int(2) NOT NULL COMMENT 'identificación de la cuota que se le aplica',
  `jugador` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'dni del jugador',
  `pagado` enum('s','n') COLLATE utf8_spanish_ci NOT NULL DEFAULT 'n' COMMENT 'pagado s no pagado n',
  PRIMARY KEY (`ideuda`),
  KEY `idcuota` (`idcuota`),
  KEY `fechapartido` (`fechapartido`),
  KEY `jugador` (`jugador`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='deudas del jugador activo' AUTO_INCREMENT=3334 ;

--
-- Volcado de datos para la tabla `deudas`
--

INSERT INTO `deudas` (`ideuda`, `fechapartido`, `fechadeuda`, `idcuota`, `jugador`, `pagado`) VALUES
(7, '2013-01-01', '2013-01-01', 1, '75486070R', 's'),
(8, '2013-02-05', '2013-02-05', 4, '1', 's'),
(9, '2014-04-15', '2014-04-15', 1, '14', 'n'),
(10, '2014-12-16', '2014-12-16', 4, '1', 'n'),
(3257, NULL, '2014-04-01', 0, '1', 'n'),
(3258, NULL, '2014-04-01', 0, '10', 'n'),
(3259, NULL, '2014-04-01', 0, '11', 'n'),
(3260, NULL, '2014-04-01', 0, '12', 'n'),
(3261, NULL, '2014-04-01', 0, '13', 'n'),
(3262, NULL, '2014-04-01', 0, '14', 's'),
(3263, NULL, '2014-04-01', 0, '15', 'n'),
(3264, NULL, '2014-04-01', 0, '16', 'n'),
(3265, NULL, '2014-04-01', 0, '17', 'n'),
(3266, NULL, '2014-04-01', 0, '18', 'n'),
(3267, NULL, '2014-04-01', 0, '19', 'n'),
(3268, NULL, '2014-04-01', 0, '2', 'n'),
(3269, NULL, '2014-04-01', 0, '20', 'n'),
(3270, NULL, '2014-04-01', 0, '21', 'n'),
(3271, NULL, '2014-04-01', 0, '22', 'n'),
(3272, NULL, '2014-04-01', 0, '25', 'n'),
(3273, NULL, '2014-04-01', 0, '3', 'n'),
(3274, NULL, '2014-04-01', 0, '4', 'n'),
(3275, NULL, '2014-04-01', 0, '5', 'n'),
(3276, NULL, '2014-04-01', 0, '6', 'n'),
(3277, NULL, '2014-04-01', 0, '7', 'n'),
(3278, NULL, '2014-04-01', 0, '75486070R', 's'),
(3279, NULL, '2014-04-01', 0, '8', 'n'),
(3280, NULL, '2014-04-01', 0, '9', 'n'),
(3281, NULL, '2014-05-01', 0, '1', 'n'),
(3282, NULL, '2014-05-01', 0, '10', 'n'),
(3283, NULL, '2014-05-01', 0, '11', 'n'),
(3284, NULL, '2014-05-01', 0, '12', 'n'),
(3285, NULL, '2014-05-01', 0, '13', 'n'),
(3286, NULL, '2014-05-01', 0, '14', 'n'),
(3287, NULL, '2014-05-01', 0, '15', 'n'),
(3288, NULL, '2014-05-01', 0, '16', 'n'),
(3289, NULL, '2014-05-01', 0, '17', 'n'),
(3290, NULL, '2014-05-01', 0, '18', 'n'),
(3291, NULL, '2014-05-01', 0, '19', 'n'),
(3292, NULL, '2014-05-01', 0, '2', 'n'),
(3293, NULL, '2014-05-01', 0, '20', 'n'),
(3294, NULL, '2014-05-01', 0, '21', 'n'),
(3295, NULL, '2014-05-01', 0, '22', 'n'),
(3296, NULL, '2014-05-01', 0, '25', 'n'),
(3297, NULL, '2014-05-01', 0, '3', 'n'),
(3298, NULL, '2014-05-01', 0, '4', 'n'),
(3299, NULL, '2014-05-01', 0, '5', 'n'),
(3300, NULL, '2014-05-01', 0, '6', 'n'),
(3301, NULL, '2014-05-01', 0, '7', 'n'),
(3302, NULL, '2014-05-01', 0, '75486070R', 's'),
(3303, NULL, '2014-05-01', 0, '8', 'n'),
(3304, NULL, '2014-05-01', 0, '9', 'n'),
(3305, NULL, '2014-04-08', 2, '75486070R', 's'),
(3306, NULL, '2014-06-01', 0, '1', 'n'),
(3307, NULL, '2014-06-01', 0, '10', 'n'),
(3308, NULL, '2014-06-01', 0, '11', 'n'),
(3309, NULL, '2014-06-01', 0, '12', 'n'),
(3310, NULL, '2014-06-01', 0, '13', 'n'),
(3311, NULL, '2014-06-01', 0, '14', 'n'),
(3312, NULL, '2014-06-01', 0, '15', 'n'),
(3313, NULL, '2014-06-01', 0, '16', 'n'),
(3314, NULL, '2014-06-01', 0, '17', 'n'),
(3315, NULL, '2014-06-01', 0, '18', 'n'),
(3316, NULL, '2014-06-01', 0, '19', 'n'),
(3317, NULL, '2014-06-01', 0, '2', 'n'),
(3318, NULL, '2014-06-01', 0, '20', 'n'),
(3319, NULL, '2014-06-01', 0, '21', 'n'),
(3320, NULL, '2014-06-01', 0, '22', 'n'),
(3321, NULL, '2014-06-01', 0, '25', 'n'),
(3322, NULL, '2014-06-01', 0, '3', 'n'),
(3323, NULL, '2014-06-01', 0, '4', 'n'),
(3324, NULL, '2014-06-01', 0, '5', 'n'),
(3325, NULL, '2014-06-01', 0, '6', 'n'),
(3326, NULL, '2014-06-01', 0, '7', 'n'),
(3327, NULL, '2014-06-01', 0, '75486070R', 'n'),
(3328, NULL, '2014-06-01', 0, '8', 'n'),
(3329, NULL, '2014-06-01', 0, '9', 'n'),
(3333, '2014-04-15', '2014-04-15', 4, '14', 'n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estrategia`
--

CREATE TABLE IF NOT EXISTS `estrategia` (
  `idestrategia` int(2) NOT NULL COMMENT 'id de la estrategia en número',
  `njugadores` int(2) NOT NULL COMMENT 'número jugadores de la estrategia',
  `def` int(1) unsigned NOT NULL COMMENT 'número de defensas',
  `cen` int(1) unsigned NOT NULL COMMENT 'número de centrocampistas',
  `del` int(1) unsigned NOT NULL COMMENT 'número de delanteros',
  PRIMARY KEY (`idestrategia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='aquí va la información acerca de la estrategia que se utiliza';

--
-- Volcado de datos para la tabla `estrategia`
--

INSERT INTO `estrategia` (`idestrategia`, `njugadores`, `def`, `cen`, `del`) VALUES
(1, 6, 2, 2, 1),
(2, 6, 2, 1, 2),
(3, 6, 1, 2, 2),
(4, 7, 2, 2, 2),
(5, 7, 2, 1, 3),
(6, 7, 2, 3, 1),
(7, 7, 3, 1, 2),
(8, 7, 3, 2, 1),
(9, 8, 3, 3, 1),
(10, 8, 3, 2, 2),
(11, 8, 3, 1, 3),
(12, 8, 2, 4, 1),
(13, 8, 2, 3, 2),
(14, 8, 2, 2, 3),
(15, 8, 2, 1, 4),
(16, 9, 4, 3, 1),
(17, 9, 4, 2, 2),
(18, 9, 3, 3, 2),
(19, 9, 3, 2, 3),
(20, 9, 3, 1, 4),
(21, 10, 4, 4, 1),
(22, 10, 4, 3, 2),
(23, 10, 4, 2, 3),
(24, 10, 3, 4, 2),
(25, 10, 3, 3, 3),
(26, 10, 3, 5, 1),
(27, 10, 3, 2, 4),
(28, 11, 4, 4, 2),
(29, 11, 4, 3, 3),
(30, 11, 4, 5, 1),
(31, 11, 3, 5, 2),
(32, 11, 3, 4, 3),
(33, 11, 3, 3, 4),
(34, 12, 4, 4, 3),
(35, 12, 4, 3, 4),
(36, 12, 4, 5, 2),
(37, 12, 3, 5, 3),
(38, 12, 3, 4, 4),
(39, 12, 3, 3, 5),
(40, 13, 4, 4, 4),
(41, 13, 4, 3, 5),
(42, 13, 4, 5, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencia`
--

CREATE TABLE IF NOT EXISTS `incidencia` (
  `fecha` date NOT NULL COMMENT 'la fecha referente al partido jugado',
  `jugador` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'dni del jugador',
  `idsancion` int(2) DEFAULT NULL COMMENT 'identificador de la sanción que se le aplica',
  `gol` int(2) DEFAULT '0' COMMENT 'gol/es que ha marcado el jugador durante el partido',
  `local` enum('s','n') COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'si juega de local S y si no N',
  `color` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'texto del color del que va',
  `posicion` enum('por','def','cen','del','A') COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'identificador de la posición en la que ha jugado en el partido',
  `3p` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'dni a quien le da 3 puntos',
  `2p` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'dni a quien le da 2 puntos',
  `1p` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'dni a quien le da 1 punto',
  PRIMARY KEY (`fecha`,`jugador`),
  KEY `idsancion` (`idsancion`),
  KEY `jugador_jugador_DNI` (`jugador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='aquí lo relacionado con las incidencias durante el partido de juego';

--
-- Volcado de datos para la tabla `incidencia`
--

INSERT INTO `incidencia` (`fecha`, `jugador`, `idsancion`, `gol`, `local`, `color`, `posicion`, `3p`, `2p`, `1p`) VALUES
('2013-01-01', '1', NULL, 0, 's', 'ne', 'def', NULL, NULL, NULL),
('2013-01-01', '2', NULL, 0, 's', 'ne', 'def', NULL, NULL, NULL),
('2013-01-01', '21', NULL, 0, 's', 'ne', 'por', NULL, NULL, NULL),
('2013-01-01', '22', NULL, 0, 's', 'ne', 'por', NULL, NULL, NULL),
('2013-01-01', '23', NULL, 0, 'n', 'na', 'def', NULL, NULL, NULL),
('2013-01-01', '24', NULL, 0, 'n', 'na', 'def', NULL, NULL, NULL),
('2013-01-01', '3', NULL, 0, 's', 'ne', 'def', NULL, NULL, NULL),
('2013-01-01', '4', NULL, 0, 's', 'ne', 'def', NULL, NULL, NULL),
('2013-01-01', '5', NULL, 0, 'n', 'na', 'def', NULL, NULL, NULL),
('2013-01-01', '6', NULL, 0, 'n', 'na', 'def', NULL, NULL, NULL),
('2013-01-01', '7', NULL, 0, 'n', 'na', 'def', NULL, NULL, NULL),
('2013-01-01', '75486070R', 1, 0, 'n', 'na', 'def', NULL, NULL, NULL),
('2013-02-05', '1', 4, 0, 's', 'ne', 'def', NULL, NULL, NULL),
('2013-02-05', '2', NULL, 0, 's', 'ne', 'def', NULL, NULL, NULL),
('2013-02-05', '21', NULL, 0, 's', 'ne', 'por', NULL, NULL, NULL),
('2013-02-05', '22', NULL, 0, 's', 'ne', 'por', NULL, NULL, NULL),
('2013-02-05', '23', NULL, 0, 'n', 'na', 'def', NULL, NULL, NULL),
('2013-02-05', '24', NULL, 0, 'n', 'na', 'def', NULL, NULL, NULL),
('2013-02-05', '3', NULL, 0, 's', 'ne', 'def', NULL, NULL, NULL),
('2013-02-05', '4', NULL, 0, 's', 'ne', 'def', NULL, NULL, NULL),
('2013-02-05', '5', NULL, 0, 'n', 'na', 'def', NULL, NULL, NULL),
('2013-02-05', '6', NULL, 0, 'n', 'na', 'def', NULL, NULL, NULL),
('2013-02-05', '7', NULL, 0, 'n', 'na', 'def', NULL, NULL, NULL),
('2013-02-05', '75486070R', NULL, 0, 'n', 'na', 'def', NULL, NULL, NULL),
('2013-10-01', '1', NULL, 0, 's', 'ne', 'def', NULL, NULL, NULL),
('2013-10-01', '2', NULL, 0, 's', 'ne', 'def', NULL, NULL, NULL),
('2013-10-01', '21', NULL, 0, 's', 'ne', 'por', NULL, NULL, NULL),
('2013-10-01', '22', NULL, 0, 's', 'ne', 'por', NULL, NULL, NULL),
('2013-10-01', '23', NULL, 0, 'n', 'na', 'def', NULL, NULL, NULL),
('2013-10-01', '24', NULL, 0, 'n', 'na', 'def', NULL, NULL, NULL),
('2013-10-01', '3', NULL, 0, 's', 'ne', 'def', NULL, NULL, NULL),
('2013-10-01', '4', NULL, 0, 's', 'ne', 'def', '21', '75486070R', '2'),
('2013-10-01', '5', NULL, 0, 'n', 'na', 'def', NULL, NULL, NULL),
('2013-10-01', '6', NULL, 0, 'n', 'na', 'def', NULL, NULL, NULL),
('2013-10-01', '7', NULL, 0, 'n', 'na', 'def', NULL, NULL, NULL),
('2013-10-01', '75486070R', NULL, 0, 'n', 'na', 'def', NULL, NULL, NULL),
('2014-04-15', '1', NULL, 2, 'n', 'na', 'cen', '21', '10', '9'),
('2014-04-15', '10', NULL, 0, 'n', 'na', 'def', '19', '10', '8'),
('2014-04-15', '11', NULL, 2, 's', 'ne', 'del', '7', '75486070R', '15'),
('2014-04-15', '12', NULL, 1, 's', 'ne', 'del', '12', '20', '4'),
('2014-04-15', '13', NULL, 0, 's', 'ne', 'def', '7', '13', '12'),
('2014-04-15', '14', 1, 0, 's', 'ne', 'por', '75486070R', '2', '4'),
('2014-04-15', '15', NULL, 0, 's', 'ne', 'def', '75486070R', '19', '12'),
('2014-04-15', '16', NULL, 0, 'n', 'na', 'del', '20', '3', '5'),
('2014-04-15', '17', NULL, 0, 'n', 'na', 'del', '3', '12', '13'),
('2014-04-15', '18', NULL, 0, 'n', 'na', 'del', '4', '8', '16'),
('2014-04-15', '19', NULL, 0, 'n', 'na', 'del', '2', '7', '10'),
('2014-04-15', '2', 1, 0, 's', 'ne', 'del', '8', '9', '1'),
('2014-04-15', '20', NULL, 0, 's', 'ne', 'def', '1', '2', '3'),
('2014-04-15', '21', NULL, 0, 's', 'ne', 'def', '4', '13', '1'),
('2014-04-15', '22', NULL, 0, 'n', 'na', 'por', '3', '6', '7'),
('2014-04-15', '23', NULL, 0, 's', 'ne', 'cen', '22', '13', '11'),
('2014-04-15', '24', 4, 2, 'n', 'na', 'cen', '8', '14', '9'),
('2014-04-15', '25', 1, NULL, NULL, NULL, NULL, '7', '1', '14'),
('2014-04-15', '3', 4, 3, 'n', 'na', 'cen', '21', '14', '12'),
('2014-04-15', '4', NULL, 0, 's', 'ne', 'del', '22', '24', '4'),
('2014-04-15', '5', NULL, 0, 's', 'ne', 'cen', '75486070R', '3', '6'),
('2014-04-15', '6', NULL, 0, 's', 'ne', 'cen', '75486070R', '6', '9'),
('2014-04-15', '7', NULL, 0, 'n', 'na', 'cen', '9', '5', '6'),
('2014-04-15', '75486070R', NULL, 1, 's', 'ne', 'del', '3', '1', '19'),
('2014-04-15', '8', NULL, 0, 'n', 'na', 'def', '75486070R', '22', '24'),
('2014-04-15', '9', NULL, 0, 'n', 'na', 'def', '18', '10', '7'),
('2014-04-22', '11', NULL, 3, 'n', 'ne', 'cen', NULL, NULL, NULL),
('2014-04-22', '12', NULL, 0, 'n', 'ne', 'cen', NULL, NULL, NULL),
('2014-04-22', '13', NULL, 4, 'n', 'ne', 'cen', NULL, NULL, NULL),
('2014-04-22', '14', NULL, 0, 'n', 'ne', 'cen', NULL, NULL, NULL),
('2014-04-22', '16', NULL, 0, 's', 'na', 'def', NULL, NULL, NULL),
('2014-04-22', '17', NULL, 2, 's', 'na', 'cen', NULL, NULL, NULL),
('2014-04-22', '18', NULL, 2, 's', 'na', 'cen', NULL, NULL, NULL),
('2014-04-22', '19', NULL, 0, 'n', 'ne', 'del', NULL, NULL, NULL),
('2014-04-22', '20', NULL, 0, 'n', 'ne', 'del', NULL, NULL, NULL),
('2014-04-22', '21', NULL, 0, 's', 'na', 'por', NULL, NULL, NULL),
('2014-04-22', '22', NULL, 2, 'n', 'ne', 'por', NULL, NULL, NULL),
('2014-04-22', '23', NULL, 0, 's', 'na', 'def', NULL, NULL, NULL),
('2014-04-22', '24', NULL, 2, 's', 'na', 'del', NULL, NULL, NULL),
('2014-04-22', '25', NULL, 0, 'n', NULL, 'A', NULL, NULL, NULL),
('2014-04-22', '6', NULL, 1, 's', 'na', 'cen', NULL, NULL, NULL),
('2014-04-22', '7', NULL, 0, 's', 'na', 'def', NULL, NULL, NULL),
('2014-04-29', '1', NULL, 0, 'n', 'na', 'por', NULL, NULL, NULL),
('2014-04-29', '10', NULL, 2, 's', 'ne', 'cen', NULL, NULL, NULL),
('2014-04-29', '11', NULL, 0, 's', 'ne', 'del', NULL, NULL, NULL),
('2014-04-29', '16', NULL, 0, 'n', 'na', 'def', NULL, NULL, NULL),
('2014-04-29', '17', NULL, 1, 's', 'ne', 'del', NULL, NULL, NULL),
('2014-04-29', '18', NULL, 3, 's', 'ne', 'del', NULL, NULL, NULL),
('2014-04-29', '2', NULL, 1, 'n', 'na', 'del', NULL, NULL, NULL),
('2014-04-29', '21', NULL, 2, 'n', 'na', 'def', NULL, NULL, NULL),
('2014-04-29', '22', NULL, 0, 's', 'ne', 'por', NULL, NULL, NULL),
('2014-04-29', '3', NULL, 0, 'n', 'na', 'del', NULL, NULL, NULL),
('2014-04-29', '4', NULL, 0, 's', 'ne', 'def', NULL, NULL, NULL),
('2014-04-29', '5', NULL, 1, 's', 'ne', 'def', NULL, NULL, NULL),
('2014-04-29', '6', NULL, 0, 's', 'ne', 'del', NULL, NULL, NULL),
('2014-04-29', '8', NULL, 1, 'n', 'na', 'cen', NULL, NULL, NULL),
('2014-04-29', '9', NULL, 2, 'n', 'na', 'del', NULL, NULL, NULL),
('2014-05-06', '1', NULL, 0, 's', 'ne', 'def', NULL, NULL, NULL),
('2014-05-06', '10', NULL, 0, 's', 'ne', 'cen', NULL, NULL, NULL),
('2014-05-06', '11', NULL, 2, 's', 'ne', 'del', NULL, NULL, NULL),
('2014-05-06', '12', NULL, 0, 'n', 'na', 'def', NULL, NULL, NULL),
('2014-05-06', '13', NULL, 0, 'n', 'na', 'cen', NULL, NULL, NULL),
('2014-05-06', '14', NULL, 0, 'n', 'na', 'cen', NULL, NULL, NULL),
('2014-05-06', '15', NULL, 1, 'n', 'na', 'cen', NULL, NULL, NULL),
('2014-05-06', '16', NULL, 0, 's', 'ne', 'cen', NULL, NULL, NULL),
('2014-05-06', '17', NULL, 2, 's', 'ne', 'del', NULL, NULL, NULL),
('2014-05-06', '18', NULL, 0, 'n', 'na', 'cen', NULL, NULL, NULL),
('2014-05-06', '19', NULL, 0, 'n', 'na', 'cen', NULL, NULL, NULL),
('2014-05-06', '2', NULL, 0, 's', 'ne', 'def', NULL, NULL, NULL),
('2014-05-06', '20', NULL, 1, 'n', 'na', 'del', '19', '21', NULL),
('2014-05-06', '21', NULL, 0, 's', 'ne', 'por', '14', '75486070R', '18'),
('2014-05-06', '22', NULL, 0, 'n', 'na', 'por', '16', '12', '15'),
('2014-05-06', '3', NULL, 0, 's', 'ne', 'def', '19', '18', '17'),
('2014-05-06', '4', NULL, 0, 's', 'ne', 'def', '22', '24', '20'),
('2014-05-06', '5', NULL, 1, 'n', 'na', 'def', '25', '24', '23'),
('2014-05-06', '6', NULL, 0, 'n', 'na', 'def', '75486070R', '20', '17'),
('2014-05-06', '7', NULL, 0, 'n', 'na', 'def', '15', '16', '75486070R'),
('2014-05-06', '8', NULL, 1, 's', 'ne', 'cen', '5', '6', '7'),
('2014-05-06', '9', NULL, 0, 's', 'ne', 'cen', '75486070R', '2', '3'),
('2014-05-13', '1', NULL, 0, 'n', 'ne', 'cen', '24', '22', '23'),
('2014-05-13', '10', NULL, 3, 'n', 'ne', 'cen', '22', '23', '24'),
('2014-05-13', '11', NULL, 0, 's', 'na', 'cen', '2', '10', '21'),
('2014-05-13', '12', NULL, 2, 'n', 'ne', 'del', '4', '5', '3'),
('2014-05-13', '13', NULL, 2, 's', 'na', 'cen', '4', '1', '9'),
('2014-05-13', '14', NULL, 1, 'n', 'ne', 'cen', '19', '7', '4'),
('2014-05-13', '15', NULL, 0, 's', 'na', 'cen', '14', '13', '12'),
('2014-05-13', '16', NULL, 0, 'n', 'ne', 'del', '19', '9', '7'),
('2014-05-13', '17', NULL, 0, 's', 'na', 'del', '16', '75486070R', '6'),
('2014-05-13', '18', NULL, 0, 's', 'na', 'del', '10', '1', '2'),
('2014-05-13', '19', NULL, NULL, NULL, NULL, NULL, '18', '13', '12'),
('2014-05-13', '2', NULL, 0, 's', 'na', 'def', '75486070R', '4', '19'),
('2014-05-13', '20', NULL, 0, 'n', 'ne', 'def', '5', '6', '7'),
('2014-05-13', '21', NULL, 0, 'n', 'ne', 'def', '9', '1', '75486070R'),
('2014-05-13', '22', NULL, 0, 's', 'na', 'por', '12', '75486070R', '4'),
('2014-05-13', '23', NULL, 1, 's', 'na', 'def', '75486070R', '25', '6'),
('2014-05-13', '25', NULL, NULL, NULL, NULL, 'A', '20', '13', '19'),
('2014-05-13', '3', NULL, 0, 'n', 'ne', 'por', '13', '14', '15'),
('2014-05-13', '4', NULL, 0, 's', 'na', 'def', '10', '11', '12'),
('2014-05-13', '5', NULL, 0, 'n', 'ne', 'cen', '9', '2', '3'),
('2014-05-13', '6', NULL, 0, 's', 'na', 'def', '25', '1', '5'),
('2014-05-13', '7', NULL, 0, 'n', 'ne', 'def', '3', '4', '5'),
('2014-05-13', '8', NULL, 0, 'n', 'ne', 'def', '22', '24', '2'),
('2014-05-13', '9', NULL, 2, 's', 'na', 'cen', '4', '2', '3'),
('2014-06-08', '1', NULL, 5, 's', 'na', 'def', NULL, NULL, NULL),
('2014-06-08', '16', NULL, 0, 'n', 'ne', 'del', NULL, NULL, NULL),
('2014-06-08', '17', NULL, 0, 'n', 'ne', 'del', NULL, NULL, NULL),
('2014-06-08', '18', NULL, 0, 'n', 'ne', 'del', NULL, NULL, NULL),
('2014-06-08', '19', NULL, 0, 'n', 'ne', 'del', NULL, NULL, NULL),
('2014-06-08', '2', NULL, 0, 's', 'na', 'def', NULL, NULL, NULL),
('2014-06-08', '20', NULL, 0, 'n', 'ne', 'del', NULL, NULL, NULL),
('2014-06-08', '21', NULL, 0, 's', 'na', 'por', NULL, NULL, NULL),
('2014-06-08', '22', NULL, 0, 'n', 'ne', 'por', NULL, NULL, NULL),
('2014-06-08', '25', NULL, 0, 'n', 'ne', 'A', NULL, NULL, NULL),
('2014-06-08', '3', NULL, 0, 's', 'na', 'def', NULL, NULL, NULL),
('2014-06-08', '4', NULL, 0, 's', 'na', 'def', '22', '25', '2'),
('2014-06-08', '5', NULL, 0, 's', 'na', 'def', NULL, NULL, NULL),
('2014-09-02', '1', NULL, 0, 's', 'ne', 'def', '15', '13', '14'),
('2014-09-02', '2', NULL, 0, 's', 'ne', 'def', '13', '14', '15'),
('2014-09-02', '21', NULL, 0, 'n', 'na', 'por', '23', '25', '1'),
('2014-09-02', '22', NULL, 0, 's', 'ne', 'por', '4', '9', '22'),
('2014-09-02', '23', NULL, 0, 'n', 'na', 'def', '2', '3', '4'),
('2014-09-02', '24', NULL, 0, 'n', 'na', 'def', '23', '25', '1'),
('2014-09-02', '3', NULL, 0, 's', 'ne', 'def', '4', '8', '24'),
('2014-09-02', '4', NULL, 0, 's', 'ne', 'def', '9', '8', '7'),
('2014-09-02', '5', NULL, 0, 's', 'ne', 'def', NULL, NULL, NULL),
('2014-09-02', '6', NULL, 0, 'n', 'na', 'def', NULL, NULL, NULL),
('2014-09-02', '7', NULL, 0, 'n', 'na', 'def', NULL, NULL, NULL),
('2014-09-02', '75486070R', NULL, 0, 'n', 'na', 'def', NULL, NULL, NULL),
('2014-12-09', '1', NULL, 0, 's', 'ne', 'def', NULL, NULL, NULL),
('2014-12-09', '2', NULL, 0, 's', 'ne', 'def', NULL, NULL, NULL),
('2014-12-09', '21', NULL, 0, 's', 'ne', 'por', NULL, NULL, NULL),
('2014-12-09', '22', NULL, 0, 's', 'ne', 'por', NULL, NULL, NULL),
('2014-12-09', '23', NULL, 0, 'n', 'na', 'def', NULL, NULL, NULL),
('2014-12-09', '24', NULL, 0, 'n', 'na', 'def', NULL, NULL, NULL),
('2014-12-09', '3', NULL, 0, 's', 'ne', 'def', NULL, NULL, NULL),
('2014-12-09', '4', NULL, 0, 's', 'ne', 'def', NULL, NULL, NULL),
('2014-12-09', '5', NULL, 0, 'n', 'na', 'def', NULL, NULL, NULL),
('2014-12-09', '6', NULL, 0, 'n', 'na', 'def', NULL, NULL, NULL),
('2014-12-09', '7', NULL, 0, 'n', 'na', 'def', NULL, NULL, NULL),
('2014-12-09', '75486070R', NULL, 0, 'n', 'na', 'def', NULL, NULL, NULL),
('2014-12-16', '1', 4, 2, 's', 'ne', 'def', NULL, NULL, NULL),
('2014-12-16', '10', NULL, 1, 'n', 'na', 'del', NULL, NULL, NULL),
('2014-12-16', '11', NULL, 1, 'n', 'na', 'del', NULL, NULL, NULL),
('2014-12-16', '13', NULL, 1, 'n', 'na', 'def', NULL, NULL, NULL),
('2014-12-16', '15', NULL, 0, 's', 'ne', 'cen', NULL, NULL, NULL),
('2014-12-16', '16', NULL, 0, 'n', 'na', 'del', NULL, NULL, NULL),
('2014-12-16', '2', NULL, 1, 's', 'ne', 'def', NULL, NULL, NULL),
('2014-12-16', '21', NULL, 0, 's', 'ne', 'por', NULL, NULL, NULL),
('2014-12-16', '22', NULL, 0, 'n', 'na', 'por', NULL, NULL, NULL),
('2014-12-16', '25', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL),
('2014-12-16', '3', NULL, 0, 's', 'ne', 'del', NULL, NULL, NULL),
('2014-12-16', '4', NULL, 0, 'n', 'na', 'def', '2', '21', '25'),
('2014-12-16', '8', NULL, 0, 's', 'ne', 'del', NULL, NULL, NULL),
('2014-12-16', '9', NULL, 0, 'n', 'na', 'cen', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugador`
--

CREATE TABLE IF NOT EXISTS `jugador` (
  `dni` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'dni del jugador',
  `dorsal` int(2) DEFAULT NULL COMMENT 'dorsal del jugador',
  `fechalta` date NOT NULL COMMENT 'fecha en la que el jugador ha sido de alto en el sistema',
  `alias` varchar(20) COLLATE utf8_spanish_ci NOT NULL COMMENT 'nombre corto del jugador',
  `activo` enum('s','n') COLLATE utf8_spanish_ci NOT NULL COMMENT 'si el jugador es jugador s o extra n',
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL COMMENT 'nombre del jugador',
  `apellidos` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'apellidos del jugador',
  `foto` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `posicionhab` enum('por','def','cen','del','A') COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'posicón habitual del jugador',
  `contrasena` varchar(32) COLLATE utf8_spanish_ci NOT NULL COMMENT 'contraseña del jugador',
  PRIMARY KEY (`dni`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='datos relativos al jugador';

--
-- Volcado de datos para la tabla `jugador`
--

INSERT INTO `jugador` (`dni`, `dorsal`, `fechalta`, `alias`, `activo`, `nombre`, `apellidos`, `foto`, `posicionhab`, `contrasena`) VALUES
('1', 1, '2014-04-10', 'alias1', 's', 'nombre1', 'ape1', 'moles.jpg', 'def', 'c4ca4238a0b923820dcc509a6f75849b'),
('10', 10, '2014-04-10', 'alias10', 's', 'nombre10', 'ape10', NULL, 'cen', 'd3d9446802a44259755d38e6d163e820'),
('11', 11, '2014-04-10', 'alias11', 's', 'nombre11', 'ape11', NULL, 'cen', '6512bd43d9caa6e02c990b0a82652dca'),
('12', 12, '2014-04-10', 'alias12', 's', 'nombre12', 'ape12', NULL, 'cen', 'c20ad4d76fe97759aa27a0c99bff6710'),
('13', 13, '2014-04-10', 'alias13', 's', 'nombre13', 'ape13', NULL, 'cen', 'c51ce410c124a10e0db5e4b97fc2af39'),
('14', 14, '2014-04-10', 'alias14', 's', 'nombre14', 'ape14', NULL, 'cen', 'aab3238922bcc25a6f606eb525ffdc56'),
('15', 15, '2014-04-10', 'alias15', 's', 'nombre15', 'ape15', NULL, 'cen', '9bf31c7ff062936a96d3c8bd1f8f2ff3'),
('16', 16, '2014-04-10', 'alias16', 's', 'nombre16', 'ape16', NULL, 'del', 'c74d97b01eae257e44aa9d5bade97baf'),
('17', 17, '2014-04-10', 'alias17', 's', 'nombre17', 'ape17', NULL, 'del', '70efdf2ec9b086079795c442636b55fb'),
('18', 18, '2014-04-10', 'alias18', 's', 'nombre18', 'ape18', NULL, 'del', '6f4922f45568161a8cdf4ad2299f6d23'),
('19', 19, '2014-04-10', 'alias19', 's', 'nombre19', 'ape19', NULL, 'del', '1f0e3dad99908345f7439f8ffabdffc4'),
('2', 2, '2014-04-10', 'alias2', 's', 'nombre2', 'ape2', NULL, 'def', 'c81e728d9d4c2f636f067f89cc14862c'),
('20', 20, '2014-04-10', 'alias20', 's', 'nombre20', 'ape20', NULL, 'del', '98f13708210194c475687be6106a3b84'),
('21', 21, '2014-04-10', 'alias21', 's', 'nombre21', 'ape21', NULL, 'por', '3c59dc048e8850243be8079a5c74d079'),
('22', 22, '2014-04-10', 'alias22', 's', 'nombre22', 'ape22', NULL, 'por', 'b6d767d2f8ed5d21a44b0e5886680cb9'),
('23', NULL, '2014-04-08', 'alias23', 'n', 'nombre23', 'ape23', NULL, 'def', '37693cfc748049e45d87b8c7d8b9aacd'),
('24', NULL, '2014-04-08', 'alias24', 'n', 'nombre24', 'ape24', NULL, 'def', 'd41d8cd98f00b204e9800998ecf8427e'),
('25', 25, '2014-04-08', 'alias25', 's', 'nombre25', 'ape25', NULL, 'A', 'd41d8cd98f00b204e9800998ecf8427e'),
('3', 3, '2014-04-10', 'alias3', 's', 'nombre3', 'ape3', NULL, 'def', 'eccbc87e4b5ce2fe28308fd9f2a7baf3'),
('4', 4, '2014-04-10', 'alias4', 's', 'nombre4', 'ape4', NULL, 'def', 'a87ff679a2f3e71d9181a67b7542122c'),
('5', 5, '2014-04-10', 'alias5', 's', 'nombre5', 'ape5', NULL, 'def', 'e4da3b7fbbce2345d7772b0674a318d5'),
('6', 6, '2014-04-10', 'alias6', 's', 'nombre6', 'ape6', NULL, 'def', 'd41d8cd98f00b204e9800998ecf8427e'),
('7', 7, '2014-04-10', 'alias7', 's', 'nombre7', 'ape7', NULL, 'def', '8f14e45fceea167a5a36dedd4bea2543'),
('75486070R', 23, '2014-04-10', 'moles', 's', 'antonio', 'moles leiva', NULL, 'def', '9f66808decf8b9bcd2ded0db0ecb621b'),
('8', 8, '2014-04-10', 'alias8', 's', 'nombre8', 'ape8', NULL, 'cen', 'c9f0f895fb98ab9159f51fd0297e236d'),
('9', 9, '2014-04-10', 'alias9', 's', 'nombre9', 'ape9', NULL, 'cen', '45c48cce2e2d7fbdea1afc51c7c6ad26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE IF NOT EXISTS `pagos` (
  `idpago` int(4) NOT NULL AUTO_INCREMENT COMMENT 'identificación del pago',
  `ideuda` int(4) NOT NULL COMMENT 'identificación de la deuda',
  `acuenta` float NOT NULL COMMENT 'dinero que da',
  PRIMARY KEY (`idpago`),
  KEY `ideuda` (`ideuda`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='pagos que hacen los jugadores activos' AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`idpago`, `ideuda`, `acuenta`) VALUES
(1, 7, 2),
(2, 3278, 7),
(3, 3278, 8),
(5, 3305, 2),
(15, 8, 1),
(16, 3302, 7),
(19, 3262, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partido`
--

CREATE TABLE IF NOT EXISTS `partido` (
  `fecha` date NOT NULL COMMENT 'fecha del partido',
  `caplocal` varchar(20) CHARACTER SET utf32 COLLATE utf32_spanish_ci DEFAULT NULL COMMENT 'dni del jugador capitán local',
  `capvisitante` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'dni del jugador capitán visitante',
  `marclocal` int(2) NOT NULL DEFAULT '0' COMMENT 'marcador del equipo local',
  `marcvisitante` int(2) NOT NULL DEFAULT '0' COMMENT 'marcador del equipo visitante',
  `estlocal` int(2) DEFAULT NULL COMMENT 'estrategia del equipo local',
  `estvisitante` int(2) DEFAULT NULL COMMENT 'estrategia del quipo visitante',
  PRIMARY KEY (`fecha`),
  KEY `estlocal` (`estlocal`),
  KEY `estvisitante` (`estvisitante`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='tabla referente a los partidos que se juegan';

--
-- Volcado de datos para la tabla `partido`
--

INSERT INTO `partido` (`fecha`, `caplocal`, `capvisitante`, `marclocal`, `marcvisitante`, `estlocal`, `estvisitante`) VALUES
('2013-01-01', NULL, NULL, 0, 0, NULL, NULL),
('2013-02-05', NULL, NULL, 0, 0, NULL, NULL),
('2013-10-01', NULL, NULL, 0, 0, NULL, NULL),
('2014-04-15', '20', '1', 4, 7, 41, 38),
('2014-04-22', '17', '12', 7, 9, 9, NULL),
('2014-04-29', NULL, NULL, 7, 6, 15, 5),
('2014-05-06', '11', '20', 5, 3, 28, 30),
('2014-05-13', NULL, '16', 5, 6, NULL, 28),
('2014-06-08', '2', '16', 5, 0, NULL, NULL),
('2014-09-02', NULL, NULL, 0, 0, NULL, NULL),
('2014-12-09', NULL, NULL, 0, 0, NULL, NULL),
('2014-12-16', '1', '11', 3, 3, NULL, 5);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `dni_jugador_dni` FOREIGN KEY (`dni`) REFERENCES `jugador` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `deudas`
--
ALTER TABLE `deudas`
  ADD CONSTRAINT `fechadeuda_partido` FOREIGN KEY (`fechapartido`) REFERENCES `partido` (`fecha`) ON UPDATE CASCADE,
  ADD CONSTRAINT `idcuota_cuota_idcuota` FOREIGN KEY (`idcuota`) REFERENCES `cuota` (`idcuota`) ON UPDATE CASCADE,
  ADD CONSTRAINT `jugador_jugador_dni_` FOREIGN KEY (`jugador`) REFERENCES `jugador` (`dni`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `incidencia`
--
ALTER TABLE `incidencia`
  ADD CONSTRAINT `fechaIncidencia_Partido` FOREIGN KEY (`fecha`) REFERENCES `partido` (`fecha`) ON UPDATE CASCADE,
  ADD CONSTRAINT `idsancion_cuota_idcuota` FOREIGN KEY (`idsancion`) REFERENCES `cuota` (`idcuota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jugador_jugador_DNI` FOREIGN KEY (`jugador`) REFERENCES `jugador` (`dni`);

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `ideuda_deudas_ideuda` FOREIGN KEY (`ideuda`) REFERENCES `deudas` (`ideuda`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `partido`
--
ALTER TABLE `partido`
  ADD CONSTRAINT `estlocal_estrategia_idestrategia` FOREIGN KEY (`estlocal`) REFERENCES `estrategia` (`idestrategia`) ON UPDATE CASCADE,
  ADD CONSTRAINT `estvisitante_estrategia_idestrategia` FOREIGN KEY (`estvisitante`) REFERENCES `estrategia` (`idestrategia`) ON UPDATE CASCADE;

