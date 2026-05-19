<?php

$errors = [];
$insertSuccess = false;

$title   = trim($_POST['title']   ?? '');
$content = trim($_POST['content'] ?? '');
$date    = date('Y-m-d H:i:s');
$idUser  = $_SESSION['idUser'] ?? null;

if (empty($title))   $errors['title']   = "Le titre est requis.";
if (empty($content)) $errors['content'] = "Le contenu est requis.";
if (!$idUser)        $errors['auth']    = "Utilisateur non connecté.";

if (empty($errors)) {
    try {
        $dsn  = "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'] . ";charset=utf8mb4";
        $conn = new PDO($dsn, $_ENV['DB_LOGIN'], $_ENV['DB_PWD'], [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);

        $stmt = $conn->prepare("
            INSERT INTO POST (title, content, date_, idUser)
            VALUES (:title, :content, :date, :idUser)
        ");
        $stmt->bindParam(':title',   $title,   PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':date',    $date,    PDO::PARAM_STR);
        $stmt->bindParam(':idUser',  $idUser,  PDO::PARAM_INT);
        $stmt->execute();

        $insertSuccess = true;
    } catch (PDOException $e) {
        error_log("Erreur BDD : " . $e->getMessage());
        $errors['db'] = "Une erreur est survenue, veuillez réessayer.";
    }
}
?>