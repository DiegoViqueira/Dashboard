#######################
# USUARIOS DEL SISTEMA
#######################



-- 
-- Estructura de tabla para la tabla `CLIENT_USERS`
-- 

CREATE TABLE IF NOT EXISTS `CLIENT_USERS` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL DEFAULT '0',
  `profile` int(11) NOT NULL DEFAULT '1', # 1- CLIENT / 2- COMPANY / 3-COMPANY EMPLOYEE / 4-admin
  `name` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `gender` int(11) NOT NULL DEFAULT '1',
  `contry` int(11) NOT NULL DEFAULT '0',
  `state` int(11) NOT NULL DEFAULT '0', # 0- ACTIVE / 1- INACTIVE
  `phone` varchar(12) NOT NULL DEFAULT '0',
  `passwd` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `iteration` int(11) NOT NULL DEFAULT '0',
  `bday` date DEFAULT NULL,
  `description` varchar(30) DEFAULT '',
  `notify` tinyint(1) NOT NULL DEFAULT '1', # PARA recibir o no notificaciones por email 1 - recibe
  `regexp_identifier` varchar(50) NOT NULL DEFAULT '.*',
  `regexp_description` varchar(50) NOT NULL,
  `fbid` varchar(100) NOT NULL DEFAULT '0',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userload` varchar(20) DEFAULT 'WEB',
  PRIMARY KEY (`id`),
  KEY `USER_INDEX` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- 
-- Volcar la base de datos para la tabla `CLIENT_USERS`
-- 

INSERT INTO `CLIENT_USERS` VALUES (2, 2, 2, 'Movistar S.A', '', 1, 0, 0, '0', 'lololo', 'movistar@mo.com', 'images/usersfotos/logo_movistar_alta_3.jpg', 0, '2016-09-14', 'Prueba', 1, '', 'Nro Telefono Ej: 15-0000-0000', '0', '2016-09-23 16:52:22', 'ROOT');
INSERT INTO `CLIENT_USERS` VALUES (4, 2, 3, 'Pablo', 'Empresa', 2, 0, 0, '15-4972-0735', 'lalala', 'pablo@pablo.com', 'images/usersfotos/descarga.png', 0, '1979-01-26', '', 1, '', '', '0', '2016-09-23 16:52:37', 'WEB');
INSERT INTO `CLIENT_USERS` VALUES (12, 2, 3, 'martin', 'arnedo', 2, 0, 1, '15-4972-0735', 'lalala', 'martin@martin.com', 'images/default_user.jpg', 0, '1978-12-22', '', 1, '', '', '0', '2016-09-24 19:10:21', 'WEB');
INSERT INTO `CLIENT_USERS` VALUES (13, 0, 1, 'Diego', 'Viqueira', 2, 0, 0, '15-4972-0735', 'lalala', 'd_viqueira@hotmail.com', 'images/default_user.jpg', 0, '0000-00-00', '', 1, '', '', '0', '2016-09-24 19:01:10', 'WEB');


#######################
# PAGINAS POR USUARIO 
#######################

CREATE TABLE IF NOT EXISTS `DEFAULT_PAGE` (
  `id_group` int(11) NOT NULL,
  `file` varchar(100) NOT NULL DEFAULT '',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userload` varchar(20) DEFAULT 'ROOT',
  PRIMARY KEY (`id_group`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ;



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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

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

-- 
-- Estructura de tabla para la tabla `MODULES_PROFILES`
-- 

CREATE TABLE `MODULES_PROFILES` (
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

INSERT INTO `MODULES_PROFILES` VALUES (1, 1, 'DEFAULT', '2016-08-29 17:45:15', 'ROOT');
INSERT INTO `MODULES_PROFILES` VALUES (1, 2, 'DEFAULT', '2016-08-29 17:44:54', 'ROOT');
INSERT INTO `MODULES_PROFILES` VALUES (1, 3, 'DEFAULT', '2016-09-09 04:57:57', 'WEB');
INSERT INTO `MODULES_PROFILES` VALUES (1, 4, 'DEFAULT', '2016-09-09 05:01:23', 'WEB');
INSERT INTO `MODULES_PROFILES` VALUES (1, 5, 'DEFAULT', '2016-09-09 05:01:23', 'WEB');
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


#######################
# RECLAMOS 
#######################

-- 
-- Estructura de tabla para la tabla `CATEGORIES`
-- 

CREATE TABLE IF NOT EXISTS `CATEGORIES` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL ,
  `name` varchar(100) NOT NULL DEFAULT '',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userload` varchar(20) DEFAULT 'ROOT',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ;

-- 
-- Estructura de tabla para la tabla `RECLAMOS_MENSAJES`
-- 

CREATE TABLE IF NOT EXISTS `RECLAMOS_MENSAJES` (
  `id_reclamo` int(11) NOT NULL,
  `description` varchar(500) NOT NULL DEFAULT '',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `userload` varchar(20) NOT NULL DEFAULT 'WEB',
  INDEX (`id_reclamo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `RECLAMOS_MENSAJES_OLD` (
  `id_reclamo` int(11) NOT NULL,
  `description` varchar(500) NOT NULL DEFAULT '',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `userload` varchar(20) NOT NULL DEFAULT 'WEB',
  INDEX (`id_reclamo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1  ;




-- 
-- Estructura de tabla para la tabla `RECLAMOS_CERRADOS`
-- 

CREATE TABLE `RECLAMOS_CERRADOS` (
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
-- Estructura de tabla para la tabla `ESTADOS_RECLAMOS`
-- 

CREATE TABLE IF NOT EXISTS `ESTADOS_RECLAMOS` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(500) NOT NULL DEFAULT '',
  fecha timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userload` varchar(20) DEFAULT 'ROOT',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Volcar la base de datos para la tabla `ESTADOS_RECLAMOS`
-- 

INSERT INTO `ESTADOS_RECLAMOS` VALUES (1, 'PENDIENTE', '2016-09-13 17:21:25', 'ROOT');
INSERT INTO `ESTADOS_RECLAMOS` VALUES (2, 'EN PROCESO', '2016-09-13 17:21:45', 'ROOT');
INSERT INTO `ESTADOS_RECLAMOS` VALUES (3, 'CERRADO', '2016-09-13 17:22:01', 'ROOT');
