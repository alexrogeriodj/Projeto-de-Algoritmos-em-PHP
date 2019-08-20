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

if ($db = new PDO("sqlite:bdteste")) 
{ 
	// grava a mensagem recebida
	if($incluir)
		$db->exec("INSERT INTO mensagens VALUES ('$nome','$cidade','$estado','$mensagem')");

	// exibe todas as mensagens
	foreach ($db->query("SELECT * FROM mensagens") as $linha)	
	{
		echo "<b>Nome</b>: ".$linha["nome"]. "<br>";
		echo "<b>Cidade</b>: ".$linha["cidade"]. "<br>";
		echo "<b>Estado</b>: ".$linha["estado"]. "<br>";
		echo "<b>Mensagem</b>: ".$linha["mensagem"]. "<hr>";
	}

	unset($db); 
} 
?>
</body>
</html>
