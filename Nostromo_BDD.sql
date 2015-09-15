DROP SCHEMA nostromo IF EXISTS;

CREATE SCHEMA nostromo;

USE nostromo;

CREATE TABLE client (
	numClient int not null auto_increment,
	nomClient varchar(30) not null,
	prenomClient varchar(30) not null,
	adresseClient varchar(50) not null,
	cpClient varchar(5) not null,
	villeClient varchar(30) not null,
	mdpClient text not null,
	mailClient mail not null,
	pointsClient int not null,
	primary key (numClient)
);

CREATE TABLE commande (
	numCde int not null auto_increment primary key,
	numClient int not null references client(numClient)
);

CREATE TABLE article (
	numArt int not null,
	designation varchar(50) not null,
	pu int not null,
	primary key (numArt)
);

CREATE TABLE commander (
	numArt int not null,
	numCde int not null,
	qté int not null,
	primary key (numArt, numCde),
	foreign key (numCde) references commande(numCde),
	foreign key (numArt) references article(numArt)
);q

CREATE TABLE reservation (
	numRes int not null,
    numClt int not null,
	dateRes date not null,
	primary key (numRes),
	foreign key (numClt) references Client(numClt)
);

CREATE TABLE vol (
	numVol int not null,
	dateVol date not null,
    nbPlace int not null,
	primary key (numVol)
);

CREATE TABLE reserver (
    numVol int not null,
    numRes int not null,
    nbPers int not null,
    primary key (numRes,numVol)
);
