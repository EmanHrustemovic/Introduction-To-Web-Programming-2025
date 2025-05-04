CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ime VARCHAR(50),
    prezime VARCHAR(50),
    email VARCHAR(50),
    telefon VARCHAR(20),
    password VARCHAR(50),
    uloga ENUM('doktor', 'pacijent', 'admin')
);

CREATE TABLE doktor_info (
    id INT PRIMARY KEY,
    titula VARCHAR(50),
    odjeljenje VARCHAR(50),
    FOREIGN KEY (id) REFERENCES user(id)
);

CREATE TABLE pacijent_info (
    id INT PRIMARY KEY,
    JMBG VARCHAR(13) UNIQUE,
    grad VARCHAR(50),
    težina DECIMAL(20,6),
    visina DECIMAL(20,6),
    datumRođenja DATE,
    nazivOsiguranika VARCHAR(50),
    FOREIGN KEY (id) REFERENCES user(id)
);

CREATE TABLE pregledi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nazivPregleda VARCHAR(50),
    datum_vrijeme DATETIME,
    status VARCHAR(50),
    opis VARCHAR(50),
    rezultati TEXT,
    odjeljenje_id INT,
    doktor_id INT,
    preporuka TEXT,
    FOREIGN KEY (doktor_id) REFERENCES doktor_info(id)
);

CREATE TABLE laboratorija (
    id INT AUTO_INCREMENT PRIMARY KEY,
    šifraNalaza INT UNIQUE,
    tipNalaza VARCHAR(50),
    vrsta_uzorka VARCHAR(50),
    datum_obrade DATETIME,
    status VARCHAR(50),
    pregledi_id INT,
    FOREIGN KEY (pregledi_id) REFERENCES pregledi(id)
);

CREATE TABLE terapija (
    id INT AUTO_INCREMENT PRIMARY KEY,
    terapija_id INT UNIQUE,
    vrsta VARCHAR(50),
    doza_i_uputa VARCHAR(50),
    trajanje DATETIME,
    kontrola DATE,
    doktor_id INT,
    pregledi_id INT,
    FOREIGN KEY (doktor_id) REFERENCES doktor_info(id),
    FOREIGN KEY (pregledi_id) REFERENCES pregledi(id)
);

CREATE TABLE zdravstvenikarton (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sifraBolesti INT UNIQUE,
    nazivBolesti VARCHAR(50),
    dijagnoza VARCHAR(50),
    terapija VARCHAR(50),
    pacijent_id INT,
    pregledi_id INT,
    doktor_id INT,
    FOREIGN KEY (pacijent_id) REFERENCES pacijent_info(id),
    FOREIGN KEY (pregledi_id) REFERENCES pregledi(id),
    FOREIGN KEY (doktor_id) REFERENCES doktor_info(id)
);
