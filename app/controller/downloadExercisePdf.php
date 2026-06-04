<?php
require_once ROOT . "/app/model/authentification.php";
if (session_status() === PHP_SESSION_NONE) { session_start(); }

if (!isLoggedOn()) {
    header("Location: ./?action=connexion");
    exit();
}

$file     = basename($_GET['file'] ?? '');
$filePath = ROOT . "/private/pdf/" . $file;

if (empty($file) || !file_exists($filePath)) {
    http_response_code(404);
    die("Fichier introuvable.");
}

header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . $file . '"');
header('Content-Length: ' . filesize($filePath));
readfile($filePath);
exit;