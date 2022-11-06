-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Nov 06, 2022 alle 15:51
-- Versione del server: 8.0.30
-- Versione PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `palestra`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `attivita`
--

CREATE TABLE `attivita` (
  `id_attivita` int NOT NULL,
  `nome_attivita` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `attivita`
--

INSERT INTO `attivita` (`id_attivita`, `nome_attivita`) VALUES
(1, 'sauna');

-- --------------------------------------------------------

--
-- Struttura della tabella `domotica`
--

CREATE TABLE `domotica` (
  `iddom` int NOT NULL,
  `luci` int DEFAULT NULL,
  `temperatura` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `domotica`
--

INSERT INTO `domotica` (`iddom`, `luci`, `temperatura`) VALUES
(1, 1, 50);

-- --------------------------------------------------------

--
-- Struttura della tabella `login`
--

CREATE TABLE `login` (
  `login_id` int NOT NULL,
  `email` varchar(319) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ruolo` enum('cliente','amministrazione') NOT NULL,
  `stato` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `login`
--

INSERT INTO `login` (`login_id`, `email`, `password`, `ruolo`, `stato`) VALUES
(1, 'danilocaruso87@gmail.com', '$2y$10$6lVGpu1rxKQnGzqjBL7hOuvLGysulf4t0TT4I5.K9Xdg7m3LUEra2', 'amministrazione', 1),
(2, 'menniti@gmail.com', '$2y$10$aQ.1Vc8e1INWtmAqHnPzYOq2Swa6CiBAiUCBALPcH6JgQ3/pAbACu', 'cliente', 1),
(3, 'admin@admin.com', '$2y$10$GZdH.QbYpUVCgYKrQyWbiupCpZ1zMABr4ayguPsETFE.ACnIXXidW', 'amministrazione', 1),
(4, '12dsf132412@asd.com', '$2y$10$z58/L7u0W5ASIMpIYpQZbeij7D400kF34yc8KHpgp4FXAf1ikvycW', 'cliente', 1),
(5, '12313123@1', '$2y$10$JQqtgkOc/pBbUtxJqmGILeJ6lTZxpaiRWSieIsOWvK1okXYX87LTG', 'cliente', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `prenotazioni`
--

CREATE TABLE `prenotazioni` (
  `id_prenotazione` int NOT NULL,
  `data_effettuazione` date NOT NULL,
  `str_data` int NOT NULL,
  `data_appuntamento` date NOT NULL,
  `fascia_oraria` enum('08-09','09-10','10-11','11-12','12-13','15-16','16-17','17-18') NOT NULL,
  `id_utente_prenotazione` int NOT NULL,
  `tipo_attivita` int NOT NULL,
  `stato_prenotazione` enum('intatta','modificata','cancellata') NOT NULL,
  `presenza` enum('False','True') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `prenotazioni`
--

INSERT INTO `prenotazioni` (`id_prenotazione`, `data_effettuazione`, `str_data`, `data_appuntamento`, `fascia_oraria`, `id_utente_prenotazione`, `tipo_attivita`, `stato_prenotazione`, `presenza`) VALUES
(1, '2022-11-10', 1665439200, '2022-10-11', '08-09', 3, 1, 'intatta', ''),
(2, '2022-10-19', 1666130400, '2022-10-19', '09-10', 3, 1, 'intatta', ''),
(3, '2022-11-03', 1667430000, '2022-11-03', '09-10', 4, 1, 'modificata', 'False'),
(4, '2022-11-03', 1667430000, '2022-11-03', '08-09', 4, 1, 'intatta', 'False'),
(5, '2022-11-06', 1667257200, '2022-11-01', '08-09', 3, 1, 'intatta', 'False'),
(6, '2022-11-06', 1667257200, '2022-11-01', '09-10', 3, 1, 'intatta', 'False'),
(7, '2022-11-06', 1667257200, '2022-11-01', '10-11', 3, 1, 'intatta', 'False'),
(8, '2022-11-06', 1667257200, '2022-11-01', '11-12', 3, 1, 'intatta', 'False'),
(9, '2022-11-06', 1667257200, '2022-11-01', '12-13', 3, 1, 'intatta', 'False'),
(10, '2022-11-06', 1667257200, '2022-11-01', '15-16', 3, 1, 'intatta', 'False'),
(11, '2022-11-06', 1667257200, '2022-11-01', '16-17', 3, 1, 'intatta', 'False'),
(12, '2022-11-06', 1667343600, '2022-11-02', '08-09', 3, 1, 'intatta', 'False'),
(13, '2022-11-06', 1669762800, '2022-11-30', '08-09', 3, 1, 'intatta', 'False'),
(14, '2022-11-06', 1669762800, '2022-11-30', '09-10', 3, 1, 'intatta', 'False'),
(15, '2022-11-06', 1669762800, '2022-11-30', '10-11', 4, 1, 'intatta', 'False'),
(16, '2022-11-06', 1669762800, '2022-11-30', '11-12', 5, 1, 'intatta', 'False'),
(17, '2022-11-06', 1667516400, '2022-11-04', '16-17', 3, 1, 'intatta', 'False'),
(18, '2022-11-06', 1667516400, '2022-11-04', '12-13', 3, 1, 'intatta', 'False'),
(19, '2022-11-06', 1667516400, '2022-11-04', '11-12', 3, 1, 'intatta', 'False'),
(20, '2022-11-06', 1667516400, '2022-11-04', '15-16', 3, 1, 'intatta', 'False'),
(21, '2022-11-06', 1669244400, '2022-11-24', '08-09', 3, 1, 'intatta', 'False'),
(22, '2022-11-06', 1669244400, '2022-11-24', '09-10', 3, 1, 'intatta', 'False'),
(23, '2022-11-06', 1667689200, '2022-11-06', '08-09', 3, 1, 'intatta', 'False'),
(24, '2022-11-06', 1667689200, '2022-11-06', '09-10', 3, 1, 'intatta', 'False'),
(25, '2022-11-06', 1667689200, '2022-11-06', '10-11', 4, 1, 'intatta', 'False'),
(26, '2022-11-06', 1669590000, '2022-11-28', '11-12', 3, 1, 'intatta', 'False'),
(27, '2022-11-06', 1668898800, '2022-11-20', '08-09', 3, 1, 'intatta', 'False'),
(28, '2022-11-06', 1669417200, '2022-11-26', '08-09', 3, 1, 'intatta', 'False'),
(29, '2022-11-06', 1668812400, '2022-11-19', '08-09', 3, 1, 'intatta', 'False'),
(30, '2022-11-06', 1668034800, '2022-11-10', '08-09', 3, 1, 'intatta', 'False'),
(31, '2022-11-06', 1669503600, '2022-11-27', '08-09', 3, 1, 'intatta', 'False'),
(32, '2022-11-06', 1669158000, '2022-11-23', '08-09', 3, 1, 'intatta', 'False'),
(33, '2022-11-06', 1668380400, '2022-11-14', '08-09', 3, 1, 'intatta', 'False'),
(34, '2022-11-06', 1667775600, '2022-11-07', '08-09', 3, 1, 'intatta', 'False'),
(35, '2022-11-06', 1669330800, '2022-11-25', '08-09', 3, 1, 'intatta', 'False'),
(36, '2022-11-06', 1668985200, '2022-11-21', '08-09', 3, 1, 'intatta', 'False'),
(37, '2022-11-06', 1668207600, '2022-11-12', '08-09', 3, 1, 'intatta', 'False'),
(38, '2022-11-06', 1668553200, '2022-11-16', '08-09', 3, 1, 'intatta', 'False'),
(39, '2022-11-06', 1668294000, '2022-11-13', '08-09', 3, 1, 'intatta', 'False'),
(40, '2022-11-06', 1668294000, '2022-11-13', '09-10', 3, 1, 'intatta', 'False'),
(41, '2022-11-06', 1669071600, '2022-11-22', '08-09', 3, 1, 'intatta', 'False'),
(42, '2022-11-06', 1668466800, '2022-11-15', '08-09', 3, 1, 'intatta', 'False'),
(43, '2022-11-06', 1668121200, '2022-11-11', '08-09', 3, 1, 'intatta', 'False'),
(44, '2022-11-06', 1667948400, '2022-11-09', '08-09', 3, 1, 'intatta', 'False'),
(45, '2022-11-06', 1667602800, '2022-11-05', '08-09', 3, 1, 'intatta', 'False'),
(46, '2022-11-06', 1669676400, '2022-11-29', '08-09', 3, 1, 'intatta', 'False'),
(47, '2022-11-06', 1667862000, '2022-11-08', '08-09', 3, 1, 'intatta', 'False'),
(48, '2022-11-06', 1667862000, '2022-11-08', '09-10', 3, 1, 'intatta', 'False'),
(49, '2022-11-06', 1668639600, '2022-11-17', '08-09', 3, 1, 'intatta', 'False'),
(50, '2022-11-06', 1668726000, '2022-11-18', '08-09', 3, 1, 'intatta', 'False'),
(51, '2022-11-06', 1668812400, '2022-11-19', '09-10', 3, 1, 'intatta', 'False'),
(52, '2022-11-06', 1668294000, '2022-11-13', '10-11', 3, 1, 'intatta', 'False'),
(53, '2022-11-06', 1669071600, '2022-11-22', '09-10', 3, 1, 'intatta', 'False'),
(54, '2022-11-06', 1668985200, '2022-11-21', '09-10', 3, 1, 'intatta', 'False'),
(55, '2022-11-06', 1668985200, '2022-11-21', '10-11', 3, 1, 'intatta', 'False'),
(56, '2022-11-06', 1669417200, '2022-11-26', '09-10', 3, 1, 'intatta', 'False'),
(57, '2022-11-06', 1667689200, '2022-11-06', '11-12', 3, 1, 'intatta', 'False'),
(58, '2022-11-06', 1667689200, '2022-11-06', '12-13', 3, 1, 'intatta', 'False'),
(59, '2022-11-06', 1667689200, '2022-11-06', '15-16', 3, 1, 'intatta', 'False'),
(60, '2022-11-06', 1668898800, '2022-11-20', '09-10', 3, 1, 'intatta', 'False'),
(61, '2022-11-06', 1668553200, '2022-11-16', '09-10', 3, 1, 'intatta', 'False');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `id_utente` int NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `login_id` int NOT NULL,
  `numero_telefono` varchar(255) NOT NULL,
  `data_nascita` date NOT NULL,
  `CF` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id_utente`, `nome`, `cognome`, `login_id`, `numero_telefono`, `data_nascita`, `CF`) VALUES
(3, 'danilo', 'caruso', 1, '3924042830', '2001-11-14', 'ccccgggggdddd444'),
(4, 'vincenzo', 'menniti', 2, '1234567', '2002-11-11', 'ccccgggggdddd444'),
(5, 'Nadmin', 'Cadmin', 3, '3298461894', '2002-11-11', 'ccccgggggdddd333'),
(6, 'nome', 'cognome', 4, '31241412', '2022-11-06', 'codice fiscale');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `attivita`
--
ALTER TABLE `attivita`
  ADD PRIMARY KEY (`id_attivita`);

--
-- Indici per le tabelle `domotica`
--
ALTER TABLE `domotica`
  ADD PRIMARY KEY (`iddom`),
  ADD UNIQUE KEY `iddom_UNIQUE` (`iddom`);

--
-- Indici per le tabelle `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`),
  ADD UNIQUE KEY `login id_UNIQUE` (`login_id`);

--
-- Indici per le tabelle `prenotazioni`
--
ALTER TABLE `prenotazioni`
  ADD PRIMARY KEY (`id_prenotazione`),
  ADD UNIQUE KEY `id_prenotazione_UNIQUE` (`id_prenotazione`),
  ADD KEY `FK_prenotazioni_utenti_idx` (`id_utente_prenotazione`),
  ADD KEY `FK_prenotazioni_attivita_idx` (`tipo_attivita`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`id_utente`),
  ADD UNIQUE KEY `login_ID_UNIQUE` (`id_utente`),
  ADD KEY `FK_utenti_login_idx` (`login_id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `attivita`
--
ALTER TABLE `attivita`
  MODIFY `id_attivita` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `prenotazioni`
--
ALTER TABLE `prenotazioni`
  MODIFY `id_prenotazione` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id_utente` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `prenotazioni`
--
ALTER TABLE `prenotazioni`
  ADD CONSTRAINT `FK_prenotazioni_attivita` FOREIGN KEY (`tipo_attivita`) REFERENCES `attivita` (`id_attivita`),
  ADD CONSTRAINT `FK_prenotazioni_utenti` FOREIGN KEY (`id_utente_prenotazione`) REFERENCES `utenti` (`id_utente`);

--
-- Limiti per la tabella `utenti`
--
ALTER TABLE `utenti`
  ADD CONSTRAINT `FK_utenti_login` FOREIGN KEY (`login_id`) REFERENCES `login` (`login_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
