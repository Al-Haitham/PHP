<?php
$expiration = time()+(7*24*60*60);

setcookie("theme", "sombre", $expiration, "/");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion du Thème</title>
</head>
<body>

    <?php
    if (isset($_COOKIE['theme'])) {
        echo "Theme actuel: ".htmlspecialchars($_COOKIE['theme']);
    } else {
        echo "Aucun thème sélectionné";
    }
    ?>

</body>
</html>