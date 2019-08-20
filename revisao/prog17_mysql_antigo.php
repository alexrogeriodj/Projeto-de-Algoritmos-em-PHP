<?php
$servidor = "localhost";
$usuario = "juliano";
$senha = "12345";
$banco = "test";

$con = mysql_connect($servidor, $usuario, $senha);
    mysql_select_db ($banco);
    $res = mysql_query("SELECT titulo,autor FROM livros");
    $num_linhas = mysql_num_rows($res);

    for($i=0 ; $i<$num_linhas; $i++)
    {
        $dados = mysql_fetch_row ($res);
        $titulo = $dados[0];
        $autor = $dados[1];
        echo "$titulo - $autor <br>";
    }
mysql_close($con);
?>