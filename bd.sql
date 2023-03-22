create schema 3info;

create table contatos(
codigocontatos int not null auto_increment,
nome varchar(45) not null,
sobrenome varchar(45) not null,
email varchar(90) not null,
obs varchar(250),
telefone varchar(15) not null,
datanasc date not null,
codigocidade int not null,
vivo tinyint,
primary key(codigocontatos)
);

create table hobbie(
codigohobbie int not null auto_increment,
descricao varchar(45) not null,
primary key (codigohobbie)
);

create table contato_hobbie(
codigocontatos int not null,
codigohobbie int not null,
primary key(codigocontatos, codigohobbie)
);

create table proposta(
codigoproposta int not null auto_increment,
nome varchar(45) not null,
email varchar(45) not null,
obs varchar(250) not null,
salario int not null,
primary key (codigoproposta)
);

create table cidade(
codigocidade int not null auto_increment,
nome varchar(45) not null,
estado varchar(45) not null,
primary key (codigocidade)
)
