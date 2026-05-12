<?php
require_once ROOT . "/app/model/user.php";

function login($email, $password) {
    if (session_status() === PHP_SESSION_NONE) { session_start(); }
    $user = getUserByMail($email);
    if (!$user) 
        header('Location: index.php?action=authentification');        
    if (password_verify($password, $user["password"])) {
        $_SESSION["email"]  = $email;
        $_SESSION["idUser"] = $user["idUser"];
        $_SESSION["admin"]  = $user["isAdmin"];
        return true; 
    }
    return false; 
    
}

function isAdmin(): bool {
    if (!isLoggedOn()) return false;
    return isset($_SESSION["admin"]) && (bool)$_SESSION["admin"] === true;
}

function requireAdmin(): void {
    if (!isAdmin()) {
        header("Location: /index.php?error=access_denied");
        exit(); 
    }
}

function logout(): void {
    if (session_status() === PHP_SESSION_NONE) { session_start(); }
    $_SESSION = [];
    session_destroy();
    header('Location: index.php?action=authentification');
}

function getMailUserLoggedOn() {
    if (isLoggedOn()) {
        return $_SESSION["email"];
    }
    return null;
}

function isLoggedOn(): bool {
    if (session_status() === PHP_SESSION_NONE) { session_start(); }
    if (!isset($_SESSION["email"], $_SESSION["idUser"])) return false;

    $user = getUserByMail($_SESSION["email"]);
    return $user !== false && $user["email"] === $_SESSION["email"];
}

if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/', __FILE__)) {
    header('Content-Type:text/plain');
    if (isLoggedOn()) {
        echo "logged";
    } else {
        echo "not logged";
    }
    logout();
}
?>