<?php
require_once ROOT . "/app/model/authentification.php";
require_once ROOT . "/app/model/updateDataUser.php";

// Only a connected user can reach this page
if (!isset($_SESSION['idUser'])) {
    header('Location: ./?action=connexion');
    exit;
}

require_once ROOT . "/app/view/head.php";
require_once ROOT . "/app/view/header.php";
require_once ROOT . "/app/view/menu.php";

$errors          = [];
$updateSuccess   = false;
$passwordSuccess = false;
$deleteSuccess   = false;
$idUser          = (int)$_SESSION['idUser'];

if (!empty($_POST)) {

    // --- Modify the password ---
    } elseif (isset($_POST['changePassword'])) {
        $currentPassword = $_POST['currentPassword'] ?? '';
        $newPassword     = $_POST['newPassword']     ?? '';
        $confirmPassword = $_POST['confirmPassword'] ?? '';

        if (empty($currentPassword))
            $errors['currentPassword'] = "Mot de passe actuel requis.";
        if (strlen($newPassword) < 8)
            $errors['newPassword']     = "Mot de passe trop court (8 car. min).";
        if ($newPassword !== $confirmPassword)
            $errors['confirmPassword'] = "Les mots de passe ne correspondent pas.";

        if (empty($errors)) {
            $result = updatePassword($idUser, $currentPassword, $newPassword);
            if ($result === true) {
                $passwordSuccess = true;
            } else {
                $errors = $result;
            }
        }

    // --- Modify the personal data ---
    } else {
        $name        = trim($_POST['name']        ?? '');
        $firstName   = trim($_POST['firstName']   ?? '');
        $phoneNumber = trim($_POST['phoneNumber'] ?? '');
        $email       = trim($_POST['email']       ?? '');

        if (empty($name))                               $errors['name']        = "Nom requis.";
        if (empty($firstName))                          $errors['firstName']   = "Prénom requis.";
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email']       = "Email invalide.";
        if (!ctype_digit($phoneNumber))                 $errors['phoneNumber'] = "Numéro invalide (chiffres uniquement).";

        if (empty($errors)) {
            $result = updateUserData($idUser, $name, $firstName, $phoneNumber, $email);
            if ($result === true) {
                $updateSuccess     = true;
                $_SESSION['email'] = $email;
            } else {
                $errors = $result;
            }
        }
    }
    // --- delete the account ---
    if (isset($_POST['deleteAccount'])) {
        $passwordProvided = $_POST['confirmDeletePassword'] ?? '';

        if (empty($passwordProvided)) {
            $errors['confirmDeletePassword'] = 'Mot de passe requis.';
        } else {
            $result = deleteAccount($idUser, $passwordProvided);
            if ($result === true) {
                session_destroy();
                header('Location: ./?action=connexion&deleted=1');
                exit;
            } else {
                $errors = $result;
            }
        }

}

$userData = getUserById($idUser);

require_once ROOT . "/app/view/updateDataUser.php";
require_once ROOT . "/app/view/footer.php";
?>