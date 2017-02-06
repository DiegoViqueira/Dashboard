-- phpMyAdmin SQL Dump
-- version 2.8.0.1
-- http://www.phpmyadmin.net
-- 
-- Servidor: custsql-ipg43.eigbox.net
-- Tiempo de generación: 15-10-2016 a las 10:58:02
-- Versión del servidor: 5.6.32
-- Versión de PHP: 4.4.9
-- 
-- Base de datos: `reclamos`
-- 

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `CATEGORIES`
-- 

CREATE TABLE IF NOT EXISTS `CATEGORIES` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userload` varchar(20) DEFAULT 'ROOT',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Volcar la base de datos para la tabla `CATEGORIES`
-- 

INSERT INTO `CATEGORIES` VALUES (1, 2, 'Facturacion', '2016-10-02 15:00:41', 'ROOT');
INSERT INTO `CATEGORIES` VALUES (2, 2, 'Todas las Categorias', '2016-10-02 15:01:16', 'ROOT');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `CLIENT_USERS`
-- 

CREATE TABLE IF NOT EXISTS `CLIENT_USERS` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL DEFAULT '0',
  `profile` int(11) NOT NULL DEFAULT '1',
  `name` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `gender` int(11) NOT NULL DEFAULT '1',
  `contry` int(11) NOT NULL DEFAULT '0',
  `state` int(11) NOT NULL DEFAULT '0',
  `phone` varchar(12) NOT NULL DEFAULT '0',
  `passwd` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `iteration` int(11) NOT NULL DEFAULT '0',
  `bday` date DEFAULT NULL,
  `description` varchar(30) DEFAULT '',
  `notify` tinyint(1) NOT NULL DEFAULT '1',
  `regexp_identifier` varchar(50) NOT NULL DEFAULT '.*',
  `regexp_description` varchar(50) NOT NULL,
  `fbid` varchar(100) NOT NULL DEFAULT '0',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userload` varchar(20) DEFAULT 'WEB',
  PRIMARY KEY (`id`),
  KEY `USER_INDEX` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

-- 
-- Volcar la base de datos para la tabla `CLIENT_USERS`
-- 

INSERT INTO `CLIENT_USERS` VALUES (2, 2, 2, 'Movistar S.A', '', 1, 0, 0, '0', 'lololo', 'movistar@mo.com', 'images/usersfotos/logo_movistar_alta_3.jpg', 0, '2016-09-14', 'Prueba', 1, '', 'Nro Telefono Ej: 15-0000-0000', '0', '2016-09-23 16:52:22', 'ROOT');
INSERT INTO `CLIENT_USERS` VALUES (4, 2, 3, 'Pablo', 'Empresa', 2, 0, 0, '15-4972-0735', 'lalala', 'pablo@pablo.com', 'images/usersfotos/descarga.png', 0, '1979-01-26', '', 1, '', '', '0', '2016-10-01 11:46:41', 'WEB');
INSERT INTO `CLIENT_USERS` VALUES (12, 2, 3, 'martin', 'arnedo', 2, 0, 1, '15-4972-0735', 'lalala', 'martin@martin.com', 'images/default_user.jpg', 0, '1978-12-22', '', 1, '', '', '0', '2016-09-24 19:10:21', 'WEB');
INSERT INTO `CLIENT_USERS` VALUES (22, 0, 1, 'Diego', 'Viqueira', 2, 0, 0, '15-4972-0735', 'lalala', 'd_viqueira@hotmail.com', 'images/default_user.jpg', 0, '1979-01-26', '', 1, '.*', '', '0', '2016-09-28 14:03:15', 'WEB');
INSERT INTO `CLIENT_USERS` VALUES (23, 0, 1, 'Julio', 'Blanc', 2, 0, 0, '15-6259-1262', 'plinplin', 'juliiblanc@gmail.com', 'images/default_user.jpg', 0, '1981-06-20', '', 1, '.*', '', '0', '2016-09-29 18:52:11', 'WEB');
INSERT INTO `CLIENT_USERS` VALUES (24, 0, 4, 'Admin', 'Admin', 1, 0, 0, '0', 'KKKKKK', 'admin@admin.com', 'images/default_user.jpg', 0, '2016-10-03', 'ADMIN_USER', 1, '.*', '', '0', '2016-10-03 08:45:34', 'ROOT');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `DEFAULT_PAGE`
-- 

CREATE TABLE IF NOT EXISTS `DEFAULT_PAGE` (
  `id_group` int(11) NOT NULL,
  `file` varchar(100) NOT NULL DEFAULT '',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userload` varchar(20) DEFAULT 'ROOT',
  PRIMARY KEY (`id_group`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `DEFAULT_PAGE`
-- 

INSERT INTO `DEFAULT_PAGE` VALUES (1, 'dash_user', '2016-10-15 10:40:44', 'ROOT');
INSERT INTO `DEFAULT_PAGE` VALUES (2, 'dash', '2016-10-03 08:01:07', 'ROOT');
INSERT INTO `DEFAULT_PAGE` VALUES (3, 'dash', '2016-10-03 08:01:13', 'ROOT');
INSERT INTO `DEFAULT_PAGE` VALUES (4, 'dash_admin', '2016-10-03 08:01:23', 'ROOT');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `ESTADOS_RECLAMOS`
-- 

CREATE TABLE IF NOT EXISTS `ESTADOS_RECLAMOS` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(500) NOT NULL DEFAULT '',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userload` varchar(20) DEFAULT 'ROOT',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Volcar la base de datos para la tabla `ESTADOS_RECLAMOS`
-- 

INSERT INTO `ESTADOS_RECLAMOS` VALUES (1, 'PENDIENTE', '2016-09-13 17:21:25', 'ROOT');
INSERT INTO `ESTADOS_RECLAMOS` VALUES (2, 'EN PROCESO', '2016-09-13 17:21:45', 'ROOT');
INSERT INTO `ESTADOS_RECLAMOS` VALUES (3, 'CERRADO', '2016-09-13 17:22:01', 'ROOT');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `GENDER`
-- 

CREATE TABLE IF NOT EXISTS `GENDER` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) NOT NULL DEFAULT '',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userload` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Volcar la base de datos para la tabla `GENDER`
-- 

INSERT INTO `GENDER` VALUES (1, 'M', '2016-08-29 17:39:06', 'ROOT');
INSERT INTO `GENDER` VALUES (2, 'F', '2016-08-29 17:38:51', 'ROOT');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `MODULES`
-- 

CREATE TABLE IF NOT EXISTS `MODULES` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_group` int(11) NOT NULL DEFAULT '1',
  `name` varchar(100) NOT NULL DEFAULT '',
  `file` varchar(100) NOT NULL DEFAULT '',
  `icono` varchar(100) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userload` varchar(20) DEFAULT 'ROOT',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- 
-- Volcar la base de datos para la tabla `MODULES`
-- 

INSERT INTO `MODULES` VALUES (1, 1, 'Editar', 'profile', 'settings', '2016-09-15 01:18:20', 'ROOT');
INSERT INTO `MODULES` VALUES (2, 1, 'Dashboard', 'dash', 'dashboard', '2016-09-09 04:53:22', 'ROOT');
INSERT INTO `MODULES` VALUES (3, 2, 'Nuevo', 'new_claim', 'note_add', '2016-09-15 01:16:05', 'ROOT');
INSERT INTO `MODULES` VALUES (4, 2, 'Pendientes', 'pend_claim', 'list', '2016-09-15 01:17:21', 'ROOT');
INSERT INTO `MODULES` VALUES (5, 2, 'Cerrados', 'old_claim', 'archive', '2016-09-15 01:15:09', 'ROOT');
INSERT INTO `MODULES` VALUES (6, 3, 'Gestion de Reclamos', 'manage_claim', 'supervisor_account', '2016-09-15 01:19:10', 'ROOT');
INSERT INTO `MODULES` VALUES (7, 3, 'Buscar Reclamo', 'search_claim', 'search', '2016-09-17 00:06:00', 'ROOT');
INSERT INTO `MODULES` VALUES (8, 4, 'Gestion de Usuarios', 'user_administration', 'face', '2016-09-18 09:51:24', 'ROOT');
INSERT INTO `MODULES` VALUES (9, 5, 'Global Empresa', 'stadistic_gral', 'assessment', '2016-09-18 10:04:46', 'ROOT');
INSERT INTO `MODULES` VALUES (10, 1, 'Dashboard', 'dash_admin', 'dashboard', '2016-10-03 08:40:38', 'ROOT');
INSERT INTO `MODULES` VALUES (11, 1, 'Dashboard', 'dash_user', 'dashboard', '2016-10-15 10:55:24', 'ROOT');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `MODULES_GROUP`
-- 

CREATE TABLE IF NOT EXISTS `MODULES_GROUP` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userload` varchar(20) DEFAULT 'ROOT',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Volcar la base de datos para la tabla `MODULES_GROUP`
-- 

INSERT INTO `MODULES_GROUP` VALUES (1, 'Perfil', '2016-09-08 10:32:08', 'ROOT');
INSERT INTO `MODULES_GROUP` VALUES (2, 'Reclamos', '2016-09-09 04:59:43', 'ROOT');
INSERT INTO `MODULES_GROUP` VALUES (3, 'Gestion', '2016-09-09 04:59:43', 'ROOT');
INSERT INTO `MODULES_GROUP` VALUES (4, 'Administracion', '2016-09-18 09:40:12', 'ROOT');
INSERT INTO `MODULES_GROUP` VALUES (5, 'Estadisticas', '2016-09-18 09:40:50', 'ROOT');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `MODULES_PROFILES`
-- 

CREATE TABLE IF NOT EXISTS `MODULES_PROFILES` (
  `profileid` int(11) NOT NULL,
  `moduleid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userload` varchar(20) DEFAULT 'WEB',
  PRIMARY KEY (`profileid`,`moduleid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `MODULES_PROFILES`
-- 

INSERT INTO `MODULES_PROFILES` VALUES (1, 1, 'DEFAULT', '2016-10-15 10:56:53', 'ROOT');
INSERT INTO `MODULES_PROFILES` VALUES (1, 3, 'DEFAULT', '2016-09-09 04:57:57', 'WEB');
INSERT INTO `MODULES_PROFILES` VALUES (1, 4, 'DEFAULT', '2016-09-09 05:01:23', 'WEB');
INSERT INTO `MODULES_PROFILES` VALUES (1, 5, 'DEFAULT', '2016-09-09 05:01:23', 'WEB');
INSERT INTO `MODULES_PROFILES` VALUES (1, 11, 'DEFAULT', '2016-10-15 10:57:24', 'ROOT');
INSERT INTO `MODULES_PROFILES` VALUES (2, 1, 'EMPRESA', '2016-09-18 09:42:07', 'WEB');
INSERT INTO `MODULES_PROFILES` VALUES (2, 2, 'EMPRESA', '2016-09-18 09:42:25', 'WEB');
INSERT INTO `MODULES_PROFILES` VALUES (2, 6, 'EMPRESA', '2016-09-18 09:43:01', 'WEB');
INSERT INTO `MODULES_PROFILES` VALUES (2, 7, 'EMPRESA', '2016-09-18 09:43:17', 'WEB');
INSERT INTO `MODULES_PROFILES` VALUES (2, 8, 'EMPRESA', '2016-09-18 09:52:23', 'WEB');
INSERT INTO `MODULES_PROFILES` VALUES (2, 9, 'EMPRESA', '2016-09-18 10:05:19', 'WEB');
INSERT INTO `MODULES_PROFILES` VALUES (3, 1, 'USER EMPRESA', '2016-09-16 17:37:50', 'WEB');
INSERT INTO `MODULES_PROFILES` VALUES (3, 2, 'USER EMPRESA', '2016-09-16 17:38:43', 'WEB');
INSERT INTO `MODULES_PROFILES` VALUES (3, 6, 'USER EMPRESA', '2016-09-17 00:03:59', 'WEB');
INSERT INTO `MODULES_PROFILES` VALUES (3, 7, 'USER EMPRESA', '2016-09-17 00:04:10', 'WEB');
INSERT INTO `MODULES_PROFILES` VALUES (4, 1, 'ADMIN_USER', '2016-10-03 08:41:34', 'WEB');
INSERT INTO `MODULES_PROFILES` VALUES (4, 10, 'ADMIN_USER', '2016-10-03 08:42:08', 'WEB');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `RECLAMOS_ACTIVOS`
-- 

CREATE TABLE IF NOT EXISTS `RECLAMOS_ACTIVOS` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `id_sid` int(11) NOT NULL DEFAULT '0',
  `identificador` varchar(50) NOT NULL,
  `isread` tinyint(1) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1',
  `id_categoria` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userload` varchar(20) NOT NULL DEFAULT 'WEB',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1 AUTO_INCREMENT=72 ;

-- 
-- Volcar la base de datos para la tabla `RECLAMOS_ACTIVOS`
-- 

INSERT INTO `RECLAMOS_ACTIVOS` VALUES (69, 22, 2, 0, '15-4972-0735', 1, 1, 1, '2016-10-03 07:51:04', 'WEB');
INSERT INTO `RECLAMOS_ACTIVOS` VALUES (70, 22, 2, 0, '1549720735', 1, 1, 1, '2016-10-11 15:33:20', 'WEB');
INSERT INTO `RECLAMOS_ACTIVOS` VALUES (71, 22, 2, 0, '11111', 1, 1, 1, '2016-10-14 01:19:09', 'WEB');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `RECLAMOS_CERRADOS`
-- 

CREATE TABLE IF NOT EXISTS `RECLAMOS_CERRADOS` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `id_sid` int(11) NOT NULL,
  `identificador` varchar(50) NOT NULL,
  `isread` tinyint(4) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userload` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `RECLAMOS_CERRADOS`
-- 

INSERT INTO `RECLAMOS_CERRADOS` VALUES (48, 22, 2, 4, '11111', 1, 3, 1, '2016-09-29 09:42:50', 'WEB');
INSERT INTO `RECLAMOS_CERRADOS` VALUES (49, 22, 2, 4, '1111a', 1, 3, 1, '2016-09-29 11:09:07', 'WEB');
INSERT INTO `RECLAMOS_CERRADOS` VALUES (50, 22, 2, 4, '1111111', 1, 3, 1, '2016-09-29 11:09:10', 'WEB');
INSERT INTO `RECLAMOS_CERRADOS` VALUES (51, 22, 2, 4, '15-4972-0735', 1, 3, 1, '2016-09-29 12:04:31', 'WEB');
INSERT INTO `RECLAMOS_CERRADOS` VALUES (52, 22, 2, 4, '15-4972-0735', 1, 3, 1, '2016-09-29 12:07:21', 'WEB');
INSERT INTO `RECLAMOS_CERRADOS` VALUES (53, 22, 2, 4, '15-4972-0735', 1, 3, 1, '2016-09-29 12:09:59', 'WEB');
INSERT INTO `RECLAMOS_CERRADOS` VALUES (54, 22, 2, 4, '15-4972-0735', 1, 3, 1, '2016-09-30 12:27:57', 'WEB');
INSERT INTO `RECLAMOS_CERRADOS` VALUES (55, 22, 2, 4, '11111', 1, 3, 1, '2016-09-30 12:27:59', 'WEB');
INSERT INTO `RECLAMOS_CERRADOS` VALUES (56, 22, 2, 4, '15-4972-0735', 1, 3, 1, '2016-09-30 12:29:16', 'WEB');
INSERT INTO `RECLAMOS_CERRADOS` VALUES (57, 22, 2, 4, '15-4972-0735', 1, 3, 1, '2016-09-30 12:29:18', 'WEB');
INSERT INTO `RECLAMOS_CERRADOS` VALUES (58, 22, 2, 4, '15-4972-0735', 1, 3, 1, '2016-09-30 12:28:28', 'WEB');
INSERT INTO `RECLAMOS_CERRADOS` VALUES (59, 23, 2, 4, '15-0000-000', 0, 3, 1, '2016-09-29 20:06:02', 'WEB');
INSERT INTO `RECLAMOS_CERRADOS` VALUES (60, 22, 2, 4, '1549', 1, 3, 1, '2016-09-30 12:28:29', 'WEB');
INSERT INTO `RECLAMOS_CERRADOS` VALUES (61, 22, 2, 4, '1549', 1, 3, 1, '2016-09-30 12:29:06', 'WEB');
INSERT INTO `RECLAMOS_CERRADOS` VALUES (62, 22, 2, 4, '15555555', 1, 3, 1, '2016-09-30 12:28:34', 'WEB');
INSERT INTO `RECLAMOS_CERRADOS` VALUES (63, 22, 2, 2, '1549720735', 1, 3, 1, '2016-09-30 16:03:43', 'WEB');
INSERT INTO `RECLAMOS_CERRADOS` VALUES (64, 22, 2, 4, '15666666', 1, 3, 1, '2016-10-01 10:55:39', 'WEB');
INSERT INTO `RECLAMOS_CERRADOS` VALUES (65, 22, 2, 4, '15-4972-0735', 1, 3, 1, '2016-10-02 16:06:02', 'WEB');
INSERT INTO `RECLAMOS_CERRADOS` VALUES (66, 22, 2, 4, '15-4972-0735', 1, 3, 2, '2016-10-02 16:06:23', 'WEB');
INSERT INTO `RECLAMOS_CERRADOS` VALUES (67, 22, 2, 4, '15-4972-0735', 1, 3, 1, '2016-10-02 17:21:05', 'WEB');
INSERT INTO `RECLAMOS_CERRADOS` VALUES (68, 22, 2, 4, '1549720735', 1, 3, 1, '2016-10-03 06:22:29', 'WEB');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `RECLAMOS_MENSAJES`
-- 

CREATE TABLE IF NOT EXISTS `RECLAMOS_MENSAJES` (
  `id_reclamo` int(11) NOT NULL,
  `description` varchar(500) NOT NULL DEFAULT '',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userload` varchar(20) NOT NULL DEFAULT 'WEB',
  KEY `id_reclamo` (`id_reclamo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `RECLAMOS_MENSAJES`
-- 

INSERT INTO `RECLAMOS_MENSAJES` VALUES (69, 'prueba2', '2016-10-03 07:51:04', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES` VALUES (70, 'No me llega la pacftura', '2016-10-11 15:33:20', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES` VALUES (71, 'Lalala', '2016-10-14 01:19:09', 'WEB');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `RECLAMOS_MENSAJES_OLD`
-- 

CREATE TABLE IF NOT EXISTS `RECLAMOS_MENSAJES_OLD` (
  `id_reclamo` int(11) NOT NULL,
  `description` varchar(500) NOT NULL DEFAULT '',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userload` varchar(20) NOT NULL DEFAULT 'WEB',
  KEY `id_reclamo` (`id_reclamo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `RECLAMOS_MENSAJES_OLD`
-- 

INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (48, 'Prueba ', '2016-09-28 14:10:05', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (48, 'lalla', '2016-09-29 08:56:38', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (49, 'a', '2016-09-28 14:42:18', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (49, 'Fuiste', '2016-09-29 10:23:50', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (50, 'a', '2016-09-28 14:42:34', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (50, 'Fuiste 2', '2016-09-29 10:24:01', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (51, 'a', '2016-09-28 14:42:48', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (51, 'Sos un Boludo', '2016-09-29 11:24:51', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (52, 'a', '2016-09-28 14:43:02', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (52, 'sos 2\n', '2016-09-29 11:25:03', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (53, 'a', '2016-09-28 14:43:16', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (53, 'lololo', '2016-09-29 12:09:44', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (54, 'a', '2016-09-28 14:43:31', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (54, 'A', '2016-09-29 18:33:20', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (55, 'a', '2016-09-28 14:43:47', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (55, 'B', '2016-09-29 18:33:32', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (56, 'a', '2016-09-28 14:44:04', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (56, 'A', '2016-09-29 18:33:59', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (57, 'a', '2016-09-28 14:44:19', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (57, 'A', '2016-09-29 18:34:08', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (58, 'a', '2016-09-28 14:44:33', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (58, 'A', '2016-09-29 18:34:17', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (59, 'Prueba', '2016-09-29 18:54:18', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (59, 'Monkey monkey ', '2016-09-29 20:06:02', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (60, 'Jyht', '2016-09-30 00:43:07', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (60, 'monk monk ', '2016-09-30 10:34:21', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (61, 'Jyht', '2016-09-30 00:43:08', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (61, 'monk', '2016-09-30 10:45:54', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (62, 'Prueba ', '2016-09-30 10:46:38', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (62, 'monk monk', '2016-09-30 11:07:45', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (64, 'Pero ', '2016-09-30 19:29:31', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (64, 'lololo', '2016-10-01 09:50:45', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (65, 'prueba', '2016-10-02 16:06:02', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (65, 'puto', '2016-10-02 16:21:48', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (66, 'a', '2016-10-02 16:06:23', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (66, 'sonzo', '2016-10-02 16:31:15', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (63, 'lalalalallaa', '2016-09-30 16:03:02', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (63, 'lololo', '2016-10-02 17:09:12', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (67, 'pruebA', '2016-10-02 17:21:05', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (67, 'Gil', '2016-10-03 06:27:20', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (68, 'Lalala', '2016-10-03 06:22:29', 'WEB');
INSERT INTO `RECLAMOS_MENSAJES_OLD` VALUES (68, 'lalalala', '2016-10-11 15:35:53', 'WEB');
