<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Numbered Triangle</title>
</head>
<body>
    <form method="get">
        <label for="nbr">Nombre des Lignes:</label>
        <input type="number" name="nbr" id="nbr" value="<?php echo isset($_GET['nbr']) ? $_GET['nbr'] : '';?>">
        <button type="submit">Generate</button>
    </form>

    <div class="result">
        <?php
        if (isset($_GET['nbr']) && $_GET['nbr']>0) {
            $nbr=(int)$_GET['nbr'];
            for ($i=1;$i<=$nbr;$i++) {
                for ($j=1;$j<=$i;$j++) {
                    echo $j;
                }
                echo "<br>";
            }
        }
        ?>
    </div>
</body>
</html>   