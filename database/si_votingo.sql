-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-09-2020 a las 08:30:25
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
-- Base de datos: `si_votingo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `candidacies`
--

CREATE TABLE `candidacies` (
  `id` int(11) NOT NULL,
  `photo` blob DEFAULT NULL,
  `candidatetype_idfk` int(11) NOT NULL,
  `studentlist_idfk` int(11) NOT NULL,
  `id_statusfk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `candidacies`
--

INSERT INTO `candidacies` (`id`, `photo`, `candidatetype_idfk`, `studentlist_idfk`, `id_statusfk`) VALUES
(1, NULL, 1, 3, 1),
(2, NULL, 3, 2, 1),
(3, NULL, 3, 1, 1),
(4, NULL, 1, 4, 1),
(5, NULL, 3, 5, 1),
(6, NULL, 1, 6, 1),
(7, NULL, 2, 7, 1),
(8, NULL, 3, 8, 1),
(9, NULL, 2, 9, 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `candidate_list`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `candidate_list` (
`id` int(11)
,`Candidate` varchar(61)
,`candidatetype_name` varchar(20)
,`grade_name` varchar(20)
,`code` int(4)
,`photo` blob
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `candidate_types`
--

CREATE TABLE `candidate_types` (
  `id` int(11) NOT NULL,
  `candidatetype_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `candidate_types`
--

INSERT INTO `candidate_types` (`id`, `candidatetype_name`) VALUES
(1, 'Personero'),
(2, 'Contralor'),
(3, 'Cabildante');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `candidatos_propuestas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `candidatos_propuestas` (
`id` int(11)
,`photo` blob
,`candidatetype_idfk` int(11)
,`studentlist_idfk` int(11)
,`id_statusfk` int(11)
,`proposal_tittle` varchar(30)
,`proposal_description` varchar(200)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `code` int(4) NOT NULL,
  `grade_idfk` int(11) NOT NULL,
  `wday_idfk` int(11) NOT NULL,
  `eprocess_idfk` int(11) NOT NULL,
  `status_idfk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `courses`
--

INSERT INTO `courses` (`id`, `code`, `grade_idfk`, `wday_idfk`, `eprocess_idfk`, `status_idfk`) VALUES
(1, 901, 1, 1, 1, 14),
(2, 1001, 2, 1, 1, 14),
(3, 1102, 3, 1, 1, 14),
(4, 902, 1, 1, 1, 14),
(5, 902, 1, 1, 1, 14),
(6, 1002, 2, 1, 1, 14),
(7, 1003, 2, 1, 1, 14),
(8, 1103, 3, 1, 1, 14),
(9, 1101, 3, 1, 1, 14),
(10, 801, 4, 1, 1, 14),
(11, 802, 4, 1, 1, 14),
(12, 701, 5, 1, 1, 14),
(13, 702, 5, 1, 1, 14),
(14, 601, 7, 1, 1, 14),
(15, 602, 5, 1, 1, 14),
(16, 501, 8, 1, 1, 14),
(17, 502, 8, 1, 1, 14),
(18, 401, 9, 1, 1, 14),
(19, 301, 10, 1, 1, 14),
(20, 302, 10, 1, 1, 14),
(21, 201, 11, 1, 1, 14),
(22, 202, 11, 1, 1, 14),
(23, 101, 12, 1, 1, 14),
(24, 101, 12, 1, 1, 14),
(25, 1, 13, 1, 1, 14),
(26, 2, 13, 1, 1, 14),
(27, 1, 13, 2, 1, 14),
(28, 2, 13, 2, 1, 14),
(29, 101, 12, 2, 1, 14),
(30, 102, 13, 2, 1, 14),
(31, 201, 11, 2, 1, 14),
(33, 301, 10, 2, 1, 14),
(34, 401, 9, 2, 1, 14),
(35, 501, 8, 2, 1, 14),
(36, 601, 7, 2, 1, 14),
(37, 701, 5, 2, 1, 14),
(38, 801, 4, 2, 1, 14),
(39, 901, 1, 2, 1, 14),
(40, 1001, 2, 2, 1, 14),
(41, 1101, 3, 2, 1, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `electoral_processes`
--

CREATE TABLE `electoral_processes` (
  `id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status_idfk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `electoral_processes`
--

INSERT INTO `electoral_processes` (`id`, `start_date`, `end_date`, `status_idfk`) VALUES
(1, '2020-08-18', '2020-08-19', 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `grade_name` varchar(20) NOT NULL,
  `level_idfk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grades`
--

INSERT INTO `grades` (`id`, `grade_name`, `level_idfk`) VALUES
(1, 'Noveno', 3),
(2, 'Decimo', 2),
(3, 'Once', 3),
(4, 'Octavo', 3),
(5, 'Septimo', 3),
(7, 'Sexto', 3),
(8, 'Quinto', 2),
(9, 'Cuarto', 2),
(10, 'Tercero', 2),
(11, 'Segundo', 2),
(12, 'Primero', 2),
(13, 'Transición', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `levels`
--

CREATE TABLE `levels` (
  `id` int(11) NOT NULL,
  `level_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `levels`
--

INSERT INTO `levels` (`id`, `level_name`) VALUES
(1, 'Preescolar'),
(2, 'Primaria'),
(3, 'Secundaria');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `numberstudent`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `numberstudent` (
`id` int(11)
,`code` int(4)
,`grade_idfk` int(11)
,`wday_idfk` int(11)
,`eprocess_idfk` int(11)
,`status_idfk` int(11)
,`wday_name` varchar(20)
,`idpro` int(11)
,`grade_name` varchar(20)
,`status_name` varchar(25)
,`numberStudents` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proposals`
--

CREATE TABLE `proposals` (
  `id` int(11) NOT NULL,
  `proposal_tittle` varchar(30) NOT NULL,
  `proposal_description` varchar(200) NOT NULL,
  `candidacy_idfk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proposals`
--

INSERT INTO `proposals` (`id`, `proposal_tittle`, `proposal_description`, `candidacy_idfk`) VALUES
(1, 'Mas refrigerios ', 'Se pondra en camino el almacenamiento aunmentado de refrigerios en la institución.', 2),
(3, 'Mas descanso', 'Los estudiante dispondran de mas descansos aumentandose de treinta minutos de descanso a una hora de descanso', 2),
(4, 'Mas paseos', 'Com el dinero recaudado tendremos mas dinero para ir a EE.UU', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(20) NOT NULL,
  `id_statusfk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `id_statusfk`) VALUES
(1, 'Administrador', 9),
(2, 'Docente', 9),
(3, 'Estudiante', 9),
(4, 'Candidatura', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `scrutinies`
--

CREATE TABLE `scrutinies` (
  `id` int(11) NOT NULL,
  `candidacy_idfk` int(11) NOT NULL,
  `number_votes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `statuses`
--

CREATE TABLE `statuses` (
  `id` int(11) NOT NULL,
  `status_name` varchar(25) NOT NULL,
  `typestatus_idfk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `statuses`
--

INSERT INTO `statuses` (`id`, `status_name`, `typestatus_idfk`) VALUES
(1, 'Activo', 4),
(2, 'Inactivo', 4),
(3, 'Voto', 3),
(4, 'No voto', 3),
(5, 'Inasistencia', 3),
(6, 'retirado', 3),
(9, 'Habilitado', 1),
(10, 'Inhabilitado', 1),
(11, 'Sancionado', 2),
(14, 'No iniciado', 6),
(15, 'En ejecucion', 6),
(16, 'Finalizado', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `student_listing`
--

CREATE TABLE `student_listing` (
  `id` int(11) NOT NULL,
  `user_idfk` int(11) NOT NULL,
  `course_idfk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `student_listing`
--

INSERT INTO `student_listing` (`id`, `user_idfk`, `course_idfk`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 9),
(4, 4, 9),
(5, 5, 9),
(6, 6, 9),
(7, 7, 6),
(8, 8, 5),
(9, 9, 7),
(10, 16, 9),
(11, 17, 29),
(12, 18, 29);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type_statuses`
--

CREATE TABLE `type_statuses` (
  `id` int(11) NOT NULL,
  `typestatus_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `type_statuses`
--

INSERT INTO `type_statuses` (`id`, `typestatus_name`) VALUES
(1, 'General'),
(2, 'Docente'),
(3, 'Estudiante'),
(4, 'Usuario'),
(5, 'Rol'),
(6, 'Proceso Electoral');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `document` bigint(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `cellphone` bigint(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `status_idfk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `document`, `password`, `cellphone`, `email`, `status_idfk`) VALUES
(1, 'Sergio Jose', 'Jacome Rodriguez', 1000410044, '12345678', 3221235321, 'Sdjacome@gmail.com', 1),
(2, 'Camilo Esteban', 'Zuluaga Viloria', 34567, '4543543', 45345, 'Cezuvil@gmail.com', 2),
(3, 'Bryan Alexander', 'suarez Ropero', 435435, '435345', 435345, 'sadsad@sdsadsa', 11),
(4, 'Rogelio Pacativa', 'Nuñez Tocasuche', 34324, '32423', 32423, 'sadsad@sdsadsa', 1),
(5, 'Andres Eduardo', 'Cortez Perez', 3434, '234324', 234234, 'dsfdsf@dsads', 1),
(6, 'Armando Luis', 'Fariñez Gomez', 34234, '34234', 324234, 'asdsad@sdsfds', 1),
(7, 'Frida Jesus', 'Dominguez Carreño', 4534543, '4534543', 45345, 'dfdsf@sdsadsa', 2),
(8, 'Gonzalo Yersson', 'Diaz Beltran', 3435, '345435', 45345, 'Sdjacome@gmail.com', 2),
(9, 'Julieth Andrea', 'Palillo Jimenez', 10002332432, '3432', 342323423432, 'Palillo@gmail.com', 2),
(10, 'Felipe Jose', 'Dominguez Jimenez', 1000343234, '34343', 3114354671, 'FjDominguez@gmail.com', 1),
(11, 'dsfsdf', 'sdfdsf', 32432, '4234324', 4324234, 'sdsadsad@sdsadsad', 1),
(12, 'sadasdsa', 'dasdasd', 34324, '324324', 324234, 'sdsadsad@qdsadas', 2),
(13, 'Stiven Ochoa', 'wwww', 434324, '', 3432434, 'Stiven2@gmail.com', 1),
(14, 'Stiven david', 'sdsadsa', 34234, '', 34324, 'STIVENVEL@HOTMAIL.COM', 1),
(15, 'Camila Andrea', 'Butrageño Cortez', 10003234542, '', 1000323212, 'CaButrageno@gmail.com', 1),
(16, 'Fernado', 'Suarez', 232432, '3432432', 343243242, 'fdsdfdsf@fsfsdf', 1),
(17, 'Serjio', 'Belandia', 23423424324, '233432434', 34324234, 'fksdfksdf@fsdfsd', 1),
(18, 'Brayan Jesus', 'Suarez Chamorro', 34324324, '453453', 3543543, 'sdsasf@dasdsad', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usurol`
--

CREATE TABLE `usurol` (
  `user_idfk` int(11) NOT NULL,
  `role_idfk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usurol`
--

INSERT INTO `usurol` (`user_idfk`, `role_idfk`) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4),
(3, 3),
(3, 4),
(4, 2),
(4, 4),
(4, 3),
(4, 4),
(5, 3),
(5, 4),
(6, 2),
(6, 4),
(7, 3),
(7, 4),
(8, 3),
(8, 4),
(9, 2),
(9, 4),
(16, 3),
(17, 3),
(18, 3);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vw_candidate_other`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vw_candidate_other` (
`id` int(11)
,`proposal_tittle` varchar(30)
,`proposal_description` varchar(200)
,`id_fk` int(11)
,`Candidato` varchar(61)
,`tipo_candidato` varchar(20)
,`grade_name` varchar(20)
,`code` int(4)
,`photo` blob
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `working_day`
--

CREATE TABLE `working_day` (
  `id` int(11) NOT NULL,
  `wday_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `working_day`
--

INSERT INTO `working_day` (`id`, `wday_name`) VALUES
(1, 'Mañana'),
(2, 'Tarde');

-- --------------------------------------------------------

--
-- Estructura para la vista `candidate_list`
--
DROP TABLE IF EXISTS `candidate_list`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `candidate_list`  AS  select `c`.`id` AS `id`,concat(`u`.`name`,' ',`u`.`last_name`) AS `Candidate`,`ct`.`candidatetype_name` AS `candidatetype_name`,`g`.`grade_name` AS `grade_name`,`cr`.`code` AS `code`,`cd`.`photo` AS `photo` from ((((((`users` `u` join `student_listing` `sl` on(`sl`.`user_idfk` = `u`.`id`)) join `candidacies` `cd` on(`cd`.`id` = `sl`.`user_idfk`)) join `candidacies` `c` on(`c`.`studentlist_idfk` = `sl`.`id`)) join `candidate_types` `ct` on(`ct`.`id` = `c`.`candidatetype_idfk`)) join `courses` `cr` on(`cr`.`id` = `sl`.`course_idfk`)) join `grades` `g` on(`g`.`id` = `cr`.`grade_idfk`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `candidatos_propuestas`
--
DROP TABLE IF EXISTS `candidatos_propuestas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `candidatos_propuestas`  AS  select `c`.`id` AS `id`,`c`.`photo` AS `photo`,`c`.`candidatetype_idfk` AS `candidatetype_idfk`,`c`.`studentlist_idfk` AS `studentlist_idfk`,`c`.`id_statusfk` AS `id_statusfk`,`p`.`proposal_tittle` AS `proposal_tittle`,`p`.`proposal_description` AS `proposal_description` from (`candidacies` `c` join `proposals` `p` on(`p`.`candidacy_idfk` = `c`.`id`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `numberstudent`
--
DROP TABLE IF EXISTS `numberstudent`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `numberstudent`  AS  select `c`.`id` AS `id`,`c`.`code` AS `code`,`c`.`grade_idfk` AS `grade_idfk`,`c`.`wday_idfk` AS `wday_idfk`,`c`.`eprocess_idfk` AS `eprocess_idfk`,`c`.`status_idfk` AS `status_idfk`,`w`.`wday_name` AS `wday_name`,`ep`.`id` AS `idpro`,`g`.`grade_name` AS `grade_name`,`s`.`status_name` AS `status_name`,count(`sl`.`user_idfk`) AS `numberStudents` from (((((`student_listing` `sl` join `courses` `c` on(`c`.`id` = `sl`.`course_idfk`)) join `electoral_processes` `ep` on(`ep`.`id` = `c`.`eprocess_idfk`)) join `working_day` `w` on(`w`.`id` = `c`.`wday_idfk`)) join `grades` `g` on(`g`.`id` = `c`.`grade_idfk`)) join `statuses` `s` on(`s`.`id` = `c`.`status_idfk`)) group by `c`.`code` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vw_candidate_other`
--
DROP TABLE IF EXISTS `vw_candidate_other`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_candidate_other`  AS  select `p`.`id` AS `id`,`p`.`proposal_tittle` AS `proposal_tittle`,`p`.`proposal_description` AS `proposal_description`,`p`.`candidacy_idfk` AS `id_fk`,concat(`u`.`name`,' ',`u`.`last_name`) AS `Candidato`,`ct`.`candidatetype_name` AS `tipo_candidato`,`g`.`grade_name` AS `grade_name`,`cr`.`code` AS `code`,`cd`.`photo` AS `photo` from (((((((`users` `u` join `student_listing` `sl` on(`sl`.`user_idfk` = `u`.`id`)) join `candidacies` `cd` on(`cd`.`id` = `sl`.`user_idfk`)) join `candidacies` `c` on(`c`.`studentlist_idfk` = `sl`.`id`)) join `candidate_types` `ct` on(`ct`.`id` = `c`.`candidatetype_idfk`)) join `courses` `cr` on(`cr`.`id` = `sl`.`course_idfk`)) join `grades` `g` on(`g`.`id` = `cr`.`grade_idfk`)) join `proposals` `p` on(`p`.`candidacy_idfk` = `c`.`id`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `candidacies`
--
ALTER TABLE `candidacies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `candidatetype_idfk` (`candidatetype_idfk`),
  ADD KEY `studentlist_idfk` (`studentlist_idfk`),
  ADD KEY `id_statusfk` (`id_statusfk`);

--
-- Indices de la tabla `candidate_types`
--
ALTER TABLE `candidate_types`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grade_idfk` (`grade_idfk`),
  ADD KEY `wday_idfk` (`wday_idfk`),
  ADD KEY `eprocess_idfk` (`eprocess_idfk`),
  ADD KEY `status_idfk` (`status_idfk`);

--
-- Indices de la tabla `electoral_processes`
--
ALTER TABLE `electoral_processes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_idfk` (`status_idfk`);

--
-- Indices de la tabla `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `level_idfk` (`level_idfk`);

--
-- Indices de la tabla `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proposals`
--
ALTER TABLE `proposals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `candidacy_idfk` (`candidacy_idfk`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_statusfk` (`id_statusfk`);

--
-- Indices de la tabla `scrutinies`
--
ALTER TABLE `scrutinies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `candidacy_idfk` (`candidacy_idfk`);

--
-- Indices de la tabla `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `typestatus_idfk` (`typestatus_idfk`);

--
-- Indices de la tabla `student_listing`
--
ALTER TABLE `student_listing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_idfk` (`user_idfk`),
  ADD KEY `course_idfk` (`course_idfk`);

--
-- Indices de la tabla `type_statuses`
--
ALTER TABLE `type_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_idfk` (`status_idfk`);

--
-- Indices de la tabla `usurol`
--
ALTER TABLE `usurol`
  ADD KEY `user_idfk` (`user_idfk`),
  ADD KEY `role_idfk` (`role_idfk`);

--
-- Indices de la tabla `working_day`
--
ALTER TABLE `working_day`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `candidacies`
--
ALTER TABLE `candidacies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `candidate_types`
--
ALTER TABLE `candidate_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `electoral_processes`
--
ALTER TABLE `electoral_processes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `levels`
--
ALTER TABLE `levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `proposals`
--
ALTER TABLE `proposals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `scrutinies`
--
ALTER TABLE `scrutinies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `student_listing`
--
ALTER TABLE `student_listing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `type_statuses`
--
ALTER TABLE `type_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `working_day`
--
ALTER TABLE `working_day`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `candidacies`
--
ALTER TABLE `candidacies`
  ADD CONSTRAINT `candidacies_ibfk_1` FOREIGN KEY (`candidatetype_idfk`) REFERENCES `candidate_types` (`id`),
  ADD CONSTRAINT `candidacies_ibfk_2` FOREIGN KEY (`studentlist_idfk`) REFERENCES `student_listing` (`id`),
  ADD CONSTRAINT `candidacies_ibfk_3` FOREIGN KEY (`id_statusfk`) REFERENCES `statuses` (`id`);

--
-- Filtros para la tabla `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`grade_idfk`) REFERENCES `grades` (`id`),
  ADD CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`wday_idfk`) REFERENCES `working_day` (`id`),
  ADD CONSTRAINT `courses_ibfk_3` FOREIGN KEY (`eprocess_idfk`) REFERENCES `electoral_processes` (`id`),
  ADD CONSTRAINT `courses_ibfk_4` FOREIGN KEY (`status_idfk`) REFERENCES `statuses` (`id`);

--
-- Filtros para la tabla `electoral_processes`
--
ALTER TABLE `electoral_processes`
  ADD CONSTRAINT `electoral_processes_ibfk_1` FOREIGN KEY (`status_idfk`) REFERENCES `statuses` (`id`);

--
-- Filtros para la tabla `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`level_idfk`) REFERENCES `levels` (`id`);

--
-- Filtros para la tabla `proposals`
--
ALTER TABLE `proposals`
  ADD CONSTRAINT `proposals_ibfk_1` FOREIGN KEY (`candidacy_idfk`) REFERENCES `candidacies` (`id`);

--
-- Filtros para la tabla `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_ibfk_1` FOREIGN KEY (`id_statusfk`) REFERENCES `statuses` (`id`);

--
-- Filtros para la tabla `scrutinies`
--
ALTER TABLE `scrutinies`
  ADD CONSTRAINT `scrutinies_ibfk_1` FOREIGN KEY (`candidacy_idfk`) REFERENCES `candidacies` (`id`);

--
-- Filtros para la tabla `statuses`
--
ALTER TABLE `statuses`
  ADD CONSTRAINT `statuses_ibfk_1` FOREIGN KEY (`typestatus_idfk`) REFERENCES `type_statuses` (`id`);

--
-- Filtros para la tabla `student_listing`
--
ALTER TABLE `student_listing`
  ADD CONSTRAINT `student_listing_ibfk_1` FOREIGN KEY (`user_idfk`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `student_listing_ibfk_2` FOREIGN KEY (`course_idfk`) REFERENCES `courses` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`status_idfk`) REFERENCES `statuses` (`id`);

--
-- Filtros para la tabla `usurol`
--
ALTER TABLE `usurol`
  ADD CONSTRAINT `usurol_ibfk_1` FOREIGN KEY (`user_idfk`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `usurol_ibfk_2` FOREIGN KEY (`role_idfk`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
