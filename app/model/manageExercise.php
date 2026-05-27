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
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM exercise WHERE idClient = :idClient ORDER BY date_ DESC");
    $stmt->execute([':idClient' => $idClient]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>