<?php
require_once ROOT . "/app/model/authentification.php";
require_once ROOT . "/app/model/exercise.php";
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isLoggedOn()) { header("Location: ./?action=connexion"); exit(); }

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idExercise = intval($_POST["idExercise"] ?? 0);

    if ($idExercise > 0 && deleteExercise($idExercise)) {
        header("Location: ./?action=manageExercise&succes=1");
    } else {
        header("Location: ./?action=manageExercise&erreur=1");
    }
    exit();
}

header("Location: ./?action=manageExercise");
exit();