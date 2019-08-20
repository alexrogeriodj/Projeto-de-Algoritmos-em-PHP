<?php

	$vetor[0][0]= "elemento00";
	$vetor[0][1]= "elemento01";
	$vetor[1][0]= "elemento10";
	$vetor[1][1]= "elemento11";

	for($i=0 ; $i<2 ; $i++)
	{
		for($k=0 ; $k<2 ; $k++)
		{
			echo "O elemento da posição $i,$k é ";
			echo $vetor [$i][$k] . "<br>";
		}
	}

?>
