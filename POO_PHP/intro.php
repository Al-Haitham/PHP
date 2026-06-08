<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    /*
    1.Crée une classe Produit avec les attributs privés
        nom 
        prix 
    2.Définir la méthode afficherProduit()
    3.Ajoute une méthode :calculerTVA() (ex: prix * 0.2) Rend prix privé
    4. Ajouter deux constructeurs : par défaut et d'initialisation
    5.définir la méthoes toString 
    6. Créer un tableau produits
    7. ajouter dans le tableau produits 6 instances de type Produit 
        3 instances crées en utilisant le constructeur par défaut 
        3 instances en utilisant le constructeur d'initialisation
    8 . afficher la liste des produits dans une table HTML : avec les boutons d'actions : edit , delete et show*/

    class produit{
        private $nom;
        private $prix;

        public function afficherProduit(){
            echo "nom:$this->nom - prix:$this->prix";
        }
        public function __construct($nom="--",$prix=1){
            $this->nom=$nom;
            $this->prix=$prix;
        }
        public function calculerTVA($this){
            return $this->prix*0.2;
        }

        public function __tostring(){
            return "nom:$this->nom - prix:$this->prix";
        }

        //getters & setters:
        public function getNom($this){
            return $this->nom;
        }
        public function setNom($this,$Nnom){
            $this->nom=$Nnom;
        }
        public function getPrix($this){
            return $this->prix;
        }
        public function setPrix($this,$Nprix){
            $this->prix=$Nprix;
        }
        
    }
    $produits=[];
    for($i=0;$i<6;$i++){
        if($i<3){
            $p=new produit("prod_0".$i,random_int(10,100));
            $produits[]=$p;
        }else{
            $p=new produit();
            $produits[]=$p;
        }
    }
    $editIndex=-1
    ?>
</body>
</html>