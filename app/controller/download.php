<?php
require_once ROOT . "/app/model/authentification.php";

// Verify the session
if (!isset($_SESSION['idUser'])) {
    header('Location: ./?action=connexion');
    exit;
}

$file     = basename($_GET['file'] ?? ''); 
$filePath = ROOT . "/private/pdf/" . $file;

if (empty($file) || !file_exists($filePath)) {
    http_response_code(404);
    die("Fichier introuvable.");
}

// send the file to the browser
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . $file . '"');
header('Content-Length: ' . filesize($filePath));
readfile($filePath);
exit;