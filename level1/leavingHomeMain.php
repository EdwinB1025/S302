<?php
require_once 'leavingHome.php';

$student = (new StudentBuilder())->getKeys()
    ->getWallet()
    ->getPhone()
    ->getPublicTransportCard()
    ->build();

$workerMoto = (new WorkerBuilder())->getKeys()
    ->getWallet()
    ->getPhone()
    ->getMotoKeys()
    ->build();

$workerCar = (new WorkerBuilder())->getKeys()
    ->getWallet()
    ->getPhone()
    ->getCarKeys()
    ->build();

var_dump($student);
var_dump($workerCar);
var_dump($workerMoto);
