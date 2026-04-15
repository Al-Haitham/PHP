<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
    <?php
    $errors=[];

    if($_SERVER["REQUEST_METHOD"]=="POST") {

        if(empty($_POST["fname"]) || !preg_match("/^[A-Z] [a-zA-Z]{3,}$/", $_POST["fname"]))
            $errors["fname"]="Prénom invalide (majuscule + min. 3 lettres).";

        if(empty($_POST["annee"]) || $_POST["annee"] < 18 || $_POST["annee"] > 70)
            $errors["annee"]="L'âge doit être entre 18 et 70.";

        if(empty($_POST["town"]))
            $errors["town"]="La ville est obligatoire.";

        if(!isset($_POST["lng"]))
            $errors["lng"]="Choisir au moins une langue.";

        if(!isset($_POST["gender"]))
            $errors["gender"]="Le genre est obligatoire.";

        if(!isset($_POST["skills"]))
            $errors["skills"]="Choisir au moins un skill.";

        if(empty($_POST["details"]))
            $errors["details"]="Les détails sont obligatoires.";
    }
    ?>
</head>
<body>
    <div class="container w-75 mx-auto p-4">
        <form action="page1.php" method="POST">
            <div class="mb-3">
                <label for="prenom">Prenom</label>
                <input type="text" name="fname" id="prenom" class="form-control">
                <?php echo $errors["fname"]?>
            </div>
            <div class="mb-3">
                <label for="age">Age</label>
                <input type="number" name="annee" id="age" class="form-control">
                <?php if(isset($errors["annee"])): ?>
                    <small class="text-danger"><?= $errors["annee"] ?></small>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="ville">ville</label>
                <select name="town" id="ville" class="form-select">
                    <option value="" selected disabled>choisir une ville ....</option>
                    <option value="Agadir">Agadir</option>
                    <option value="Safi">Safi</option>
                    <option value="Rabat">Rabat</option>
                </select>
                <?php if(isset($errors["town"])): ?>
                    <small class="text-danger"><?= $errors["town"] ?></small>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="langues">Langues</label>
                <select name="lng[]" multiple id="langues" class="form-select">
                    <option value="Arabe" selected disabled>Arabe</option>
                    <option value="Français">Français</option>
                    <option value="Anglais">Anglais</option>
                    <option value="Espagnol">Espagnol</option>
                </select>
                <?php if(isset($errors["lng"])): ?>
                    <small class="text-danger"><?= $errors["lng"] ?></small>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="gente">Gente</label>
                <div class="form-check form-check-inline">
                    <input type="radio" checked id="male" class="form-check-input" name="gender" value="male">
                    <label for="male" class="form-check-label">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" id="female" class="form-check-input" name="gender" value="female">
                    <label for="female" class="form-check-label">Female</label>
                </div>
                <?php if(isset($errors["gender"])): ?>
                    <small class="text-danger"><?= $errors["gender"] ?></small>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="skills">Skills</label>
                <div class="form-check form-check-inline">
                    <input type="checkbox" id="python" class="form-check-input" name="skills[]" value="python">
                    <label for="python" class="form-check-label">Python</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="checkbox" id="javascript" class="form-check-input" name="skills[]" value="javascript">
                    <label for="javascript" class="form-check-label">javascript</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="checkbox" id="php" class="form-check-input" name="skills[]" value="php">
                    <label for="php" class="form-check-label">php</label>
                </div>
                <?php if(isset($errors["skills"])): ?>
                    <small class="text-danger"><?= $errors["skills"] ?></small>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="details">Details</label>
                <textarea name="details" id="details"></textarea>
                <?php if(isset($errors["details"])): ?>
                    <small class="text-danger"><?= $errors["details"] ?></small>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>