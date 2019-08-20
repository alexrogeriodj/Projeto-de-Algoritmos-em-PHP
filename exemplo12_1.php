<?php
include "conecta_mysql.inc";
$resultado = $mysqli->query("SELECT * FROM produtos");
$mysqli->close();
?>