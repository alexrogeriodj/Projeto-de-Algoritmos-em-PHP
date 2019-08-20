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


insert into jogos values ('Grêmio x Atlético-MG', 'Olímpico', '20:30', '2003-10-19');
insert into jogos values ('Guarani x Fluminense', 'Brinco de Ouro', '20:30', '2003-10-19');
insert into jogos values ('Criciúma x Vasco', 'Heriberto Hulse', '20:30', '2003-10-19');
insert into jogos values ('Vitória x São Caetano', 'Barradão', '20:30', '2003-10-19');
insert into jogos values ('Cruzeiro x Juventude', 'Mineirão', '20:30', '2003-10-19');

insert into goleadores values ('Dimba', 'Goiás', '20');
insert into goleadores values ('Luís Fabiano', 'São Paulo', '18');
insert into goleadores values ('Aristizábal', 'Cruzeiro', '15');
insert into goleadores values ('Róbson', 'Paysandu', '15');
insert into goleadores values ('Marcel', 'Coritiba', '12');
