<?php
require_once 'MDB2.php';
$usuario = 'juliano';
$senha = '12345';
$servidor = 'localhost';
$banco = 'test';
$dsn = "mysql://$usuario:$senha@$servidor/$banco";
$db = MDB2::connect($dsn);

if (PEAR::isError($db)) {
    die($db->getMessage());
}

$sql = "select nome,time,gols from goleadores order by gols desc limit 5";
$res = $db->query($sql);

while ($linha = $res->fetchRow())
{
    $nome = $linha[0];
    $time = $linha[1];
    $gols = $linha[2];

    echo "<tr>";
    echo "<td>$nome</td>";
    echo "<td>$time</td>";
    echo "<td>$gols</td>";
    echo "</tr>";
}
?>