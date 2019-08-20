<?php

    include "conecta_pg.inc";

       $resultado = pg_query ($conexao, "SELECT * FROM produtos");
       $linhas = pg_num_rows ($resultado);

       for ($i=0 ; $i<$linhas ; $i++)
       {
           $nome = pg_result ($resultado , $i , "nome_produto");
           $preco = pg_result ($resultado , $i , "preco");
           echo "Nome do produto: $nome <br>";
           echo "Preço: $preco <br>";
       }

    pg_close($conexao);
?>
