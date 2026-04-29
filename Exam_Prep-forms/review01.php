<?php
session_start();

$errors=[];
$old_data=[];

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $nom=trim($_POST['nom']??'');
    $email=trim($_POST['email']??'');
    $url=trim($_POST['url']??'');
    $age=trim($_POST['age']??0);
    $ville=$_POST['ville']??'';
    $langues=$_POST['langues']??[];
    $genre=$_POST['genre']??'';
    $skills=$_POST['skills']??[];
    $adresse=trim($_POST['adresse']??'');

    $old_data=[
        'nom'=>$nom,'email'=>$email,'url'=>$url,'age'=>$age,'ville'=>$ville,
        'langues'=>$langues,'genre'=>$genre,'skills'=>$skills,'adresse'=>$adresse
    ];

    if (empty($nom)){
        $errors['nom']="le nom est obligatoire!";
    }elseif (!preg_match('/^[A-Z]{4,}$/',$nom)){
        $errors['nom']="le nom doit contenir au moins 4 caractéres, tout en majuscules!";
    }

    if (empty($email)){
        $errors['email']="l'email est obligatoire!";
    }elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors['email']="l'email est d'une format invalid!";
    }

    if (empty($url)){
        $errors['url']="l'url est obligatoire!";
    }elseif (!filter_var($url,FILTER_VALIDATE_URL)){
        $errors['url']="l'url est d'une format invalid!";
    }

    if (empty($age)){
        $errors['age']="l'age est obligatoire!";
    }elseif (!filter_var($age,FILTER_VALIDATE_INT,["options" =>["min_range"=>1]])){
        $errors['age']="l'age est invalid!";
    }

    if (empty($ville)){
        $errors['ville']="la ville est obligatoire!";
    }

    if (empty($langues)||!is_array($langues)||count($langues)===0){
        $errors['langues']="au moins une langue doit etre selectioné!";
    }

    if (empty($genre)){
        $errors['genre']="genre est obligatoire!";
    }

    if (empty($skills)||!is_array($skills)||count($skills)===0){
        $errors['skills']="au moins un competence doit etre selectioné!";
    }

    if (empty($errors)){
        $_SESSION['form_data']=$old_data;
        header("Location: db.php");
        exit();
    }else{
        $_SESSION['form_data']=$old_data;
        $_SESSION['form_errors']=$errors;
    }
}else{
    unset($_SESSION['form_data']);
    unset($_SESSION['form_errors']);
}

$current_data=$_SESSION['form_data']??[];
$current_errors=$_SESSION['form_errors']??[];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow my-3">
            <div class="card-header">
                <h3 class="text-center">Formulaire</h3>
            </div>
            <div class="card-body">
                <form action="" class="d-flex flex-column" method="POST">
                    <div class="mb-3">
                    <label for="nom" class="form-label">Nom :</label>
                        <input type="text" class="form-control<?= isset($current_errors['nom'])?'is-invalid':'';?>"
                        name="nom" id="nom" value="<?= htmlspecialchars($current_data['nom']??'');?>">
                        <div class="invalid-feedback"><?= htmlspecialchars($current_errors['nom']??'');?></div>
                    </div>
                    <label for="email" class="form-label">E-mail :</label>
                        <input type="email" class="form-control<?= isset($current_errors['email'])?'is-invalid':'';?>"
                        name="email" id="email" value="<?= htmlspecialchars($current_data['email']??'');?>">
                        <div class="invalid-feedback"><?= htmlspecialchars($current_errors['email']??'');?></div>
                    
                    <label for="url" class="form-label">URL :</label>
                        <input type="url" class="form-control<?= isset($current_errors['url'])?'is-invalid':'';?>"
                        name="url" id="url" value="<?= htmlspecialchars($current_data['url']??'');?>">
                        <div class="invalid-feedback"><?= htmlspecialchars($current_errors['url']??'');?></div>
                    
                    <label for="age" class="form-label">Age :</label>
                        <input type="number" class="form-control<?= isset($current_errors['age'])?'is-invalid':'';?>"
                        name="age" id="age" value="<?= htmlspecialchars($current_data['age']??'');?>">
                        <div class="invalid-feedback"><?= htmlspecialchars($current_errors['age']??'');?></div>
                    
                    <label for="ville" class="form-label">Ville :
                        <select name="ville" id="ville" class="form-select <?= isset($current_errors['ville'])?'is-invalid':'';?>">
                            <option value="" disabled <?=empty($current_data['ville'])?'selected':''?>>-- Choisir une ville --</option>
                            <option value="rabat" <?= (($current_data['ville']??'')==='rabat')?'selected':'';?>>Rabat</option>
                            <option value="agadir" <?= (($current_data['ville']??'')==='agadir')?'selected':'';?>>Agadir</option>
                            <option value="safi" <?= (($current_data['ville']??'')==='safi')?'selected':'';?>>Safi</option>
                        </select>
                        <div class="invalid-feedback"><?=htmlspecialchars($current_errors['ville']??'');?></div>
                    </label>
                    <label for="langues" class="form-label">Langues :
                        <select name="langues[]" id="langues" class="form-select <?=isset($current_errors['langues'])?'is-invalid':'';?>" multiple size="4">
                            <option value="arab" <?=in_array('arab',$current_data['langues']??[])?'selected':'';?>>Arabe</option>
                            <option value="anglais" <?=in_array('anglais',$current_data['langues']??[])?'selected':'';?>>Anglais</option>
                            <option value="mandarin" <?=in_array('mandarin',$current_data['langues']??[])?'selected':'';?>>Mandarin</option>
                            <option value="francais" <?=in_array('francais',$current_data['langues']??[])?'selected':'';?>>Francais</option>
                        </select>
                        <div class="invalid-feedback"><?=htmlspecialchars($current_errors['langues']??'');?></div>
                    </label>
                    <label for="genre" class="form-label">Genre :
                        <div class="container">
                        <div class="form-check">
                            <input type="radio" class="form-check-input" value="H"
                            <?=(($current_data['genre']??'')==='H')?'checked':'';?> name="genre">
                            <label for="genreH" class="form-check-label">Homme</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" value="F"
                            <?=(($current_data['genre']??'')==='F')?'checked':'';?> name="genre">
                            <label for="genreF" class="form-check-label">Femme</label>
                        </div>
                        </div>
                        <div class="invalid-feedback"><?=htmlspecialchars($current_errors['genre']??'');?></div>
                    </label>
                    <label for="skills" class="form-label">Compétences :
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="skills[]" id="skillPHP" value="PHP" 
                            <?=in_array('PHP',$current_data['skills']??[])?'checked':'';?>>
                            <label for="PHP" class="form-check-label">PHP</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="skills[]" id="skillCSS" value="CSS" 
                            <?=in_array('CSS',$current_data['skills']??[])?'checked':'';?>>
                            <label for="CSS" class="form-check-label">CSS</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="skills[]" id="skillJAVASCRIPT" value="JAVASCRIPT" 
                            <?=in_array('JAVASCRIPT',$current_data['skills']??[])?'checked':'';?>>
                            <label for="JAVASCRIPT" class="form-check-label">JAVASCRIPT</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="skills[]" id="skillPYTHON" value="PYTHON" 
                            <?=in_array('PYTHON',$current_data['skills']??[])?'checked':'';?>>
                            <label for="PYTHON" class="form-check-label">PYTHON</label>
                        </div>
                    </label>
                    <div class="invalid-feedback"><?=htmlspecialchars($current_errors['skills']??'');?></div>
                    <label for="adresse" class="form-label">Adresse :
                        <textarea name="adresse" id="adresse" class="form-control" rows="3"><?=htmlspecialchars($current_data['adresse']??'');?></textarea>
                        <div class="invalid-feedback"><?=htmlspecialchars($current_errors['adresse']??'');?></div>
                    </label>
                    <button type="submit" class="btn btn-success">Envoyer</button>
                </form>
            </div>
        </div>
        

    </div>
</body>
</html>