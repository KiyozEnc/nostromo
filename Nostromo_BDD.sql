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

INSERT INTO vol VALUES (1,"2015-12-05", "15:00:00",40, 3000);
INSERT INTO vol VALUES (2,"2015-10-09", "12:15:00",80, 3000);
INSERT INTO vol VALUES (3,"2015-11-08", "18:10:00",90, 3000);
INSERT INTO vol VALUES (4,"2016-01-10", "14:20:00",60, 3000);
INSERT INTO vol VALUES (5,"2016-02-28", "18:05:00",10, 3000);
INSERT INTO vol VALUES (6,"2016-03-18", "14:05:00",10, 3000);
INSERT INTO vol VALUES (7,"2016-10-10", "06:05:00",10, 3000);

INSERT INTO article VALUES (1,"Gants astronaute","Default description",250,20,'public/Resources/img/Basket/gauntlet.jpg');
INSERT INTO article VALUES (2,"Pantalon astronaute","Default description",400,20,'public/Resources/img/Basket/down.jpg');
INSERT INTO article VALUES (3,"Casque astronaute","Default description",1200,5,'public/Resources/img/Basket/helmet.png');
INSERT INTO article VALUES (4,"Truc astronaute","Default description",600,5,null);
INSERT INTO article VALUES (5,"Haut astronaute","Default description",1500,5,'public/Resources/img/Basket/tenue.png');

INSERT INTO `client` VALUES (1,"Nostromo","Contact","7 rue de Mars",53100,"MAYENNE","ffb4761cba839470133bee36aeb139f58d7dbaa9","contact@nostromo.com",150);

INSERT InTO reservation VALUES (1,1,3,'2014-12-10 15:14:30',50);

INSERT INTO echeance VALUES (1, 10140, '2016-02-21', 1);
INSERT INTO echeance VALUES (2, 10000, '2016-03-22', 1);
INSERT INTO echeance VALUES (3, 10000, '2016-04-22', 1);

INSERT INTO commande VALUES (1,1,"2015-11-28 12:00:00");
INSERT INTO commande VALUES (2,1,"2015-10-20 10:00:00");

INSERT INTO commander VALUES (1,1,2);
INSERT INTO commander VALUES (2,1,1);
INSERT INTO commander VALUES (1,2,4);

SET FOREIGN_KEY_CHECKS = 1;
