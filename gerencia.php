<?php

$operacao = $_POST["operacao"];

if ($operacao == "inclusao")
{
	// realiza a inclusão do produto
	echo "Produto incluído!";	

}

elseif ($operacao == "alteracao")
{
	// realiza a alteração do produto
	echo "Produto alterado!";	
}

elseif ($operacao == "exclusao")
{
	// realiza a exclusão do produto
	echo "Produto excluído!";	
}


?>
