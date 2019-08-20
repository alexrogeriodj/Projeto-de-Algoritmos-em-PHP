<?php
	include "conecta_pg.inc";
	$resultado = pg_query ($conexao, "DELETE FROM produtos");
	$linhas = pg_affected_rows ($resultado);
	pg_close($conexao);
	 echo "<p align=\"center\">";
	echo "Foram excluídos $linhas produtos!</p>";
?>
