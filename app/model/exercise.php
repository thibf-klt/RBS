<?php
require_once "connect.php";

function getPdf(int $idPdf): array {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * FROM PDF WHERE idPdf = :idPdf");
        $req->bindValue(':idPdf', $idPdf, PDO::PARAM_INT);
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur PDO : " . $e->getMessage());
    }
    return $result;
}

function getMedias(int $idMed): array {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * FROM MEDIA WHERE idMed = :idMed");
        $req->bindValue(':idMed', $idMed, PDO::PARAM_INT);
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur PDO : " . $e->getMessage());
    }
    return $result;
}

function saveExercise(
    int     $idClient,
    string  $title,
    ?string $pdfPath   = null,
    ?string $mediaPath = null
): bool {
    try {
        $cnx = connexionPDO();

        // Table EXERCISE
        $req = $cnx->prepare("INSERT INTO EXERCISE (idClient, title, date_)
                               VALUES (:idClient, :title, CURDATE())");
        $req->bindValue(':idClient', $idClient, PDO::PARAM_INT);
        $req->bindValue(':title',    $title,    PDO::PARAM_STR);
        $req->execute();
        $idExercise = $cnx->lastInsertId();

        // Table PDF si fichier fourni
        if ($pdfPath !== null) {
            $req = $cnx->prepare("INSERT INTO PDF (idExercise, title, content, date_)
                                   VALUES (:idExercise, :title, :content, CURDATE())");
            $req->bindValue(':idExercise', $idExercise, PDO::PARAM_INT);
            $req->bindValue(':title',      $title,      PDO::PARAM_STR);
            $req->bindValue(':content',    $pdfPath,    PDO::PARAM_STR);
            $req->execute();
        }

        // Table MEDIA si fichier fourni
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
        $req = $cnx->prepare("SELECT * FROM EXERCISE WHERE idClient = :idClient
                               ORDER BY date_ DESC");
        $req->bindValue(':idClient', $idClient, PDO::PARAM_INT);
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur PDO : " . $e->getMessage());
    }
    return $result;
}

function getClientFiles(int $idClient): array {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("
            SELECT e.title AS ex_title, p.content AS pdf_path, m.content AS media_path, e.date_
            FROM EXERCISE e
            LEFT JOIN PDF p ON e.title = p.title
            LEFT JOIN MEDIA m ON e.title = m.title
            WHERE e.idClient = :idClient
            ORDER BY e.date_ DESC
        ");
        $req->bindValue(':idClient', $idClient, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur PDO : " . $e->getMessage());
    }
}
?>