<?php

    include "conecta_pg.inc";

       $resultado = pg_query ($conexao, "SELECT * FROM produtos");
       $linhas = pg_num_rows ($resultado);

    pg_close($conexao);

   echo "<p align=\"center\">";
   echo "A consulta retornou $linhas registros!</p>";

?>
