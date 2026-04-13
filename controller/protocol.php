<?php
session_start();

// check if user is logged on
if (!isset($_SESSION['idUser'])) {
    header('Location: /login.php');
    exit;
}

require_once ROOT . "/model/protocol.php";

// get the data
$protocols = getProtocols($_SESSION['idUser']);

// call the view
include ROOT . "/view/protocol.php";

?>