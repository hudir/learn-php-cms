<?php

echo "build in functions<br>";
echo "math<br>";

echo pow(2,7)."<br>";
echo rand(1, 100)."<br>";
echo sqrt( 100)."<br>";
echo ceil( 4.5)."<br>";
echo floor( 4.5)."<br>";
echo round( 4.4)."<br>";

echo "string<br>";
$string = "Hello student do you like the class";

echo strlen( $string)."<br>";
echo strtoupper( $string)."<br>";
echo strtolower( $string)."<br>";
print( $string)."<br>";


echo "array method<br>";
$list = array(45,8798,14546,464,46546,64654);

echo max($list)."<br>";
echo min($list)."<br>";

sort($list);
print_r($list);

$nums=[1,2,3];
if (in_array(1, $nums)) {
    echo "<br>"."found it";
}


?>

