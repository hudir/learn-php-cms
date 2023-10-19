<?php

class CarStatic {
    static $wheels = 4; // only for class
    var $hood = 1;
    var $engine = 1;
    var $doors;
    function  moveWheels() {
        echo "Wheels move";
    }
    static function  countWheels() {
        CarStatic::$wheels = 10;
    }
}

$bmw = new CarStatic();

//$bmw->countWheels();
CarStatic::countWheels();

echo CarStatic::$wheels;

//echo $bmw->wheels;

