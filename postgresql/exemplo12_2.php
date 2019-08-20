<?php

	include "conecta_pg.inc";
	$sql = "SELECT * FROM produtos";
	$resultado = pg_query ($conexao, $sql);
	pg_close($conexao);

?>