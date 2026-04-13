<?php

/**
*	Controleur secondaire : connexion 
*/

if ( $_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__) ) {
	// Un MVC utilise uniquement ses requêtes depuis le contrôleur principal : index.php
    die('Erreur : '.basename(__FILE__));
}

require_once ROOT . "/model/authentification.php";

// recuperation des donnees GET, POST, et SESSION
if (isset($_POST["email"]) && isset($_POST["password"])){
    $email=trim($_POST["email"]);
    $password=$_POST["password"];
} else {
    $email=null;
    $password=null;
}

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 


// traitement si necessaire des donnees recuperees
login($email,$password);

if (isLoggedOn()){ // si l'utilisateur est connecté on redirige vers le controleur monProfil
    include ROOT . "/controleur/monProfil.php";
}
else{ // l'utilisateur n'est pas connecté, on affiche le formulaire de connexion
    // appel du script de vue 
    $titre = "authentification";
    include ROOT . "/view/head.php";
    include ROOT . "/view/authentification.php";
    include ROOT . "/view/footer.php";
}

?>