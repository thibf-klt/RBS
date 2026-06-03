<?php
require_once ROOT . "/app/model/protocol.php";

$protocoles = getProtocols($_SESSION["idUser"]);
require_once ROOT . "/app/view/head.php";
require_once ROOT . "/app/view/header.php";
require_once ROOT . "/app/view/menu.php";
require_once ROOT . "/app/view/viewProtocol.php";
require_once ROOT . "/app/view/footer.php";
?>