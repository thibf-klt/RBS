
<?php
include_once ROOT . "/model/connect.php";

function getPosts() {
    $result = [];
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * FROM POSTS");
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
    return $result;
}
?>