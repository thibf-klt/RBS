<?php
require_once ROOT . "/app/model/authentification.php";
require_once ROOT . "/app/model/protocol.php";
if (session_status() === PHP_SESSION_NONE) { session_start(); }

if (!isLoggedOn()) {
    header("Location: ./?action=connexion");
    exit();
}

$erreur = "";
$succes = "";
$users  = getAllUsers(); // ← pour le menu déroulant

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idClient  = intval($_POST["idClient"]  ?? 0);  // ← idUser du CLIENT
    $firstName = trim($_POST["firstName"]   ?? "");
    $name      = trim($_POST["name"]        ?? "");
    $title     = trim($_POST["title"]       ?? "");

    if (empty($firstName) || empty($name) || empty($title) || $idClient === 0) {
        $erreur = "Veuillez remplir tous les champs.";

    } elseif (!isset($_FILES["protocol"]) || $_FILES["protocol"]["error"] !== UPLOAD_ERR_OK) {
        $erreur = "Aucun fichier reçu ou erreur lors de l'upload.";

    } else {
        $fichier   = $_FILES["protocol"];
        $extension = strtolower(pathinfo($fichier["name"], PATHINFO_EXTENSION));
        $mimetype  = mime_content_type($fichier["tmp_name"]);

        if ($extension !== "pdf" || $mimetype !== "application/pdf") {
            $erreur = "Le fichier doit être un PDF.";

        } elseif ($fichier["size"] > 10 * 1024 * 1024) {
            $erreur = "Le fichier ne doit pas dépasser 10 Mo.";

        } else {
            $dossierCible = ROOT . "/private/pdf/";
            if (!is_dir($dossierCible)) {
                mkdir($dossierCible, 0755, true);
            }

            $nomFichier = preg_replace('/[^a-zA-Z0-9]/', '_', $name . "_" . $firstName . "_" . $title)
                          . "_" . time() . ".pdf";

            if (move_uploaded_file($fichier["tmp_name"], $dossierCible . $nomFichier)) {
                
                if (saveProtocol($idClient, $title, $nomFichier)) {
                    $succes = "Protocole \"" . htmlspecialchars($title) . "\" pour "
                              . htmlspecialchars($firstName . " " . $name)
                              . " ajouté avec succès.";
                } else {
                    $erreur = "Fichier sauvegardé mais erreur en base de données.";
                }
            } else {
                $erreur = "Erreur lors de la sauvegarde du fichier.";
            }
        }
    }
}

require_once ROOT . "/app/view/head.php";
require_once ROOT . "/app/view/header.php";
require_once ROOT . "/app/view/menu.php";
require_once ROOT . "/app/view/createProtocol.php";
require_once ROOT . "/app/view/footer.php";
?>