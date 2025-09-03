-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-07-2025 a las 06:22:14
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_educkaonline`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcategoria`
--

CREATE TABLE `tcategoria` (
  `idcategoria` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tcategoria`
--

INSERT INTO `tcategoria` (`idcategoria`, `nombre`, `descripcion`, `estado`) VALUES
(1, 'Programacion', 'Clase de C#', 1),
(2, 'Logica', 'Logica Difusa', 1),
(3, 'Base De Datos 2', 'No Relacional 2', 1),
(4, 'Android', 'Java', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tclases`
--

CREATE TABLE `tclases` (
  `idclases` int(11) NOT NULL,
  `idcurso` int(11) NOT NULL,
  `titulo` varchar(300) NOT NULL,
  `enlace` varchar(1000) NOT NULL,
  `archivos` varchar(100) DEFAULT NULL,
  `archivourl` varchar(100) DEFAULT NULL,
  `privacidad` tinyint(1) DEFAULT NULL,
  `descripcion` varchar(2000) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tclases`
--

INSERT INTO `tclases` (`idclases`, `idcurso`, `titulo`, `enlace`, `archivos`, `archivourl`, `privacidad`, `descripcion`, `estado`) VALUES
(1, 1, 'clase 1', 'GKz_5Yd6fhA', 'Material de Clase - 1.rar', './Assets/archivos/materiales/Material de Clase - 1.rar', 1, 'primera clase', 1),
(15, 1, 'Clase 2', 'dsfg54654', NULL, NULL, 0, 'segunda clase', 1),
(16, 1, 'Clase 3', 'IQeHmHtOll0', NULL, NULL, 0, 'clase 3', 1),
(17, 1, 'Clase 4', 'IQeHmHtOll0', NULL, NULL, 0, 'cuarta clase', 1),
(18, 1, 'clase vasia', 'dsagr4gfd', NULL, NULL, 0, 'sin una', 1),
(19, 1, 'Clase 5', 'IQeHmHtOll0', 'Clase 5 - 19.rar', './Assets/archivos/materiales/Clase 5 - 19.rar', 0, 'clase 5 pruebas', 1),
(20, 1, 'Clase 6', 'IQeHmHtOll0', 'Clase 6 - 20.rar', './Assets/archivos/materiales/Clase 6 - 20.rar', 1, 'esta clase tiene archivos', 1),
(21, 2, 'clase 1', 'IQeHmHtOll0', 'Roger S. Pressman - Ingeniería del software _ un enfoque práctico (2013).pdf', './Assets/archivos/materiales/Roger S. Pressman - Ingeniería del software _ un enfoque práctico (2013', 0, 'primer clase personalizada', 1),
(22, 2, 'Clase 2', 'IQeHmHtOll0', 'Clase 2 - 22.pdf', './Assets/archivos/materiales/Clase 2 - 22.pdf', 0, 'pruebas de archivos', 1),
(23, 2, 'Clase 3', 'IQeHmHtOll0', 'Clase 3 - 23.pdf', './Assets/archivos/materiales/Clase 3 - 23.pdf', 0, 'cambios de archivo', 1),
(24, 8, 'Calculo 1', 'https://youtu.be/lZJ5iKarI-k', 'Material de Clase - 24.zip', './Assets/archivos/materiales/Material de Clase - 24.zip', 0, 'Es sobre la cal', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcodigos`
--

CREATE TABLE `tcodigos` (
  `idcodigo` int(11) NOT NULL,
  `codigo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tcodigos`
--

INSERT INTO `tcodigos` (`idcodigo`, `codigo`) VALUES
(2, '470a39ed0b55145e9407-ea86115a8e7e63db9b40-3c30e3604ecc803e4e27-4d52743e2a858aad53b9'),
(3, 'ab18b6d0da318e4c70a7-f8da6c6f6071b542f044-45e6ee5915fa6fdb9a20-42175d0db7b7d937fc20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcomentario`
--

CREATE TABLE `tcomentario` (
  `idcomentario` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idclase` int(11) NOT NULL,
  `idrespuestas` int(11) NOT NULL,
  `comentario` varchar(5000) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcursos`
--

CREATE TABLE `tcursos` (
  `idcurso` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idcategoria` int(11) DEFAULT NULL,
  `idplataforma` int(11) DEFAULT NULL,
  `titulo` varchar(50) NOT NULL,
  `descripcion` varchar(2000) DEFAULT NULL,
  `privacidad` tinyint(1) DEFAULT NULL,
  `portadaname` varchar(100) DEFAULT NULL,
  `portadaurl` varchar(100) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tcursos`
--

INSERT INTO `tcursos` (`idcurso`, `idusuario`, `idcategoria`, `idplataforma`, `titulo`, `descripcion`, `privacidad`, `portadaname`, `portadaurl`, `estado`) VALUES
(1, 3, 1, 1, 'Mecanografía Avanzada', 'Un curso de recomendaciones para avanzar', 0, 'Portada - 1.jpg', './Assets/archivos/portada-curso/Portada - 1.jpg', 1),
(2, 8, 2, 1, 'Gastronomia 2', 'platos nuevos', 0, 'Portada - 2.jpg', './Assets/archivos/portada-curso/Portada - 2.jpg', 1),
(3, 9, 3, 1, 'No relacional', 'No se Sql', 0, 'Portada - 3.jpg', './Assets/archivos/portada-curso/Portada - 3.jpg', 1),
(4, 3, 1, 1, 'Lenguaje', 'Ingles', 0, 'Portada - 4.jpeg', './Assets/archivos/portada-curso/Portada - 4.jpeg', 1),
(6, 3, 3, 1, 'Ceshart', 'Lenguajes Ps', 0, 'Portada - 6.jpeg', './Assets/archivos/portada-curso/Portada - 6.jpeg', 1),
(7, 3, 2, 1, 'MCVs', 'PHP', 0, 'Portada - 7.jpeg', './Assets/archivos/portada-curso/Portada - 7.jpeg', 1),
(8, 9, 2, 1, 'Prubas de cocinas', '', 0, 'Portada - 8.jpeg', '/Assets/archivos/portada-curso/Portada - 8.jpeg', 1),
(9, 9, 1, 3, 'Calculo', 'Calculosss', 0, 'Portada - 9.jpg', './Assets/archivos/portada-curso/Portada - 9.jpg', 1),
(10, 9, 3, 1, 'Juegos 3D', 'Juegos mmorpg no lineal en que puedes crear tu propio mundo', 0, 'Portada - 10.jpg', './Assets/archivos/portada-curso/Portada - 10.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmodulos`
--

CREATE TABLE `tmodulos` (
  `idmodulo` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tmodulos`
--

INSERT INTO `tmodulos` (`idmodulo`, `nombre`, `estado`) VALUES
(1, 'Suscriptores', 1),
(2, 'Usuarios', 1),
(3, 'Docentes', 1),
(4, 'Estudiantes', 1),
(5, 'Roles', 1),
(6, 'Cursos', 1),
(7, 'Clases', 1),
(8, 'Categorías', 1),
(9, 'Plataformas ', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tpermisos`
--

CREATE TABLE `tpermisos` (
  `idpermisos` int(11) NOT NULL,
  `idmodulo` int(11) NOT NULL,
  `idrol` int(11) NOT NULL,
  `r` int(11) NOT NULL,
  `w` int(11) NOT NULL,
  `u` int(11) NOT NULL,
  `d` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tpermisos`
--

INSERT INTO `tpermisos` (`idpermisos`, `idmodulo`, `idrol`, `r`, `w`, `u`, `d`) VALUES
(31, 1, 5, 0, 0, 0, 0),
(32, 2, 5, 0, 0, 0, 0),
(33, 3, 5, 0, 0, 0, 0),
(34, 4, 5, 0, 0, 0, 0),
(35, 5, 5, 0, 0, 0, 0),
(36, 6, 5, 0, 0, 0, 0),
(37, 1, 2, 0, 0, 0, 0),
(38, 2, 2, 0, 0, 0, 0),
(39, 3, 2, 1, 1, 1, 1),
(40, 4, 2, 0, 0, 0, 0),
(41, 5, 2, 0, 0, 0, 0),
(42, 6, 2, 0, 0, 0, 0),
(43, 1, 1, 1, 1, 1, 1),
(44, 2, 1, 1, 1, 1, 1),
(45, 3, 1, 1, 1, 1, 1),
(46, 4, 1, 1, 1, 1, 1),
(47, 5, 1, 1, 1, 1, 1),
(48, 6, 1, 1, 1, 1, 1),
(49, 7, 1, 1, 1, 1, 1),
(50, 8, 1, 1, 1, 1, 1),
(51, 9, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tplataforma`
--

CREATE TABLE `tplataforma` (
  `idplataforma` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tplataforma`
--

INSERT INTO `tplataforma` (`idplataforma`, `nombre`, `descripcion`, `estado`) VALUES
(1, 'Unity', 'plataforma de juegos', 1),
(2, 'Web II', 'Php', 1),
(3, 'Juegos', 'Muy bueno 3d', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `troles`
--

CREATE TABLE `troles` (
  `idroles` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `troles`
--

INSERT INTO `troles` (`idroles`, `tipo`, `descripcion`, `estado`) VALUES
(1, 'Administrador', 'Todos los Permisos', 1),
(2, 'Docente', 'Creador de Contenido', 1),
(3, 'Estudiante', 'Cuenta por defecto', 1),
(4, 'AdminS', 'Fre', 0),
(5, 'Prueba', 'PruebaD', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tsuscripciones`
--

CREATE TABLE `tsuscripciones` (
  `idsuscripcion` int(11) NOT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `fechaini` date DEFAULT NULL,
  `fechafin` date DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tsuscripciones`
--

INSERT INTO `tsuscripciones` (`idsuscripcion`, `idusuario`, `fechaini`, `fechafin`, `estado`) VALUES
(1, 2, '2024-01-06', '2024-01-24', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tusuarios`
--

CREATE TABLE `tusuarios` (
  `idusuario` int(11) NOT NULL,
  `idroles` int(11) NOT NULL,
  `ci` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `telefono` int(30) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `suscripcion` tinyint(1) NOT NULL,
  `token` varchar(100) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tusuarios`
--

INSERT INTO `tusuarios` (`idusuario`, `idroles`, `ci`, `nombre`, `apellidos`, `telefono`, `correo`, `password`, `suscripcion`, `token`, `estado`) VALUES
(1, 1, '8411', 'Name', 'Lastname', 788925, 'corr@gmail.com', '', 0, '', 0),
(2, 1, '5465456', 'Jose', 'Mayta', 67016437, 'mayta5544fail@gmail.com', 'b639b5438a7762e01d72265de20566658f1432e52c47b2370be1461de1127d27', 0, 'bb18f71d14a6b6016644-36bd93f0ae9d379c512c-859b0dd8fa484129d1f8-5c99970131105061cae8', 0),
(3, 1, '8411252', 'Carlos', 'Vallejos', 7889249, 'moises18vallejos@gmail.com', 'bb29714cf55294897007573a5a66075c209d2947f771c6b894555ce06c2a3444', 1, '', 1),
(4, 1, '9911804', 'Diego Jesus', 'Mercado Castillo', 75879879, 'dmercadoff@gmail.com', '14b4f03e39188dca80daf2a65b152a05c99a8360a47572fcead80f2e0e9a3de1', 0, '', 1),
(5, 1, '6355', 'Jose', 'Mayta1', 67016437, 'mayta55448768@gmail.com', 'e5608b2719c2c2d4e5ff5a0289dad7118a45286f6add46b8b088c2cab2acc7a9', 0, 'e9333daa3e0f7e21b1b8-3903e96591f14a1f4584-6c829ee4eb71fdc0815e-18915c3df84bef7c3f0a', 1),
(6, 3, '4253454235', 'Jose', 'Maytayu', 67016437, 'hg@gmail.com', '91164a89495a56f5d3b35cb98b994c6d9a2d3da3d67b3027d951b4f6f13c4a1a', 0, '75c4138dced087b79602-f8147ac4b6cf29e371b2-610b84268a6eecfb290a-664386c0a5378049e409', 1),
(7, 2, '13243214', 'Jose', 'Maytas', 67016437, 'mdj2023029@gmail.com', '003b222aa66253db1da8be72bc9f334f31ccaf09f81256610f75d1c6673adfe8', 0, '6347b6775592adde1056-600cd4e363fbefdc3fda-550b3581464c4b8757cb-4e50897a20a0b6ba895b', 2),
(8, 2, '5435435', 'Josetwqewq', 'Maytastewq', 67016437, 'mayta5544no@gmail.com', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225', 0, '', 1),
(9, 1, '452435236', 'Josetr', 'Maytastu', 67016437, 'mayta5544@gmail.com', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225', 0, '', 1),
(10, 3, '65533', 'Moises', 'Pacheco', 0, 'pacheco@gmail.com', '5f5c4657fab32e1c916ee95de3e3dfa197d0c18f1e2ac1fc7f93104c5ce6f851', 1, 'd405101688702baf3ba1-fa9c6e1db3818a601c48-83124f93dc1e3cf2559e-4379f2b6d21889185d88', 0),
(11, 3, '7999944', 'Masaa', 'Pachaaa', 792451101, 'currop@gmail.com', '0bb775c366f52d316c63b5493741049aa42be369c5f227238114cb768efee942', 1, '82fc9a8a95ae2a835c9b-6c6024400e56e1f23e40-3f7355b969795f2bf7cd-e03de796a1a0ca03da58', 0),
(12, 3, '97777', 'Ike', 'Vall', 1234567, 'cassr@gmail.com', 'de4220717edd38098a7420b7724b0a6bac6fb96b5f9ad36e8fc674f49eec8565', 0, '5882f3658d22160c9a75-94364c8d6165cfd9dfea-3a8799bb99acc6dcba6d-057470d9e7f4ad995f38', 0),
(13, 2, '8797897', 'Carkos', 'Paceso', 10101010, 'asdddd@gmail.com', 'c4a8c1e9b4f90509775c4b4e4b9ccd09e2693fdbab5356db0aff1aa97adb4259', 0, '17271fec2fc9b0d4b522-20ba507f37dbca880bf2-fb2afdc13f26e06cbb58-7bf081bf69e202c2c0e3', 1),
(14, 3, '87773', 'Carlos', 'Vallejossssssss', 799224994, 'kil@gmail.com', '5d1352a329e4c63307bb4c016af8211356392a70a68b567ab54854dd48adc8f3', 0, '610be4f5a30254ad29fa-a69f8b6551e28078e82a-a228751985429bc6ab04-f00a662ed922be0e9246', 1),
(15, 3, '4353', 'Sesiom', 'Vaka', 799224994, 'ollo@gmail.com', '47b138332d9bd07efc061d6a06eb20b3771ac57aab6402304b0127cd36833baa', 0, '746ad8ac9af683a403a9-0f016f4858a5b83b7b3c-5fdb0a00295fd06d2df7-b254f27c1b1ae930aa63', 1),
(16, 3, '9888888', 'Ercik', 'Velaz', 988112321, 'micorrei@gmail.com', 'e8d573255a457f3398d9fbf4d69cca1b6e48d0c63f40924f13b6f72d864e4583', 0, '7795d7daa3e3e3103cdf-2077385533ffaea7e886-f848388d1d04ff7226df-c9d5371a7ec98471fe87', 1),
(17, 3, '6777777776', 'Julio', 'Cesar', 78856789, 'csar@gmail.com', '47641dd8d281d31a31bb5aa1311c0c494c907339c026c8c0f6a1a1c4bcaa54a9', 0, '49345dccb698864afbfa-30c64573c06f9c980c81-c106766b5bbb0d5fae66-7311931487fe707ad552', 1),
(18, 3, '98888', 'Jhosen', 'Tuna', 9886655, 'tuna@gmail.com', '0ce6e1948c8ae139c58710e9a1655751ae7c05ff31c5f6d2f6b47b8ca701b020', 0, 'c9b874b5f3f928719180-15095bdb8273f7970de4-b5e6f5af26e32e6cdb10-2a45aca3b87c711317d2', 1),
(19, 3, '66655', 'Sprin', 'Caran', 78884121, 'aca21@gmail.com', 'c5b16d2dc2cc12fa1844a4b27214bc990998701c1615e6a21b8a0ce6f921f100', 0, 'deaa43ab364a2b38bb2b-fc5ffdeed8995f903785-d82a21ac96cbee1ac80e-4c8f759c717d30ec8295', 1),
(20, 3, '423432', 'LEo', 'Perro', 6854521, 'leo@gmail.com', '37987c4b570daeabf2bbb80ff5a1f6bf140a43851c628c0a662b996b4f36bf4d', 0, '16f665c40607f35752d7-3efec3c461a5778ce6e4-e5914ef82051f2162f12-bb79ff540e141a56bb3c', 1),
(21, 3, '90000', 'Nitro', 'Fuil', 123778, 'full@gmail.com', '76824c8732fb688bacec6606013dafc03666be97125967a9149c30925fb30cb0', 0, 'b74e77283babd4c79902-913fe9e32423f367c870-13a79b82690114b4790c-c3d323769028a2af8734', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tvideos`
--

CREATE TABLE `tvideos` (
  `idvideo` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idcatsubcat` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `enlace` varchar(500) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tcategoria`
--
ALTER TABLE `tcategoria`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `tclases`
--
ALTER TABLE `tclases`
  ADD PRIMARY KEY (`idclases`),
  ADD KEY `idcurso` (`idcurso`);

--
-- Indices de la tabla `tcodigos`
--
ALTER TABLE `tcodigos`
  ADD PRIMARY KEY (`idcodigo`);

--
-- Indices de la tabla `tcomentario`
--
ALTER TABLE `tcomentario`
  ADD PRIMARY KEY (`idcomentario`);

--
-- Indices de la tabla `tcursos`
--
ALTER TABLE `tcursos`
  ADD PRIMARY KEY (`idcurso`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idcategoria` (`idcategoria`),
  ADD KEY `idplataforma` (`idplataforma`);

--
-- Indices de la tabla `tmodulos`
--
ALTER TABLE `tmodulos`
  ADD PRIMARY KEY (`idmodulo`);

--
-- Indices de la tabla `tpermisos`
--
ALTER TABLE `tpermisos`
  ADD PRIMARY KEY (`idpermisos`),
  ADD KEY `idmodulos` (`idmodulo`),
  ADD KEY `idrol` (`idrol`);

--
-- Indices de la tabla `tplataforma`
--
ALTER TABLE `tplataforma`
  ADD PRIMARY KEY (`idplataforma`);

--
-- Indices de la tabla `troles`
--
ALTER TABLE `troles`
  ADD PRIMARY KEY (`idroles`);

--
-- Indices de la tabla `tsuscripciones`
--
ALTER TABLE `tsuscripciones`
  ADD PRIMARY KEY (`idsuscripcion`);

--
-- Indices de la tabla `tusuarios`
--
ALTER TABLE `tusuarios`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `idroles` (`idroles`);

--
-- Indices de la tabla `tvideos`
--
ALTER TABLE `tvideos`
  ADD PRIMARY KEY (`idvideo`),
  ADD KEY `idcatsubcat` (`idcatsubcat`),
  ADD KEY `idcatsubcat_2` (`idcatsubcat`),
  ADD KEY `idusuario` (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tcategoria`
--
ALTER TABLE `tcategoria`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tclases`
--
ALTER TABLE `tclases`
  MODIFY `idclases` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `tcodigos`
--
ALTER TABLE `tcodigos`
  MODIFY `idcodigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tcomentario`
--
ALTER TABLE `tcomentario`
  MODIFY `idcomentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tcursos`
--
ALTER TABLE `tcursos`
  MODIFY `idcurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tmodulos`
--
ALTER TABLE `tmodulos`
  MODIFY `idmodulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tpermisos`
--
ALTER TABLE `tpermisos`
  MODIFY `idpermisos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `tplataforma`
--
ALTER TABLE `tplataforma`
  MODIFY `idplataforma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `troles`
--
ALTER TABLE `troles`
  MODIFY `idroles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tsuscripciones`
--
ALTER TABLE `tsuscripciones`
  MODIFY `idsuscripcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tusuarios`
--
ALTER TABLE `tusuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `tvideos`
--
ALTER TABLE `tvideos`
  MODIFY `idvideo` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
