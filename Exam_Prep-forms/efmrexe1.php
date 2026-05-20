<?php
    function calculeSomme(int $x,int $y):int{
        return $x + $y;
    }

    function afficherDecision(float $note){
        if($note>=10){
            echo "Réussite!";
        }else{
            echo "Échec!";
        }
    }

    $villes=['rabat','agadir','casablanca','safi'];
    echo "<ul>";
    foreach ($villes as $v){
        echo "<li>$v</li>";
    }
    echo "</ul>";

    function montantOF($nb){
        switch ($nb){
            case 0: return 0;
            case 1: return 300;
            case 2: return 500;
            default: return 600;
        }
    }
    echo montantOF(4);

?>
