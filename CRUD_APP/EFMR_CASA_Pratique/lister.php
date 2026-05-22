<?php
require('config.php');

$sql="SELECT * FROM produit";
$stmt=$pdo->query($sql);
$produit=$stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lister</title>
</head>
<body>
    <h2>prod List</h2>
    <div><a href="Ajout.php">Ajouter</a></div>
    <table border="1">
        <tr>
            <th>Code</th>
            <th>Désignation</th>
            <th>Prix_Unitaire</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
        <?php foreach($produit as $prod): ?>
        <tr>
            <td><?= $prod['Code_produit'] ?></td>
            <td><?= htmlspecialchars($prod['Designation']) ?></td>
            <td><?= $prod['Prix_Unitaire'] ?></td>
            <td><?= $prod['stock'] ?></td>
            <!--
            <td>
                <a href="edit.php?id=<?= $prod['id'] ?>">Edit</a>
                <a href="delete.php?id=<?= $prod['id'] ?>"></a>
            </td>
            -->
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>