-- Autor: André Milani
-- Site: http://www.novateceditora.com.br
--
-- Atenção: Criar um banco de dados e conectá-lo antes de executar este arquivo,
-- visando não misturar este conteúdo com outros bancos de dados.

CREATE SEQUENCE SEQ_FUNCIONARIOS INCREMENT 1 START 1;
CREATE TABLE TB_FUNCIONARIOS
(
  ID int PRIMARY KEY DEFAULT NextVal('SEQ_FUNCIONARIOS'),
  NOME VARCHAR(64) NOT NULL,
  ESCOLARIDADE VARCHAR(32) NOT NULL,
  CARGO VARCHAR(48) NOT NULL,
  SALARIO FLOAT8 NOT NULL 
);

INSERT INTO TB_FUNCIONARIOS (NOME, ESCOLARIDADE, CARGO, SALARIO) VALUES ('André', 'Pós-Graduado', 'Analista de Negócios', 1000);
INSERT INTO TB_FUNCIONARIOS (NOME, ESCOLARIDADE, CARGO, SALARIO) VALUES ('Cláudio', 'Mestre', 'Analista de Sistemas', 2000);
INSERT INTO TB_FUNCIONARIOS (NOME, ESCOLARIDADE, CARGO, SALARIO) VALUES ('Luis', 'Graduado', 'Analista de Sistemas', 700);
INSERT INTO TB_FUNCIONARIOS (NOME, ESCOLARIDADE, CARGO, SALARIO) VALUES ('Alfredo', 'Pós-Graduado', 'Analista de BI', 2300);
INSERT INTO TB_FUNCIONARIOS (NOME, ESCOLARIDADE, CARGO, SALARIO) VALUES ('Augusto', 'Doutor', 'Administrador de Banco de Dados', 2600);
INSERT INTO TB_FUNCIONARIOS (NOME, ESCOLARIDADE, CARGO, SALARIO) VALUES ('Ricardo', 'Graduado', 'Analista de Sistemas', 1000);
INSERT INTO TB_FUNCIONARIOS (NOME, ESCOLARIDADE, CARGO, SALARIO) VALUES ('Thais', 'Graduado', 'Analista de Marketing', 1100);
INSERT INTO TB_FUNCIONARIOS (NOME, ESCOLARIDADE, CARGO, SALARIO) VALUES ('Pedro', 'Graduado', 'Programador', 900);
INSERT INTO TB_FUNCIONARIOS (NOME, ESCOLARIDADE, CARGO, SALARIO) VALUES ('Flávia', 'Mestre', 'Analista de Sistemas', 2300);

CREATE SEQUENCE SEQ_CARGOS INCREMENT 1 START 1;
CREATE TABLE TB_CARGOS
(
  ID int PRIMARY KEY DEFAULT NextVal('SEQ_CARGOS'),
  CARGO VARCHAR(48) NOT NULL,
  DEPARTAMENTO VARCHAR(48) NOT NULL 
);

INSERT INTO TB_CARGOS (CARGO, DEPARTAMENTO) VALUES ('Analista de Negócios', 'Tecnologia da Informação');
INSERT INTO TB_CARGOS (CARGO, DEPARTAMENTO) VALUES ('Analista de Sistemas', 'Tecnologia da Informação');
INSERT INTO TB_CARGOS (CARGO, DEPARTAMENTO) VALUES ('Analista de BI', 'Tecnologia da Informação');
INSERT INTO TB_CARGOS (CARGO, DEPARTAMENTO) VALUES ('Administrador de Banco de Dados', 'Tecnologia da Informação');
INSERT INTO TB_CARGOS (CARGO, DEPARTAMENTO) VALUES ('Analista de Marketing', 'Marketing');
INSERT INTO TB_CARGOS (CARGO, DEPARTAMENTO) VALUES ('Programador', 'Tecnologia da Informação');
INSERT INTO TB_CARGOS (CARGO, DEPARTAMENTO) VALUES ('Contador', 'Contabilidade');
INSERT INTO TB_CARGOS (CARGO, DEPARTAMENTO) VALUES ('Administrador', 'Contabilidade');
INSERT INTO TB_CARGOS (CARGO, DEPARTAMENTO) VALUES ('Designer', 'Marketing');