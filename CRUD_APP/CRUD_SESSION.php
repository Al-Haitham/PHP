<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Gestion des Produits</title>
    <?php
    session_start();

    if (!isset($_SESSION["produits"])) {
        $_SESSION["produits"] = [];
    }

    if (isset($_GET['delete'])) {
        $i = $_GET['delete'];
        // Optionally delete the image file from disk too
        if (isset($_SESSION['produits'] [$i] ['imgURL'])) {
            $filePath = ltrim($_SESSION['produits'] [$i] ['imgURL'], '/');
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        unset($_SESSION['produits'] [$i]);
        $_SESSION['produits'] = array_values($_SESSION['produits']);
    }

    $prodRef = uniqid();
    $lib     = "prod" . $prodRef;
    $categoriesList = ["alimentaire", "bureautique", "menage"];
    $paysList       = ["maroc", "france", "espagne"];
    $uploadError    = "";

    if (isset($_POST["submit"])) {
        $prodRef       = $_POST["prodRef"]   ?? uniqid();
        $lib           = $_POST["lib"]        ?? "prod" . $prodRef;
        $categorie     = $_POST["category"]   ?? '';
        $prix          = $_POST["prix"]        ?? '';
        $paysSelected  = $_POST["pays"]        ?? [];
        $dispo         = $_POST["dispo"]       ?? '';
        $imgURL        = "";

        // ── Image upload logic ──────────────────────────────────────────────
        $uploadDir = "uploads/";

        // Create the uploads folder if it doesn't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        if (isset($_FILES["image"]) && $_FILES["image"] ["error"] === UPLOAD_ERR_OK) {

            $allowedTypes = ["image/jpeg", "image/png", "image/gif", "image/webp"];
            $maxSize      = 2 * 1024 * 1024; // 2 MB

            $fileTmpPath  = $_FILES["image"] ["tmp_name"];
            $fileSize     = $_FILES["image"] ["size"];
            $fileMimeType = mime_content_type($fileTmpPath); // safer than trusting $_FILES["type"]
            $fileExt      = strtolower(pathinfo($_FILES["image"] ["name"], PATHINFO_EXTENSION));

            if (!in_array($fileMimeType, $allowedTypes)) {
                $uploadError = "Type de fichier non autorisé. Utilisez JPG, PNG, GIF ou WEBP.";
            } elseif ($fileSize > $maxSize) {
                $uploadError = "L'image ne doit pas dépasser 2 Mo.";
            } else {
                // Build a unique filename to avoid collisions
                $newFileName = uniqid("img_", true) . "." . $fileExt;
                $destPath    = $uploadDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    $imgURL = "/" . $destPath; // store a web-accessible path
                } else {
                    $uploadError = "Erreur lors du déplacement du fichier uploadé.";
                }
            }
        } else if (isset($_FILES["image"]) && $_FILES["image"] ["error"] !== UPLOAD_ERR_NO_FILE) {
            // Map PHP upload error codes to readable messages
            $uploadErrors = [
                UPLOAD_ERR_INI_SIZE   => "Le fichier dépasse la limite upload_max_filesize du serveur.",
                UPLOAD_ERR_FORM_SIZE  => "Le fichier dépasse la limite MAX_FILE_SIZE du formulaire.",
                UPLOAD_ERR_PARTIAL    => "Le fichier n'a été que partiellement uploadé.",
                UPLOAD_ERR_NO_TMP_DIR => "Dossier temporaire manquant.",
                UPLOAD_ERR_CANT_WRITE => "Impossible d'écrire le fichier sur le disque.",
                UPLOAD_ERR_EXTENSION  => "Upload bloqué par une extension PHP.",
            ];
            $uploadError = $uploadErrors[$_FILES["image"] ["error"]] ?? "Erreur d'upload inconnue.";
        } else {
            $uploadError = "Veuillez sélectionner une image.";
        }
        // ────────────────────────────────────────────────────────────────────

        // Only save the product if everything is valid
        if (
            empty($uploadError) &&
            !empty($lib) &&
            !empty($categorie) &&
            !empty($imgURL) &&
            $prix > 0 &&
            !empty($dispo) &&
            !empty($paysSelected)
        ) {
            $data = [
                "prodRef"   => $prodRef,
                "lib"       => $lib,
                "categorie" => $categorie,
                "imgURL"    => $imgURL,
                "prix"      => $prix,
                "pays"      => $paysSelected,
                "dispo"     => $dispo,
            ];
            $_SESSION["produits"] [] = $data;

            // Reset for a fresh form
            $prodRef = uniqid();
            $lib     = "prod" . $prodRef;
        }
    }
    ?>
</head>
<body>
    <div class="container mt-3 col-8">
        <h1 class="text-center mb-4">Gestion des Produits</h1>

        <?php if (!empty($uploadError)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($uploadError) ?></div>
        <?php endif; ?>

        <form action="" method="POST" enctype="multipart/form-data" class="card p-4 shadow mb-4">

            <div class="mb-3">
                <label for="lib" class="form-label">Libellé du Produit</label>
                <input class="form-control" type="text" id="lib" name="lib"
                       placeholder="Nom du produit..." required>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Catégorie</label>
                <select class="form-select" id="category" name="category" required>
                    <option value="" selected disabled>Sélectionnez une catégorie...</option>
                    <?php foreach ($categoriesList as $ctg): ?>
                        <option value="<?= $ctg ?>"><?= $ctg ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image du Produit</label>
                <input class="form-control" type="file" name="image" id="image"
                       accept="image/jpeg,image/png,image/gif,image/webp" required>
                <div class="form-text">Formats acceptés : JPG, PNG, GIF, WEBP — max 2 Mo.</div>
            </div>

            <div class="mb-3">
                <label for="prix" class="form-label">Prix (MAD)</label>
                <input class="form-control" type="number" id="prix" step="0.01"
                       name="prix" placeholder="0.00" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Pays d'origine</label>
                <div>
                    <?php foreach ($paysList as $p): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"
                                   id="pays_<?= $p ?>" name="pays[]" value="<?= $p ?>">
                            <label class="form-check-label" for="pays_<?= $p ?>">
                                <?= $p ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Disponibilité</label>
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio"
                               id="dispo_oui" value="oui" name="dispo" required>
                        <label class="form-check-label" for="dispo_oui">Oui</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio"
                               id="dispo_non" value="non" name="dispo" required>
                        <label class="form-check-label" for="dispo_non">Non</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100" name="submit">
                Ajouter Produit
            </button>
        </form>

        <div class="row g-3">
            <?php foreach ($_SESSION["produits"] as $index => $produit): ?>
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="<?= htmlspecialchars($produit["imgURL"]) ?>"
                             alt="<?= htmlspecialchars($produit["lib"]) ?>"
                             class="card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($produit["lib"]) ?></h5>
                            <p class="card-text">
                                <small class="text-muted">Ref: <?= $produit["prodRef"] ?></small>
                            </p>
                            <p class="card-text"><strong><?= $produit["prix"] ?> MAD</strong></p>
                            <p class="card-text">
                                <small>Catégorie: <?= htmlspecialchars($produit["categorie"]) ?></small>
                            </p>
                            <p class="card-text">
                                <small>Disponible: <?= htmlspecialchars($produit["dispo"]) ?></small>
                            </p>
                        </div>
                        <div class="card-footer bg-white border-top">
                            <a href="?delete=<?= $index ?>" class="btn btn-danger btn-sm w-100">
                                Supprimer
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>