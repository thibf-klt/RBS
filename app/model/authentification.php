<?php
require_once ROOT . "/app/model/user.php";

//get the user in the db by his email, check the hashed password, initializing the session if success
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

//check if connected user is an admin, returns a boolean
function isAdmin(): bool
{
    return isset($_SESSION["admin"]) && (bool)$_SESSION["admin"] === true;
}

//blocks access to the page if user is not an admin
function requireAdmin(): void
{
    if (!isAdmin()) {
        header("Location: index.php?error=access_denied");
        exit();
    }
}

//Current user logout. Empties and destroys the session, then send to authentification
function logout(): void
{
    $_SESSION = [];
    session_destroy();
    header('Location: index.php?action=authentification');
    exit();
}

//Returns current connected user's email
function getMailUserLoggedOn(): ?string
{
    return $_SESSION["email"] ?? null;
}

//Check user's connection (checking both email and user's id, returns a boolean)
function isLoggedOn(): bool
{
    return isset($_SESSION["email"], $_SESSION["idUser"]);
}
?>