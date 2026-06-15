<?php
require_once "connect.php";

//Gets protocols for a given user, baser on its id
function getProtocolById(int $id, int $idUser): array|false {
    $db = connexionPDO();
    $stmt = $db->prepare("SELECT * FROM protocole WHERE idPr = :id AND idUser = :idUser");
    $stmt->execute([":id" => $id, ":idUser" => $idUser]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>