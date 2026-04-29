<?php
session_start();

// Initialisation des variables
$errors = [];
$old_data = [];

// Si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération et nettoyage des données
    $nom = trim($_POST['nom'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $url = trim($_POST['url'] ?? '');
    $age = trim($_POST['age'] ?? '');
    $ville = $_POST['ville'] ?? '';
    $langues = $_POST['langues'] ?? [];
    $genre = $_POST['genre'] ?? '';
    $skills = $_POST['skills'] ?? [];
    $adresse = trim($_POST['adresse'] ?? '');

    // Stockage temporaire pour ré-afficher les données
    $old_data = [
        'nom' => $nom, 'email' => $email, 'url' => $url, 'age' => $age,
        'ville' => $ville, 'langues' => $langues, 'genre' => $genre,
        'skills' => $skills, 'adresse' => $adresse
    ];

    // --- VALIDATION ---

    // 1. Nom
    if (empty($nom)) {
        $errors['nom'] = "Le nom est requis.";
    } elseif (strlen($nom) < 4) {
        $errors['nom'] = "Le nom doit contenir au moins 4 caractères.";
    } elseif (!preg_match('/^[A-Z]+$/', $nom)) {
        $errors['nom'] = "Le nom doit être uniquement en majuscules (A-Z).";
    }

    // 2. Email
    if (empty($email)) {
        $errors['email'] = "L'email est requis.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Format d'email invalide.";
    }

    // 3. URL
    if (empty($url)) {
        $errors['url'] = "L'URL est requise.";
    } elseif (!filter_var($url, FILTER_VALIDATE_URL)) {
        $errors['url'] = "Format d'URL invalide.";
    }

    // 4. Age
    if (empty($age)) {
        $errors['age'] = "L'âge est requis.";
    } elseif (!filter_var($age, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]])) {
        $errors['age'] = "L'âge doit être un nombre entier positif.";
    }

    // 5. Ville
    if (empty($ville)) {
        $errors['ville'] = "La ville est requise.";
    }

    // 6. Langues (Multiple)
    if (empty($langues) || !is_array($langues) || count($langues) === 0) {
        $errors['langues'] = "Veuillez sélectionner au moins une langue.";
    }

    // 7. Genre
    if (empty($genre)) {
        $errors['genre'] = "Veuillez sélectionner votre genre.";
    }

    // 8. Skills (Checkbox)
    if (empty($skills) || !is_array($skills) || count($skills) === 0) {
        $errors['skills'] = "Veuillez sélectionner au moins un skill.";
    }

    // Gestion de la redirection ou des erreurs
    if (empty($errors)) {
        $_SESSION['form_data'] = $old_data;
        header("Location: db.php");
        exit();
    } else {
        $_SESSION['form_data'] = $old_data;
        $_SESSION['form_errors'] = $errors;
    }
} else {
    unset($_SESSION['form_errors']);
    unset($_SESSION['form_data']);
}

// Récupération des données de session pour l'affichage
$current_data = $_SESSION['form_data'] ?? [];
$current_errors = $_SESSION['form_errors'] ?? [];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Bootstrap</title>
    <!-- Lien CDN Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Formulaire de Candidature</h4>
                </div>
                <div class="card-body">
                    
                    <form action="index.php" method="POST">
                        
                        <!-- Nom -->
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom (Min 4 majuscules)</label>
                            <input type="text" class="form-control <?php echo isset($current_errors['nom']) ? 'is-invalid' : ''; ?>" 
                                   id="nom" name="nom" value="<?php echo htmlspecialchars($current_data['nom'] ?? ''); ?>">
                            <div class="invalid-feedback"><?php echo $current_errors['nom'] ?? ''; ?></div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control <?php echo isset($current_errors['email']) ? 'is-invalid' : ''; ?>" 
                                   id="email" name="email" value="<?php echo htmlspecialchars($current_data['email'] ?? ''); ?>">
                            <div class="invalid-feedback"><?php echo $current_errors['email'] ?? ''; ?></div>
                        </div>

                        <!-- URL -->
                        <div class="mb-3">
                            <label for="url" class="form-label">URL</label>
                            <input type="url" class="form-control <?php echo isset($current_errors['url']) ? 'is-invalid' : ''; ?>" 
                                   id="url" name="url" value="<?php echo htmlspecialchars($current_data['url'] ?? ''); ?>">
                            <div class="invalid-feedback"><?php echo $current_errors['url'] ?? ''; ?></div>
                        </div>

                        <!-- Age -->
                        <div class="mb-3">
                            <label for="age" class="form-label">Âge</label>
                            <input type="number" class="form-control <?php echo isset($current_errors['age']) ? 'is-invalid' : ''; ?>" 
                                   id="age" name="age" value="<?php echo htmlspecialchars($current_data['age'] ?? ''); ?>">
                            <div class="invalid-feedback"><?php echo $current_errors['age'] ?? ''; ?></div>
                        </div>

                        <!-- Ville -->
                        <div class="mb-3">
                            <label for="ville" class="form-label">Ville</label>
                            <select class="form-select <?php echo isset($current_errors['ville']) ? 'is-invalid' : ''; ?>" id="ville" name="ville">
                                <option value="">-- Choisir une ville --</option>
                                <option value="Paris" <?php echo ( ($current_data['ville'] ?? '') === 'Paris' ) ? 'selected' : ''; ?>>Paris</option>
                                <option value="Lyon" <?php echo ( ($current_data['ville'] ?? '') === 'Lyon' ) ? 'selected' : ''; ?>>Lyon</option>
                                <option value="Marseille" <?php echo ( ($current_data['ville'] ?? '') === 'Marseille' ) ? 'selected' : ''; ?>>Marseille</option>
                            </select>
                            <div class="invalid-feedback"><?php echo $current_errors['ville'] ?? ''; ?></div>
                        </div>

                        <!-- Langues (Multiple) -->
                        <div class="mb-3">
                            <label for="langues" class="form-label">Langues (Ctrl+Clic pour multiples)</label>
                            <select class="form-select <?php echo isset($current_errors['langues']) ? 'is-invalid' : ''; ?>" id="langues" name="langues[]" multiple size="4">
                                <option value="Francais" <?php echo in_array('Francais', $current_data['langues'] ?? []) ? 'selected' : ''; ?>>Français</option>
                                <option value="Anglais" <?php echo in_array('Anglais', $current_data['langues'] ?? []) ? 'selected' : ''; ?>>Anglais</option>
                                <option value="Espagnol" <?php echo in_array('Espagnol', $current_data['langues'] ?? []) ? 'selected' : ''; ?>>Espagnol</option>
                                <option value="Arabe" <?php echo in_array('Arabe', $current_data['langues'] ?? []) ? 'selected' : ''; ?>>Arabe</option>
                            </select>
                            <div class="invalid-feedback d-block"><?php echo $current_errors['langues'] ?? ''; ?></div>
                        </div>

                        <!-- Genre (Radio) -->
                        <div class="mb-3">
                            <label class="form-label d-block">Genre</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="genre" id="genreH" value="H" <?php echo ( ($current_data['genre'] ?? '') === 'H' ) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="genreH">Homme</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="genre" id="genreF" value="F" <?php echo ( ($current_data['genre'] ?? '') === 'F' ) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="genreF">Femme</label>
                            </div>
                            <div class="text-danger mt-2" style="font-size: 0.9em;">
                                <?php echo $current_errors['genre'] ?? ''; ?>
                            </div>
                        </div>

                        <!-- Skills (Checkbox) -->
                        <div class="mb-3">
                            <label class="form-label d-block">Compétences (Skills)</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="skills[]" id="skillPHP" value="PHP" <?php echo in_array('PHP', $current_data['skills'] ?? []) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="skillPHP">PHP</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="skills[]" id="skillJS" value="JS" <?php echo in_array('JS', $current_data['skills'] ?? []) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="skillJS">JavaScript</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="skills[]" id="skillHTML" value="HTML" <?php echo in_array('HTML', $current_data['skills'] ?? []) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="skillHTML">HTML/CSS</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="skills[]" id="skillSQL" value="SQL" <?php echo in_array('SQL', $current_data['skills'] ?? []) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="skillSQL">SQL</label>
                            </div>
                            <div class="text-danger mt-2" style="font-size: 0.9em;">
                                <?php echo $current_errors['skills'] ?? ''; ?>
                            </div>
                        </div>

                        <!-- Adresse (Textarea) -->
                        <div class="mb-3">
                            <label for="adresse" class="form-label">Adresse détaillée</label>
                            <textarea class="form-control" id="adresse" name="adresse" rows="3"><?php echo htmlspecialchars($current_data['adresse'] ?? ''); ?></textarea>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script JS Bootstrap (optionnel pour les interactions avancées) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>