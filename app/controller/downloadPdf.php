<?php
require_once ROOT . "/app/model/authentification.php";
require_once ROOT . "/app/model/protocole.php";
if (session_status() === PHP_SESSION_NONE) { session_start(); }

if (!isLoggedOn()) {
    header("Location: ./?action=connexion");
    exit();
}

$idProt = intval($_GET["id"] ?? 0);

// Vérifie que le protocole appartient bien à l'utilisateur connecté
$protocole = getProtocoleByIdAndUser($idProt, $_SESSION["idUser"]);

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