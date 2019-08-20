<?php
	$operacao = $_POST["operacao"];

	include "conecta_pg.inc";
	if ($operacao=="incluir")
	{
		$sql = "INSERT INTO produtos VALUES ";
		$sql .= "('$codigo','$nome','$descricao',$preco,$peso,$cc,$cs,'$ad')";
		$resultado = pg_query ($conexao, $sql); 
		echo "Produto incluído com sucesso!";
	}
	elseif ($operacao=="excluir")
	{
		$sql = "DELETE FROM produtos WHERE codigo_produto=$codigo";
		$resultado = pg_query ($conexao, $sql); 
		$linhas = pg_affected_rows($resultado);
        if($linhas==1)
             { echo "Produto excluído com sucesso!"; }
        else
             { echo "Produto não encontrado!"; }
	}
	elseif ($operacao=="mostrar")
	{
		$resultado = pg_query ($conexao, "SELECT * FROM produtos");
		$linhas = pg_num_rows ($resultado);
		echo "<p><b>Lista de produtos da loja</b></p>";
		for ($i=0 ; $i<$linhas ; $i++)
		{
                 $reg = pg_fetch_row($resultado,$i);  
                 echo "$reg[0] <br>$reg[1] <br>$reg[2] <br>$reg[3] <br>";
                 echo "$reg[4] <br>$reg[5] <br>$reg[6] <br>$reg[7] <br><br>";
        }
    }
     pg_close($conexao);
?>
