<?php

class handDishWash
{
    public function pickADish()
    {
        echo "The dish(es) are in place to be watch\n";
    }
    public function soapDish()
    {
        echo "The dish(es) have been soaped\n";
    }
    public function rinseDish()
    {
        echo "The dish(es) have been rinsed\n";
    }
    public function dryDish()
    {
        echo "The dish(es) have been dried\n";
    }
}

class dishWasher
{
    protected handDishWash $steps;
    protected bool $gelLoad = false;

    public function __construct()
    {
        $this->steps = new handDishWash;
    }

    public function insertingLaundryGel()
    {
        $this->gelLoad = true;
        echo "Gel/Tablet are in placed\n";
    }

    public function turnOn()
    {
        if ($this->gelLoad) {

            $this->steps->pickADish();
            $this->steps->soapDish();
            $this->steps->rinseDish();
            $this->steps->dryDish();
            echo "The dish(es) are cleaned!\n";
            $this->gelLoad = false;
        } else {
            echo "Gel or tablet not in place.\n";
        }
    }
}

$washingMachine = new dishWasher;
$washingMachine->turnOn();
$washingMachine->insertingLaundryGel();
$washingMachine->turnOn();
