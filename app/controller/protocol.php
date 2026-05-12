<?php

// check if user is logged on
if (!isset($_SESSION['idUser'])) {
    header('Location: /authentification.php');
    exit;
}

// call the view
require_once ROOT . "/app/view/head.php";
require_once ROOT . "/app/view/header.php";
require_once ROOT . "/app/view/menu.php";
require_once ROOT . "/app/model/protocol.php";

// get the data
$protocols = getProtocols($_SESSION['idUser']);

require_once ROOT . "/app/view/protocol.php";
require_once ROOT . "/app/view/footer.php";
?>