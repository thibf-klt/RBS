<?php

include_once "connect.php";

function getProtocols(int $idUser): array {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * FROM PROTOCOL WHERE idUser = :idUser");
        $req->bindValue(':idUser', $idUser, PDO::PARAM_INT);
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur PDO : " . $e->getMessage());
    }
    return $result;
}

require ROOT . "/view/protocol.php";
?>