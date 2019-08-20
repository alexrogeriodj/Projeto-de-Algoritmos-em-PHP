<html>
<body>
<h1>Livro de visitas</h1>
<?php

$incluir = 0;
if(!empty($_POST["nome"]) && !empty($_POST["cidade"]) && !empty($_POST["estado"]) && !empty($_POST["mensagem"]))
{
	$nome = $_POST["nome"];
	$cidade = $_POST["cidade"];
	$estado = $_POST["estado"];
	$mensagem = $_POST["mensagem"];
	$incluir = 1;
}

if ($db = sqlite_open('bdteste', 0666, $erro)) 
{ 
	// grava a mensagem recebida
	if($incluir)
		sqlite_query($db,"INSERT INTO mensagens VALUES ('$nome','$cidade','$estado','$mensagem')");

	// exibe todas as mensagens
	$res = sqlite_query($db,'select * from mensagens');
	$linhas = sqlite_num_rows($res);
	for($i=0; $i<$linhas; $i++)
	{
		$linha = sqlite_fetch_array($res); 
		echo "<b>Nome</b>: ".$linha["nome"]. "<br>";
		echo "<b>Cidade</b>: ".$linha["cidade"]. "<br>";
		echo "<b>Estado</b>: ".$linha["estado"]. "<br>";
		echo "<b>Mensagem</b>: ".$linha["mensagem"]. "<hr>";
	}

	sqlite_close ($db);
} 
else 
    die ($erro);
?>
</body>
</html>
