
<?php
require_once ROOT . "/model/connect.php";

function getPosts() {
    $result = [];
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * FROM POST");
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
    return $result;
}
?>