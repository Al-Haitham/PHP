<?php

require('config.php');
$sqlimmo="SELECT * FROM immob";
$stmtimmo=$cnx->query($sqlimmo);
$immobs=$stmtimmo->fetchAll(PDO::FETCH_ASSOC);
$sqltype="SELECT * FROM immob";
$stmtimmo=$cnx->query($sqlimmo);
$immobs=$stmtimmo->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
                    <td><?=$i['id_immobilier'];?></td>
                    <td><?=$i['id_immobilier'];?></td>
                    <td>
                        <a href="delete.php"></a>
                    </td>
                </tr>
        </tbody>
    </table>
</body>
</html>