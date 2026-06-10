<?php

class student{
    private $code;
    private $nom;
    public function __construct($code,$nom){
        $this->code=$code;
        $this->nom=$nom;
    }

    public function __toString(){
        return sprintf("code: %d - nom:%s",$this->code,$this->nom);
    }

    public function __call($method,$params){
        echo "la method $method n est pas definie!";
    }

}

?>