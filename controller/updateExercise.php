<?php
session_start();

// check if user is logged on
if (!isset($_SESSION['idUser']) || !isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] !== true) {
    header('Location: /authentification.php');
    exit;
}

require_once ROOT . "/model/updateExercise.php";

// get the data for the connected user
// $post = getPosts($_SESSION['idUser']);

// call the view
include ROOT . "/view/updateExercise.php";

?>