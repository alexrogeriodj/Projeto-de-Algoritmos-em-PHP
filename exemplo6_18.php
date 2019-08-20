<?php
class MinhaClasse {
    function __construct() {
        $this->nome = "MinhaClasse";
        print "Este é o construtor da classe ". $this->nome."<br>";
    }
    function __destruct() {
        print "Este é o destrutor da classe ". $this->nome;
    }
}
$obj = new MinhaClasse();
?>