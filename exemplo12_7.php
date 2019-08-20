<?php
include "conecta_mysql.inc";
$resultado = $mysqli->query("SELECT * FROM produtos");
$linhas = $resultado->num_rows;
for ($i=0 ; $i<$linhas ; $i++)
{
	$registro = $resultado->fetch_row();
	echo "Código do produto: $registro[0] <br>";
	echo "Nome do produto: $registro[1] <br>";
	echo "Descrição: $registro[2] <br>";
	echo "Preço: $registro[3] <br>";
	echo "Peso: $registro[4] <br>";
	echo "Informações adicionais: $registro[7] <br><br>";
}
$mysqli->close();
?>