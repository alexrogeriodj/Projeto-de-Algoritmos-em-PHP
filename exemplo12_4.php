<?php
include "conecta_mysql.inc";
$resultado = $mysqli->query("SELECT * FROM produtos");
$linhas = $resultado->num_rows;
$mysqli->close();
echo "<p align=\"center\">A consulta retornou $linhas registros!</p>";
?>
