<?php

require_once('config.php');

$sqlJoin="SELECT i.* , t.libelle
            FROM immobilier i
            JOIN typebImmo t ON i.id_type=t.id_type";
try{
    $stmt=$cnx->query($sqlJoin);
    $immobs=$stmt->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    die("Erreur: $getMessage($e)");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2 class="text-center">Gestion Immobilier</h2>
    <a href="ajouter.php" class="btn btn-sm btn-primary" name="send">Ajouter</a>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>titre</th>
                <th>adresse</th>
                <th>prix</th>
                <th>type</th>
                <th>disponible</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($immobs as $i):?>
                <tr>
                    <td><?=$i['id_immobilier'];?></td>
                    <td><?=$i['titre'];?></td>
                    <td><?=$i['adresse'];?></td>
                    <td><?=$i['prixlocation'];?></td>
                    <td><?=$i['libelle'];?></td>
                    <td><?=$i['disponible'];?></td>
                    <td>
                        <a href="delete.php" class="btn btn-sm btn-danger" href="delete.php?idImmo=<?= $i['id_immobilier'];?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>