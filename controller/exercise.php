<?php
require_once ROOT . "/model/exercise.php";

// get the data
$exercises = getExercises ();

// call the view
require_once ROOT . "/view/head.php";
require_once ROOT . "/view/header.php";
require_once ROOT . "/view/menu.php";
require_once ROOT . "/view/exercise.php";
require_once ROOT . "/view/footer.php";
?>