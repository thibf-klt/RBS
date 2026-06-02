<?php
require_once ROOT . "/app/model/authentification.php"; 
require_once ROOT . "/app/model/protocol.php";
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isLoggedOn()) { header("Location: ./?action=connexion"); exit(); }

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idProtocol = intval($_POST["idProtocol"] ?? 0);
    if ($idProtocol > 0 && deleteProtocol($idProtocol)) {
        header("Location: ./?action=createProtocol&succes=1");
    } else {
        header("Location: ./?action=createProtocol&erreur=1");
    }
    exit();
}

header("Location: ./?action=createProtocol");
exit();