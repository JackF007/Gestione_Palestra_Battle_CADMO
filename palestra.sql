-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Nov 03, 2022 alle 22:46
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
(1, 0, 50);

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
(3, 'admin@admin.com', '$2y$10$GZdH.QbYpUVCgYKrQyWbiupCpZ1zMABr4ayguPsETFE.ACnIXXidW', 'amministrazione', 1);

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
(4, '2022-11-03', 1667430000, '2022-11-03', '08-09', 4, 1, 'intatta', 'False');

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
(5, 'Nadmin', 'Cadmin', 3, '3298461894', '2002-11-11', 'ccccgggggdddd333');

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
  MODIFY `login_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `prenotazioni`
--
ALTER TABLE `prenotazioni`
  MODIFY `id_prenotazione` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id_utente` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
