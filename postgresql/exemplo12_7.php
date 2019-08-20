<?php

    include "conecta_pg.inc";

       $resultado = pg_query ($conexao, "SELECT * FROM produtos");
       $linhas = pg_num_rows ($resultado);

       for ($i=0 ; $i<$linhas ; $i++)
       {
           $registro = pg_fetch_row($resultado,$i);    
    
           echo "Código do produto: $registro[0] <br>";
           echo "Nome do produto: $registro[1] <br>";
           echo "Descrição: $registro[2] <br>";
           echo "Preço: $registro[3] <br>";
           echo "Peso: $registro[4] <br>";
           echo "Informações adicionais: $registro[7] <br><br>";
       }

    pg_close($conexao);

?>
