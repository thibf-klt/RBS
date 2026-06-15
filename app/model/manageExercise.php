<?php
require_once ROOT . "/app/model/database.php";

//Saves an exercise and its associated files in the db
function saveExercise(int $idClient, string $title, ?string $pdfPath = null, ?string $mediaPath = null): bool {
    try {
        $cnx = connexionPDO();

        $req = $cnx->prepare("INSERT INTO EXERCISE (idClient, title, content, date_)
                               VALUES (:idClient, :title, '', CURDATE())");
        $req->bindValue(':idClient', $idClient, PDO::PARAM_INT);
        $req->bindValue(':title',    $title,    PDO::PARAM_STR);
        $req->execute();
        $idEx = $cnx->lastInsertId();

        if ($pdfPath !== null) {
            $req = $cnx->prepare("INSERT INTO PDF (idEx, title, content, date_)
                                   VALUES (:idEx, :title, :content, CURDATE())");
            $req->bindValue(':idEx',    $idEx,     PDO::PARAM_INT);
            $req->bindValue(':title',   $title,    PDO::PARAM_STR);
            $req->bindValue(':content', $pdfPath,  PDO::PARAM_STR);
            $req->execute();
        }

        if ($mediaPath !== null) {
            $req = $cnx->prepare("INSERT INTO MEDIA (idEx, title, content, date_)
                                   VALUES (:idEx, :title, :content, CURDATE())");
            $req->bindValue(':idEx',    $idEx,      PDO::PARAM_INT);
            $req->bindValue(':title',   $title,     PDO::PARAM_STR);
            $req->bindValue(':content', $mediaPath, PDO::PARAM_STR);
            $req->execute();
        }

        return true;

    } catch (PDOException $e) {
        error_log("Erreur saveExercise : " . $e->getMessage());
        return false;
    }
}

//GEts all exercises assigned to a user, from the most recent to the oldest. Returns only idEx and title, sufficient for dropdown menus
function getAllExercisesByClient(int $idClient): array {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT idEx, title FROM EXERCISE
                               WHERE idClient = :idClient ORDER BY date_ DESC");
        $req->bindValue(':idClient', $idClient, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        error_log("Erreur getAllExercisesByClient : " . $e->getMessage());
        return [];
    }
}

//Deletes an exercise and its attached files
function deleteExercise(int $idEx): bool {
    try {
        $cnx = connexionPDO();

        // Get and delete pdf files
        $req = $cnx->prepare("SELECT content FROM PDF WHERE idEx = :id");
        $req->bindValue(':id', $idEx, PDO::PARAM_INT);
        $req->execute();
        foreach ($req->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $f = ROOT . "/private/pdf/" . $row["content"];
            if (file_exists($f)) unlink($f);
        }

        // Get and delete media files
        $req = $cnx->prepare("SELECT content FROM MEDIA WHERE idEx = :id");
        $req->bindValue(':id', $idEx, PDO::PARAM_INT);
        $req->execute();
        foreach ($req->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $f = ROOT . "/private/media/" . $row["content"];
            if (file_exists($f)) unlink($f);
        }

        // Delete PDF and MEDIA in db
        $cnx->prepare("DELETE FROM PDF   WHERE idEx = :id")->execute([':id' => $idEx]);
        $cnx->prepare("DELETE FROM MEDIA WHERE idEx = :id")->execute([':id' => $idEx]);

        // Delete the exercise
        $req = $cnx->prepare("DELETE FROM EXERCISE WHERE idEx = :id");
        $req->bindValue(':id', $idEx, PDO::PARAM_INT);
        $req->execute();

        return $req->rowCount() > 0;

    } catch (PDOException $e) {
        error_log("Erreur deleteExercise : " . $e->getMessage());
        return false;
    }
}
?>