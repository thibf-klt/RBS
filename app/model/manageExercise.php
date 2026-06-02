<?php
require_once ROOT . "/app/model/database.php"; 

function saveExercise(
    int     $idClient,
    string  $title,
    ?string $pdfPath   = null,
    ?string $mediaPath = null
): bool {
    try {
        $cnx = connexionPDO();

        // Insérer dans EXERCISE
        $req = $cnx->prepare("INSERT INTO EXERCISE (idClient, title, content, date_)
                               VALUES (:idClient, :title, '', CURDATE())");
        $req->bindValue(':idClient', $idClient, PDO::PARAM_INT);
        $req->bindValue(':title',    $title,    PDO::PARAM_STR);
        $req->execute();
        $idExercise = $cnx->lastInsertId();

        // Insert into PDF if fichier given
        if ($pdfPath !== null) {
            $req = $cnx->prepare("INSERT INTO PDF (idExercise, title, content, date_)
                                   VALUES (:idExercise, :title, :content, CURDATE())");
            $req->bindValue(':idExercise', $idExercise, PDO::PARAM_INT);
            $req->bindValue(':title',      $title,      PDO::PARAM_STR);
            $req->bindValue(':content',    $pdfPath,    PDO::PARAM_STR);
            $req->execute();
        }

        // Insert into MEDIA if file given
        if ($mediaPath !== null) {
            $req = $cnx->prepare("INSERT INTO MEDIA (idExercise, title, content, date_)
                                   VALUES (:idExercise, :title, :content, CURDATE())");
            $req->bindValue(':idExercise', $idExercise, PDO::PARAM_INT);
            $req->bindValue(':title',      $title,      PDO::PARAM_STR);
            $req->bindValue(':content',    $mediaPath,  PDO::PARAM_STR);
            $req->execute();
        }

        return true;

    } catch (PDOException $e) {
        die("Erreur PDO : " . $e->getMessage());
    }
}

function getAllExercisesByClient(int $idClient): array {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT idExercise, title FROM EXERCISE WHERE idClient = :idClient ORDER BY date_ DESC");
        $req->bindValue(':idClient', $idClient, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur PDO : " . $e->getMessage());
    }
}
function deleteExercise(int $idExercise): bool {
    try {
        $cnx = connexionPDO();

        // 1. Récupérer les fichiers associés
        $req = $cnx->prepare("SELECT content FROM PDF WHERE idExercise = :id");
        $req->bindValue(':id', $idExercise, PDO::PARAM_INT);
        $req->execute();
        foreach ($req->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $f = ROOT . "/private/pdf/" . $row["content"];
            if (file_exists($f)) unlink($f);
        }

        $req = $cnx->prepare("SELECT content FROM MEDIA WHERE idExercise = :id");
        $req->bindValue(':id', $idExercise, PDO::PARAM_INT);
        $req->execute();
        foreach ($req->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $f = ROOT . "/private/media/" . $row["content"];
            if (file_exists($f)) unlink($f);
        }

        // 2. Supprimer PDF et MEDIA en BDD (si pas de CASCADE)
        $cnx->prepare("DELETE FROM PDF WHERE idExercise = :id")->execute([':id' => $idExercise]);
        $cnx->prepare("DELETE FROM MEDIA WHERE idExercise = :id")->execute([':id' => $idExercise]);

        // 3. Supprimer l'exercice
        $req = $cnx->prepare("DELETE FROM EXERCISE WHERE idEx = :id");
        $req->bindValue(':id', $idExercise, PDO::PARAM_INT);
        return $req->execute();

    } catch (PDOException $e) {
        die("Erreur PDO : " . $e->getMessage());
    }
}
?>