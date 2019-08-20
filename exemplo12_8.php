<?php
include "conecta_mysql.inc";
$resultado = $mysqli->query("SELECT * FROM produtos");
$objeto = $resultado->fetch_object();
echo "Nome do produto: " . $objeto->nome_produto . "<br>";
echo "Preço: " . $objeto->preco;
$mysqli->close();
?>
