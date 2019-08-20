<?php
require_once 'DB.php';
$usuario = 'juliano';
$senha = '12345';
$servidor = 'localhost';
$banco = 'test';

$dsn = "mysql://$usuario:$senha@$servidor/$banco";
$db = DB::connect($dsn);

$hoje = date("Y-m-d");
//$hoje = "2003-10-19";

$sql = "select jogo,local,horario from jogos where data='$hoje'";
$res = $db->query($sql);

while ($linha = $res->fetchRow()) {
    $jogo = $linha[0];
    $local = $linha[1];
    $horario = $linha[2];

    echo "<tr>";
    echo "<td>$horario</td>";
    echo "<td>$jogo</td>";
    echo "<td>$local</td>";
    echo "</tr>";
}

$res->free();
$db->disconnect();
?>

