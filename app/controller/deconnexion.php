<?php
/**
*   secondary controller : deconnexion 
*/
if ( $_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__) ) {
    
    die('Erreur : '.basename(__FILE__));
}
require_once ROOT . "/app/model/authentification.php";

logout();


$titre = "authentification";
require_once ROOT . "/app/view/head.php";
require_once ROOT . "/app/view/authentification.php";
require_once ROOT . "/app/view/footer.php";
?>