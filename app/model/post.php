
<?php
require_once ROOT . "/app/model/connect.php";

//Gets posts from the db(the posts will then be shown on screen)
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