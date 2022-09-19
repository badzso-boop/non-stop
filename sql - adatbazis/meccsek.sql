-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2022. Sze 19. 21:50
-- Kiszolgáló verziója: 10.4.24-MariaDB
-- PHP verzió: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `non-stop`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `meccsek`
--

CREATE TABLE `meccsek` (
  `id` int(15) NOT NULL,
  `csapat_a` varchar(255) COLLATE utf8mb4_hungarian_ci DEFAULT NULL,
  `csapat_a_gol` int(15) DEFAULT NULL,
  `csapat_b` varchar(255) COLLATE utf8mb4_hungarian_ci DEFAULT NULL,
  `csapat_b_gol` int(15) DEFAULT NULL,
  `datum` date DEFAULT NULL,
  `idopont` time DEFAULT NULL,
  `eredmeny` int(15) DEFAULT NULL,
  `bunteto` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `meccsek`
--

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

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `meccsek`
--
ALTER TABLE `meccsek`
  ADD UNIQUE KEY `id` (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `meccsek`
--
ALTER TABLE `meccsek`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
