<?php
require_once 'DB.php';
$usuario = 'juliano';
$senha = '12345';
$servidor = 'localhost';
$banco = 'test';

$dsn = "mysql://$usuario:$senha@$servidor/$banco";
$db = DB::connect($dsn);

$sql = "select * from goleadores order by gols desc limit 5";
$res = $db->query($sql);

while ($linha = $res->fetchRow()) {
    $nome = $linha[0];
    $time = $linha[1];
    $gols = $linha[2];

    echo "<tr>";
    echo "<td>$nome</td>";
    echo "<td>$time</td>";
    echo "<td>$gols</td>";
    echo "</tr>";
}

$res->free();
$db->disconnect();
?>

