<?php
/**
*   Controleur secondaire : deconnexion 
*/
if ( $_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__) ) {
    // Un MVC utilise uniquement ses requêtes depuis le contrôleur principal : index.php
    die('Erreur : '.basename(__FILE__));
}
require_once ROOT . "/model/authentification.php";
// recuperation des donnees GET, POST, et SESSION
// (aucune donnée GET/POST nécessaire pour la déconnexion)

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 
// traitement si necessaire des donnees recuperees
logout();

// appel du script de vue qui permet de gerer l'affichage des donnees
$titre = "authentification";
require_once ROOT . "/view/head.php";
require_once ROOT . "/view/authentification.php";
require_once ROOT . "/view/footer.php";
?>