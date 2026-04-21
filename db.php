<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php 
   session_start();
   $data=$_SESSION["data"];
   print_r($data);



?>
</head>
<body>
    <ul>
        <li><?php echo $data["fnom"];   ?></li>
         <li><?php echo implode(", ",$data["lng"]);   ?></li>
    </ul>
    
</body>
</html>