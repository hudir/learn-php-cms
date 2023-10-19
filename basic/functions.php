<?php

echo "functions<br>";

function init() {
    say_Something();
    echo "<br>";
    calculate();
    echo "<br>";
    greeting("Hudir");
    echo "<br>";
    sum(55,77);
    echo "<br>";
    $result = sumWithReturn(2,2);
    $result = sumWithReturn(4,4);
    echo $result;
    echo "<br>";
    echo "<br>";
}
function say_Something(){
    echo "Hello Student, do you like the class?";
}

function calculate(){
    echo 444 + 565;
}

function greeting($name) {
    echo "Nice wo meet you ".$name;
}

/*
 * to get the sum value of two numbers
 * param: $num1: number
 */
function sum($num1, $num2) {
    echo $num2 + $num1;
}

function  sumWithReturn($num1, $num2){
    $sum = $num1 + $num2;
    return $sum;
}

init();

echo "Scope<br>";

$x= "outside<br>";

function change(){
    $x= "inside";
}

echo $x;
change();
echo $x;

echo "constants<br>";

$number = 10;
$number = 11;
echo "\$number is now".$number."<br>";

define("NAME", "wow<br>");
echo NAME;

const NAME1 = "wow2<br>";
echo NAME1;

const ANIMALS = array('dog', 'cat', 'bird');
echo ANIMALS[1];

?>