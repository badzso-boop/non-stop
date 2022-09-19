-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2022. Sze 19. 21:49
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
-- Tábla szerkezet ehhez a táblához `csapatok`
--

CREATE TABLE `csapatok` (
  `id` int(255) NOT NULL,
  `csapat_nev` char(255) COLLATE utf8mb4_hungarian_ci DEFAULT NULL,
  `csapat_tagok` varchar(512) COLLATE utf8mb4_hungarian_ci DEFAULT NULL,
  `pontszam` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `csapatok`
--

INSERT INTO `csapatok` (`id`, `csapat_nev`, `csapat_tagok`, `pontszam`) VALUES
(4, '9/D', 'tanulo1 - 9/D;', 0),
(5, '10/A', 'tanulo1 - 10/A;', 0),
(6, '10/E', 'tanulo1 - 10/E;', 0),
(7, '10/C', 'tanulo1 - 10/C;', 3),
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

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `csapatok`
--
ALTER TABLE `csapatok`
  ADD UNIQUE KEY `id` (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `csapatok`
--
ALTER TABLE `csapatok`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
