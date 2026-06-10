<?php
require_once ROOT . "/app/model/user.php";

function login($email, $password): bool
{
    $user = getUserByMail($email);
    if (!$user) return false;
    if (password_verify($password, $user["password"])) {
        $_SESSION["email"]  = $email;
        $_SESSION["idUser"] = $user["idUser"];
        $_SESSION["admin"]  = $user["isAdmin"];
        return true;
    }
    return false;
}

function isAdmin(): bool
{
    return isset($_SESSION["admin"]) && (bool)$_SESSION["admin"] === true;
}

function requireAdmin(): void
{
    if (!isAdmin()) {
        header("Location: index.php?error=access_denied");
        exit();
    }
}

function logout(): void
{
    $_SESSION = [];
    session_destroy();
    header('Location: index.php?action=authentification');
    exit();
}

function getMailUserLoggedOn(): ?string
{
    return $_SESSION["email"] ?? null;
}

function isLoggedOn(): bool
{
    return isset($_SESSION["email"], $_SESSION["idUser"]);
}
?>