<?php
  $para = "joao@dominio.com.br";
  $mensagem = "<font color=\"#0000FF\">Teste</font>";

  mail($para, "Teste", $mensagem, "Content-Type: text/html");

?>
