<?php
    require_once ROOT . "/app/model/authentification.php";
    require_once ROOT . "/app/model/protocol.php";
if (!isLoggedOn()) {
    header("Location: ./?action=connexion");
    exit();
}

$protocoles = getProtocols($_SESSION["idUser"]);

    require_once ROOT . "/app/view/head.php";
    require_once ROOT . "/app/view/header.php";
    require_once ROOT . "/app/view/menu.php";
    require_once ROOT . "/app/view/personalSpace.php";
    require_once ROOT . "/app/view/footer.php";
?>