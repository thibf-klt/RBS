<?php
session_start ();

require_once ROOT . "/model/testimony.php";

// get the data
$testimonies = getTestimonies();

// call the view
include ROOT . "/view/testimony.php";
?>