-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Št 21.Mar 2024, 12:20
-- Verzia serveru: 10.4.24-MariaDB
-- Verzia PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `dbloginbartko`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `t_user`
--

CREATE TABLE `t_user` (
  `ID` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(80) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `t_user`
--

INSERT INTO `t_user` (`ID`, `username`, `password`, `email`) VALUES
(1, 'Anick5a', '$2y$10$XxfPUbHU0dVSWhB8jL0I4.YKlaudSvM.ONFwjP', '59anica@gmail.com'),
(2, 'Jedna dva', '$2y$10$CIujecXzaktaUj0jP8dw1un2pxvIiphHowjFph', 'jednadva@gmail.com'),
(3, 'heslo123', '$2y$10$0eSaJiU8Nvxshq1MiwCyn.PgrUAE/J1GtuJdvr', 'heslo@gmail.com'),
(4, 'anickaaaa', '$2y$10$E4uU0Zatr/pKMphXdQJ7IubUQ1/hIq6xRQ1/61', 'anickaa@gmail.com'),
(5, 'HESLO1234', '$2y$10$7IM6h43v0jTta4SM504VI.HoMmsgnxsakG.mXg', 'dawiodioaw@gmail.com'),
(6, 'heslo12345', '$2y$10$qU6KV3HZt.cdKzd9ZtmFCeYjvGgPWjzQKqcGifkKaru.jbK2fZqvu', 'heshoih@gmail.com'),
(7, 'heslo12345', '$2y$10$ouksXgCGwAe2inOTe8HTDeUF3Y.NkdZ1vDVxS0kyIQ5TWaaEXmWqC', 'heshoih@gmail.com'),
(8, 'fjioesjfio', '$2y$10$Zv8CsmIAG4AoeImx/62UJOwAajsDf49uB2/ve.6Ogg5ah3DXXezgm', 'feajoifjaieo@gmail.com');

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `t_user`
--
ALTER TABLE `t_user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
