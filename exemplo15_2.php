<?php

   $de = "webmaster@algumdominio.com.br";
   $para = "alguem@dominio.com.br";
   $mensagem .= "Isto é um teste!";

    mail($para, "Teste", $mensagem, "From: $de");

?>
