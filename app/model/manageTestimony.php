<?php
function getUserById($pdo, $userId) {
    try {
        $stmt = $pdo->prepare("SELECT firstName, name FROM USER_ WHERE idUser = :idUser");
        $stmt->execute([':idUser' => $userId]);
        return $stmt->fetch();
    } catch (PDOException $e) {
        error_log("Erreur BDD : " . $e->getMessage());
        return false;
    }
}

function getTestimoniesByUser($pdo, $userId) {
    try {
        $stmt = $pdo->prepare("SELECT idTest, title FROM TESTIMONY WHERE idUser = :idUser");
        $stmt->execute([':idUser' => $userId]);
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Erreur BDD : " . $e->getMessage());
        return [];
    }
}

function createTestimony($pdo, $title, $content, $date, $userId) {
    try {
        $stmt = $pdo->prepare("
            INSERT INTO TESTIMONY (title, content, date_, idUser)
            VALUES (:title, :content, :date, :idUser)
        ");
        $stmt->bindParam(':title',   $title,   PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':date',    $date,    PDO::PARAM_STR);
        $stmt->bindParam(':idUser',  $userId,  PDO::PARAM_INT);
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        error_log("Erreur BDD : " . $e->getMessage());
        return false;
    }
}

function deleteTestimoniesByUser($pdo, $ids, $userId) {
    try {
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $stmt = $pdo->prepare("
            DELETE FROM TESTIMONY 
            WHERE idTest IN ($placeholders) 
            AND idUser = ?
        ");
        $params = array_merge(array_map('intval', $ids), [$userId]);
        $stmt->execute($params);
        return true;
    } catch (PDOException $e) {
        error_log("Erreur BDD : " . $e->getMessage());
        return false;
    }
}
?>