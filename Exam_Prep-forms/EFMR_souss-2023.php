<?php
    $nbr=8;
    for($i=0;$i<$nbr;$i++){
        echo str_repeat("1",$i),str_repeat("*",$nbr-$i);
        echo "<br>";
    }
?>