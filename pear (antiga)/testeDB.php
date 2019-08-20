<?php
require_once 'DB.php';

$usuario = 'juliano';
$senha = '12345';
$servidor = 'localhost';
$banco = 'test';

$dsn = "mysql://$usuario:$senha@$servidor/$banco";
$db = DB::connect($dsn);

$sql = "select * from livros limit 3";
$res = $db->query($sql);

while ($linha = $res->fetchRow()) {
    $isbn = $linha[0];
    $titulo = $linha[1];
    $autor = $linha[2];
    echo "$isbn - $titulo - $autor<br>";
}

$res->free();
$db->disconnect();
?>

