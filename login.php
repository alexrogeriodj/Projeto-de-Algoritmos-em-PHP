<?php
// obtém os valores digitados
$username = $_POST["username"];
$senha = $_POST["senha"];

// acesso ao banco de dados
include "conecta_mysql.inc";
$resultado = $mysqli->query("SELECT * FROM usuarios WHERE username='$username'");
$linhas = $resultado->num_rows;
if($linhas==0)  // testa se a consulta retornou algum registro
{
	echo "<html><body>";
	echo "<p align=\"center\">Usuário não encontrado!</p>";
	echo "<p align=\"center\"><a href=\"login.html\">Voltar</a></p>";
	echo "</body></html>";
}
else
{
	$registro = $resultado->fetch_array();
   	if ($senha != $registro["senha"]) // confere senha
	{
		echo "<html><body>";
		echo "<p align=\"center\">A senha está incorreta!</p>";
		echo "<p align=\"center\"><a href=\"login.html\">Voltar</a></p>";
		echo "</body></html>";
	}
	else   // usuário e senha corretos. Vamos criar os cookies
    {
        setcookie("nome_usuario", $username);
        setcookie("senha_usuario", $senha);
        // direciona para a página inicial dos usuários cadastrados
        header ("Location: pagina_inicial.php");
    }
}
$mysqli->close();
?>