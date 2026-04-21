<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $produits=["pc", "telephone", "tablette", "clavier"];

    $resultat=array_map(function($prod){
        return [
            'prefixed'=>'PROD_'.strtoupper($prod),
            'length'=>strlen($prod)
        ];
    }, $produits);

    foreach ($resultat as $item){
        echo $item['prefixed']." - Longueur: ".$item['length']."<br>";
    }
    ?>
</body>
</html>