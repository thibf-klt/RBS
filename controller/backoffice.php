<?php
    require_once ROOT . "/model/authentification.php";
if (!isAdmin()) {
    header("Location: ./?action=connexion");
    exit();
}
require_once ROOT . "/model/authentification.php";

// On vérifie les droits AVANT de faire quoi que ce soit d'autre
requireAdmin();

// Le reste du code ne s'exécutera que si l'utilisateur est admin
echo "Bienvenue dans l'espace secret de l'admin !";
    require_once ROOT . "/view/head.php";
    require_once ROOT . "/view/header.php";
    require_once ROOT . "/view/menu.php";
    require_once ROOT . "/view/backoffice.php";
    require_once ROOT . "/view/footer.php";
?>