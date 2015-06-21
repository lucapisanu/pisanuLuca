-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Giu 05, 2015 alle 18:05
-- Versione del server: 5.5.41-0ubuntu0.14.04.1
-- Versione PHP: 5.5.9-1ubuntu4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `amm15_pisanuLuca`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `acquisti`
--

CREATE TABLE IF NOT EXISTS `acquisti` (
  `id_commerciante` bigint(20) NOT NULL DEFAULT '0',
  `id_cliente` bigint(20) NOT NULL DEFAULT '0',
  `id_auto` bigint(20) NOT NULL DEFAULT '0',
  `data_vendita` varchar(32) NOT NULL,
  `guadagno` decimal(9,2) NOT NULL,
  PRIMARY KEY (`id_commerciante`,`id_cliente`,`id_auto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `acquisti`
--

INSERT INTO `acquisti` (`id_commerciante`, `id_cliente`, `id_auto`, `data_vendita`, `guadagno`) VALUES
(1, 1, 1, '10-10-2014', 1000.00),
(2, 2, 4, '10-10-2010', 1000.00),
(3, 3, 7, '1-11-2013', 800.00);

-- --------------------------------------------------------

--
-- Struttura della tabella `auto`
--

CREATE TABLE IF NOT EXISTS `auto` (
  `id_auto` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `modello` varchar(128) NOT NULL,
  `produttore` varchar(128) NOT NULL,
  `accessori` varchar(128) DEFAULT NULL,
  `colore` varchar(128) NOT NULL,
  `alimentazione` varchar(128) NOT NULL,
  `emissioni` varchar(128) DEFAULT NULL,
  `anno` int(4) NOT NULL,
  `prezzo` decimal(9,2) NOT NULL,
  `descrizione` varchar(254) DEFAULT NULL,
  PRIMARY KEY (`id_auto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dump dei dati per la tabella `auto`
--

INSERT INTO `auto` (`id_auto`, `modello`, `produttore`, `accessori`, `colore`, `alimentazione`, `emissioni`, `anno`, `prezzo`, `descrizione`) VALUES
(1, 'cd', 'cdc', 'cdec', 'cdwc', 'kdmod', 'Euro 2', 2008, 1500.00, 'dvdc'),
(2, '3.20', 'Bmw', 'Cerchi in lega', 'Blu', 'Diesel', 'Euro 5', 2008, 3500.00, 'ottime condizioni'),
(3, 'mokmdwp', 'Abarth', ' Climatizzatore;', 'Beige; Metallizato', 'Benzina+Metano', 'Euro2', 2000, 1700.00, 'osowdin'),
(4, 'cd', 'cdc', 'cdec', 'cdwc', 'kdmod', 'Euro 2', 2008, 1500.00, 'dvdc'),
(5, 'feg', 'BMW', 'dwf', 'wdff', 'cdwfw', 'dwfwf', 2010, 2000.00, 'wkmfkm'),
(6, 'dwed', 'Aston Martin', ' ESP;', 'Arancio; Metallizato', 'Benzina+Metano', 'Euro1', 2000, 1500.00, 'edwed'),
(7, 'cdsv', 'Aston Martin', ' ESP;', 'Arancio; Metallizato', 'Benzina+Metano', 'Euro1', 2000, 1500.00, 'fergregre'),
(8, 'cdsv', 'Aston Martin', ' ESP;', 'Arancio; Metallizato', 'Benzina+Metano', 'Euro1', 2000, 1500.00, 'fergregre'),
(9, 'cdsv', 'Aston Martin', ' ESP;', 'Arancio; Metallizato', 'Benzina+Metano', 'Euro1', 2000, 1500.00, 'fergregre'),
(10, 'cd', 'cdc', 'cdec', 'cdwc', 'kdmod', 'Euro 2', 2008, 1500.00, 'dvdc');

-- --------------------------------------------------------

--
-- Struttura della tabella `carrello`
--

CREATE TABLE IF NOT EXISTS `carrello` (
  `id_cliente` int(20) NOT NULL,
  `id_auto` int(20) NOT NULL,
  `data_inserimento` varchar(10) NOT NULL,
  PRIMARY KEY (`id_cliente`,`id_auto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `carrello`
--

INSERT INTO `carrello` (`id_cliente`, `id_auto`, `data_inserimento`) VALUES
(1, 9, '2015-04-20'),
(2, 3, '2015-04-20'),
(2, 8, '2015-04-20'),
(3, 6, '2015-04-20');

-- --------------------------------------------------------

--
-- Struttura della tabella `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `id_cliente` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(128) NOT NULL,
  `cognome` varchar(128) NOT NULL,
  `telefono` varchar(32) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `citta` varchar(128) DEFAULT NULL,
  `via` varchar(128) DEFAULT NULL,
  `cap` varchar(5) DEFAULT NULL,
  `provincia` varchar(128) DEFAULT NULL,
  `numero_civico` varchar(11) DEFAULT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `ruolo` varchar(32) DEFAULT 'Cliente',
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nome`, `cognome`, `telefono`, `email`, `citta`, `via`, `cap`, `provincia`, `numero_civico`, `username`, `password`, `ruolo`) VALUES
(1, 'Luca', 'Di Biaggio', '3409087657', 'ut1@email.it', 'Cagliari', NULL, NULL, NULL, NULL, 'clien1', 'pass', 'Cliente'),
(2, 'Giulio', 'De Rossi', '3409045657', 'ut2@email.it', 'Sassari', NULL, NULL, NULL, NULL, 'clien2', 'pass', 'Cliente'),
(3, 'Andrea', 'Bianchi', '3444045657', 'ut3@email.it', 'Oristano', NULL, NULL, NULL, NULL, 'clien3', 'pass', 'Cliente');

-- --------------------------------------------------------

--
-- Struttura della tabella `commerciante`
--

CREATE TABLE IF NOT EXISTS `commerciante` (
  `id_commerciante` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(128) NOT NULL,
  `cognome` varchar(128) NOT NULL,
  `telefono` varchar(32) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `nome_azienda` varchar(128) DEFAULT 'Privato',
  `citta` varchar(128) DEFAULT NULL,
  `via` varchar(128) DEFAULT NULL,
  `cap` varchar(5) DEFAULT NULL,
  `provincia` varchar(128) DEFAULT NULL,
  `numero_civico` varchar(11) DEFAULT NULL,
  `descrizione_azienda` varchar(256) DEFAULT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `ruolo` varchar(32) DEFAULT 'Commerciante',
  PRIMARY KEY (`id_commerciante`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `commerciante`
--

INSERT INTO `commerciante` (`id_commerciante`, `nome`, `cognome`, `telefono`, `email`, `nome_azienda`, `citta`, `via`, `cap`, `provincia`, `numero_civico`, `descrizione_azienda`, `username`, `password`, `ruolo`) VALUES
(1, 'Mago', 'Merlino', '3409044657', 'mago.merlino@email.it', 'Maghi delle auto', 'Citta dei maghi', NULL, NULL, NULL, NULL, NULL, 'comme1', 'pass', 'Commerciante'),
(2, 'Marco', 'Sau', '3298041157', 'marco.sau@email.it', 'Cagliari Car', 'Cagliari', NULL, NULL, NULL, NULL, NULL, 'comme2', 'pass', 'Commerciante'),
(3, 'Luca', 'Toni', '348944657', 'luca.toni@email.it', 'Privato', NULL, NULL, NULL, NULL, NULL, NULL, 'comme3', 'pass', 'Commerciante');

-- --------------------------------------------------------

--
-- Struttura della tabella `invendita`
--

CREATE TABLE IF NOT EXISTS `invendita` (
  `id_commerciante` bigint(20) NOT NULL DEFAULT '0',
  `id_auto` bigint(20) NOT NULL DEFAULT '0',
  `data_invendita` varchar(10) NOT NULL,
  PRIMARY KEY (`id_commerciante`,`id_auto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `invendita`
--

INSERT INTO `invendita` (`id_commerciante`, `id_auto`, `data_invendita`) VALUES
(1, 2, '30-02-2015'),
(1, 3, '2015-04-20'),
(1, 8, '20-10-2014'),
(2, 5, '02-11-2013'),
(2, 6, '09-04-2013'),
(3, 9, '30-02-2015'),
(3, 10, '30-02-2015');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
