<?php

require_once "user.php";
// opening the session or restoring a previous one found on the server
function login($email, $password) {

    $user = getUserByMail($email);
    if (!$user) return;
    $pwdDB = $user["password"];

    if (trim($pwdDB) == trim(crypt($password, $pwdDB))) {
        // le mot de passe est celui de l'utilisateur dans la base de donnees
        $_SESSION["email"] = $email;
        $_SESSION["idUser"] = $user["idUser"];
        $_SESSION["admin"] = $user["isAdmin"];
    }
}

function logout() {
    if (!isset($_SESSION)) {
        session_start();
    }
    unset($_SESSION["email"]);
    unset($_SESSION["password"]);
}

function getMailUserLoggedOn(){
    if (isLoggedOn()){
        $ret = $_SESSION["email"];
    }
    else {
        $ret = null;
    }
    return $ret;
        
}

function isLoggedOn() {
    if (!isset($_SESSION)) {
        session_start();
    }
    $ret = false;

    if (isset($_SESSION["mail"])) {
        $user = getUserByMail($_SESSION["email"]);
        if ($user["email"] == $_SESSION["email"] && $user["password"] == $_SESSION["password"]
        ) {
            $ret = true;
        }
    }
    return $ret;
}

if ( $_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__) ) {
    // prog principal de test
    header('Content-Type:text/plain');


    // test de connexion
    login("test@kercode.dev", "kercode");
    if (isLoggedOn()) {
        echo "logged";
    } else {
        echo "not logged";
    }

    // deconnexion
    logout();
}

?>