<html>
<title>Desenvolvendo Websites com PHP</title>
<body>
<?php

     for( $i=0, $k=10  ;  $i<10  ;  $i++, $k-- )
     {
          echo "\$i vale $i e \$k vale $k";

           if ($i==$k)
           { echo " (os valores são iguais!)"; }

          echo "<br>";
     }

?>

</body>
</html>
