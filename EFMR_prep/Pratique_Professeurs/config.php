<?php
$srvr='localhost';
$dbname='university';
$login='root';
$PW='';

try{
    $cnx=new PDO("mysql:host=$srvr;dbname=$dbname",$login,$PW);
}catch(PDOException $e){
    die("Erreur: ".$e->getMessage());
}
?>