<?php

// check if user connected
if (!isset($_SESSION['idUser'])) {
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
        require_once ROOT . "/app/model/createTestimony.php";
    }
}

// calling the view
require_once ROOT . "/app/view/head.php";
require_once ROOT . "/app/view/header.php";
require_once ROOT . "/app/view/menu.php";
require_once ROOT . "/app/view/createTestimony.php";
require_once ROOT . "/app/view/footer.php";
?>