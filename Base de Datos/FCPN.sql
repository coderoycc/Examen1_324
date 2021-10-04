SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `carrera` (
  `id_carrera` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `carrera` (`id_carrera`, `descripcion`) VALUES
(1, 'Informática'),
(2, 'Química'),
(3, 'Física'),
(4, 'Matemática');

CREATE TABLE `dicta` (
  `sigla` varchar(6) NOT NULL,
  `ci` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `dicta` (`sigla`, `ci`) VALUES
('LAB113', 919281),
('LAB111', 919281),
('MAT121', 987264),
('MAT131', 987264),
('MAT212', 990260),
('LIN116', 990260),
('INF111', 919281),
('MAT112', 987264);

CREATE TABLE `inscrito` (
  `sigla` varchar(6) NOT NULL,
  `ci` int(10) NOT NULL,
  `nota1` int(11) DEFAULT NULL,
  `nota2` int(11) DEFAULT NULL,
  `nota3` int(11) DEFAULT NULL,
  `notafinal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `inscrito` (`sigla`, `ci`, `nota1`, `nota2`, `nota3`, `notafinal`) VALUES
('LIN116', 1012219, 77, 85, 49, 70),
('MAT121', 1012219, 40, 57, 88, 62),
('LAB113', 1012219, 62, 43, 90, 65),
('LIN116', 1012515, 30, 30, 75, 45),
('MAT121', 1012515, 51, 66, 62, 60),
('LAB113', 1012515, 60, 85, 90, 78),
('LIN116', 1018899, 65, 75, 88, 76),
('MAT121', 1018899, 70, 88, 43, 67),
('LAB113', 1018899, 66, 91, 54, 70),
('LIN116', 1102203, 66, 100, 66, 77),
('MAT121', 1102203, 75, 51, 55, 60),
('LAB113', 1102203, 91, 49, 62, 67),
('LIN116', 1112233, 91, 30, 100, 74),
('MAT121', 1112233, 90, 30, 90, 70),
('LAB113', 1112233, 77, 55, 90, 74),
('LAB111', 1098765, 30, 77, 81, 63),
('INF111', 1098765, 70, 91, 58, 73),
('MAT212', 1098765, 30, 71, 88, 63),
('LAB111', 1131311, 83, 100, 30, 71),
('INF111', 1131311, 75, 65, 91, 77),
('MAT212', 1131311, 80, 40, 57, 59),
('LAB111', 1192219, 81, 62, 50, 64),
('INF111', 1192219, 30, 55, 80, 55),
('MAT212', 1192219, 66, 85, 65, 72),
('LAB111', 1198721, 54, 60, 65, 60),
('INF111', 1198721, 88, 30, 43, 54),
('MAT212', 1198721, 71, 62, 58, 64),
('LAB111', 1234567, 66, 77, 30, 58),
('INF111', 1234567, 70, 51, 88, 70),
('MAT212', 1234567, 91, 54, 60, 68),
('MAT131', 1241212, 62, 67, 62, 64),
('INF111', 1241212, 48, 48, 45, 47),
('MAT112', 1241212, 60, 29, 67, 52),
('MAT131', 1312210, 58, 40, 50, 49),
('INF111', 1312210, 30, 51, 31, 37),
('MAT112', 1312210, 48, 50, 30, 43),
('MAT131', 1321219, 71, 50, 25, 49),
('INF111', 1321219, 25, 65, 65, 52),
('MAT112', 1321219, 30, 58, 55, 48),
('MAT131', 1331982, 67, 30, 65, 54),
('INF111', 1331982, 58, 51, 51, 53),
('MAT112', 1331982, 10, 62, 45, 39),
('MAT131', 1412211, 71, 70, 43, 61),
('INF111', 1412211, 75, 44, 49, 56),
('MAT112', 1412211, 25, 40, 50, 38),
('MAT131', 1412319, 10, 45, 44, 33),
('INF111', 1412319, 60, 30, 63, 51),
('MAT112', 1412319, 65, 31, 30, 42);


CREATE TABLE `materia` (
  `sigla` varchar(6) NOT NULL,
  `descripcion_m` varchar(60) NOT NULL,
  `id_carrera` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `materia` (`sigla`, `descripcion_m`, `id_carrera`) VALUES
('INF111', 'Introducción a la informática', 1),
('LAB111', 'Laboratorio de INF111', 1),
('LAB113', 'Laboratorio de computación', 1),
('LIN116', 'Lengua I', 1),
('MAT111', 'Matemática discreta', 3),
('MAT112', 'Matemática lógica', 1),
('MAT114', 'Algebra I', 1),
('MAT115', 'Calculo 1', 1),
('MAT121', 'Álgebra Lineal', 3),
('MAT131', 'Teoría de Números', 3),
('MAT212', 'Cálculo II', 3);


CREATE TABLE `usuario` (
  `ci` int(10) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `fecha_nac` varchar(15) NOT NULL,
  `departamento` varchar(2) NOT NULL,
  `tipo` char(1) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `password_u` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `usuario` (`ci`, `nombre`, `fecha_nac`, `departamento`, `tipo`, `usuario`, `password_u`) VALUES
(919281, 'Fernanda Rodriguez Mamani', '21-09-1968', '05', 'D', 'fero91', '123456'),
(966666, 'Zoyla Vaca Parada', '12-12-2000', '05', 'D', 'vacap99', '123456'),
(987264, 'Ramiro Gallardo', '12-02-1970', '02', 'D', 'raga98', '123456'),
(989898, 'Requena Quispe Quispe', '12-12-1990', '03', 'D', 'requena98', '123456'),
(990260, 'Carlos Choque Paz', '02-06-1972', '04', 'D', 'cach99', '123456'),
(1012219, 'Rocio Espejo Apaza', '23-10-1998', '02', 'E', 'roes10', '09876'),
(1012515, 'Recio Solerman Canaviri', '12-12-1993', '03', 'E', 'reso10', '09876'),
(1018899, 'Manuel Quispe Tantani', '03-10-1991', '02', 'E', 'maqu10', '09876'),
(1098765, 'Gabriel Marca Paxi', '30-10-1997', '02', 'E', 'gama10', '09876'),
(1102203, 'Estefany Gutierrez Cama', '11-11-1998', '03', 'E', 'esgu11', '09876'),
(1112233, 'Fabricio Gamboa Torrico', '23-10-1998', '02', 'E', 'faga11', '09876'),
(1131311, 'Yuliza Galileo Roma', '30-10-1994', '02', 'E', 'yuga11', '09876'),
(1192219, 'Evelyn Quispe Huaycho', '29-11-1997', '04', 'E', 'evqu11', '09876'),
(1198721, 'Camila Cosio Llanque', '10-01-1997', '03', 'E', 'caco11', '09876'),
(1234567, 'Fabiola Ramirez Choque', '03-11-1999', '04', 'E', 'fara12', '09876'),
(1241212, 'Daniela Mamani Apaza', '11-01-1998', '03', 'E', 'dama12', '09876'),
(1312210, 'Ruth Gabriela Pancata Daza', '23-03-1998', '02', 'E', 'ruga13', '09876'),
(1321219, 'Gerardo Ramirez Pardo', '20-10-1999', '04', 'E', 'gera13', '09876'),
(1331982, 'Roberto Carlos Chambi Calizaya', '27-06-1998', '02', 'E', 'roca13', '09876'),
(1412211, 'Pedro Marcelo Gonzalez', '23-10-1999', '04', 'E', 'pema14', '09876'),
(1412319, 'Shirley Calle Osco', '23-06-1998', '03', 'E', 'shca14', '09876'),
(9999999, 'Elsa Badillo', '12-12-1998', '03', 'D', 'elbadi', '123456');

ALTER TABLE `carrera`
  ADD PRIMARY KEY (`id_carrera`),
  ADD UNIQUE KEY `id_carrera` (`id_carrera`);

ALTER TABLE `dicta`
  ADD KEY `sigla` (`sigla`),
  ADD KEY `ci` (`ci`);

ALTER TABLE `inscrito`
  ADD KEY `sigla` (`sigla`),
  ADD KEY `ci` (`ci`);

ALTER TABLE `materia`
  ADD PRIMARY KEY (`sigla`),
  ADD KEY `id_carrera` (`id_carrera`);

ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ci`);

ALTER TABLE `carrera`
  MODIFY `id_carrera` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `dicta`
  ADD CONSTRAINT `dicta_ibfk_1` FOREIGN KEY (`sigla`) REFERENCES `materia` (`sigla`),
  ADD CONSTRAINT `dicta_ibfk_2` FOREIGN KEY (`ci`) REFERENCES `usuario` (`ci`);

ALTER TABLE `inscrito`
  ADD CONSTRAINT `inscrito_ibfk_1` FOREIGN KEY (`sigla`) REFERENCES `materia` (`sigla`),
  ADD CONSTRAINT `inscrito_ibfk_2` FOREIGN KEY (`ci`) REFERENCES `usuario` (`ci`);
COMMIT;