<?php
$car=["brand"=>"ford","model"=>"mustag","year"=>1964];
echo $car["brand"]."<br>";
echo $car["model"]."<br>";
echo $car["year"]."<br>";

foreach($car as $key=>$value){
    echo "$key=>$value<br>";
}

var_dump($car);

//sorting assoc array
$arr=["A"=>2,"B"=>5,"C"=>13];
//sort by key ASC
ksort($arr);

//sort by value
arsort($arr);
print_r($arr);


//supposed we have a JSON file student.json
$result=file_get_contents("student.json");
var_dump($result);
echo $result."<br>".gettype($result);
$students=json_decode($result,true); //if true is not present, it will give an object instead of an associative array
echo "<pre>"; //use this so the var_dump displays the array in a more structured way (looking like a json file)
var_dump($students);

$data=[];
foreach($students as $std){
    array_push($data,"<tr><td>".$std["cef"]."</td></tr>");
}
$data=implode("",$data);


?>