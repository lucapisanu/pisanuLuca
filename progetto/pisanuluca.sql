SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


--
-- Database: 'pisanuLuca'
--

CREATE SCHEMA pisanuLuca;

-- --------------------------------------------------------

--
-- Struttura della tabella 'cliente'
--

CREATE TABLE IF NOT EXISTS cliente(

  id_cliente BIGINT(20) unsigned NOT NULL AUTO_INCREMENT,
  nome VARCHAR(128) NOT NULL, 
  cognome VARCHAR(128) NOT NULL,
  telefono VARCHAR(32) DEFAULT NULL,
  email VARCHAR(128) NOT NULL,
  citta VARCHAR(128) DEFAULT NULL,
  via VARCHAR(128) DEFAULT NULL,
  cap VARCHAR(5) DEFAULT NULL,
  provincia VARCHAR(128) DEFAULT NULL,
  numero_civico VARCHAR(11) DEFAULT NULL,
  username VARCHAR(128) NOT NULL,
  password VARCHAR(128) NOT NULL, 
  ruolo VARCHAR(32) DEFAULT 'Cliente',

  PRIMARY KEY cliente(id_cliente)
)ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


--
-- Dump dei dati per la tabella 'cliente'
--

INSERT INTO cliente (id_cliente, nome, cognome, telefono, email, citta, via, cap, provincia, numero_civico, username, password) VALUES
(DEFAULT, 'Luca', 'Di Biaggio', 3409087657, 'ut1@email.it' , 'Cagliari', DEFAULT, DEFAULT, DEFAULT, DEFAULT, 'clien1', 'pass'),
(DEFAULT, 'Giulio', 'De Rossi', 3409045657, 'ut2@email.it' , 'Sassari', DEFAULT, DEFAULT, DEFAULT, DEFAULT, 'clien2', 'pass'),
(DEFAULT, 'Andrea', 'Bianchi', 3444045657, 'ut3@email.it' , 'Oristano', DEFAULT, DEFAULT, DEFAULT, DEFAULT, 'clien3', 'pass');



-- --------------------------------------------------------

--
-- Struttura della tabella 'commerciante'
--

CREATE TABLE IF NOT EXISTS commerciante(

  id_commerciante BIGINT(20) unsigned NOT NULL AUTO_INCREMENT,
  nome VARCHAR(128) NOT NULL, 
  cognome VARCHAR(128) NOT NULL,
  telefono VARCHAR(32) DEFAULT NULL,
  email VARCHAR(128) NOT NULL,
  nome_azienda VARCHAR(128) DEFAULT 'Privato',
  citta VARCHAR(128) DEFAULT NULL,
  via VARCHAR(128) DEFAULT NULL,
  cap VARCHAR(5) DEFAULT NULL,
  provincia VARCHAR(128) DEFAULT NULL,
  numero_civico VARCHAR(11) DEFAULT NULL,
  descrizione_azienda VARCHAR(256) DEFAULT NULL,
  username VARCHAR(128) NOT NULL,
  password VARCHAR(128) NOT NULL,
  ruolo VARCHAR(32) DEFAULT 'Commerciante',

  PRIMARY KEY commerciante(id_commerciante)
)ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dump dei dati per la tabella 'commerciante'
--

INSERT INTO commerciante (id_commerciante, nome, cognome, telefono,email, nome_azienda, citta, via, cap, provincia, numero_civico, descrizione_azienda, username, password) VALUES
(DEFAULT, 'Mago', 'Merlino', 3409044657, 'mago.merlino@email.it' , 'Maghi delle auto' , 'Citta dei maghi', DEFAULT, DEFAULT, DEFAULT, DEFAULT, DEFAULT, 'comme1', 'pass'),
(DEFAULT, 'Marco', 'Sau', 3298041157, 'marco.sau@email.it' , 'Cagliari Car' ,'Cagliari', DEFAULT, DEFAULT, DEFAULT, DEFAULT, DEFAULT, 'comme2', 'pass'),
(DEFAULT, 'Luca', 'Toni', 348944657, 'luca.toni@email.it' , DEFAULT , DEFAULT, DEFAULT, DEFAULT, DEFAULT, DEFAULT, DEFAULT, 'comme3', 'pass');  


-- --------------------------------------------------------

--
-- Struttura della tabella 'auto'
--

CREATE TABLE IF NOT EXISTS auto(

  id_auto BIGINT(20) unsigned NOT NULL AUTO_INCREMENT,
  modello VARCHAR(128) NOT NULL,
  produttore VARCHAR(128) NOT NULL,
  accessori VARCHAR(128) DEFAULT NULL,
  colore VARCHAR(128) NOT NULL,
  alimentazione VARCHAR(128) NOT NULL,
  emissioni VARCHAR(128) DEFAULT NULL,
  anno INT(4) NOT NULL, 
  prezzo NUMERIC(9,2) NOT NULL CHECK (prezzo > 0.0),
  descrizione VARCHAR(254) DEFAULT NULL,

  PRIMARY KEY auto(id_auto)
)ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

--
-- Dump dei dati per la tabella 'auto'
--

INSERT INTO auto(id_auto, modello, produttore, accessori, colore, alimentazione, emissioni, anno, prezzo, descrizione) VALUES
(DEFAULT, 'Serie 1', 'Bmw', 'Cerchi in lega', 'Nero', 'Benzina', 'Euro 4', 2010, 21000, DEFAULT),
(DEFAULT, 'Serie 3', 'Bmw', 'Bracciolo', 'Bianco','Benzina', 'Euro 4', 2014, 27000, DEFAULT),
(DEFAULT, 'Classe A', 'Mercedes','Cerchi in lega, bracciolo', 'Grigio', 'Diesel', 'Euro 4', 2002, 21000, DEFAULT),
(DEFAULT, 'Slk', 'Mercedes', 'Tettuccio', 'Nero', 'Diesel', 'Euro 4', 2012, 21000, DEFAULT),
(DEFAULT, 'A3', 'Audi', DEFAULT, 'Nero', 'Benzina', 'Euro 4', 2013, 23000, DEFAULT ),
(DEFAULT, 'A4', 'Audi', DEFAULT, 'Nero', 'Diesel',  'Euro 4', 2012, 20000, DEFAULT);




-- --------------------------------------------------------

--
-- Struttura della tabella 'acquisti'
--

CREATE TABLE IF NOT EXISTS acquisti(

  id_commerciante BIGINT(20) REFERENCES commerciante(id_commerciante) ON DELETE NO ACTION ON UPDATE CASCADE,
  id_cliente BIGINT(20) REFERENCES cliente(id_cliente) ON DELETE NO ACTION ON UPDATE CASCADE,
  id_auto BIGINT(20) REFERENCES auto(id_auto) ON DELETE NO ACTION ON UPDATE CASCADE,
  data_vendita VARCHAR(32) NOT NULL,
  guadagno NUMERIC(9,2) NOT NULL CHECK (guadagno > 0.0),
  
PRIMARY KEY acquisti(id_commerciante, id_cliente, id_auto)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella 'acquisti'
--

INSERT INTO acquisti (id_commerciante, id_cliente, id_auto, data_vendita, guadagno) VALUES
(1, 2, 2, '10-10-2014', 1000.00),
(2, 1, 1, '1-11-2013', 800.00); 



-- --------------------------------------------------------

--
-- Struttura della tabella 'invendita'
--

CREATE TABLE IF NOT EXISTS invendita(

  id_commerciante BIGINT(20) REFERENCES commerciante(id_commerciante) ON DELETE CASCADE ON UPDATE CASCADE,
  id_auto BIGINT(20) REFERENCES auto(id_auto) ON DELETE CASCADE ON UPDATE CASCADE,
  data_invendita VARCHAR(10) NOT NULL,

  PRIMARY KEY invendita(id_commerciante, id_auto)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella 'acquisti'
--

INSERT INTO invendita (id_commerciante, id_auto, data_invendita) VALUES
(1, 3, '23-09-2013'),
(2, 4, '04-01-2014'),
(2, 5, '02-11-2013'),
(3, 6, '09-04-2013');




