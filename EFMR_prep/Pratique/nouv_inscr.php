<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['id'])) {
    header('Location: connexion.php');
    exit;
}

$id_stagiaire=$_SESSION['id'];
$erreur='';
$succes='';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['envoyer'])) {
    
    $identifiant=trim($_POST['identifiant']);
    $id_formation=$_POST['formation'];

    if (!preg_match('/^INSI\d{5}$/', $identifiant)) {
        $erreur="L'identifiant doit être au format INSI12345 (ex: INSI12345).";
    } else {
        $stmt=$pdo->prepare("SELECT id FROM inscriptions WHERE identifiant=?");
        $stmt->execute([$identifiant]);
        if ($stmt->fetch()) {
            $erreur="Cet identifiant d'inscription existe déjà.";
        } else {
            $stmt=$pdo->prepare("SELECT places_disponibles FROM formations WHERE id=?");
            $stmt->execute([$id_formation]);
            $formation=$stmt->fetch();

            if (!$formation || $formation['places_disponibles']<=0) {
                $erreur="Cette formation est complète.";
            } else {
                $target_dir="documents/";
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }

                $fichier=$_FILES['justificatif'];
                $ext=strtolower(pathinfo($fichier['name'], PATHINFO_EXTENSION));
                $nom_fichier=uniqid() . '.' . $ext;
                $target_file=$target_dir . $nom_fichier;

                if ($ext!=='pdf' || $fichier['size'] > 5000000) {
                    $erreur="Seul un fichier PDF de moins de 5 Mo est autorisé.";
                } elseif (!move_uploaded_file($fichier['tmp_name'], $target_file)) {
                    $erreur="Erreur lors du téléchargement du justificatif.";
                } else {
                    $date_inscription=date('Y-m-d H:i:s');
                    $stmt=$pdo->prepare("INSERT INTO inscriptions (id_stagiaire, id_formation, identifiant, date_inscription, justificatif) VALUES (?, ?, ?, ?, ?)");
                    $stmt->execute([$id_stagiaire, $id_formation, $identifiant, $date_inscription, $nom_fichier]);

                    $stmt=$pdo->prepare("UPDATE formations SET places_disponibles=places_disponibles - 1 WHERE id=?");
                    $stmt->execute([$id_formation]);

                    $succes="Inscription réussie !";
                    header('Location: mesInscriptions.php?msg=1');
                    exit;
                }
            }
        }
    }
}

$stmt=$pdo->query("SELECT id, titre, places_disponibles FROM formations WHERE places_disponibles > 0 ORDER BY titre");
$formations=$stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouvelle Inscription</title>
</head>
<body>

<h1>Nouvelle Inscription</h1>
    <?php if ($erreur){ ?>
        <p class="error"><?= htmlspecialchars($erreur) ?></p>
    <?php };?>
    <?php if (isset($_GET['msg']) && $_GET['msg'] == '1'){?>
        <p class="success">Inscription enregistrée avec succès !</p>
    <?php }; ?>

<form method="POST" action="" enctype="multipart/form-data">
    
    <label for="identifiant">Identifiant d'inscription :</label>
    <input type="text" name="identifiant" id="identifiant" placeholder="INSI12345" required value="<?= htmlspecialchars($_POST['identifiant'] ?? '') ?>">

    <label for="formation">Formation :</label>
    <select name="formation" id="formation" required>
        <option value="">Choisir une formation</option>
        <?php foreach ($formations as $f){?>
            <option value="<?= $f['id'] ?>" <?= ($f['id'] == ($_POST['formation'] ?? '')) ? 'selected' : '' ?>>
                <?= htmlspecialchars($f['titre']) ?>(<?= $f['places_disponibles'] ?> places)
            </option>
        <?php }; ?>
    </select>

    <label for="justificatif">Justificatif (PDF) :</label>
    <input type="file" name="justificatif" id="justificatif" accept=".pdf" required>

    <button type="submit" name="envoyer">Valider l'inscription</button>
</form>

</body>
</html>