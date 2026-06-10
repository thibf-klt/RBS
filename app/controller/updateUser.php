<?php
require_once ROOT . "/app/model/authentification.php";
require_once ROOT . "/app/model/user.php";
require_once ROOT . "/app/model/updateUser.php";

if (!isAdmin()) {
    header('Location: ./?action=connexion');
    exit;
}

$errors        = [];
$insertSuccess = false;
$deleteSuccess = false;

if (isset($_SESSION['insertSuccess'])) {
    $insertSuccess = true;
    unset($_SESSION['insertSuccess']);
}

if (!empty($_POST)) {
    // --- Suppression ---
    if (isset($_POST['deleteSelected'])) {
        $ids    = $_POST['delete_ids'] ?? [];
        $result = deleteUsers($ids);
        if ($result === true) {
            $currentUserId = $_SESSION['idUser'] ?? null;
            if ($currentUserId && in_array((int)$currentUserId, array_map('intval', $ids))) {
                session_unset();
                session_destroy();
                header('Location: index.php?action=authentification');
                exit;
            }
            $deleteSuccess = true;
        } else {
            $errors = $result;
        }
    // --- Add ---
    } else {
        $name        = trim($_POST['name']        ?? '');
        $firstName   = trim($_POST['firstName']   ?? '');
        $phoneNumber = trim($_POST['phoneNumber'] ?? '');
        $email       = trim($_POST['email']       ?? '');
        $password    =       $_POST['password']   ?? '';
        $isAdmin     = 0;

        if (empty($name))                               $errors['name']        = "Nom requis.";
        if (empty($firstName))                          $errors['firstName']   = "Prénom requis.";
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email']       = "Email invalide.";
        if (strlen($password) < 8)                      $errors['password']    = "Mot de passe trop court (8 car. min).";
        if (!ctype_digit($phoneNumber))                 $errors['phoneNumber'] = "Numéro invalide (chiffres uniquement).";

        if (empty($errors)) {
            $result = createUser($name, $firstName, $phoneNumber, $email, $password, $isAdmin);
            if ($result === true) {
                $_SESSION['insertSuccess'] = true;
                header('Location: index.php?action=updateUser');
                exit;
            } else {
                $errors = $result;
            }
        }
    }
}

require_once ROOT . "/app/view/head.php";
require_once ROOT . "/app/view/header.php";
require_once ROOT . "/app/view/menu.php";
require_once ROOT . "/app/view/updateUser.php";
require_once ROOT . "/app/view/footer.php";
?>