<?php
function getUserById($pdo, $idUser) {
    try {
        $stmt = $pdo->prepare("SELECT firstName, name FROM USER_ WHERE idUser = :idUser");
        $stmt->execute([':idUser' => $idUser]);
        return $stmt->fetch();
    } catch (PDOException $e) {
        error_log("Erreur BDD : " . $e->getMessage());
        return false;
    }
}

function createTestimony($pdo, $title, $content, $date, $idUser) {
    try {
        $stmt = $pdo->prepare("
            INSERT INTO TESTIMONY (title, content, date_, idUser)
            VALUES (:title, :content, :date, :idUser)
        ");
        $stmt->bindParam(':title',   $title,   PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':date',    $date,    PDO::PARAM_STR);
        $stmt->bindParam(':idUser',  $idUser,  PDO::PARAM_INT);
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        error_log("Erreur BDD : " . $e->getMessage());
        return false;
    }
}
?>