<?php
require_once ROOT . "/app/model/authentification.php";

if (!isAdmin()) {
    header('Location: ./?action=connexion');
    exit;
}

require_once ROOT . "/app/view/head.php";
require_once ROOT . "/app/view/header.php";
require_once ROOT . "/app/view/menu.php";

$errors        = [];
$insertSuccess = false;

if (!empty($_POST)) {
    $name        = trim($_POST['name']        ?? '');
    $firstName   = trim($_POST['firstName']   ?? '');
    $phoneNumber = trim($_POST['phoneNumber'] ?? '');
    $email       = trim($_POST['email']       ?? '');
    $password    =       $_POST['password']   ?? '';
    // isAdmin peut valoir "0" (non-admin) : on vérifie isset + !== ''
    $isAdmin     = isset($_POST['isAdmin']) && $_POST['isAdmin'] !== ''
                   ? (int)(bool)$_POST['isAdmin']
                   : null;

    // --- Validation contrôleur ---
    if (empty($name))                               $errors['name']        = "Nom requis.";
    if (empty($firstName))                          $errors['firstName']   = "Prénom requis.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email']       = "Email invalide.";
    if (strlen($password) < 8)                      $errors['password']    = "Mot de passe trop court (8 car. min).";
    if (!ctype_digit($phoneNumber))                 $errors['phoneNumber'] = "Numéro invalide (chiffres uniquement).";
    if ($isAdmin === null)                          $errors['isAdmin']     = "Requis.";

    // --- Appel du modèle uniquement si aucune erreur ---
    if (empty($errors)) {
        $result = createUser($name, $firstName, $phoneNumber, $email, $password, $isAdmin);

        if ($result === true) {
            $insertSuccess = true;
        } else {
            // $result contient le tableau d'erreurs remonté par le modèle
            $errors = $result;
        }
    }
}

require_once ROOT . "/app/view/updateUser.php";
require_once ROOT . "/app/view/footer.php";
?>