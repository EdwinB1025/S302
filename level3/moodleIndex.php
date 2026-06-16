<?php
require_once 'moodleObserver.php';

$fullStack = new MoodleCourse;
$ruben = new Instructor('Ruben');
$fullStack->addInstructor($ruben);
$fullStack->deliverTask('Ejercicio Observer', 'Edwin Barrera');
