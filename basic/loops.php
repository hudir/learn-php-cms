<?php

echo "while loops<br>";

$count=0;
while(true) {

    echo "<br>Inside while loop. counter=" . $count;
    $count++;
    if($count===10) break;
}

echo "<br><br>for loops<br>";

for($counter = 0; $counter < 10; $counter++) {
    echo "counter".$counter. "<br>";
}

echo "<br><br>foreach loops(only work for array)<br>";

$numbers = array(324,543,213,546,123,2344,9527);
foreach($numbers as $number) {
    echo $number."<br>";
}

?>