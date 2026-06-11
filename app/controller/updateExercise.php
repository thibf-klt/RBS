<?php
session_start();

// check if user is logged on
if (!isset($_SESSION['idUser']) || !isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] !== true) {
    header('Location: /authentification.php');
    exit;
}

require_once ROOT . "/app/model/updateExercise.php";

// call the view
include ROOT . "/app/view/updateExercise.php";

?>