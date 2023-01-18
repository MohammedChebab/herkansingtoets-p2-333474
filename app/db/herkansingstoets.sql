-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 18 jan 2023 om 11:28
-- Serverversie: 5.7.31
-- PHP-versie: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `herkansingstoets`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Auto`
--

DROP TABLE IF EXISTS `Auto`;
CREATE TABLE IF NOT EXISTS `Auto` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Kenteken` varchar(50) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `Bouwjaar` date NOT NULL,
  `Brandstof` varchar(50) NOT NULL,
  `InstructeurId` int(11) DEFAULT NULL,
  `DatumToekenning` date DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `m` (`InstructeurId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `Auto`
--

INSERT INTO `Auto` (`Id`, `Kenteken`, `Type`, `Bouwjaar`, `Brandstof`, `InstructeurId`, `DatumToekenning`) VALUES
(1, 'AU-67-IO', 'Golf', '2017-06-12', 'Diesel', 5, '2017-06-18'),
(2, 'TH-78-KL', 'Mercedes', '2023-01-01', 'Benzine', NULL, NULL),
(3, '90-KL-TR', 'Fiat 500', '2021-09-12', 'Benzine', 1, '2021-09-26'),
(4, 'YY-OP-78', 'BMW M5', '2022-05-13', 'Diesel', NULL, NULL),
(5, 'ST-FZ-28', 'Citroen', '2018-01-20', 'Electrisch', NULL, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Instructeur`
--

DROP TABLE IF EXISTS `Instructeur`;
CREATE TABLE IF NOT EXISTS `Instructeur` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Voornaam` varchar(50) NOT NULL,
  `Tussenvoegsel` varchar(50) NOT NULL,
  `Achternaam` varchar(50) NOT NULL,
  `Mobiel` int(11) NOT NULL,
  `Datum_in_dienst` date NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `Instructeur`
--

INSERT INTO `Instructeur` (`Id`, `Voornaam`, `Tussenvoegsel`, `Achternaam`, `Mobiel`, `Datum_in_dienst`) VALUES
(1, 'Li', '', 'Zhan', 628493827, '2015-04-17'),
(2, 'Leroy', '', 'Boerhaven', 639398734, '2018-06-25'),
(3, 'Yoeri', 'Van', 'Veen', 624383291, '2010-05-12'),
(4, 'Bert', 'Van', 'Sali', 648293823, '2023-01-10'),
(5, 'Mohammed', 'El', 'Yassidi', 634291234, '2010-06-14'),
(6, 'h', 'h', 'ew', 622222222, '2018-04-23'),
(7, 'a', 'a', 'a', 612345678, '2018-04-23');

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `Auto`
--
ALTER TABLE `Auto`
  ADD CONSTRAINT `m` FOREIGN KEY (`InstructeurId`) REFERENCES `Instructeur` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
