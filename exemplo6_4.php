<?php

   function clubes ( )
   {
         $clubes [ ] = "Grêmio";
         $clubes [ ] = "Palmeiras";
         $clubes [ ] = "Flamengo";
         $clubes [ ] = "Atlético Mineiro";
         $clubes [ ] = "Bahia";

         return $clubes;
   }

   // início do programa principal

   $nomes = clubes( );

   for ($i=0 ; $i < sizeof($nomes) ; $i++)
   {
        echo "\$nomes[$i] vale $nomes[$i] <br>";
   }

?>
