create table jogos
(
	jogo varchar(100) NOT NULL,
	local varchar(50) NOT NULL,
	horario char(5) NOT NULL,
	data date NOT NULL
);


create table goleadores
(
	nome varchar(100) NOT NULL,
	time varchar(50) NOT NULL,
	gols smallint NOT NULL
);


insert into jogos values ('Gr�mio x Atl�tico-MG', 'Ol�mpico', '20:30', '2003-10-19');
insert into jogos values ('Guarani x Fluminense', 'Brinco de Ouro', '20:30', '2003-10-19');
insert into jogos values ('Crici�ma x Vasco', 'Heriberto Hulse', '20:30', '2003-10-19');
insert into jogos values ('Vit�ria x S�o Caetano', 'Barrad�o', '20:30', '2003-10-19');
insert into jogos values ('Cruzeiro x Juventude', 'Mineir�o', '20:30', '2003-10-19');

insert into goleadores values ('Dimba', 'Goi�s', '20');
insert into goleadores values ('Lu�s Fabiano', 'S�o Paulo', '18');
insert into goleadores values ('Aristiz�bal', 'Cruzeiro', '15');
insert into goleadores values ('R�bson', 'Paysandu', '15');
insert into goleadores values ('Marcel', 'Coritiba', '12');
