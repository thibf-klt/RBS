<?php
require_once ROOT . "/app/model/connect.php";

// gets the connected user's data
function getUserById(int $idUser): array|false {
    try {
        $cnx  = connexionPDO();
        $stmt = $cnx->prepare("
            SELECT idUser, name, firstName, phoneNumber, email 
            FROM USER_ 
            WHERE idUser = :idUser
        ");
        $stmt->bindValue(':idUser', $idUser, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erreur BDD getUserById : " . $e->getMessage());
        return false;
    }
}

// updates the connected user's password, values are bound for security reasons
function updatePassword(
    int    $idUser,
    string $currentPassword,
    string $newPassword
): true|array {
    $errors = [];
    try {
        $cnx   = connexionPDO();
        $check = $cnx->prepare("SELECT password FROM USER_ WHERE idUser = :idUser");
        $check->bindValue(':idUser', $idUser, PDO::PARAM_INT);
        $check->execute();
        $row = $check->fetch(PDO::FETCH_ASSOC);

        if (!$row || !password_verify($currentPassword, $row['password'])) {
            $errors['currentPassword'] = "Mot de passe actuel incorrect.";
            return $errors;
        }

        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $stmt = $cnx->prepare("
            UPDATE USER_ SET password = :password WHERE idUser = :idUser
        ");
        $stmt->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindValue(':idUser',   $idUser,         PDO::PARAM_INT);
        $stmt->execute();
        return true;

    } catch (PDOException $e) {
        error_log("Erreur BDD updatePassword : " . $e->getMessage());
        $errors['db'] = "Une erreur est survenue, veuillez réessayer.";
        return $errors;
    }
}

//Deletes the user's account, without removing protocol and exercise
function deleteAccount(int $userId, string $passwordProvided): true|array {
    $errors = [];
    try {
        $cnx  = connexionPDO();
        $stmt = $cnx->prepare("SELECT password FROM USER_ WHERE idUser = :idUser");
        $stmt->bindValue(':idUser', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row || !password_verify($passwordProvided, $row['password'])) {
            $errors['confirmDeletePassword'] = 'Mot de passe incorrect.';
            return $errors;
        }

        $exStmt = $cnx->prepare("SELECT idEx FROM EXERCISE WHERE idClient = :idUser");
        $exStmt->bindValue(':idUser', $userId, PDO::PARAM_INT);
        $exStmt->execute();
        $exIds = $exStmt->fetchAll(PDO::FETCH_COLUMN);

        
        if (!empty($exIds)) {
            $exPlaceholders = implode(',', array_fill(0, count($exIds), '?'));
            foreach (['INSERTING', 'USES', 'UTILIZE'] as $table) {
                $stmt = $cnx->prepare("DELETE FROM $table WHERE idEx IN ($exPlaceholders)");
                $stmt->execute($exIds);
            }
        }

        // Delete only TESTIMONY and UTILIZE (without PROTOCOL and EXERCISE, done by SET NULL)
        foreach (['TESTIMONY', 'UTILIZE'] as $table) {
            $stmt = $cnx->prepare("DELETE FROM $table WHERE idUser = :idUser");
            $stmt->bindValue(':idUser', $userId, PDO::PARAM_INT);
            $stmt->execute();
        }

        // Delete the account
        $deleteUser = $cnx->prepare("DELETE FROM USER_ WHERE idUser = :idUser");
        $deleteUser->bindValue(':idUser', $userId, PDO::PARAM_INT);
        $deleteUser->execute();

        return true;

    } catch (PDOException $e) {
        error_log("Erreur BDD deleteAccount : " . $e->getMessage());
        $errors['db'] = $e->getMessage();
        return $errors;
    }
}
?>