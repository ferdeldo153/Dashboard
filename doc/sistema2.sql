-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-07-2016 a las 00:55:23
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acciones`
--

CREATE TABLE `acciones` (
  `id_act` int(11) NOT NULL,
  `act` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `acciones`
--

INSERT INTO `acciones` (`id_act`, `act`) VALUES
(1, 'Inicio sesión'),
(2, 'Cerro sesión');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id_user` int(11) NOT NULL,
  `icon` varchar(10) NOT NULL DEFAULT '#287EFF',
  `hiper` varchar(10) NOT NULL DEFAULT '#00B6CE',
  `bg1` varchar(10) NOT NULL DEFAULT '#FEFEFE',
  `bg0` varchar(10) NOT NULL DEFAULT '#F5F5F5',
  `bar` varchar(10) NOT NULL DEFAULT '#F5F5F5',
  `photo` varchar(100) NOT NULL DEFAULT 'user.png',
  `theme` varchar(100) NOT NULL DEFAULT 'theme/makepage0.php',
  `asistente` int(11) NOT NULL DEFAULT '0',
  `scroll` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id_user`, `icon`, `hiper`, `bg1`, `bg0`, `bar`, `photo`, `theme`, `asistente`, `scroll`) VALUES
(1, '#b6072b', '#6d0a1e', '#FEFEFE', '#F5F5F5', '#F5F5F5', '7f08d8c2a996003767fbe0cb09d89589.gif', 'makepage2.php', 0, 0),
(2, '#287EFF', '#00B6CE', '#FEFEFE', '#F5F5F5', '#F5F5F5', 'user.png', 'makepage2.php', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracioncuenta`
--

CREATE TABLE `configuracioncuenta` (
  `id_tipo_cuenta` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `titleicon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `configuracioncuenta`
--

INSERT INTO `configuracioncuenta` (`id_tipo_cuenta`, `title`, `titleicon`) VALUES
(1, 'Sistema Administrador', 'fa fa-wrench fa-fw'),
(2, 'Sistema Demo', 'fa fa-user fa-fw');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `id_user` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `amaterno` varchar(50) NOT NULL,
  `apaterno` varchar(50) NOT NULL,
  `id_tipo_cuenta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cuenta`
--

INSERT INTO `cuenta` (`id_user`, `name`, `amaterno`, `apaterno`, `id_tipo_cuenta`) VALUES
(1, 'y46fiZ6JmX6akaiDmg==', 'tI6Ug6KKpsU=', 'tI6Ug6KKpsY=', 1),
(2, 'v5aWjA==', 'v5aWjA==', 'v5aWjA==', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dashboardconfig`
--

CREATE TABLE `dashboardconfig` (
  `id_user` int(11) NOT NULL,
  `op_color` int(11) NOT NULL DEFAULT '0',
  `color` varchar(10) DEFAULT NULL,
  `op_size` int(11) NOT NULL DEFAULT '0',
  `size` varchar(20) NOT NULL,
  `op_sizeicon` int(11) NOT NULL DEFAULT '0',
  `sizeicon` varchar(10) DEFAULT NULL,
  `orderby` int(11) DEFAULT '0',
  `limite` int(11) NOT NULL DEFAULT '25'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `dashboardconfig`
--

INSERT INTO `dashboardconfig` (`id_user`, `op_color`, `color`, `op_size`, `size`, `op_sizeicon`, `sizeicon`, `orderby`, `limite`) VALUES
(1, 0, '#ff0000', 0, 'size11', 0, '80px', 0, 20),
(2, 0, '#ff0000', 1, 'size21', 0, '80px', 0, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `id_act` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `time` varchar(20) NOT NULL,
  `id_user` int(11) NOT NULL,
  `descrip` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `log`
--

INSERT INTO `log` (`id_log`, `id_act`, `fecha`, `time`, `id_user`, `descrip`) VALUES
(3, 2, '2016-07-22', '13:42:30', 1, 'Cerro sesión en el sistemas'),
(4, 1, '2016-07-22', '14:38:42', 1, 'inicio sesión en el sistemas'),
(5, 2, '2016-07-22', '14:49:14', 1, 'Cerro sesión en el sistemas'),
(6, 1, '2016-07-24', '21:39:55', 1, 'inicio sesión en el sistemas'),
(7, 1, '2016-07-24', '22:25:53', 1, 'inicio sesión en el sistemas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcadormsg`
--

CREATE TABLE `marcadormsg` (
  `id_m_msg` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_msg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `marcadormsg`
--

INSERT INTO `marcadormsg` (`id_m_msg`, `id_user`, `id_msg`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcadoruser`
--

CREATE TABLE `marcadoruser` (
  `id_m_user` int(11) NOT NULL,
  `id_dueno` int(11) NOT NULL,
  `id_marcado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `marcadoruser`
--

INSERT INTO `marcadoruser` (`id_m_user`, `id_dueno`, `id_marcado`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id_msg` int(11) NOT NULL,
  `id_envio` int(11) NOT NULL,
  `id_recibio` int(11) NOT NULL,
  `txt` text NOT NULL,
  `fecha` varchar(20) NOT NULL,
  `hora` time NOT NULL,
  `visto` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id_msg`, `id_envio`, `id_recibio`, `txt`, `fecha`, `hora`, `visto`) VALUES
(1, 1, 2, 'hola ', '14-07-16', '20:32:08', 1),
(2, 1, 2, 'hola', '18-07-16', '10:39:59', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modules`
--

CREATE TABLE `modules` (
  `id_modul` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `color` varchar(10) NOT NULL,
  `size` varchar(10) NOT NULL DEFAULT 'size21',
  `iconsize` varchar(20) NOT NULL DEFAULT '80px',
  `icon` text NOT NULL,
  `ruta` text NOT NULL,
  `descrip` text NOT NULL,
  `id_tipo_module` int(11) DEFAULT NULL,
  `id_seg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `modules`
--

INSERT INTO `modules` (`id_modul`, `name`, `color`, `size`, `iconsize`, `icon`, `ruta`, `descrip`, `id_tipo_module`, `id_seg`) VALUES
(1, 'HelloWold', '#FF9900', 'size21', '80px', '../../Modules/HelloWold/icon.png', '../../Modules/HelloWold/index.php', 'Hola mundo !!!', 1, 1),
(2, 'root', '#3B5998', 'size32', '200px', '../../Modules/Root/icon.png', '../../Modules/Root/index.php', 'Administrador de cuentas de usuarios y aplicaciones.', 1, 2),
(3, 'notepad', '#00CF4C', 'size11', '80px', '../../Modules/note/icon.png', '../../Modules/note/index.php', 'Escribe notas', 2, 1),
(4, 'calculadoras', '#C063DC', 'size21', '80px', '../../Modules/Calculadoras/icon.png', '../../Modules/Calculadoras/index.php', 'Multiples Calculadoras', 3, 1),
(5, 'personaliza', '#DAD200', 'size21', '80px', '../../Modules/Personalizar/icon.png', '../../Modules/Personalizar/index.php', 'Personaliza tu interfaz', 1, 1),
(6, 'tiny', '#06E0DC', 'size21', '80px', '../../Modules/TinyEditor/icon.png', '../../Modules/TinyEditor/index.php', 'Editor de texto', 2, 1),
(7, 'cámara', '#B70000', 'size21', '80px', '../../Modules/Camara/icon.png', '../../Modules/Camara/index.php', 'Toma fotografias', 3, 1),
(8, 'Dictador', '#9A9A9A', 'size21', '80px', '../../Modules/Dictador/icon.png', '../../Modules/Dictador/index.php', 'Dicta y el programa lo escribe.', 3, 1),
(9, 'asistente', '#F7D603', 'size21', '80px', '../../Modules/asistente/icon.png', '../../Modules/asistente/index.php', 'Configure el asistente', 1, 1),
(10, 'gpass', '#B7B7B7', 'size21', '80px', '../../Modules/gpass/icon.png', '../../Modules/gpass/index.php', 'Generador de contraseñas', 3, 1),
(11, 'Cabina', '#9AD780', 'size21', '80px', '../../Modules/GrabaAudio/icon.png', '../../Modules/GrabaAudio/index.php', 'Graba audio y guarda las grabaciones', 3, 1),
(12, 'QR', '#4DA203', 'size21', '80px', '../../Modules/qr/icon.png', '../../Modules/qr/index.php', 'Realiza escanea o ve tu qr', 3, 1),
(13, 'Scroll', '#FF44F3', 'size21', '80px', '../../Modules/SCROLL/icon.png', '../../Modules/SCROLL/index.php', 'Utiliza tu puño como scroll', 1, 1),
(14, 'IP', '#00B400', 'size21', '80px', '../../Modules/ip/icon.png', '../../Modules/ip/index.php', 'Obten tu ip', 1, 1),
(15, 'Clock', '#be7e7e', 'size21', '80px', '../../Modules/clock/icon.png', '../../Modules/clock/index.php', 'Puedes ver la Hora', 3, 1),
(16, 'Subir App', '#6aa3c1', 'size21', '80px', '../../Modules/uploadapp/icon.png', '../../Modules/uploadapp/index.php', 'Sube tu app', 1, 1),
(17, 'piano', '#da2150', 'size21', '80px', '../../Modules/piano/icon.png', '../../Modules/piano/index.php', 'Toca el piano', 3, 1),
(18, 'log', '#acacac', 'size21', '80px', '../../Modules/log/icon.png', '../../Modules/log/index.php', 'Revisa la actividad de usuarios', 1, 2),
(19, 'Foda', '#e8de26', 'size21', '80px', '../../Modules/foda/icon.png', '../../Modules/foda/index.php', 'Crea Fodas', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `note`
--

CREATE TABLE `note` (
  `id_note` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nota` text NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `note`
--

INSERT INTO `note` (`id_note`, `id_user`, `nota`, `date`) VALUES
(1, 1, 'Hola esta es una prueba', '18-07-16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguridad_module`
--

CREATE TABLE `seguridad_module` (
  `id_seg` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `seguridad_module`
--

INSERT INTO `seguridad_module` (`id_seg`, `nombre`) VALUES
(1, 'Publico'),
(2, 'Privado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temas`
--

CREATE TABLE `temas` (
  `file` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `temas`
--

INSERT INTO `temas` (`file`, `name`) VALUES
('makepage0.php', 'Default'),
('makepage1.php', 'Logo'),
('makepage2.php', 'Yoko'),
('makepagebanner.php', 'Banner');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cuenta`
--

CREATE TABLE `tipo_cuenta` (
  `id_tipo_cuenta` int(11) NOT NULL,
  `name_cuenta` varchar(50) NOT NULL,
  `main` varchar(50) NOT NULL,
  `new` varchar(50) NOT NULL,
  `inputmsg` varchar(50) NOT NULL,
  `outmsg` varchar(50) NOT NULL,
  `marcadormsg` varchar(50) NOT NULL,
  `vermsg` varchar(50) NOT NULL,
  `myapp` varchar(50) NOT NULL,
  `findapp` varchar(50) NOT NULL,
  `delapp` varchar(50) NOT NULL,
  `config` varchar(50) NOT NULL,
  `perfil` varchar(50) NOT NULL,
  `buscaruser` varchar(50) NOT NULL,
  `marcarusr` varchar(50) NOT NULL,
  `fallo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_cuenta`
--

INSERT INTO `tipo_cuenta` (`id_tipo_cuenta`, `name_cuenta`, `main`, `new`, `inputmsg`, `outmsg`, `marcadormsg`, `vermsg`, `myapp`, `findapp`, `delapp`, `config`, `perfil`, `buscaruser`, `marcarusr`, `fallo`) VALUES
(1, 'Administrador', '../../User/admin/index.php', '../../User/admin/new.php', '../../User/admin/inputmsg.php', '../../User/admin/outmsg.php', '../../User/admin/marmsg.php', '../../User/admin/viewmsg.php', '../../User/admin/myapp.php', '../../User/admin/findapp.php', '../../User/admin/delapp.php', '../../User/admin/config.php', '../../User/admin/viewpeople.php', '../../User/admin/finderuser.php', '../../User/admin/marusr.php', '../../User/admin/fallo.php'),
(2, 'Demo', '../../User/demo/index.php', '../../User/demo/new.php', '../../User/demo/inputmsg.php', '../../User/demo/outmsg.php', '../../User/demo/marmsg.php', '../../User/demo/viewmsg.php', '../../User/demo/myapp.php', '../../User/demo/findapp.php', '../../User/demo/delapp.php', '../../User/demo/config.php', '../../User/demo/viewpeople.php', '../../User/demo/finderuser.php', '../../User/demo/marusr.php', '../../User/demo/fallo.php');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_module`
--

CREATE TABLE `tipo_module` (
  `id_tipo_module` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_module`
--

INSERT INTO `tipo_module` (`id_tipo_module`, `nombre`) VALUES
(1, 'Sistema'),
(2, 'Editor'),
(3, 'Utilidades');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(80) NOT NULL,
  `pass` varchar(80) NOT NULL,
  `act` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id_user`, `email`, `pass`, `act`) VALUES
(1, 'root@root.com', 'j4yUiQ==', 1),
(2, 'demo@demo.com', 'n5aWjA==', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_modulo`
--

CREATE TABLE `user_modulo` (
  `id_user_modulo` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_modul` int(11) NOT NULL,
  `visita` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user_modulo`
--

INSERT INTO `user_modulo` (`id_user_modulo`, `id_user`, `id_modul`, `visita`) VALUES
(1, 1, 2, 82),
(2, 1, 5, 50),
(3, 1, 4, 15),
(4, 1, 3, 10),
(5, 1, 1, 82),
(6, 1, 6, 20),
(7, 1, 7, 54),
(8, 1, 8, 35),
(9, 2, 1, 1),
(10, 2, 5, 14),
(12, 2, 6, 0),
(13, 2, 3, 2),
(15, 2, 7, 12),
(16, 1, 9, 68),
(17, 1, 10, 8),
(18, 2, 9, 5),
(19, 1, 11, 17),
(20, 1, 12, 44),
(21, 1, 13, 15),
(22, 2, 12, 7),
(23, 2, 13, 7),
(24, 2, 11, 5),
(25, 1, 14, 7),
(26, 1, 15, 4),
(27, 1, 16, 0),
(28, 1, 17, 3),
(29, 1, 18, 0),
(30, 1, 19, 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acciones`
--
ALTER TABLE `acciones`
  ADD PRIMARY KEY (`id_act`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id_user`);

--
-- Indices de la tabla `configuracioncuenta`
--
ALTER TABLE `configuracioncuenta`
  ADD PRIMARY KEY (`id_tipo_cuenta`);

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`id_user`);

--
-- Indices de la tabla `dashboardconfig`
--
ALTER TABLE `dashboardconfig`
  ADD PRIMARY KEY (`id_user`);

--
-- Indices de la tabla `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indices de la tabla `marcadormsg`
--
ALTER TABLE `marcadormsg`
  ADD PRIMARY KEY (`id_m_msg`);

--
-- Indices de la tabla `marcadoruser`
--
ALTER TABLE `marcadoruser`
  ADD PRIMARY KEY (`id_m_user`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id_msg`);

--
-- Indices de la tabla `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id_modul`);

--
-- Indices de la tabla `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id_note`);

--
-- Indices de la tabla `seguridad_module`
--
ALTER TABLE `seguridad_module`
  ADD PRIMARY KEY (`id_seg`);

--
-- Indices de la tabla `temas`
--
ALTER TABLE `temas`
  ADD PRIMARY KEY (`file`);

--
-- Indices de la tabla `tipo_cuenta`
--
ALTER TABLE `tipo_cuenta`
  ADD PRIMARY KEY (`id_tipo_cuenta`);

--
-- Indices de la tabla `tipo_module`
--
ALTER TABLE `tipo_module`
  ADD PRIMARY KEY (`id_tipo_module`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indices de la tabla `user_modulo`
--
ALTER TABLE `user_modulo`
  ADD PRIMARY KEY (`id_user_modulo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `marcadormsg`
--
ALTER TABLE `marcadormsg`
  MODIFY `id_m_msg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `marcadoruser`
--
ALTER TABLE `marcadoruser`
  MODIFY `id_m_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id_msg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `modules`
--
ALTER TABLE `modules`
  MODIFY `id_modul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `note`
--
ALTER TABLE `note`
  MODIFY `id_note` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tipo_module`
--
ALTER TABLE `tipo_module`
  MODIFY `id_tipo_module` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `user_modulo`
--
ALTER TABLE `user_modulo`
  MODIFY `id_user_modulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
