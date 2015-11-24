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

CREATE TABLE commande (
	numCde int not null auto_increment primary key,
	numClt int not null references client(numClt)
);

CREATE TABLE article (
	numArt int not null,
	designation varchar(50) not null,
	pu int not null,
	qteStock int not null,
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

CREATE TABLE vol (
	numVol int not null,
	dateVol date not null,
	heureVol time not null,
	nbPlace int not null,
	primary key (numVol)
);

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

CREATE TABLE echeance (
	numRes int not null primary key,
	montant int not null,
	dateEcheance datetime not null,
	foreign key (numRes) references reservation(numRes)
);

INSERT INTO vol VALUES (1,"2015-08-15", "15:15:00",33);
INSERT INTO vol VALUES (2,"2015-08-15", "15:15:00",10);
INSERT INTO vol VALUES (3,"2015-08-15", "15:15:00",13);
INSERT INTO vol VALUES (4,"2015-08-15", "15:15:00",6);
