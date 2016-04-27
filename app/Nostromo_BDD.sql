/* DROP DATABASE IF EXISTS `2014-nostromo_base`; */

/* CREATE DATABASE `2014-nostromo_base`; */

USE `2014-nostromo_base`;

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS client;

CREATE TABLE client (
  numClt int not null auto_increment,
  nomClt varchar(30) not null,
  prenomClt varchar(30) not null,
  adresseClt varchar(50) not null,
  cpClt varchar(5) not null,
  villeClt varchar(30) not null,
  mdpClt text not null,
  mailClt text not null,
  pointsClt int not null,
  primary key (numClt)
);

DROP TABLE IF EXISTS commande ;

CREATE TABLE commande (
  numCde int not null auto_increment primary key,
  numClt int not null references client(numClt),
  pointsUtilise int not null,
  date datetime not null
);

DROP TABLE IF EXISTS article ;

CREATE TABLE article (
  numArt int not null,
  designation varchar(50) not null,
  description text not null,
  pu DOUBLE not null,
  qteStock int not null,
  url varchar(200),
  primary key (numArt)
);

DROP TABLE IF EXISTS commander ;

CREATE TABLE commander (
  numArt int not null,
  numCde int not null,
  qte int not null,
  primary key (numArt, numCde),
  foreign key (numCde) references commande(numCde),
  foreign key (numArt) references article(numArt)
);

DROP TABLE IF EXISTS vol ;

CREATE TABLE vol (
  numVol int not null,
  dateVol date not null,
  heureVol time not null,
  nbPlace int not null,
  prix int not null,
  primary key (numVol)
);

DROP TABLE IF EXISTS reservation ;

CREATE TABLE reservation (
  numRes int not null auto_increment,
  numClt int not null,
  numVol int not null,
  dateRes datetime not null,
  nbPers int not null,
  primary key (numRes),
  foreign key (numClt) references client(numClt),
  foreign key (numVol) references vol(numVol)
);

DROP TABLE IF EXISTS echeance ;

CREATE TABLE echeance (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  montant int not null,
  dateEcheance date not null,
  numRes int not null,
  foreign key (numRes) references reservation(numRes)
);

INSERT INTO vol VALUES (1, "2015-12-05", "15:00:00", 40, 15000);
INSERT INTO vol VALUES (2, "2015-10-09", "12:15:00", 80, 15000);
INSERT INTO vol VALUES (3, "2015-11-08", "18:10:00", 90, 15000);
INSERT INTO vol VALUES (4, "2016-01-10", "14:20:00", 60, 15000);
INSERT INTO vol VALUES (5, "2016-02-28", "18:05:00", 40, 15000);
INSERT INTO vol VALUES (6, "2016-03-18", "14:05:00", 35, 15000);
INSERT INTO vol VALUES (7, "2016-10-10", "06:05:00", 60, 15000);
INSERT INTO vol VALUES (8, "2016-11-02", "12:05:00", 120, 15000);
INSERT INTO vol VALUES (9, "2016-10-26", "16:05:00", 30, 15000);
INSERT INTO vol VALUES (10, "2016-11-10", "11:24:00", 60, 24000);

INSERT INTO article VALUES (1, "Gants astronaute", "Ces gants de l’espace pour les cosmonautes en herbe sont les répliques de ceux utilisés par les vrais astronautes. Une pièce incontournable pour les missions spatiales…", 250, 100, 'public/Resources/img/Basket/gauntlet.png');
INSERT INTO article VALUES (2, "Pantalon astronaute", "Élastique à la taille, s'ajustera parfaitement à votre taille.", 400, 100, 'public/Resources/img/Basket/down.png');
INSERT INTO article VALUES (3, "Casque astronaute", "Paré au lancement ! Vous qui avez toujours rêvé de quitter l'atmosphère et découvrir de nouvelles planètes, prenez votre casque de cosmonaute et décollez pour de nouveaux horizons !", 1200, 50, 'public/Resources/img/Basket/helmet.png');
INSERT INTO article VALUES (5, "Haut astronaute", "Haut de couleur blanc, possède des éléments argentés au niveau des épaules et de la taille. Il possède également le drapeau de l'Amérique sur le torse. Il se ferme dans le dos par un scratch.", 1500, 50, 'public/Resources/img/Basket/tenue.png');

INSERT INTO `client` VALUES (1, "Nostromo", "Contact", "7 rue de Mars", 53100, "MAYENNE", "ffb4761cba839470133bee36aeb139f58d7dbaa9", "contact@nostromo.com", 150);

INSERT INTO commande VALUES (1, 1, 0, "2015-11-28 12:00:00");
INSERT INTO commande VALUES (2, 1, 0, "2015-10-20 10:00:00");

INSERT INTO commander VALUES (1, 1, 2);
INSERT INTO commander VALUES (2, 1, 1);
INSERT INTO commander VALUES (1, 2, 4);


SET FOREIGN_KEY_CHECKS = 1;