<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    $notes=[12,5,18,9,14,20,7,11,16,8];
    $notes_reussies=array_filter($notes,function($notes){
        return $notes>=10;
    });

    echo "Notes>=10 (réussies): ";
    print_r($notes_reussies);

    $notes_excellentes=array_filter($notes,function($note){
        return $note>=15;
    });

    echo "Notes>=15 (excellentes) : ";
    print_r($notes_excellentes);

    $notes_echec=array_filter($notes,function($note){
        return $note<10;
    });

    echo "Notes<10 (échec) : ";
    print_r($notes_echec);

    function filtrerNotes(array $notes,string $operateur,float $seuil): array{
        return array_filter($notes,function($note) use ($operateur,$seuil){
            switch ($operateur){
                case '>=':return $note>=$seuil;
                case '>':return $note>$seuil;
                case '<=':return $note<=$seuil;
                case '<':return $note<$seuil;
                case '==':return $note==$seuil;
                default:return false;
            }
        });
    }?>
</body>
</html>