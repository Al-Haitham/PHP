<?php
//create
$tab1=array("laptop",150,true,["cpu","gpu","ram"]);
function display(){
    echo "this is a function";
}
$tab2=["laptop",150,false,display()];



//advanced Functions
$t=array("it1","it2","it3");
$v=array("it4","it5","it6");
$z=array("abc","defg","hijkl");

$result1=array_merge($t,$v);
print_r($result1);
echo "<br>";
print_r($t);
echo "<br>";
print_r($v);

$result2=array_diff($t,$v); //t-v; it gets the unique item of t(l-erg) according to v(r-arg)
echo "<br>";
print_r($t);
echo "<br>";
print_r($v);

$filtred=array_filter($z,function($pos,$item){
    return strlen($item)>=4;
})
?>