<?php

class Car {
    var $wheels = 4;
    var $hood = 1;
    var $engine = 1;
    var $doors;
    function  moveWheels() {
        echo "Wheels move";
    }
    function  countWheels() {
        $this->wheels = 10;
    }
}

if(class_exists('Car')) {
    echo "Cai is there!";
} else {
    echo "No it's not there";
}
if(method_exists('Car', "moveWheels")) {
    echo "moveWheels is there!";
} else {
    echo "No it's not there";
}


$audi = new Car(); // instance -> object
$bmw = new Car();

$bmw->moveWheels(); // call a method
$audi->moveWheels();

$bmw->wheels = 8;
echo $bmw->wheels;
$bmw->countWheels();
echo $bmw->wheels . '<br>';

echo $audi->wheels = 16;
echo $audi->doors = 2;

class plane extends Car {
    var $hood = "over write the parent's vairable";

}

if (class_exists('plane')) {
    echo '<br> plane exists';
}

$jet = new plane();
echo $jet->engine;
$jet->countWheels();
echo $jet->wheels;
echo $jet->hood;