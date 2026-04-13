<?php
session_start();

// check if admin connected
if (!isset($_SESSION['idUser']) || !isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] !== true) {
    header('Location: /authentification.php');
    exit;
}

$errors = [];

if (!empty($_POST)) {
    $name   = trim($_POST['name']   ?? '');
    $firstName = trim($_POST['firstName'] ?? '');
    $phoneNumber = trim($_POST['phoneNumber'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $isAdmin = trim($_POST['isAdmin'] ?? '');

    // Validation
    if (empty($name)) $errors['name']   = "Requis";
    if (empty($firstName)) $errors['firstName'] = "Requis";
    if (empty($phoneNumber)) $errors['phoneNumber'] = "Requis";
    if (empty($email)) $errors['email'] = "Requis";
    if (empty($password)) $errors['password'] = "Requis";
    if (empty($isAdmin)) $errors['isAdmin'] = "Requis";

    // Model called only if no errors
    if (empty($errors)) {
        require_once ROOT . "/model/updateUser.php";
    }
}

// calling the view
include ROOT . "/view/updateUser.php";
?>

