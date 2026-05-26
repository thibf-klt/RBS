<?php
include_once "connect.php";

// Récupérer tous les protocoles d'un utilisateur
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

// Récupérer un protocole par son id ET vérifier qu'il appartient à l'utilisateur
function getProtocoleByIdAndUser(int $idProt, int $idUser): array|false {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("
            SELECT * FROM PROTOCOL 
            WHERE idProt = :idProt AND idUser = :idUser
        ");
        $req->bindValue(':idProt',  $idProt,  PDO::PARAM_INT);
        $req->bindValue(':idUser',  $idUser,  PDO::PARAM_INT);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur PDO : " . $e->getMessage());
    }
}

// Sauvegarder un nouveau protocole (nom du fichier PDF stocké dans content)
function saveProtocole(int $idUser, string $title, string $nomFichier): bool {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("
            INSERT INTO PROTOCOL (idUser, title, content, date_)
            VALUES (:idUser, :title, :content, NOW())
        ");
        $req->bindValue(':idUser',  $idUser,      PDO::PARAM_INT);
        $req->bindValue(':title',   $title,       PDO::PARAM_STR);
        $req->bindValue(':content', $nomFichier,  PDO::PARAM_STR);
        return $req->execute();
    } catch (PDOException $e) {
        die("Erreur PDO : " . $e->getMessage());
    }
}
?>