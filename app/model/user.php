<?php

require_once ROOT . "/app/model/connect.php";

// Gets a user by his id
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

//Get all users (not admin)
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

//Gets a user by email
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

//Adds a new user, returns boolean when done
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
