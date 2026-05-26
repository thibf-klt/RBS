<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Check that the file was sent
    if (!isset($_FILES["pdf"]) || $_FILES["pdf"]["error"] !== UPLOAD_ERR_OK) {
        $erreur = "Aucun fichier reçu ou erreur lors de l'upload.";
    } else {

        $fichier = $_FILES["pdf"];

        // Check that it is a pdf file
        $extension = strtolower(pathinfo($fichier["name"], PATHINFO_EXTENSION));
        $mimetype  = mime_content_type($fichier["tmp_name"]);

        if ($extension !== "pdf" || $mimetype !== "application/pdf") {
            $erreur = "Le fichier doit être un PDF.";

        // Check the size (max 5 Mo)
        } elseif ($fichier["size"] > 5 * 1024 * 1024) {
            $erreur = "Le fichier ne doit pas dépasser 5 Mo.";

        } else {
            // Generate a unique name to avoid conflicts
            $nomFichier  = uniqid("pdf_", true) . ".pdf";
            $dossierCible = ROOT . "/uploads/";

            // Create the file if not present
            if (!is_dir($dossierCible)) {
                mkdir($dossierCible, 0755, true);
            }

            // Move the file
            if (move_uploaded_file($fichier["tmp_name"], $dossierCible . $nomFichier)) {
                $succes = "PDF uploadé avec succès : " . $nomFichier;
            } else {
                $erreur = "Erreur lors de la sauvegarde du fichier.";
            }
        }
    }
}
?>