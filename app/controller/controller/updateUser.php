<?php

require_once ROOT . "/app/model/authentification.php";
if (!isAdmin()) {
    header('Location: ./?action=connexion');
    exit;
}
require_once ROOT . "/app/view/head.php";
require_once ROOT . "/app/view/header.php";
require_once ROOT . "/app/view/menu.php";

$errors = [];
if (!empty($_POST)) {
    $name        = trim($_POST['name']        ?? '');
    $firstName   = trim($_POST['firstName']   ?? '');
    $phoneNumber = trim($_POST['phoneNumber'] ?? '');
    $email       = trim($_POST['email']       ?? '');
    $password    = trim($_POST['password']    ?? '');
    $isAdmin     = trim($_POST['isAdmin']     ?? '');

    // Validation
    if (empty($name))        $errors['name']        = "Requis";
    if (empty($firstName))   $errors['firstName']   = "Requis";
    if (empty($phoneNumber)) $errors['phoneNumber'] = "Requis";
    if (empty($email))       $errors['email']       = "Requis";
    if (empty($password))    $errors['password']    = "Requis";
    if (empty($isAdmin))     $errors['isAdmin']     = "Requis";

    // Model called only if no errors
    if (empty($errors)) {
        require_once ROOT . "/app/model/updateUser.php";
    }
}

// calling the view
require_once ROOT . "/app/view/updateUser.php";
require_once ROOT . "/app/view/footer.php";
?>
