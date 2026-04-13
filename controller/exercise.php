<?php
session_start();

require_once ROOT . "/model/exercise.php";

// get the data
$exercises = getExercises ();

// call the view
include ROOT . "/view/exercise.php";
?>