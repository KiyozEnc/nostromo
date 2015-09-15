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
);
