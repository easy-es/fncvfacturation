USE cake_cms;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created DATETIME,
    modified DATETIME
);

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(255),
    created DATETIME,
    modified DATETIME,
    UNIQUE KEY (libelle)
);

CREATE TABLE factures (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero_facture INT,
    categorie_id INT NOT NULL,
    montant_ttc FLOAT NOT NULL,
    adressea VARCHAR(255)  NULL,
    objet VARCHAR(255) NOT NULL,
    date_facture DATETIME,
    relance VARCHAR(255),
    reste FLOAT NULL,
    montant_ttc_encaissement FLOAT NULL,
    date_encaissement DATETIME NULL,
    mode_paiement VARCHAR(255) NULL,
    remarque TEXT,
    paye TINYINT(1),
    avoir INT,
    created DATETIME,
    modified DATETIME,
    FOREIGN KEY categorie_key (categorie_id) REFERENCES categories(id)
);
-- Mise a jour des factures payées.
update factures set paye = true where reste = 0 and remarque = '';
