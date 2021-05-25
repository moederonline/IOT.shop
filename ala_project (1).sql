-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 20 apr 2021 om 12:06
-- Serverversie: 10.4.8-MariaDB
-- PHP-versie: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ala project`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `beheerder`
--

CREATE TABLE `beheerder` (
  `beheerderId` int(255) NOT NULL,
  `naamBeheerder` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestelgegevens`
--

CREATE TABLE `bestelgegevens` (
  `OrderDetailId` int(255) NOT NULL,
  `productId` int(255) NOT NULL,
  `productNaam` varchar(255) NOT NULL,
  `hoeveelheid` int(255) NOT NULL,
  `verzendKosten` int(100) NOT NULL,
  `totaalPrijs` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestellingen`
--

CREATE TABLE `bestellingen` (
  `OrderId` int(255) NOT NULL,
  `datumcreate` datetime NOT NULL,
  `datumverzend` datetime NOT NULL,
  `klantNaam` varchar(255) NOT NULL,
  `klantId` int(9) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruikers`
--

CREATE TABLE `gebruikers` (
  `id` int(255) NOT NULL,
  `customerid` int(9) NOT NULL,
  `password` varchar(12) NOT NULL,
  `LoginStatus` varchar(10) NOT NULL,
  `registratieDatum` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klanten`
--

CREATE TABLE `klanten` (
  `klantid` int(9) NOT NULL,
  `klantNaam` varchar(55) NOT NULL,
  `straatNaam` varchar(255) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `stad` varchar(255) NOT NULL,
  `land` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `betaalInfo` varchar(255) NOT NULL,
  `verzendId` int(13) NOT NULL,
  `verzendType` varchar(30) NOT NULL,
  `verzendKosten` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product`
--

CREATE TABLE `product` (
  `productId` int(255) NOT NULL,
  `productNaam` varchar(255) NOT NULL,
  `productPrijs` int(255) NOT NULL,
  `hoeveelheid` int(255) NOT NULL,
  `OrderId` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `winkelwagen`
--

CREATE TABLE `winkelwagen` (
  `winkelmandId` int(255) NOT NULL,
  `productId` int(255) NOT NULL,
  `hoeveelheid` int(255) NOT NULL,
  `datum` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
