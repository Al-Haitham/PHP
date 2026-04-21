<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php
    /*Afficher tous les produits et prix
    Calculer le total avec foreach
    Afficher uniquement les produits > 100
    Compter les produits chers*/

    $produits = [
    "PC" => 1200,
    "Souris" => 25,
    "Clavier" => 45,
    "Écran" => 300
    ];
    $total=0;
    foreach($produits as $k=>$v){
        echo "$k -> $v <br>";
        $total+=$v;
    }
    $produitsFiltred=array_filter($produits,function($v,$k){
        return $v>=100;
    },ARRAY_FILTER_USE_BOTH);
   
   /*$filtredArray=[];
   foreach($produits as $k=>$v){
        if($v>=100){
            array_push($filtredArray,$produits[$k]);
        }  
        }*/
    print_r($produitsFiltred);
    echo "<br>";
    echo "le nombre des produits chers est: ".count($produitsFiltred);

    ?>
</body>
</html>