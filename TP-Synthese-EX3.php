<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $prix=[120,45,30,75,200];

    $total=array_reduce($prix,fn($carry,$item)=>$carry+$item,0);
    $max=max($prix);
    $moyenne=$total/count($prix);

    echo "total: $total<br>Max: $max<br>Moyenne: $moyenne";
    ?>
</body>
</html>