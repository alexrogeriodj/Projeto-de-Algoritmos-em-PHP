<?php
if(IsSet($_COOKIE["nome_usuario"]))
    $nome_usuario = $_COOKIE["nome_usuario"];
if(IsSet($_COOKIE["senha_usuario"]))
    $senha_usuario = $_COOKIE["senha_usuario"];

if(!(empty($nome_usuario) OR empty($senha_usuario)))
{
    include "conecta_mysql.inc";
	$resultado = $mysqli->query("SELECT * FROM usuarios WHERE username='$nome_usuario'");
	if($resultado->num_rows==1)
	{
		$registro = $resultado->fetch_array();
		if($senha_usuario != $registro["senha"])
		{
            setcookie("nome_usuario");
            setcookie("senha_usuario");
            echo "Você não efetuou o LOGIN!";
            exit;
        }
    }
    else
    {
        setcookie("nome_usuario");
        setcookie("senha_usuario");
        echo "Você não efetuou o LOGIN!";
        exit;
    }
}
else
{
    echo "Você não efetuou o LOGIN!";
    exit;
}
$mysqli->close();
?>