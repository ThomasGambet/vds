use vds;

CREATE TABLE IF NOT EXISTS partenaire (
  id int AUTO_INCREMENT PRIMARY KEY,
  nom varchar(50) NOT NULL,
  logo varchar(100) NOT NULL,
  actif int NOT NULL DEFAULT '1' COMMENT '0= Inactif, 1= Actif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;


insert into partenaire (nom, logo) values
('Conseil général de la Somme', 'somme.png'),
('Conseil régional des Hauts de France', 'hautdefrance.png'),
('Amiens métropole', 'amiens.png');