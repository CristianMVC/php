-- phpMyAdmin SQL Dump
-- version 4.0.10.8
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 30-10-2015 a las 15:59:35
-- Versión del servidor: 5.1.73-log
-- Versión de PHP: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `cristian`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_accion`
--

CREATE TABLE IF NOT EXISTS `sys_accion` (
  `id_sys_accion` int(11) NOT NULL AUTO_INCREMENT,
  `id_sys_modulo` int(11) DEFAULT NULL,
  `id_sys_controlador` int(11) DEFAULT NULL,
  `es_menu` tinyint(1) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_menu` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `orden` int(11) NOT NULL,
  `borrado` tinyint(1) NOT NULL,
  `logear` tinyint(1) NOT NULL,
  `validar_phpsessid` tinyint(1) NOT NULL,
  `es_menu_destacado` tinyint(1) NOT NULL,
  `nombre_route` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_sys_accion`),
  KEY `IDX_6E766E59AD0FC20C` (`id_sys_modulo`),
  KEY `IDX_6E766E593F98F133` (`id_sys_controlador`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32 ;

--
-- Volcado de datos para la tabla `sys_accion`
--

INSERT INTO `sys_accion` (`id_sys_accion`, `id_sys_modulo`, `id_sys_controlador`, `es_menu`, `nombre`, `nombre_menu`, `descripcion`, `orden`, `borrado`, `logear`, `validar_phpsessid`, `es_menu_destacado`, `nombre_route`) VALUES
(1, 1, 5, 1, 'ListarUsuarios', 'Usuarios', 'ListarUsuarios', 1, 0, 1, 0, 0, 'gcba_usuario_homepage'),
(2, 1, 6, 1, 'ListarUsuariosGcba', 'Usuarios Gcba', 'ListarUsuariosGcba', 2, 0, 1, 0, 0, 'gcba_usuario_gcba_listar'),
(3, 1, 4, 1, 'ListarPerfiles', 'Perfiles', 'ListarPerfiles', 3, 0, 1, 0, 0, 'gcba_perfil_listar'),
(4, 1, 4, 1, 'AltaPerfil', 'Alta Perfil', 'AltaPerfil', 4, 0, 1, 0, 0, 'gcba_perfil_alta'),
(5, 1, 1, 1, 'ListarModulo', 'Modulo', 'Modulo', 5, 0, 1, 0, 0, 'gcba_modulo_listar'),
(6, 1, 1, 1, 'AltaModulo', 'Alta Modulo', 'AltaModulo', 6, 0, 1, 0, 0, 'gcba_modulo_alta'),
(7, 1, 2, 1, 'ListarControlador', 'Controladores', 'ListarControlador', 7, 0, 1, 0, 0, 'gcba_controlador_listar'),
(8, 1, 2, 1, 'AltaControlador', 'Alta Controlador', 'AltaControlador', 8, 0, 1, 0, 0, 'gcba_controlador_alta'),
(9, 1, 3, 1, 'ListarAccion', 'Acción', 'ListarAccion', 9, 0, 1, 0, 0, 'gcba_accion_listar'),
(10, 1, 3, 1, 'AltaAccion', 'Alta Acción', 'AltaAccion', 10, 0, 1, 0, 0, 'gcba_accion_alta'),
(11, 1, 4, 1, 'PerfilAccion', 'Perfil Acción', 'PerfilAccion', 11, 0, 1, 0, 0, 'gcba_perfil_asignar_accion'),
(12, 1, 5, 1, 'AltaUsuario', 'Alta Usuario', 'AltaUsuario', 12, 0, 1, 0, 0, 'gcba_alta_usuario'),
(13, 1, 3, 0, 'EditarAccion', 'EditarAccion', 'EditarAccion', 17, 0, 1, 0, 0, 'gcba_accion_editar'),
(14, 1, 2, 0, 'EditarControlador', 'EditarControlador', 'EditarControlador', 18, 0, 1, 0, 0, 'gcba_controlador_editar'),
(15, 1, 1, 0, 'EditarModulo', 'EditarModulo', 'EditarModulo', 19, 0, 1, 0, 0, 'gcba_modulo_editar'),
(16, 1, 3, 0, 'delaccion', 'delaccion', 'delaccion', 20, 0, 1, 0, 0, 'gcba_usuario_delaccion'),
(17, 1, 3, 0, 'addaccion', 'addaccion', 'addaccion', 21, 0, 1, 0, 0, 'gcba_perfil_addaccion'),
(18, 1, 5, 0, 'EditarUsuario', 'EditarUsuario', 'EditarUsuario', 22, 0, 1, 0, 0, 'gcba_usuario_editar'),
(19, 1, 5, 0, 'addperfil', 'addperfil', 'addperfil', 23, 0, 1, 0, 0, 'gcba_usuario_addperfil'),
(20, 1, 5, 0, 'delperfil', 'delperfil', 'delperfil', 24, 0, 1, 0, 0, 'gcba_usuario_delperfil'),
(21, 1, 5, 0, 'CambiarPassword', 'Cambiar Password', 'CambiarPassword', 25, 0, 1, 0, 0, 'gcba_usuario_cambiarpassword'),
(22, 1, 7, 1, 'ListarLog', 'Ver Log', 'ListarLog', 50, 0, 1, 0, 0, 'gcba_log_gcba_listar'),
(23, 1, 5, 0, 'login', 'login', 'login', 58, 0, 1, 0, 0, 'login'),
(24, 1, 1, 0, 'logout', 'logout', 'logout', 57, 0, 1, 0, 0, 'logout'),
(25, 1, 5, 1, 'listarBloqueo', 'Listar Bloqueos', 'listarBloqueo', 26, 0, 1, 0, 0, 'gcba_bloqueos'),
(26, 1, 3, 1, 'SyncMenu', 'Sync Menu', 'SyncMenu', 67, 0, 0, 0, 0, 'gcba_syncMenu'),
(27, 1, 7, 1, 'GenerarRemito', 'Generar remito', 'GeneraRemitos', 70, 0, 1, 0, 0, 'remito_generar'),
(28, 4, 8, 1, 'alta', 'Alta', 'alta remito', 1, 0, 1, 1, 1, 'remito_controller'),
(29, 4, 11, 1, 'buscar', 'Buscar', 'buscar remito', 2, 0, 1, 1, 1, 'buscar_controller'),
(30, 5, 12, 1, 'altaRol', 'Alta Rol', 'Alta Rol', 34, 0, 1, 1, 1, 'alta_rol'),
(31, 5, 12, 1, 'asignarRol', 'Asignar rol', 'Asignar rol', 100, 0, 1, 1, 1, 'asignar_rol');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_bloqueo`
--

CREATE TABLE IF NOT EXISTS `sys_bloqueo` (
  `id_sys_bloqueo` int(11) NOT NULL AUTO_INCREMENT,
  `id_sys_usuario` bigint(20) DEFAULT NULL,
  `bloqueado_hasta` datetime NOT NULL,
  `bloqueado_desde` datetime NOT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_sys_bloqueo`),
  KEY `IDX_7F70C92EE42897E2` (`id_sys_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `sys_bloqueo`
--

INSERT INTO `sys_bloqueo` (`id_sys_bloqueo`, `id_sys_usuario`, `bloqueado_hasta`, `bloqueado_desde`, `activo`) VALUES
(1, 1, '2015-10-23 12:14:34', '2015-10-23 12:04:34', 0),
(2, 1, '2015-10-26 14:42:33', '2015-10-26 14:32:33', 0),
(3, 1, '2015-10-26 16:53:05', '2015-10-26 16:43:05', 0),
(4, 1, '2015-10-27 13:14:56', '2015-10-27 13:04:56', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_controlador`
--

CREATE TABLE IF NOT EXISTS `sys_controlador` (
  `id_sys_controlador` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `borrado` int(11) NOT NULL,
  PRIMARY KEY (`id_sys_controlador`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `sys_controlador`
--

INSERT INTO `sys_controlador` (`id_sys_controlador`, `nombre`, `borrado`) VALUES
(1, 'Modulo', 0),
(2, 'Controlador', 0),
(3, 'Accion', 0),
(4, 'Perfil', 0),
(5, 'Usuario', 0),
(6, 'UsuarioGcba', 0),
(7, 'Log', 0),
(8, 'Alta', 0),
(10, 'Buscar', 0),
(11, 'Remito', 0),
(12, 'Rol', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_log`
--

CREATE TABLE IF NOT EXISTS `sys_log` (
  `idlog` int(11) NOT NULL AUTO_INCREMENT,
  `accion` int(11) DEFAULT NULL,
  `administrador` bigint(20) DEFAULT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `orig` longtext COLLATE utf8_unicode_ci,
  `modificado` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`idlog`),
  KEY `IDX_31A37DFD8A02E3B4` (`accion`),
  KEY `IDX_31A37DFD44F9A521` (`administrador`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=68 ;

--
-- Volcado de datos para la tabla `sys_log`
--

INSERT INTO `sys_log` (`idlog`, `accion`, `administrador`, `descripcion`, `ip`, `fecha`, `orig`, `modificado`) VALUES
(1, 23, 1, 'El usuario admin no pudo ingresar por contraseña incorrecta', '10.79.182.70', '2015-10-06 02:52:54', NULL, NULL),
(2, 23, 1, 'Se logueo el usuario  admin admin (admin)', '10.79.182.70', '2015-10-06 02:53:20', NULL, NULL),
(3, 2, 1, 'El usuario admin Dio de alta el usuario abarbosa@buenosaires.gob.ar ', '10.79.182.70', '2015-10-06 02:58:39', NULL, NULL),
(4, 19, 1, 'El usuario admin Dio de alta el perfil ROLE_SUPERADMIN al usuario abarbosa@buenosaires.gob.ar', '10.79.182.70', '2015-10-06 02:58:50', NULL, NULL),
(5, 19, 1, 'El usuario admin Dio de alta el perfil ROLE_ADMIN al usuario abarbosa@buenosaires.gob.ar', '10.79.182.70', '2015-10-06 02:58:51', NULL, NULL),
(6, 21, 1, 'El usuario adminSe cambió la contraseña ', '10.79.182.70', '2015-10-06 03:24:12', NULL, NULL),
(7, 23, 1, 'Se logueo el usuario  admin admin (admin)', '10.79.182.70', '2015-10-06 04:44:39', NULL, NULL),
(8, 23, 1, 'El usuario admin no pudo ingresar por contraseña incorrecta', '10.79.182.65', '2015-10-23 12:03:19', NULL, NULL),
(9, 23, 1, 'El usuario admin no pudo ingresar por contraseña incorrecta', '10.79.182.65', '2015-10-23 12:04:18', NULL, NULL),
(10, 23, 1, 'El usuario admin no pudo ingresar por contraseña incorrecta', '10.79.182.65', '2015-10-23 12:04:34', NULL, NULL),
(11, 23, 1, 'El usuario admin fue bloqueado por ingresar 3 veces la contraseña incorrecta hasta la fecha-> 23/10/2015 12:14:34', '10.79.182.65', '2015-10-23 12:04:34', NULL, NULL),
(12, 23, 1, 'El usuario admin no pudo ingresar por contraseña incorrecta', '10.79.182.65', '2015-10-23 01:41:58', NULL, NULL),
(13, 23, 1, 'El usuario admin no pudo ingresar por contraseña incorrecta', '10.79.182.67', '2015-10-26 02:31:07', NULL, NULL),
(14, 23, 1, 'El usuario admin no pudo ingresar por contraseña incorrecta', '10.79.182.67', '2015-10-26 02:32:33', NULL, NULL),
(15, 23, 1, 'El usuario admin fue bloqueado por ingresar 3 veces la contraseña incorrecta hasta la fecha-> 26/10/2015 02:42:33', '10.79.182.67', '2015-10-26 02:32:33', NULL, NULL),
(16, 23, 1, 'El usuario admin fue desbloqueado al expirar el tiempo de bloqueo', '10.79.182.67', '2015-10-26 03:09:45', NULL, NULL),
(17, 23, 1, 'El usuario admin no pudo ingresar por contraseña incorrecta', '10.79.182.67', '2015-10-26 03:09:45', NULL, NULL),
(18, 23, 1, 'El usuario admin no pudo ingresar por contraseña incorrecta', '10.79.182.67', '2015-10-26 03:20:45', NULL, NULL),
(19, 23, 1, 'El usuario admin no pudo ingresar por contraseña incorrecta', '10.79.182.67', '2015-10-26 04:43:05', NULL, NULL),
(20, 23, 1, 'El usuario admin fue bloqueado por ingresar 3 veces la contraseña incorrecta hasta la fecha-> 26/10/2015 04:53:05', '10.79.182.67', '2015-10-26 04:43:05', NULL, NULL),
(21, 23, 1, 'El usuario admin fue desbloqueado al expirar el tiempo de bloqueo', '10.79.182.71', '2015-10-27 10:14:17', NULL, NULL),
(22, 23, 1, 'El usuario admin no pudo ingresar por contraseña incorrecta', '10.79.182.71', '2015-10-27 10:14:17', NULL, NULL),
(23, 23, 1, 'El usuario cristian no pudo ingresar por contraseña incorrecta', '10.79.182.71', '2015-10-27 12:20:07', NULL, NULL),
(24, 23, 1, 'El usuario cristian no pudo ingresar por contraseña incorrecta', '10.79.182.71', '2015-10-27 01:04:56', NULL, NULL),
(25, 23, 1, 'El usuario cristian fue bloqueado por ingresar 3 veces la contraseña incorrecta hasta la fecha-> 27/10/2015 01:14:56', '10.79.182.71', '2015-10-27 01:04:56', NULL, NULL),
(26, 23, 1, 'El usuario admin fue desbloqueado al expirar el tiempo de bloqueo', '10.79.182.71', '2015-10-27 01:22:08', NULL, NULL),
(27, 23, 1, 'El usuario admin no pudo ingresar por contraseña incorrecta', '10.79.182.71', '2015-10-27 01:22:08', NULL, NULL),
(28, 23, 1, 'Se logueo el usuario  admin admin (admin)', '10.79.182.71', '2015-10-27 01:32:22', NULL, NULL),
(29, 23, 1, 'Se logueo el usuario  admin admin (admin)', '10.79.182.71', '2015-10-27 02:05:29', NULL, NULL),
(30, 23, 1, 'Se logueo el usuario  admin admin (admin)', '10.79.182.71', '2015-10-27 03:03:14', NULL, NULL),
(31, 19, 1, 'El usuario admin Dio de alta el perfil ROLE_SUPERADMIN al usuario cristian', '10.79.182.71', '2015-10-27 04:20:20', NULL, NULL),
(32, 20, 1, 'El usuario adminLe quitó el perfil ROLE_SUPERADMIN al usuario cristian', '10.79.182.71', '2015-10-27 04:20:33', NULL, NULL),
(33, 19, 1, 'El usuario admin Dio de alta el perfil ROLE_SUPERADMIN al usuario cristian', '10.79.182.71', '2015-10-27 04:20:37', NULL, NULL),
(34, 20, 1, 'El usuario adminLe quitó el perfil ROLE_SUPERADMIN al usuario cristian', '10.79.182.71', '2015-10-27 04:20:41', NULL, NULL),
(35, 19, 1, 'El usuario admin Dio de alta el perfil ROLE_ADMIN_REMITOS al usuario cristian', '10.79.182.71', '2015-10-27 04:20:44', NULL, NULL),
(36, 23, 1, 'Se logueo el usuario  admin admin (admin)', '10.79.182.71', '2015-10-27 04:42:46', NULL, NULL),
(37, 23, 1, 'Se logueo el usuario  admin admin (admin)', '10.79.182.95', '2015-10-28 05:19:31', NULL, NULL),
(38, 23, 1, 'Se logueo el usuario  admin admin (admin)', '10.79.182.95', '2015-10-28 05:33:12', NULL, NULL),
(39, 23, 1, 'Se logueo el usuario  admin admin (admin)', '10.79.182.68', '2015-10-29 09:57:34', NULL, NULL),
(40, 23, 1, 'Se logueo el usuario  admin admin (admin)', '10.79.182.68', '2015-10-29 10:03:16', NULL, NULL),
(41, 12, 1, 'El usuario admin Dió de alta el  Usuario prueba ', '10.79.182.68', '2015-10-29 10:08:35', NULL, NULL),
(42, 23, 1, 'Se logueo el usuario  admin admin (admin)', '10.79.182.68', '2015-10-29 10:15:38', NULL, NULL),
(43, 23, 1, 'Se logueo el usuario  admin admin (admin)', '10.79.182.68', '2015-10-29 10:16:53', NULL, NULL),
(44, 23, 1, 'Se logueo el usuario  admin admin (admin)', '10.79.182.68', '2015-10-29 10:26:11', NULL, NULL),
(45, 23, 1, 'Se logueo el usuario  admin admin (admin)', '10.79.182.68', '2015-10-29 10:27:22', NULL, NULL),
(46, 23, 1, 'Se logueo el usuario  admin admin (admin)', '10.79.182.68', '2015-10-29 10:32:42', NULL, NULL),
(47, 23, 1, 'Se logueo el usuario  admin admin (admin)', '10.79.182.68', '2015-10-29 10:34:29', NULL, NULL),
(48, 23, 1, 'Se logueo el usuario  admin admin (admin)', '10.79.182.68', '2015-10-29 10:37:10', NULL, NULL),
(49, 23, 1, 'Se logueo el usuario  admin admin (admin)', '10.79.182.68', '2015-10-29 10:48:29', NULL, NULL),
(50, 23, 1, 'Se logueo el usuario  admin admin (admin)', '10.79.182.68', '2015-10-29 10:53:21', NULL, NULL),
(51, 23, 1, 'Se logueo el usuario  admin admin (admin)', '10.79.182.68', '2015-10-29 10:55:48', NULL, NULL),
(52, 23, 1, 'Se logueo el usuario  admin admin (admin)', '10.79.182.68', '2015-10-29 10:57:34', NULL, NULL),
(53, 23, 1, 'Se logueo el usuario  admin admin (admin)', '10.79.182.68', '2015-10-29 11:00:05', NULL, NULL),
(54, 23, 1, 'Se logueo el usuario  admin admin (admin)', '10.79.182.68', '2015-10-29 11:02:58', NULL, NULL),
(55, 23, 1, 'Se logueo el usuario  admin admin (admin)', '10.79.182.68', '2015-10-29 11:09:54', NULL, NULL),
(56, 23, 1, 'Se logueo el usuario  admin admin (admin)', '10.79.182.68', '2015-10-29 11:12:35', NULL, NULL),
(57, 23, 1, 'Se logueo el usuario  admin admin (admin)', '10.79.182.68', '2015-10-29 11:23:30', NULL, NULL),
(58, 23, 1, 'Se logueo el usuario  admin admin (admin)', '10.79.182.68', '2015-10-29 11:26:02', NULL, NULL),
(59, 23, 1, 'Se logueo el usuario  admin admin (admin)', '10.79.182.68', '2015-10-29 11:27:41', NULL, NULL),
(60, 23, 1, 'Se logueo el usuario  admin admin (admin)', '10.79.182.68', '2015-10-29 11:32:02', NULL, NULL),
(61, 23, 1, 'Se logueo el usuario  admin admin (admin)', '10.79.182.68', '2015-10-29 03:07:24', NULL, NULL),
(62, 23, 1, 'Se logueo el usuario  admin admin (admin)', '10.79.182.66', '2015-10-30 09:33:19', NULL, NULL),
(63, 23, 1, 'El usuario admin no pudo ingresar por contraseña incorrecta', '10.79.182.66', '2015-10-30 09:52:08', NULL, NULL),
(64, 23, 1, 'Se logueo el usuario  admin admin (admin)', '10.79.182.66', '2015-10-30 09:52:22', NULL, NULL),
(65, 23, 1, 'Se logueo el usuario  admin admin (admin)', '10.79.182.66', '2015-10-30 09:54:52', NULL, NULL),
(66, 23, 1, 'Se logueo el usuario  admin admin (admin)', '10.79.182.66', '2015-10-30 10:19:22', NULL, NULL),
(67, 23, 1, 'Se logueo el usuario  admin admin (admin)', '10.79.182.66', '2015-10-30 12:59:56', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_modulo`
--

CREATE TABLE IF NOT EXISTS `sys_modulo` (
  `id_sys_modulo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `orden` int(11) NOT NULL,
  `borrado` int(11) NOT NULL,
  PRIMARY KEY (`id_sys_modulo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `sys_modulo`
--

INSERT INTO `sys_modulo` (`id_sys_modulo`, `nombre`, `descripcion`, `orden`, `borrado`) VALUES
(1, 'Sistema', 'ABM Usuarios', 20, 0),
(2, 'Nuevo Modulo', 'Prueba', 2, 1),
(3, 'cursos', 'cursos', 3, 0),
(4, 'Remitos', 'Remitos', 21, 0),
(5, 'Roles', 'Administrar roles', 21, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_perfil`
--

CREATE TABLE IF NOT EXISTS `sys_perfil` (
  `id_sys_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `borrado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_sys_perfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `sys_perfil`
--

INSERT INTO `sys_perfil` (`id_sys_perfil`, `nombre`, `descripcion`, `borrado`) VALUES
(1, 'ROLE_SUPERADMIN', 'Superadmin', 0),
(2, 'ROLE_ADMIN', 'Admin', 0),
(3, 'ROLE_USER', 'Usuario', 0),
(5, 'ROLE_ADMIN_REMITOS', 'Administrador de remitos', 0),
(6, 'ROLE_CONSULTAR_REMITOS', 'Consulta de remitos', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_perfil_accion`
--

CREATE TABLE IF NOT EXISTS `sys_perfil_accion` (
  `id_sys_perfil` int(11) NOT NULL,
  `id_sys_accion` int(11) NOT NULL,
  PRIMARY KEY (`id_sys_perfil`,`id_sys_accion`),
  KEY `IDX_7309B7E8D79B7B7D` (`id_sys_perfil`),
  KEY `IDX_7309B7E8CBFCEE8E` (`id_sys_accion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `sys_perfil_accion`
--

INSERT INTO `sys_perfil_accion` (`id_sys_perfil`, `id_sys_accion`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(2, 27),
(2, 28),
(5, 28);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_remitos`
--

CREATE TABLE IF NOT EXISTS `sys_remitos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area` varchar(30) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `sys_remitos`
--

INSERT INTO `sys_remitos` (`id`, `area`, `descripcion`) VALUES
(1, 'a1', 'a1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_rol`
--

CREATE TABLE IF NOT EXISTS `sys_rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `sys_rol`
--

INSERT INTO `sys_rol` (`id`, `nombre`, `descripcion`) VALUES
(19, 'ss', 'zs'),
(18, 'zz', 'zz'),
(17, 'aa', 'aa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_rol_detalle`
--

CREATE TABLE IF NOT EXISTS `sys_rol_detalle` (
  `id_rol` int(11) NOT NULL,
  `id_area` varchar(100) NOT NULL,
  `Detalle_area` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_rol_usuario`
--

CREATE TABLE IF NOT EXISTS `sys_rol_usuario` (
  `id_rol` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_usuario`
--

CREATE TABLE IF NOT EXISTS `sys_usuario` (
  `id_sys_usuario` bigint(20) NOT NULL AUTO_INCREMENT,
  `correo` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `usuario` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `borrado` int(11) NOT NULL,
  `intento_login_fallido` int(11) DEFAULT NULL,
  `fecha_ultimo_intento_fallido` datetime DEFAULT NULL,
  `clave_valida_hasta` datetime DEFAULT NULL,
  `primer_login` int(11) DEFAULT NULL,
  `logeado` int(11) DEFAULT NULL,
  `ultimo_acceso` datetime DEFAULT NULL,
  `activo` int(11) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_sys_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `sys_usuario`
--

INSERT INTO `sys_usuario` (`id_sys_usuario`, `correo`, `usuario`, `password`, `nombre`, `apellido`, `borrado`, `intento_login_fallido`, `fecha_ultimo_intento_fallido`, `clave_valida_hasta`, `primer_login`, `logeado`, `ultimo_acceso`, `activo`, `salt`) VALUES
(1, 'admin@admin.com', 'admin', 'vvyOnyXpk9EfWekYtKjvKRjTBUHNKXWdNrY4kyChJ97RB/tVxq7Py0zQBocpxRExEMipqz54mseDP0T/LIorQg==', 'admin', 'admin', 0, 0, '2015-10-30 09:52:08', NULL, 0, 0, NULL, 1, 'e48c1ba6dc713f7332f10b708e22f9b1'),
(2, 'abarbosa@buenosaires.gob.ar', 'abarbosa@buenosaires.gob.ar', NULL, 'Anibal', 'Barbosa', 0, NULL, NULL, NULL, 0, 0, NULL, 1, ''),
(3, 'c.burgos@buenosaires.gob.ar', 'cristian', 'rxaYZn1agsiVQnOjHWXaTt9/ymrBxbUtQBmgeYB2P6V8IBrwlLtbUU9mUvtVQdLPH93qhqNkZeNP4ILjfE3/6w==', 'cristian', 'burgos', 0, NULL, NULL, NULL, 0, 0, NULL, 1, '19859d8627c63d5afc1ac9e8be7f8cb7'),
(4, 'prueba@gmail.com', 'prueba', 'qT81oCmOlgVw4MHiwU8i08zr87FPLJQcptg4V5PeQ6e0SL9GX/3UIrWVEUVCKVtdfY0+p5ubXmWuRbvzZTCfgg==', 'prueba', 'prueba', 0, NULL, NULL, NULL, 0, 0, NULL, 1, 'cfa27335646d9a3e397baa6fcfbbab8b');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_usuario_perfil`
--

CREATE TABLE IF NOT EXISTS `sys_usuario_perfil` (
  `id_sys_usuario` bigint(20) NOT NULL,
  `id_sys_perfil` int(11) NOT NULL,
  PRIMARY KEY (`id_sys_usuario`,`id_sys_perfil`),
  KEY `IDX_D0840004E42897E2` (`id_sys_usuario`),
  KEY `IDX_D0840004D79B7B7D` (`id_sys_perfil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `sys_usuario_perfil`
--

INSERT INTO `sys_usuario_perfil` (`id_sys_usuario`, `id_sys_perfil`) VALUES
(1, 1),
(2, 1),
(2, 2),
(3, 5);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `sys_accion`
--
ALTER TABLE `sys_accion`
  ADD CONSTRAINT `FK_6E766E593F98F133` FOREIGN KEY (`id_sys_controlador`) REFERENCES `sys_controlador` (`id_sys_controlador`),
  ADD CONSTRAINT `FK_6E766E59AD0FC20C` FOREIGN KEY (`id_sys_modulo`) REFERENCES `sys_modulo` (`id_sys_modulo`);

--
-- Filtros para la tabla `sys_bloqueo`
--
ALTER TABLE `sys_bloqueo`
  ADD CONSTRAINT `FK_7F70C92EE42897E2` FOREIGN KEY (`id_sys_usuario`) REFERENCES `sys_usuario` (`id_sys_usuario`);

--
-- Filtros para la tabla `sys_log`
--
ALTER TABLE `sys_log`
  ADD CONSTRAINT `FK_31A37DFD44F9A521` FOREIGN KEY (`administrador`) REFERENCES `sys_usuario` (`id_sys_usuario`),
  ADD CONSTRAINT `FK_31A37DFD8A02E3B4` FOREIGN KEY (`accion`) REFERENCES `sys_accion` (`id_sys_accion`);

--
-- Filtros para la tabla `sys_perfil_accion`
--
ALTER TABLE `sys_perfil_accion`
  ADD CONSTRAINT `FK_7309B7E8CBFCEE8E` FOREIGN KEY (`id_sys_accion`) REFERENCES `sys_accion` (`id_sys_accion`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_7309B7E8D79B7B7D` FOREIGN KEY (`id_sys_perfil`) REFERENCES `sys_perfil` (`id_sys_perfil`) ON DELETE CASCADE;

--
-- Filtros para la tabla `sys_usuario_perfil`
--
ALTER TABLE `sys_usuario_perfil`
  ADD CONSTRAINT `FK_D0840004D79B7B7D` FOREIGN KEY (`id_sys_perfil`) REFERENCES `sys_perfil` (`id_sys_perfil`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_D0840004E42897E2` FOREIGN KEY (`id_sys_usuario`) REFERENCES `sys_usuario` (`id_sys_usuario`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
