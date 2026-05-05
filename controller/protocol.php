<?php

// check if user is logged on
if (!isset($_SESSION['idUser'])) {
    header('Location: /authentification.php');
    exit;
}

// call the view
require_once ROOT . "/view/head.php";
require_once ROOT . "/view/header.php";
require_once ROOT . "/view/menu.php";
require_once ROOT . "/model/protocol.php";

// get the data
$protocols = getProtocols($_SESSION['idUser']);

require_once ROOT . "/view/protocol.php";
require_once ROOT . "/view/footer.php";
?>