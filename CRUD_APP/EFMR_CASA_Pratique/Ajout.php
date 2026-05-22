<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $Code_produit=$_POST['Code_produit'];
    $Designation=$_POST['Designation'];
    $Prix_Unitaire=$_POST['Prix_Unitaire'];
    $stock=$_POST['stock'];

    $sql="INSERT INTO produit (Designation, Prix_Unitaire, stock) VALUES(:Designation, :Prix_Unitaire, :stock)";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(['Code_produit'=>$Code_produit,'Designation'=>$Designation,'Prix_Unitaire'=>$Prix_Unitaire, 'stock'=>$stock]);

    header("Location:lister.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta Code_produit="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <h2>Gestion des produits</h2>
        <input type="text" name="Code_produit" placeholder="Code_produit.." required><br>
        <input type="text" name="Designation" placeholder="Designation.." required><br>
        <input type="number" step=0.5 name="Prix_Unitaire" placeholder="Prix_Unitaire.." required><br>
        <input type="number" name="stock" placeholder="Stock.." required><br>
        <button type="submit">Add user</button>
    </form>
</body>
</html>