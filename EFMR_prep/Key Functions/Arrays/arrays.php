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
});

//remove / pop
$tabspl=array_splice($t,1,2);//1: pos, 2: nbr of items to be popped
array_splice($t,1,0,["newItam1","newItem2"]); //the fourth arg is for replacement/new items, in this case, it add new items after the pos 1


array_push($t,"newVal"); //add in end
array_shift($t); //remove first
array_pop($t); //remove last
array_unshift($t,"newVal"); //add in start
unset($t[0]); //remove specific, the value and the pos too, without reorganizing
// hence the use of:
array_values($t); //to organize the tab items/pos
in_array("item",$t); //verify existence
array_search("itam",$t); //gives pos if exist

?>