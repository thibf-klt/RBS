<?php
require_once ROOT . "/app/model/connect.php";

/**
 * get the connected user's data
 * @param int $idUser
 * @return array|false
 */
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

/**
 * update the the connected user's data
 * @param int    $idUser
 * @param string $name
 * @param string $firstName
 * @param string $phoneNumber
 * @param string $email
 * @return true|array
 */
function updateUserData(
    int    $idUser,
    string $name,
    string $firstName,
    string $phoneNumber,
    string $email
): true|array {
    $errors = [];
    try {
        $cnx   = connexionPDO();
        $check = $cnx->prepare("
            SELECT COUNT(*) FROM USER_ 
            WHERE email = :email AND idUser != :idUser
        ");
        $check->execute([':email' => $email, ':idUser' => $idUser]);
        if ((int)$check->fetchColumn() > 0) {
            $errors['email'] = "Cette adresse email est déjà utilisée.";
            return $errors;
        }

        $stmt = $cnx->prepare("
            UPDATE USER_ 
            SET name = :name, firstName = :firstName, 
                phoneNumber = :phoneNumber, email = :email
            WHERE idUser = :idUser
        ");
        $stmt->bindValue(':name',        $name,        PDO::PARAM_STR);
        $stmt->bindValue(':firstName',   $firstName,   PDO::PARAM_STR);
        $stmt->bindValue(':phoneNumber', $phoneNumber, PDO::PARAM_STR);
        $stmt->bindValue(':email',       $email,       PDO::PARAM_STR);
        $stmt->bindValue(':idUser',      $idUser,      PDO::PARAM_INT);
        $stmt->execute();
        return true;

    } catch (PDOException $e) {
        error_log("Erreur BDD updateUserData : " . $e->getMessage());
        $errors['db'] = "Une erreur est survenue, veuillez réessayer.";
        return $errors;
    }
}

/**
 * update the connected user's password
 * @param int    $idUser
 * @param string $currentPassword
 * @param string $newPassword
 * @return true|array
 */
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

        // 1. Récupérer les idEx des exercices liés
        $exStmt = $cnx->prepare("SELECT idEx FROM EXERCISE WHERE idClient = :idUser");
        $exStmt->bindValue(':idUser', $userId, PDO::PARAM_INT);
        $exStmt->execute();
        $exIds = $exStmt->fetchAll(PDO::FETCH_COLUMN);

        // 2. Supprimer les tables liées aux exercices (sans PDF et MEDIA, gérés par SET NULL)
        if (!empty($exIds)) {
            $exPlaceholders = implode(',', array_fill(0, count($exIds), '?'));
            foreach (['INSERTING', 'USES', 'UTILIZE'] as $table) {
                $stmt = $cnx->prepare("DELETE FROM $table WHERE idEx IN ($exPlaceholders)");
                $stmt->execute($exIds);
            }
        }

        // 3. Supprimer uniquement TESTIMONY et UTILIZE (sans PROTOCOL et EXERCISE, gérés par SET NULL)
        foreach (['TESTIMONY', 'UTILIZE'] as $table) {
            $stmt = $cnx->prepare("DELETE FROM $table WHERE idUser = :idUser");
            $stmt->bindValue(':idUser', $userId, PDO::PARAM_INT);
            $stmt->execute();
        }

        // 4. Supprimer le compte
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