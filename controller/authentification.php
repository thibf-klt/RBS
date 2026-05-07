<?php
require_once ROOT . "/model/authentification.php"; 
$erreur = "";    

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email    = trim($_POST["email"]    ?? "");
    $password = trim($_POST["password"] ?? "");

    if (empty($email) || empty($password)) {
        $erreur = "Veuillez remplir tous les champs.";
    } elseif (!login($email, $password)) {
        $erreur = "Email ou mot de passe incorrect.";
    } else {
        
        if (isAdmin()) {
            header("Location: ./?action=backoffice");
        } else {
            header("Location: ./?action=personalSpace");
        }
        exit();
    }
}

require_once ROOT . "/view/head.php";
require_once ROOT . "/view/header.php";
require_once ROOT . "/view/menu.php";
require_once ROOT . "/view/authentification.php"; 
require_once ROOT . "/view/footer.php";
?>