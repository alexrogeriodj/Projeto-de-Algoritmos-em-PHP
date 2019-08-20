<?php
$arquivo = "contador.txt";  // arquivo do contador

if(file_exists($arquivo))   // se existe, lê o valor atual e o incrementa
{
    $fd = fopen($arquivo,"r");
	    $valor_atual = chop(fgets($fd));
	fclose($fd);
    $valor_atual++;
}
else
    $valor_atual = 1;

// grava o novo valor no arquivo
$ponteiro = fopen ($arquivo, "w");
    fwrite($ponteiro, $valor_atual);
fclose ($ponteiro);
?>

