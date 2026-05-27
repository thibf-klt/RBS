<?php
require_once ROOT . "/app/model/authentification.php";
require_once ROOT . "/app/model/protocol.php";
require_once ROOT . "/app/model/exercise.php";

if (session_status() === PHP_SESSION_NONE) { session_start(); }

if (!isLoggedOn()) {
    header("Location: ./?action=connexion");
    exit();
}

$erreur = "";
$succes = "";
$users  = getAllClients();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idClient = intval($_POST["idClient"] ?? 0);
    $title    = trim($_POST["title"] ?? "");

    if ($idClient === 0) {
        $erreur = "Veuillez sélectionner un.e client.e.";
    } elseif (empty($title)) {
        $erreur = "Veuillez remplir le titre.";
    } else {
        $hasPdf   = isset($_FILES["exercisePdf"])   && $_FILES["exercisePdf"]["error"]   === UPLOAD_ERR_OK;
        $hasMedia = isset($_FILES["exerciseMedia"]) && $_FILES["exerciseMedia"]["error"]  === UPLOAD_ERR_OK;

        if (!$hasPdf && !$hasMedia) {
            $erreur = "Veuillez fournir au moins un fichier (PDF ou média).";
        } else {
            $pdfPath   = null;
            $mediaPath = null;

            // --- Traitement PDF ---
            if ($hasPdf) {
                $fichier   = $_FILES["exercisePdf"];
                $extension = strtolower(pathinfo($fichier["name"], PATHINFO_EXTENSION));
                $mimetype  = mime_content_type($fichier["tmp_name"]);

                if ($extension !== "pdf" || $mimetype !== "application/pdf") {
                    $erreur = "Le fichier PDF doit être un PDF valide.";
                } elseif ($fichier["size"] > 10 * 1024 * 1024) {
                    $erreur = "Le PDF ne doit pas dépasser 10 Mo.";
                } else {
                    $dossierPdf = ROOT . "/private/pdf/";
                    if (!is_dir($dossierPdf)) { mkdir($dossierPdf, 0755, true); }
                    $nomPdf = preg_replace('/[^a-zA-Z0-9]/', '_', $title) . "_" . time() . ".pdf";
                    if (move_uploaded_file($fichier["tmp_name"], $dossierPdf . $nomPdf)) {
                        $pdfPath = $nomPdf;
                    } else {
                        $erreur = "Erreur lors de la sauvegarde du PDF.";
                    }
                }
            }

            // --- Traitement Média (seulement si pas d'erreur PDF) ---
            if (empty($erreur) && $hasMedia) {
                $fichier   = $_FILES["exerciseMedia"];
                $extension = strtolower(pathinfo($fichier["name"], PATHINFO_EXTENSION));
                $allowed   = ["mp3", "mp4"];
                $allowedMimes = ["audio/mpeg", "video/mp4"];
                $mimetype  = mime_content_type($fichier["tmp_name"]);

                if (!in_array($extension, $allowed) || !in_array($mimetype, $allowedMimes)) {
                    $erreur = "Le média doit être un fichier MP3 ou MP4 valide.";
                } elseif ($fichier["size"] > 100 * 1024 * 1024) {
                    $erreur = "Le média ne doit pas dépasser 100 Mo.";
                } else {
                    $dossierMedia = ROOT . "/private/media/";
                    if (!is_dir($dossierMedia)) { mkdir($dossierMedia, 0755, true); }
                    $nomMedia = preg_replace('/[^a-zA-Z0-9]/', '_', $title) . "_" . time() . "." . $extension;
                    if (move_uploaded_file($fichier["tmp_name"], $dossierMedia . $nomMedia)) {
                        $mediaPath = $nomMedia;
                    } else {
                        $erreur = "Erreur lors de la sauvegarde du média.";
                    }
                }
            }

            // --- Sauvegarde en base ---
            if (empty($erreur)) {
                if (saveExercise($idClient, $title, $pdfPath, $mediaPath)) {
                    $succes = "Exercice \"" . htmlspecialchars($title) . "\" ajouté avec succès.";
                } else {
                    $erreur = "Fichier(s) sauvegardé(s) mais erreur en base de données.";
                }
            }
        }
    }
}

require_once ROOT . "/app/view/head.php";
require_once ROOT . "/app/view/header.php";
require_once ROOT . "/app/view/menu.php";
require_once ROOT . "/app/view/manageExercise.php";
require_once ROOT . "/app/view/footer.php";
?>
