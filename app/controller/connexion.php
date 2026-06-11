<?php
/**
*   Secondary controller : connection 
*/
if ( $_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__) ) {
    die('Erreur : '.basename(__FILE__));
}
require_once ROOT . "/app/model/authentification.php";

// getting POST data
if (isset($_POST["email"]) && isset($_POST["password"])){
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    // Connexion only if data is present
    login($email, $password);

    if (isLoggedOn()) {
        
        if (isAdmin()) {
            header('Location: ./?action=backoffice');
        } else {
            header('Location: ./?action=personalSpace');
        }
        exit();
    } else {
        // Failure : message to be seen by the user
        $erreur = "Email ou mot de passe incorrect.";
    }
}

$titre = "authentification";
require ROOT . "/app/view/head.php";
require ROOT . "/app/view/authentification.php";
require ROOT . "/app/view/footer.php";