<?php
require_once "user.php";

function login($email, $password) {
    $user = getUserByMail($email);
    if (!$user) return;

    $pwdDB = $user["password"];

    if (password_verify($password, $pwdDB)) {
        $_SESSION["email"]  = $email;
        $_SESSION["idUser"] = $user["idUser"];
        $_SESSION["admin"]  = $user["isAdmin"];
    }
}

function isAdmin(): bool {
    if (!isLoggedOn()) return false;
    return isset($_SESSION["admin"]) && (bool)$_SESSION["admin"] === true;
}

function logout() {
    if (!isset($_SESSION)) {
        session_start();
    }
    unset($_SESSION["email"]);
    unset($_SESSION["idUser"]);
    unset($_SESSION["admin"]);
}

function getMailUserLoggedOn() {
    if (isLoggedOn()) {
        return $_SESSION["email"];
    }
    return null;
}

function isLoggedOn() {
    if (!isset($_SESSION)) {
        session_start();
    }
    if (!isset($_SESSION["email"])) return false;

    $user = getUserByMail($_SESSION["email"]);
    return $user && $user["email"] === $_SESSION["email"];
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