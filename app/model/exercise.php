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

require ROOT . "/app/view/exercise.php";
?>