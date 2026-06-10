<?php
session_start();
require_once ('config.php');

$erreur="";

if($_SERVER['REQUEST_METHOD']=='POST'){
    $username=$_POST['username'];
    $password=$_POST['password'];

    if(empty($username) || empty($password)){
        $erreur="Veuillez saisir vos infos de connexion !";
    }
    else{
        $req='SELECT * FROM users WHERE username=?';
        $stmt=$cnx->prepare($req);
        $stmt->execute([$username]);
        $user=$stmt->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password, $user['password'])){
            $_SESSION['user_id']=$user['id'];
            $_SESSION['username']=$user['username'];
            header("Location:ajout.php");
            exit;
        }
        
        elseif(!password_verify($password,$user['password'])){
            $error="mot de passe incorrects !";
            exit;
        }elseif(!$user){
            $error="mot de passe incorrects !";
            exit;
        }

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