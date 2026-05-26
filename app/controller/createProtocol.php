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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST["title"] ?? "");

    if (empty($title)) {
        $erreur = "Veuillez remplir le titre.";

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

            // Nom du fichier : titre_timestamp.pdf
            $nomFichier = preg_replace('/[^a-zA-Z0-9]/', '_', $title)
                          . "_" . time() . ".pdf";

            if (move_uploaded_file($fichier["tmp_name"], $dossierCible . $nomFichier)) {
                if (saveProtocole($_SESSION["idUser"], $title, $nomFichier)) {
                    $succes = "Protocole \"" . htmlspecialchars($title) . "\" ajouté avec succès.";
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