<html>
<title>Desenvolvendo Websites com PHP</title>
<body>

<?php
     
      if (empty($nome) OR empty($email) OR empty($cpf))
     {
        echo "Você deve preencher os campos nome, e-mail e CPF!";
        exit;
     }

?>

</body>
</html>
