<?php
require_once ROOT . "/app/model/authentification.php"; 


$erreur = "";    

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email    = trim($_POST["email"]    ?? "");
    $password = trim($_POST["password"] ?? "");

    if (empty($email) || empty($password)) {
        $erreur = "Veuillez remplir tous les champs.";
    } elseif (!login($email, $password)) {
        $_SESSION["erreur"] = "Email ou mot de passe incorrect.";
        header("Location: ./?action=authentification");
        exit();
    } else {
        if (isAdmin()) {
            header("Location: ./?action=backoffice");
        } else {
            header("Location: ./?action=personalSpace");
        }
        exit();
    }
}


if (isset($_SESSION["erreur"])) {
    $erreur = $_SESSION["erreur"];
    unset($_SESSION["erreur"]); 
}

require_once ROOT . "/app/view/head.php";
require_once ROOT . "/app/view/header.php";
require_once ROOT . "/app/view/menu.php";
require_once ROOT . "/app/view/authentification.php"; 
require_once ROOT . "/app/view/footer.php";
?>