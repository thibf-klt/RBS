<?php
// Vérification de la connexion
if (!isset($_SESSION['idUser'])) {
    header('Location: /authentification.php');
    exit;
}

// Récupération de l'auteur via le modèle
$userId = $_SESSION['idUser'];
require_once ROOT . "/app/model/createTestimony.php";
$author    = getUserById($pdo, $userId);
$firstName = $author['firstName'] ?? '';
$name  = $author['name']  ?? '';

$errors = [];
if (!empty($_POST)) {
    $title   = trim($_POST['title']   ?? '');
    $content = trim($_POST['content'] ?? '');
    $date    = $_POST['date']         ?? '';

    // Validation
    if (empty($title))   $errors['title']   = "Requis";
    if (empty($content)) $errors['content'] = "Requis";
    if (empty($date))    $errors['date']    = "Requis";

    // Modèle appelé uniquement s'il n'y a pas d'erreurs
    
}
   if (empty($errors)) {
        $insertSuccess = createTestimony($pdo, $title, $content, $date, $userId);
        if (!$insertSuccess) {
            $errors['db'] = "Une erreur est survenue, veuillez réessayer.";
        }
    }


// Appel de la vue
require_once ROOT . "/app/view/head.php";
require_once ROOT . "/app/view/header.php";
require_once ROOT . "/app/view/menu.php";
require_once ROOT . "/app/view/createTestimony.php";
require_once ROOT . "/app/view/footer.php";
?>