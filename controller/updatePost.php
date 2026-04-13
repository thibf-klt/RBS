<?php
session_start();

// check if admin connected
if (!isset($_SESSION['idUser']) || !isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] !== true) {
    header('Location: /authentification.php');
    exit;
}

$errors = [];

if (!empty($_POST)) {
    $title   = trim($_POST['title']   ?? '');
    $content = trim($_POST['content'] ?? '');
    $date    = $_POST['date']         ?? '';

    // Validation
    if (empty($title))   $errors['title']   = "Requis";
    if (empty($content)) $errors['content'] = "Requis";
    if (empty($date))    $errors['date']    = "Requis";

    // Model called only if no errors
    if (empty($errors)) {
        require_once ROOT . "/model/updatePost.php";
    }
}

// calling the view
include ROOT . "/view/updatePost.php";
?>