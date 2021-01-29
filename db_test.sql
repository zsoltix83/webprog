-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2020. Jan 22. 23:47
-- Kiszolgáló verziója: 10.1.36-MariaDB
-- PHP verzió: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `db_test`
--

DELIMITER $$
--
-- Eljárások
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `Log` (IN `what` VARCHAR(255), IN `tab` VARCHAR(255), IN `user` INT)  NO SQL
INSERT INTO log(date,what,tables,user) values (SYSDATE(),what,tab,user)$$

--
-- Függvények
--
CREATE DEFINER=`root`@`localhost` FUNCTION `vehicleID` (`id` VARCHAR(7)) RETURNS TINYINT(1) NO SQL
IF COUNT(id) <> 7 THEN
	return false;
ELSE
    RETURN true;
end IF$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cars`
--

CREATE TABLE `cars` (
  `idCars` varchar(9) COLLATE utf8_hungarian_ci NOT NULL,
  `brand` varchar(150) COLLATE utf8_hungarian_ci NOT NULL,
  `color` varchar(45) COLLATE utf8_hungarian_ci NOT NULL,
  `owner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `cars`
--

INSERT INTO `cars` (`idCars`, `brand`, `color`, `owner`) VALUES
('BBB-333', 'Suzuki', 'Piros', 3);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `houses`
--

CREATE TABLE `houses` (
  `idHouse` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `owner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `houses`
--

INSERT INTO `houses` (`idHouse`, `size`, `owner`) VALUES
(3, 1200, 3);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `irldatas`
--

CREATE TABLE `irldatas` (
  `idIRLDatas` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `age` int(11) NOT NULL,
  `address` text COLLATE utf8_hungarian_ci NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `irldatas`
--

INSERT INTO `irldatas` (`idIRLDatas`, `name`, `age`, `address`, `userID`) VALUES
(1, 'Kiss Béla', 52, 'Miskolc', 3);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `log`
--

CREATE TABLE `log` (
  `logID` int(11) NOT NULL,
  `date` date NOT NULL,
  `what` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `tables` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `log`
--

INSERT INTO `log` (`logID`, `date`, `what`, `tables`, `user`) VALUES
(4, '2019-01-22', 'INSERT', 'users', 3),
(5, '2019-01-22', 'INSERT', 'motorcycles', 3);

--
-- Eseményindítók `log`
--
DELIMITER $$
CREATE TRIGGER `DeleteLog` AFTER DELETE ON `log` FOR EACH ROW INSERT INTO Log(what,tables,user) VALUES('DELETE','log',0)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `motorcycles`
--

CREATE TABLE `motorcycles` (
  `idMotorC` varchar(9) COLLATE utf8_hungarian_ci NOT NULL,
  `color` varchar(45) COLLATE utf8_hungarian_ci NOT NULL,
  `type` varchar(45) COLLATE utf8_hungarian_ci NOT NULL,
  `brand` varchar(45) COLLATE utf8_hungarian_ci NOT NULL,
  `owner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `motorcycles`
--

INSERT INTO `motorcycles` (`idMotorC`, `color`, `type`, `brand`, `owner`) VALUES
('AAA-111', 'Fekete', 'naked', 'Suzuki', 3),
('AAA-333', 'Fekete', 'cross', 'Suzuki', 3),
('BBB-111', 'Fekete', 'nake', 'Honda', 3),
('CCC-222', 'Piros', 'naked', 'Kawasaki', 3);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `userName` varchar(25) COLLATE utf8_hungarian_ci NOT NULL,
  `userPsswd` varchar(50) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`userID`, `userName`, `userPsswd`) VALUES
(3, 'Alma', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(5, 'Barack', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(6, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997'),
(12, 'Feri', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`idCars`),
  ADD KEY `Cars-Users` (`owner`);

--
-- A tábla indexei `houses`
--
ALTER TABLE `houses`
  ADD PRIMARY KEY (`idHouse`),
  ADD KEY `houses-users` (`owner`);

--
-- A tábla indexei `irldatas`
--
ALTER TABLE `irldatas`
  ADD PRIMARY KEY (`idIRLDatas`),
  ADD UNIQUE KEY `userID` (`userID`);

--
-- A tábla indexei `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`logID`);

--
-- A tábla indexei `motorcycles`
--
ALTER TABLE `motorcycles`
  ADD PRIMARY KEY (`idMotorC`),
  ADD KEY `Motorcycles-Users` (`owner`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userName` (`userName`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `houses`
--
ALTER TABLE `houses`
  MODIFY `idHouse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `irldatas`
--
ALTER TABLE `irldatas`
  MODIFY `idIRLDatas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `log`
--
ALTER TABLE `log`
  MODIFY `logID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `Cars-Users` FOREIGN KEY (`owner`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `houses`
--
ALTER TABLE `houses`
  ADD CONSTRAINT `houses-users` FOREIGN KEY (`owner`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `irldatas`
--
ALTER TABLE `irldatas`
  ADD CONSTRAINT `IRLDatas-Users` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `motorcycles`
--
ALTER TABLE `motorcycles`
  ADD CONSTRAINT `Motorcycles-Users` FOREIGN KEY (`owner`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
