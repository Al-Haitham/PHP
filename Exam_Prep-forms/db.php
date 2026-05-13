<?php
session_start();

// Vérification de sécurité : si les données ne sont pas là, on renvoie au formulaire
if (!isset($_SESSION['form_data'])) {
    header("Location: review01.php");
    exit();
}

$data = $_SESSION['form_data'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Données enregistrées</title>
    <style>
        body { font-family: sans-serif; max-width: 700px; margin: 2rem auto; background-color: #f9f9f9; }
        .container { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h2 { color: #2c3e50; border-bottom: 2px solid #eee; padding-bottom: 10px; }
        .row { margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px; }
        .label { font-weight: bold; color: #555; display: inline-block; width: 150px; }
        .value { color: #333; }
        .list-item { display: inline-block; background: #eef; padding: 2px 6px; border-radius: 4px; margin-right: 5px; font-size: 0.9em; }
        a { display: inline-block; margin-top: 20px; color: #007bff; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="container">
    <h2>Récapitulatif des données</h2>
    
    <div class="row">
        <span class="label">Nom :</span>
        <span class="value"><?php echo htmlspecialchars($data['nom']); ?></span>
    </div>

    <div class="row">
        <span class="label">Email :</span>
        <span class="value"><?php echo htmlspecialchars($data['email']); ?></span>
    </div>

    <div class="row">
        <span class="label">URL :</span>
        <span class="value"><a href="<?php echo htmlspecialchars($data['url']); ?>" target="_blank"><?php echo htmlspecialchars($data['url']); ?></a></span>
    </div>

    <div class="row">
        <span class="label">Âge :</span>
        <span class="value"><?php echo htmlspecialchars($data['age']); ?> ans</span>
    </div>

    <div class="row">
        <span class="label">Ville :</span>
        <span class="value"><?php echo htmlspecialchars($data['ville']); ?></span>
    </div>

    <div class="row">
        <span class="label">Genres :</span>
        <span class="value"><?php echo htmlspecialchars($data['genre']); ?></span>
    </div>

    <div class="row">
        <span class="label">Langues :</span>
        <span class="value">
            <?php 
            if (!empty($data['langues'])) {
                foreach ($data['langues'] as $lang) {
                    echo "<span class='list-item'>" . htmlspecialchars($lang) . "</span>";
                }
            } else {
                echo "Aucune";
            }
            ?>
        </span>
    </div>

    <div class="row">
        <span class="label">Compétences :</span>
        <span class="value">
            <?php 
            if (!empty($data['skills'])) {
                foreach ($data['skills'] as $skill) {
                    echo "<span class='list-item'>" . htmlspecialchars($skill) . "</span>";
                }
            } else {
                echo "Aucune";
            }
            ?>
        </span>
    </div>

    <div class="row">
        <span class="label">Adresse :</span>
        <span class="value"><?php echo nl2br(htmlspecialchars($data['adresse'])); ?></span>
    </div>

    <a href="review01.php">Retour au formulaire</a>
</div>

<?php
// Optionnel : on peut vider la session après affichage si on ne veut pas garder les données
// session_destroy(); 
?>

</body>
</html>