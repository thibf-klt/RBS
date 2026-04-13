<?php
include_once "connect.php";

function getTestimonies(): array {
    $result = [];
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * FROM TESTIMONY");
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur PDO : " . $e->getMessage());
    }
    return $result;
}
?>