<?php
session_start();
require_once ('config.php');
if($_SERVER['REQUEST_METHOD']=='POST'){
    $username=$_POST['username'];
    $password=$_POST['password'];

    $stmt=$pdo->prepare('SELECT * FROM users WHERE username=?');
    $stmt->execute([$username]);
    $row=$stmt->fetch();

    if($row && password_verify($password, $row['password'])){
        $_SESSION['user_id']=$row['id'];
        $_SESSION['username']=$row['username'];
        header("Location:ajout.php");
        exit;
    }else{
        $error="identifiants incorrects! ";
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form method="POST">
        <?php if(!isset($error)){ ?>
            <p class="alert alert-danger"><?= $error ?></p>
        <?php }?>
        
        <input type="text" name="username" placeholder="utilisateur">
        <input type="password" placeholder="mot de passe">
        <button type="submit">Connexion</button>
    </form>
</body>
</html>