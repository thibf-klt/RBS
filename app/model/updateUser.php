<?php

require_once ROOT . "/app/model/connect.php";

/**
 * @return true|array
 */
function createUser(
    string $name,
    string $firstName,
    string $phoneNumber,
    string $email,
    string $password,
    int    $isAdmin
): true|array {
    $errors = [];
    try {
        $conn = connexionPDO();

        // check is email not already used
        $check = $conn->prepare("SELECT COUNT(*) FROM USER_ WHERE email = :email");
        $check->execute([':email' => $email]);
        if ((int)$check->fetchColumn() > 0) {
            $errors['email'] = "Cette adresse email est déjà utilisée.";
            return $errors;
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("
            INSERT INTO USER_ (name, firstName, phoneNumber, email, password, isAdmin)
            VALUES (:name, :firstName, :phoneNumber, :email, :password, :isAdmin)
        ");
        $stmt->bindParam(':name',        $name,           PDO::PARAM_STR);
        $stmt->bindParam(':firstName',   $firstName,      PDO::PARAM_STR);
        $stmt->bindParam(':phoneNumber', $phoneNumber,    PDO::PARAM_STR);
        $stmt->bindParam(':email',       $email,          PDO::PARAM_STR);
        $stmt->bindParam(':password',    $hashedPassword, PDO::PARAM_STR);
        $stmt->bindParam(':isAdmin',     $isAdmin,        PDO::PARAM_INT);
        $stmt->execute();
        return true;

    } catch (PDOException $e) {
        error_log("Erreur BDD createUser : " . $e->getMessage());
        $errors['db'] = "Une erreur est survenue, veuillez réessayer.";
        return $errors;
    }
}

/**
 * Suppress selected customers (non admin only)
 * @param array $ids
 * @return true|array
 */
function deleteUsers(array $ids): true|array {
    if (empty($ids)) {
        return ['selection' => "Aucun client sélectionné."];
    }
    try {
        $conn         = connexionPDO();
        $ids          = array_map('intval', $ids);
        $placeholders = implode(',', array_fill(0, count($ids), '?'));

        $stmt = $conn->prepare("
            DELETE FROM USER_ 
            WHERE idUser IN ($placeholders) 
            AND isAdmin = 0
        ");
        $stmt->execute($ids);
        return true;

    } catch (PDOException $e) {
        error_log("Erreur BDD deleteUsers : " . $e->getMessage());
        return ['db' => "Une erreur est survenue, veuillez réessayer."];
    }
}
?>