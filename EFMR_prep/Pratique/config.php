<?php
try{
    $cnx=new PDO("mysql:host=localhost;dbname=gestionFormation","root","");
}catch(PDOException $e){
    die("l erreur est: ".$e->getMessage());
}
?>