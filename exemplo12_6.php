<?php
include "conecta_mysql.inc";
$resultado = $mysqli->query("SELECT * FROM produtos");
$linhas = $resultado->num_rows;
for ($i=0 ; $i<$linhas ; $i++)
{
	$registro = $resultado->fetch_array();
	$nome = $registro["nome_produto"];
	$preco = $registro["preco"];
	echo "Nome do produto: $nome <br>";
	echo "Preço: $preco <br>";
}
$mysqli->close();
?>