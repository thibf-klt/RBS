<?php
// CHeck the connection
if (!isset($_SESSION['idUser'])) {
    header('Location: /authentification.php');
    exit;
}

$userId = $_SESSION['idUser'];
require_once ROOT . "/app/model/manageTestimony.php";
$author    = getUserById($pdo, $userId);
$firstName = $author['firstName'] ?? '';
$name      = $author['name']      ?? '';

// Suppress a testimony
$deleteSuccess = false;
if (!empty($_POST) && isset($_POST['action_type']) && $_POST['action_type'] === 'delete') {
    if (isset($_POST['delete_ids'])) {
        $deleteSuccess = deleteTestimoniesByUser($pdo, $_POST['delete_ids'], $userId);
    }
}

// Add a testimony
$errors = [];
if (!empty($_POST) && isset($_POST['title'])) {
    $title   = trim($_POST['title']   ?? '');
    $content = trim($_POST['content'] ?? '');
    $date    = date('Y-m-d');

    if (empty($title))   $errors['title']   = "Requis";
    if (empty($content)) $errors['content'] = "Requis";

    if (empty($errors)) {
        $insertSuccess = createTestimony($pdo, $title, $content, $date, $userId);
        if (!$insertSuccess) {
            $errors['db'] = "Une erreur est survenue, veuillez réessayer.";
        }
    }
}

// Get the testimonies
$posts = getTestimoniesByUser($pdo, $userId);

// Call the view
require_once ROOT . "/app/view/head.php";
require_once ROOT . "/app/view/header.php";
require_once ROOT . "/app/view/menu.php";
require_once ROOT . "/app/view/manageTestimony.php";
require_once ROOT . "/app/view/footer.php";
?>