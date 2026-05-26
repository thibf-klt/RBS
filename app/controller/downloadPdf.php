<?php
require_once ROOT . "/app/model/authentification.php";
require_once ROOT . "/app/model/protocol.php";
if (session_status() === PHP_SESSION_NONE) { session_start(); }

if (!isLoggedOn()) {
    header("Location: ./?action=connexion");
    exit();
}

$idPr = intval($_GET["id"] ?? 0);


$protocole = getProtocoleByIdAndUser($idPr, $_SESSION["idUser"]);

if (!$protocole) {
    http_response_code(403);
    die("Accès refusé.");
}

$chemin = ROOT . "/private/pdf/" . $protocole["content"];

if (!file_exists($chemin)) {
    http_response_code(404);
    die("Fichier introuvable.");
}

header("Content-Type: application/pdf");
header("Content-Disposition: attachment; filename=\"" . basename($protocole["content"]) . "\"");
header("Content-Length: " . filesize($chemin));
readfile($chemin);
exit();
?>