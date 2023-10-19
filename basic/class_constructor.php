<?php

class Cars {
    var $wheels = 4;
    var $hood = 1;
    var $engine = 1;
    var $doors;

    function  __construct()
    {
        echo $this->moveWheels();
    }
    function  moveWheels() {
        echo "Wheels move";
    }
    function  countWheels() {
        $this->wheels = 10;
    }
}



$bmw = new Cars();
