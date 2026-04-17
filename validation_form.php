<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <?php
     $fnom="";
     $age=0;
     $ville="";
     $lng=[];
     $loisirs=[];
     $adresse="";
     $errors=[];    
    // $method=$_SERVER["REQUEST_METHOD"];
     if($_SERVER["REQUEST_METHOD"]=="POST"){
       print_r($_POST);
      function clean($txt){
        return htmlspecialchars(trim($txt));
     }
     $fnom=clean($_POST["fname"])??"";
     $age=$_POST["age"]??0;
     $ville=$_POST["ville"]??"";
     $lng=$_POST["lng"]??[];
     $loisirs=$_POST["loisirs"]??[];
     $adresse=clean($_POST["adresse"])??"";
     $errors=[];

    
     //valider le nom
     if(empty(clean($fnom))){
          $errors["fnom"]="le nom est requis !!!!";
     }else{
        if(!preg_match("/^[A-Z][a-zA-Z]{2,}(\s[a-zA-Z]+)*$/",clean($fnom))){
          $errors["fnom"]="le nom est invalide !!!!!!";
        }
     }
     //valider l'age
     if($_POST["age"]==0){
         $errors["age"]="l'age est obligatoire !!!!!!";
     }
     else if($_POST["age"]<=18 || $_POST["age"]>=70){
         $errors["age"]="l'age est invalide !!!!!!";
     }
     //valider la ville
     if(empty(clean($ville))){
          $errors["ville"]="la ville est obligatoire !!!!";
     }
      //valider les langues
     if(count($lng)==0){
          $errors["lng"]="vous devez au moins une langue !!!!";
     }
    //valider les loisirs
     if(count($loisirs)==0){
          $errors["loisirs"]="vous devez au moins une loisir !!!!";
     }
   //valider l'adresse
     if(empty(clean($adresse))){
          $errors["adresse"]="l'adresse est requise !!!!";
     }else{
        if(strlen(clean($adresse))<10){
          $errors["adresse"]="l'adresse est invalide !!!!!!";
        }
     }
      if(count($errors)==0){
        echo "<div class='alert alert-success'>formulaire valide !!!!</div>";
        //header('Location:db.php');
      }

       

     }




    ?>





</head>
<body>
   <!-- <div class="mt-5">
        <span class="alert alert-primary"><?= $method;?></span>

    </div>-->
    <div class=" mt-5 container w-75 mx-auto p-3 shadow bg-light rounded">
     <form action="" method="POST">
        <div class="mb-3">
            <label for="nom">Nom : </label>
            <input type="text" name="fname" id="nom" class="form-control"
               value=<?= $fnom??""?>
            >
           <?php if(isset($errors["fnom"]))
                echo"<span class='text-danger'>".$errors["fnom"]."</span>";
            else echo ""; ?>
       
        </div>
      <div class="mb-3">
            <label for="age">Age : </label>
            <input type="number"
             name="age" id="age" class="form-control"
             value=<?=$age??0?>>
         <?php if(isset($errors["age"]))
                echo"<span class='text-danger'>".$errors["age"]."</span>";
            else echo ""; ?>
      </div>
      <div class="mb-3">
       <label for="ville">Ville</label>
       <select name="ville" id="ville" class="form-select">
         <option value="Agadir" <?=(isset($ville) && $ville=='Agadir')?"selected":""?>>Agadir</option>
        <option value="Safi" <?=(isset($ville) && $ville=='Safi')?"selected":""?>>Safi</option>
        <option value="Rabat" <?=(isset($ville) && $ville=='Rabat')?"selected":""?>>Rabat</option>
       
        </select>
    <?php if(isset($errors["ville"]))
                echo"<span class='text-danger'>".$errors["ville"]."</span>";
            else echo ""; ?>

      </div>

    <div class="mb-3">
       <label for="langues">Langues</label>
       <!--la valeur du clé lang est de type tableau -->
       <select multiple name="lng[]" id="langues" class="form-select">
         <option value="Arabe" <?=  in_array('Arabe',$lng)?"selected":"";   ?>>Arabe</option>
        <option value="Français" <?=  in_array('Français',$lng)?"selected":"";   ?>>Français</option>
        <option value="Anglais" <?=  in_array('Anglais',$lng)?"selected":"";   ?>>Anglais</option>
       </select>
        <?php if(isset($errors["lng"]))
                echo"<span class='text-danger'>".$errors["lng"]."</span>";
            else echo ""; ?>
      </div>
   <div class="mb-3">
    <label for="gente">Gente</label>
    <div class="form-check-inline">
       <input type="radio" <?= $gente=="female"?"checked":""?> id="gender" name="gender" value="female" class="form-check-input">
       <label for="gender"  class="form-check-label">Female</label>
    </div>
     <div class="form-check-inline">
       <input type="radio" <?= $gente=="male"?"checked":""?>  id="gender" name="gender" value="male" class="form-check-input">
       <label for="gender" class="form-check-label">male</label>
    </div>
       <?php if(isset($errors["gente"]))
                echo"<span class='text-danger'>".$errors["gente"]."</span>";
            else echo ""; ?>
</div>
<div class="mb-3">
    <label for="loisirs">Loisir</label>
    <div class="form-check-inline">
       <input type="checkbox"  id="lecture" name="loisirs[]" <?= in_array("lecture",$loisirs)?"checked":""   ?> value="lecture" class="form-check-input">
       <label for="lecture" class="form-check-label">Lecture</label>
    </div>
     <div class="form-check-inline">
       <input type="checkbox"  id="sport" name="loisirs[]" <?= in_array("sport",$loisirs)?"checked":""   ?> value="sport" class="form-check-input">
       <label for="sport" class="form-check-label">Sport</label>
    </div>  
    <div class="form-check-inline">
       <input type="checkbox" <?= in_array("peinture",$loisirs)?"checked":""   ?> id="peinture" name="loisirs[]" value="peinture" class="form-check-input">
       <label for="peinture" class="form-check-label">Peinture</label>
    </div>
     <div class="form-check-inline">
       <input type="checkbox" <?= in_array("voyage",$loisirs)?"checked":""   ?>  id="voyage" name="loisirs[]" value="voyage" class="form-check-input">
       <label for="voyage" class="form-check-label">Voyage</label>
    </div> 
    <span class="text-danger"><?php echo $errors["loisirs"]??"";?></span>
</div>

<div class="mb-3">
    <label for="adresse">Adresse</label>
    <textarea name="adresse"  id="adresse" class="form-control">
      <?= $adresse??"";?>

    </textarea>
       <span class="text-danger"><?php echo $errors["adresse"]??"";   ?></span>
</div>
<div class="mb-3">
    <button class="btn btn-primary">Envoyer</button>
</div>


     </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>  