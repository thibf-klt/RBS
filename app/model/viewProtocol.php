<?php
require_once "connect.php";

function getProtocolById(int $id, int $idUser): array|false {
    $db = connexionPDO();
    $stmt = $db->prepare("SELECT * FROM protocole WHERE idPr = :id AND idUser = :idUser");
    $stmt->execute([":id" => $id, ":idUser" => $idUser]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>