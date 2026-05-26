<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // 1. Vérifier qu'un fichier a bien été envoyé
    if (!isset($_FILES["pdf"]) || $_FILES["pdf"]["error"] !== UPLOAD_ERR_OK) {
        $erreur = "Aucun fichier reçu ou erreur lors de l'upload.";
    } else {

        $fichier = $_FILES["pdf"];

        // 2. Vérifier que c'est bien un PDF
        $extension = strtolower(pathinfo($fichier["name"], PATHINFO_EXTENSION));
        $mimetype  = mime_content_type($fichier["tmp_name"]);

        if ($extension !== "pdf" || $mimetype !== "application/pdf") {
            $erreur = "Le fichier doit être un PDF.";

        // 3. Vérifier la taille (ici max 5 Mo)
        } elseif ($fichier["size"] > 5 * 1024 * 1024) {
            $erreur = "Le fichier ne doit pas dépasser 5 Mo.";

        } else {
            // 4. Générer un nom unique pour éviter les conflits
            $nomFichier  = uniqid("pdf_", true) . ".pdf";
            $dossierCible = ROOT . "/uploads/";

            // 5. Créer le dossier s'il n'existe pas
            if (!is_dir($dossierCible)) {
                mkdir($dossierCible, 0755, true);
            }

            // 6. Déplacer le fichier depuis le dossier temporaire
            if (move_uploaded_file($fichier["tmp_name"], $dossierCible . $nomFichier)) {
                $succes = "PDF uploadé avec succès : " . $nomFichier;
            } else {
                $erreur = "Erreur lors de la sauvegarde du fichier.";
            }
        }
    }
}
?>