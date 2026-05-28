<?php
require_once 'moodleObserver.php';

$fullStack = new MoodleCourse;
$fullStack->addInstructor('Ruben');
$fullStack->notifyInstructors();

$fullStack->deliverTask('Ejercicio Observer', 'Edwin Barrera');
