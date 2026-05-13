<?php
    require_once ROOT . "/app/model/authentification.php";
if (!isLoggedOn()) {
    header("Location: ./?action=connexion");
    exit();
}
    require_once ROOT . "/app/view/head.php";
    require_once ROOT . "/app/view/header.php";
    require_once ROOT . "/app/view/menu.php";
    require_once ROOT . "/app/view/personalSpace.php";
    require_once ROOT . "/app/view/footer.php";
?>