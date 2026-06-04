<?php
session_start();
require_once 'config.php';

$erreur='';

// validation form
if (isset($_POST['send'])) {
    $login=trim($_POST['login']);
    $password=$_POST['password'];

    //verifier les champs vides
    if (empty($login) || empty($password)) {
        $erreur="Veuillez saisir vos infos !";
    } else {
        //verifier si user exist
        $sql="SELECT * FROM Stagiaire WHERE login=?";
        $req=$pdo->prepare($sql);
        $req->execute([$login]);
        $stagiaire=$req->fetch(PDO::FETCH_ASSOC);

        if (!$stagiaire) {
            $erreur="Ce login n'existe pas !";
        } 
        // verifier pw
        elseif (!password_verify($password, $stagiaire['motDePasse'])) {
            $erreur="Ce mot de passe est incorrect !";
        } 
        // create sess
        else {
            $_SESSION['id']=$stagiaire['idStagiaire'];
            $_SESSION['nom']=$stagiaire['nom'];
            $_SESSION['prenom']=$stagiaire['prenom'];
            
            // redirection
            header('Location: mesInscription.php');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>

<div class="login-box">
    <h2>Connexion</h2>
    
    <!--affiche erreur-->
    <?php if (!empty($erreur)): ?>
        <div class="error"><?= htmlspecialchars($erreur) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <input type="text" name="login" placeholder="Login" required value="<?= htmlspecialchars($_POST['login'] ?? '') ?>">
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit" name="send">Se connecter</button>
    </form>
</div>

</body>
</html>