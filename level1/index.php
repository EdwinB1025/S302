<?php

require_once 'tiger.php';

$referenceToTiger1 = Tigger::getInstance();
$referenceToTiger2 = Tigger::getInstance();

$referenceToTiger1->roar();
$referenceToTiger2->roar();
$referenceToTiger1->roar();

$referenceToTiger1->getCounter();
