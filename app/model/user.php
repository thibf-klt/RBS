<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once ROOT . "/app/model/connect.php";

/**
 * Récupère un utilisateur par son id
 * @param int $idUser
 * @return array|false
 */
function getUsers(int $idUser) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * FROM USER_ WHERE idUser = :idUser");
        $req->bindValue(':idUser', $idUser, PDO::PARAM_INT);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}

/**
 * Récupère tous les clients (non admins)
 * @return array
 */
function getAllUsers(): array {
    try {
        $cnx  = connexionPDO();
        $stmt = $cnx->prepare("
            SELECT idUser, name, firstName 
            FROM USER_ 
            WHERE isAdmin = 0 
            ORDER BY name, firstName
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erreur BDD getAllUsers : " . $e->getMessage());
        return [];
    }
}

/**
 * Récupère un utilisateur par son email
 * @param string $email
 * @return array|false
 */
function getUserByMail(string $email) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * FROM USER_ WHERE email = :email");
        $req->bindValue(':email', $email, PDO::PARAM_STR);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}

/**
 * @param string $email
 * @param string $password
 * @return bool
 */
function addUser(string $email, string $password): bool {
    try {
        $cnx     = connexionPDO();
        $pwdHash = password_hash($password, PASSWORD_DEFAULT);
        $req     = $cnx->prepare("INSERT INTO USER_ (email, password) VALUES (:email, :password)");
        $req->bindValue(':email',    $email,   PDO::PARAM_STR);
        $req->bindValue(':password', $pwdHash, PDO::PARAM_STR);
        return $req->execute();
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}

if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/', __FILE__)) {
    header('Content-Type: text/plain');
    echo "=== getUsers(1) ===\n";
    print_r(getUsers(1));
    echo "\n=== getAllUsers() ===\n";
    print_r(getAllUsers());
    echo "\n=== getUserByMail('mathieu@gmail.com') ===\n";
    print_r(getUserByMail("mathieu@gmail.com"));
}
?>