<?php
include_once "connect.php";
include_once ROOT . "/app/model/user.php"; 

// Get all protocols for a given user
function getProtocols(int $idUser): array {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * FROM PROTOCOL WHERE idUser = :idUser ORDER BY date_ DESC");
        $req->bindValue(':idUser', $idUser, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur PDO : " . $e->getMessage());
    }
}

// Get a protocol by its id AND check that it belongs to the user
function getProtocoleByIdAndUser(int $idPr, int $idUser): array|false {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("
            SELECT * FROM PROTOCOL 
            WHERE idPr = :idPr AND idUser = :idUser
        ");
        $req->bindValue(':idPr',   $idPr,   PDO::PARAM_INT);  
        $req->bindValue(':idUser', $idUser, PDO::PARAM_INT);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur PDO : " . $e->getMessage());
    }
}

function getAllClients(): array {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT idUser, name, firstName FROM USER_ WHERE isAdmin = 0 ORDER BY name ASC");
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur PDO : " . $e->getMessage());
    }
}
// Save a new protocol (name of PDF file stocked in content)
function saveProtocol(int $idUser, string $title, string $nomFichier): bool {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("
            INSERT INTO PROTOCOL (idUser, title, content, date_)
            VALUES (:idUser, :title, :content, NOW())
        ");
        $req->bindValue(':idUser',  $idUser,     PDO::PARAM_INT);
        $req->bindValue(':title',   $title,      PDO::PARAM_STR);
        $req->bindValue(':content', $nomFichier, PDO::PARAM_STR);
        return $req->execute();
    } catch (PDOException $e) {
        die("Erreur PDO : " . $e->getMessage());
    }
}

function getProtocolsByClient(int $idClient): array {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT idPr, title FROM PROTOCOL WHERE idUser = :idClient ORDER BY date_ DESC");
        $req->bindValue(':idClient', $idClient, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur PDO : " . $e->getMessage());
    }
}

function deleteProtocol(int $idProtocol): bool {
    try {
        $cnx = connexionPDO();
        // 1. Récupérer le nom du fichier
        $req = $cnx->prepare("SELECT content FROM PROTOCOL WHERE idPr = :idPr");
        $req->bindValue(':idPr', $idProtocol, PDO::PARAM_INT);
        $req->execute();
        $row = $req->fetch(PDO::FETCH_ASSOC);
        if (!$row) return false;

        // 2. Supprimer le fichier physique
        $fichier = ROOT . "/private/pdf/" . $row["content"];
        if (file_exists($fichier)) {
            unlink($fichier);
        }

        // 3. Supprimer en BDD
        $req = $cnx->prepare("DELETE FROM PROTOCOL WHERE idPr = :idPr");
        $req->bindValue(':idPr', $idProtocol, PDO::PARAM_INT);
        return $req->execute();
    } catch (PDOException $e) {
        die("Erreur PDO : " . $e->getMessage());
    }
}