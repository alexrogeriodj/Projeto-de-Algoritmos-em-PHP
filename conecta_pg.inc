<?php

$str_conexao = "dbname=bdteste port=5432 user=postgres password=postgres";

if(!($conexao=pg_connect($str_conexao)))
{
	echo "Não foi possivel estabelecer uma conexão com o banco de dados.";
	exit;
}

?>
