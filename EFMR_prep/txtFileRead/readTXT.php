
<?php
#method-01
if (file_exists("notes.txt")){
    $lines=file('notes.txt');
    foreach ($lines as $l){
        if (str_contains($l,"Admis")){
            echo $l."<br>";
        };
    };
}else{
    echo "Fichier introuvable";
}


#method-02
$filename="notes.txt";

if (file_exists($filename)) {
    $handle=fopen($filename,"r");

    if ($handle) {
        while (($line=fgets($handle))!==false) {
            $line=trim($line);
            if (str_contains($line, "Admis")) {
                echo $line."<br>";
            }
        }
        fclose($handle);
    } else {
        echo "Impossible d'ouvrir le fichier.";
    }
} else {
    echo "Fichier introuvable";
}
?>