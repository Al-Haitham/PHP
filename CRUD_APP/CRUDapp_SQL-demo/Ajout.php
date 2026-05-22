<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];

    $sql="INSERT INTO users (name, email, phone) VALUES(:name, :email, :phone)";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(['name'=>$name,'email'=>$email,'phone'=>$phone]);

    header("Location:listUsers.php");
    exit;
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
    <form method="POST">
        <h2>Gestion des produits</h2>
        <input type="text" name="name" placeholder="Name.." required><br>
        <input type="email" name="email" placeholder="Email.." required><br>
        <input type="text" name="phone" placeholder="Phone.." required><br>
        <button type="submit">Add user</button>
    </form>
</body>
</html>