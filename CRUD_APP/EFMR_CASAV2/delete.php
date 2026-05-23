<?php
require_once('config.php');

if(isset($_GET['idImmo'])){
    $idD=$_GET['idImmo'];
    $sqlDel="
            DELETE FROM immobilier
            WHERE id_immobilier=?
            ";
    $stmt=$cnx->prepare($sqlDel);
    $stmt->execute([$idD]);
    header('Location:listerC.php');
    }
?>