CREATE DATABASE 'non-stop';

CREATE TABLE csapatok (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    csapat_nev VARCHAR(255) NOT NULL COLLATE utf8mb4_hungarian_ci,
    csapat_tagok VARCHAR(212) COLLATE utf8mb4_hungarian_ci NOT NULL,
    pontszam INT,
    csoport VARCHAR(255) DEFAULT NULL
);

INSERT INTO `csapatok` (`id`, `csapat_nev`, `csapat_tagok`, `pontszam`) VALUES
(4, '9/D', 'tanulo1 - 9/D;', 0),
(5, '10/A', 'tanulo1 - 10/A;', 0),
(6, '10/E', 'tanulo1 - 10/E;', 0),
(7, '10/C', 'tanulo1 - 10/C;', 0),
(8, '9/E', 'tanulo1 - 9/E;', 0),
(9, '10/B', 'tanulo1 - 10/B;', 0),
(10, '11/B', 'tanulo1 - 11/B;', 0),
(11, '12/D', 'tanulo1 - 12/D;', 0),
(12, '13/C', 'tanulo1 - 13/C;', 0),
(13, '11/E', 'tanulo1 - 11/E;', 0),
(14, '13/D', 'tanulo1 - 13/D;', 0),
(15, '11/D', 'tanulo1 - 11/D;', 0),
(16, '12/E', 'tanulo1 - 12/E;', 0),
(17, '13/E', 'tanulo1 - 13/E;', 0),
(19, '10/D', 'tanulo1 - 10/D;', 0),
(20, '9/C', 'tanulo1 - 9/C;', 0),
(21, '12/C', 'tanulo1 - 12/C;', 0);

CREATE TABLE felhasznalok (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    uname VARCHAR(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
    pwd VARCHAR(512) COLLATE utf8mb4_hungarian_ci NOT NULL
);

INSERT INTO `felhasznalok` (`id`, `uname`, `pwd`) VALUES
(1, 'admin', 'admin');

CREATE TABLE meccsek (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    csapat_a VARCHAR(255)  COLLATE utf8mb4_hungarian_ci,
    csapat_a_gol INT,
    csapat_b VARCHAR(255) COLLATE utf8mb4_hungarian_ci,
    csapat_b_gol INT,
    datum DATE,
    idopont TIME,
    eredmeny INT,
    bunteto INT,
    bunteto_a_gol INT DEFAULT 0,
    bunteto_b_gol INT DEFAULT 0
);

INSERT INTO `meccsek` (`id`, `csapat_a`, `csapat_a_gol`, `csapat_b`, `csapat_b_gol`, `datum`, `idopont`, `eredmeny`, `bunteto`) VALUES
(10, '9/D', 0, '10/A', 0, '2022-09-19', '14:30:00', -1, 0),
(11, '10/E', 0, '10/C', 0, '2022-09-19', '15:00:00', -1, 0),
(12, '9/E', 0, '10/B', 0, '2022-09-19', '15:30:00', -1, 0),
(13, '11/B', 0, '12/D', 0, '2022-09-20', '14:30:00', -1, 0),
(14, '12/D', 0, '13/C', 0, '2022-09-20', '15:00:00', -1, 0),
(15, '11/B', 0, '13/C', 0, '2022-09-20', '15:30:00', -1, 0),
(16, '11/E', 0, '12/C', 0, '2022-09-21', '14:30:00', -1, 0),
(17, '12/C', 0, '13/D', 0, '2022-09-21', '15:00:00', -1, 0),
(18, '11/E', 0, '13/D', 0, '2022-09-21', '15:30:00', -1, 0),
(19, '11/D', 0, '12/E', 0, '2022-09-22', '14:30:00', -1, 0),
(20, '12/E', 0, '13/E', 0, '2022-09-22', '15:00:00', -1, 0),
(21, '11/D', 0, '13/E', 0, '2022-09-22', '15:30:00', -1, 0),
(22, '10/A', 0, '10/D', 0, '2022-09-26', '14:30:00', -1, 0),
(23, '9/D', 0, '9/C', 0, '2022-09-26', '15:00:00', -1, 0),
(24, '9/D', 0, '10/D', 0, '2022-09-26', '15:30:00', -1, 0),
(25, '10/E', 0, '9/E', 0, '2022-09-27', '14:30:00', -1, 0),
(26, '10/C', 0, '10/B', 0, '2022-09-27', '15:00:00', -1, 0),
(27, '10/C', 0, '9/E', 0, '2022-09-27', '15:30:00', -1, 0),
(28, '9/C', 0, '10/D', 0, '2022-09-28', '14:30:00', -1, 0),
(29, '10/E', 0, '10/B', 0, '2022-09-28', '15:00:00', -1, 0),
(30, '9/C', 0, '10/A', 0, '2022-09-28', '15:30:00', -1, 0);

CREATE TABLE csoportok (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    csoport_nev VARCHAR(255),
    csapatok VARCHAR(255)
);