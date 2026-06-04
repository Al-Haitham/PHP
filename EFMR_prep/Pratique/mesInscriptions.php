<?php
session_start();
require 'config.php';

// redirct si pas connecter
if (!isset($_SESSION['stagiaire_id'])) {
    header('Location: connexion.php');
    exit;
}

$stagiaire_id=$_SESSION['stagiaire_id'];

$stmt=$pdo->prepare("SELECT nom, prenom FROM stagiaires WHERE id=?");
$stmt->execute([$stagiaire_id]);
$stagiaire=$stmt->fetch();

$sql="SELECT i.id, i.date_inscription, f.titre as formation, f.duree, f.prix 
        FROM inscriptions i
        JOIN formations f ON i.formation_id=f.id
        WHERE i.stagiaire_id=?";
$stmt=$pdo->prepare($sql);
$stmt->execute([$stagiaire_id]);
$inscriptions=$stmt->fetchAll();

// 3. Déterminer la salutation selon l'heure
$heure=(int)date('H');
$salutation=($heure>=19||$heure<6)?"Bonsoir":"Bonjour";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Inscriptions</title>
</head>
<body>

    <h1>
        <?= $salutation ?>, <?= htmlspecialchars($stagiaire['prenom'] ?? '') ?> <?= htmlspecialchars($stagiaire['nom'] ?? '') ?>
        <a href="deconnexion.php" class="logout">Déconnexion</a>
    </h1>

    <h2>Mes Inscriptions</h2>

    <?php if (count($inscriptions)>0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID Inscription</th>
                    <th>Date Inscription</th>
                    <th>Formation</th>
                    <th>Durée</th>
                    <th>Prix</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($inscriptions as $insc): ?>
                    <tr>
                        <td><?= $insc['id'] ?></td>
                        <td><?= date('d/m/Y', strtotime($insc['date_inscription'])) ?></td>
                        <td><?= htmlspecialchars($insc['formation']) ?></td>
                        <td><?= htmlspecialchars($insc['duree']) ?></td>
                        <td><?= number_format($insc['prix'], 2) ?> €</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucune inscription trouvée.</p>
    <?php endif; ?>

</body>
</html>