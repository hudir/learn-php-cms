<?php

class CarData {
    public $wheels = 4;
    protected $hood = 1998; // inside This class and sub classed
    private $engine = 1; // only inside this class
    var $doors;

    function  __construct()
    {
    }
    function  moveWheels() {
        echo "Wheels move";
    }
    function  showHood() {
        echo $this->hood.'<br>';
    }
}

$bmw = new CarData();
echo $bmw->$hood;
$bmw -> showHood();

class Semi extends CarData {
    function  showHood1() {
        echo $this->hood. "from Semi<br>";
        echo $this->engine. "from Semi";
    }
};

$truck = new Semi();
$truck->showHood1();