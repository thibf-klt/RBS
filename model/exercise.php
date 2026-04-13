
<?php
include_once ROOT . "/model/connect.php";

function getExercises() {
    $result = [];
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * 
            FROM EXERCISE 
            INNER JOIN USES USING (idEx) 
            INNER JOIN MEDIA USING (idEx)
            INNER JOIN INSERT_ USING (idEx)
            INNER JOIN PDF USING (idEx)");
        $req->execute();
        while ($exercise = $req->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $exercise;
        }
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
    return $result;
}
?>