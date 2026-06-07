<?php
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    
    $input=isset($_POST['t1'])? $_POST['t1']:'';

    if (!empty($input) && is_numeric($input)) {
        
        $number=(int)$input;

        if ($number>0) {
            
            $product=1;
            $steps=[]; 

            
            for ($i=1; $i<$number; $i+=2) {
                $product*=$i;
                $steps[]=$i;
            }

            
            $stepsString=implode(" * ", $steps);

            echo "<h3>Resultat:</h3>";
            
            if (empty($steps)) {
                echo "No odd numbers less than $number.";
            } else {
                echo "<p>$stepsString=<strong>$product</strong></p>";
            }
        } else {
            echo "<p>Error: Please enter a positive integer.</p>";
        }
    } else {
        echo "<p>Error: Invalid input. Please enter a numeric value.</p>";
    }
} else {
    echo "<p>No data submitted.</p>";
}
?>   