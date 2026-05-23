<?php

require_once('config.php');

$sqlD="
        SELECT i.*, l.date_debut_location, l.date_fin_location
        FROM location l
        JOIN immobilier i ON i.id_immobilier=l.id_immobilier
      ";
$date_debut=$_POST['date_debut'];
$date_fin=$_POST['date_fin'];

if(isset($_POST['date_debut']) && isset($_POST['date_debut'])){
    $sqlD.=" WHERE l.date_debut_location>=? AND l.date_fin_location<=?";
    $stmt=$cnx->prepare($sqlD);
    $stmt->execute([$date_debut,$date_fin]);
    $immoD=$stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <div class="container">
        <form action="" method="POST">
            
            <label for="date_debut">Date Debut: </label>
            <input type="date" name="date_debut">

            <label for="date_fin">Date Fin: </label>
            <input type="date" name="date_fin">
        <div>
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </div>
        </form>

        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>titre</th>
                <th>adresse</th>
                <th>prix</th>
                <th>type</th>
                <th>disponible</th>
                <th>Dates</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($immoD as $i):?>
                    <tr>
                        <td><?=$i['id_immobilier'];?></td>
                        <td><?=$i['titre'];?></td>
                        <td><?=$i['adresse'];?></td>
                        <td><?=$i['prixlocation'];?></td>
                        <td><?=$i['libelle'];?></td>
                        <td><?=$i['disponible'];?></td>
                        <td><?=$i['date_debut-location'];?> - <?=$i['date_fin-location'];?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>