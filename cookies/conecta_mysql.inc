<?php
// configura��es do banco de dados
$servidor = "localhost";
$usuario_bd = "juliano";
$senha_bd = "12345";
$banco = "test";

$conexao = new mysqli($servidor, $usuario_bd, $senha_bd, $banco);
?>