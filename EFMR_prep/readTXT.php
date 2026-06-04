<?php
if (file_exists("notes.txt")){
    $lines=file('notes.txt');
    foreach ($lines as $l){
        if (str_contains($l,"admis")){
            echo $l;
        };
    };
}else{
    echo "Fichier introuvable";
}
?>