<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Gestion des Produits</title>
    <?php
    session_start();
    if (!isset($_SESSION["produits"])){
        $_SESSION["produits"]=[];
    }

    if (isset($_GET['delete'])) {
        $i=$_GET['delete'];
        unset($_SESSION['produits'] [$i]);
        $_SESSION['produits']=array_values($_SESSION['produits']);
    }

    $prodRef=$lib=$categorie=$imgURL=$prix=$dispo="";
    $pays=[];
    
    $prodRef=uniqid();
    $lib="prod".$prodRef;
    $categoriesList=["alimentaire", "bureautique", "menage"];
    $imgURL="";
    $prix=0;
    $paysList=["maroc", "france", "espagne"];
    $dispo="";
    
    if (isset($_POST["submit"])){
        $prodRef=$_POST["prodRef"]??uniqid();
        $lib=$_POST["lib"]??"prod".$prodRef;
        $categorie=$_POST["category"]??'';
        $img=$_FILES["img"]["name"]??'';
        $prix=$_POST["prix"]??'';
        $paysSelected=$_POST["pays"]??[];
        $dispo=$_POST["dispo"]??'';

        // Validation (basic example)
        if (!empty($lib)&&!empty($categorie)&&!empty($imgURL)&&$prix>0&&!empty($dispo)&&!empty($paysSelected)) {
            $data=[
                "prodRef"=>$prodRef,
                "lib"=>$lib,
                "categorie"=>$categorie,
                "imgURL"=>$imgURL,
                "prix"=>$prix,
                "pays"=>$paysSelected,
                "dispo"=>$dispo,
            ];
            $_SESSION["produits"][]=$data;
            // Reset form
            $prodRef=uniqid();
            $lib="prod".$prodRef;
        }
    }
    ?>
</head>
<body>
    <div class="container mt-3 col-8">
        <h1 class="text-center mb-4">Gestion des Produits</h1>
        
        <form action="" method="POST" enctype="multipart/form-data" class="card p-4 shadow mb-4">
            
            <div class="mb-3">
                <label for="lib" class="form-label">Libellé du Produit</label>
                <input class="form-control" type="text" id="lib" name="lib" placeholder="Nom du produit..." required>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Catégorie</label>
                <select class="form-select" id="category" name="category" required>
                    <option value="" selected disabled>Sélectionnez une catégorie...</option>
                    <?php foreach($categoriesList as $ctg): ?>
                        <option value="<?= $ctg ?>"><?= $ctg ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <input type="file" name="image" id="image" accept="image/*">
                <input type="submit" value="Upload Image" name="submit">
            </div>

            <div class="mb-3">
                <label for="prix" class="form-label">Prix (MAD)</label>
                <input class="form-control" type="number" id="prix" step="0.01" name="prix" placeholder="0.00" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Pays d'origine</label>
                <div>
                    <?php foreach($paysList as $p): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="pays_<?= $p ?>" name="pays[]" value="<?= $p ?>">
                            <label class="form-check-label" for="pays_<?= $p ?>">
                                <?=$p ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Disponibilité</label>
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="dispo_oui" value="oui" name="dispo" required>
                        <label class="form-check-label" for="dispo_oui">Oui</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="dispo_non" value="non" name="dispo" required>
                        <label class="form-check-label" for="dispo_non">Non</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100" name="submit">Ajouter Produit</button>
        </form>

        <div class="row g-3">
            <?php foreach($_SESSION["produits"] as $index=>$produit): ?>
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="<?= $produit["imgURL"] ?>" alt="<?= $produit["lib"] ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $produit["lib"] ?></h5>
                            <p class="card-text"><small class="text-muted">Ref: <?= $produit["prodRef"] ?></small></p>
                            <p class="card-text"><strong><?= $produit["prix"] ?> MAD</strong></p>
                            <p class="card-text"><small>Catégorie: <?= $produit["categorie"] ?></small></p>
                            <p class="card-text"><small>Disponible: <?= $produit["dispo"] ?></small></p>
                        </div>
                        <div class="card-footer bg-white border-top">
                            <a href="?delete=<?= $index ?>" class="btn btn-danger btn-sm w-100">Supprimer</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>