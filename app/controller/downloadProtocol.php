<?php
require_once ROOT . "/app/model/protocol.php";

$id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;

if (!$id) {
    header("Location: ./?action=viewProtocol");
    exit();
}

$protocole = getProtocoleByIdAndUser($id, $_SESSION["idUser"]);

if (!$protocole) {
    header("Location: ./?action=viewProtocol");
    exit();
}

$filePath = ROOT . "/private/pdf/" . $protocole["content"];

if (!file_exists($filePath)) {
    die("Fichier introuvable.");
}

header("Content-Type: application/pdf");
header("Content-Disposition: attachment; filename=\"" . basename($filePath) . "\"");
header("Content-Length: " . filesize($filePath));
readfile($filePath);
exit();