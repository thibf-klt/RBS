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

//Returns an array with all the users
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

//Gets the protocols for a given user by his id
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

//Deletes a user's protocol and the pdf attcahed to it, returns a boolean true when done
function deleteProtocol(int $idProtocol): bool {
    try {
        $cnx = connexionPDO();
        // Get the name of the file
        $req = $cnx->prepare("SELECT content FROM PROTOCOL WHERE idPr = :idPr");
        $req->bindValue(':idPr', $idProtocol, PDO::PARAM_INT);
        $req->execute();
        $row = $req->fetch(PDO::FETCH_ASSOC);
        if (!$row) return false;

        // Delete the file
        $fichier = ROOT . "/private/pdf/" . $row["content"];
        if (file_exists($fichier)) {
            unlink($fichier);
        }

        // Delete in database
        $req = $cnx->prepare("DELETE FROM PROTOCOL WHERE idPr = :idPr");
        $req->bindValue(':idPr', $idProtocol, PDO::PARAM_INT);
        return $req->execute();
    } catch (PDOException $e) {
        die("Erreur PDO : " . $e->getMessage());
    }
}