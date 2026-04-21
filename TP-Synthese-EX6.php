<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>

    <?php
    session_start();
    
    $nom="";
    $module="";
    $note=0;
    $typeExam="";
    
    // Initialize the array if it doesn't exist
    if(!isset($_SESSION['records'])){
        $_SESSION['records'] = [];
    }
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        print_r($_POST);

        function clean($txt){
            return htmlspecialchars(trim($txt));
        }

        $nom=clean($_POST["nom"])??"";
        $module=clean($_POST["module"])??"";
        $note=clean($_POST["note"])??0;
        $typeExam=clean($_POST["typeExam"])??"";    

        $errors=[];
        if (empty(clean($nom))){
            $errors["nom"]="le nom est obligatoire!";
        }else if(!preg_match("/^[A-Z\s]+$/",clean($nom))){
                $errors["nom"]="le nom doit contenir que des Majiscules et espaces!";
        }
        if (empty(clean($module))){
            $errors["module"]="le module est obligatoire!";
        }
        if (empty($note)){
            $errors["note"]="la note est obligatoire!";
        }else if($_POST["note"]<0 || $_POST["note"]>20){
            $errors["note"]="note invalid!";
        }
        
        // If no errors, add to session
        if(empty($errors)){
            $_SESSION['records'] [] = [
                'nom' => $nom,
                'module' => $module,
                'note' => $note,
                'typeExam' => $typeExam
            ];
        }
    }else{
        unset($_SESSION["records"]);
    }
    ?>
</head>
<body>
    <div class="container">
        <form action="" method="POST" class="d-flex flex-column gap-4 mt-3">
            <input class="form-control" type="text" id="nom" name="nom" placeholder="nom.." value=<?= $nom??""?>>
            <?php if(isset($errors["nom"]))
                echo "<span class='text-danger'>".$errors["nom"]."</span>";
                else echo "";
            ?>
            <select class="form-select" name="module" id="module">
                <option value="" selected disabled>Choisir un module ..</option>
                <option value="m101">M101</option>
                <option value="m102">M102</option>
                <option value="m103">M103</option>
            </select>
            <?php if(isset($errors["module"]))
                echo "<span class='text-danger'>".$errors["module"]."</span>";
            ?>
            <input class="form-control" type="number" min="0" max="20" step="0.05" name="note" value=<?= $note??0?>>
            <?php if(isset($errors["note"]))
                echo "<span class='text-danger'>".$errors["note"]."</span>";
                else echo "";
            ?>
            <div class="d-flex flex-row gap-4">
                <label for="">
                <input class="form-radio" type="radio" name="typeExam" value="regional">Regional</label>
                <label for="">
                <input class="form-radio" type="radio" name="typeExam" value="nonRegional" checked>Non-Regional</label>
            </div>

            <div class="mb-3">
                <button class="btn btn-primary mt-4 col-12">Envoyer</button>
            </div>
        </form>
        <table class="col-12 table-stripepd text-center">
            <thead class="bg-dark text-light">
                <tr>
                    <th>Nom</th>
                    <th>Module</th>
                    <th>Note</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="resultTable">
                <?php
                    if(isset($_SESSION['records']) && !empty($_SESSION['records'])){
                        foreach($_SESSION['records'] as $record){
                            echo "<tr>
                            <td>".$record['nom']."</td>
                            <td>".($record['module'])."<span class=\"".($record['typeExam']=='regional'?'bg-success':'bg-warning')."\">".($record['typeExam']=='regional'?'REG':'NREG')."</span></td>
                            <td>".$record['note']."</td>
                            <td></td>
                            </tr>";
                        }
                    }       
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>