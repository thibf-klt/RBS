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
    if (isset($_POST['changePassword'])) {
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
    // --- delete the account ---
    } elseif (isset($_POST['deleteAccount'])) {
        $passwordProvided = $_POST['confirmDeletePassword'] ?? '';

        if (empty($passwordProvided)) {
            $errors['confirmDeletePassword'] = 'Mot de passe requis.';
        } else {
            $result = deleteAccount($idUser, $passwordProvided);
            if ($result === true) {
                session_destroy();
                header('Location: ./?action=authentification&deleted=1');
                exit;
            } else {
                $errors = $result;
            }
        }
    }
}


$userData = getUserById($idUser);

require_once ROOT . "/app/view/updateDataUser.php";
require_once ROOT . "/app/view/footer.php";
?>