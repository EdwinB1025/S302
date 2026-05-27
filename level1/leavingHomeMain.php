<?php
require_once 'leavingHome.php';

$student = new Person(new StudentDependencies);
$workerCar = new Person(new WorkerDependencies('car'));
$workerMoto = new Person(new WorkerDependencies('moto'));


var_dump($student);
var_dump($workerCar);
var_dump($workerMoto);
