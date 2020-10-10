<?php

class Robot {
    public $name;

    public function getName() {
        return $this->name;
    }
}

$marvin = new Robot();
$marvin->name = "Marvin the Paranoid Android";
echo $marvin->getName();

//var_dump($marvin);