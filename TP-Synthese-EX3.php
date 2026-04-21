<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $prix=[120, 45, 30, 75, 200];

    $total=array_reduce($prix, fn($carry, $item) => $carry + $item, 0);

    /*$max=array_reduce($prix, fn($carry, $item) => $item > $carry ? $item : $carry, 0);*/
    $max=$prix[0];
    for($i=0;$i<count($prix);$i++){
        if($prix[$i]>$max){
            $max=$prix[$i];
        }
    }
    echo "le max est: $max";
    echo "<br>";


    $sum=array_reduce($prix, fn($carry, $item) => $carry + $item, 0);
    $moyenne=count($prix)>0?$sum/count($prix):0;

    echo "Total: $total<br>Max: $max<br>Moyenne: $moyenne";
    ?>
</body>
</html>