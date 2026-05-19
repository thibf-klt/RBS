<?php
$title   = trim($_POST['title']   ?? '');
$content = trim($_POST['content'] ?? '');
$dateRaw = trim($_POST['date']    ?? '');
$idUser  = $_SESSION['idUser'] ?? null;
$deleteSuccess = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Suppression
    if (isset($_POST['action_type']) && $_POST['action_type'] === 'delete') {
        $idsToDelete = $_POST['delete_ids'] ?? [];
        if (!empty($idsToDelete)) {
            $idsToDelete = array_map('intval', $idsToDelete);
        }
    }

    // Insertion
    if (!isset($_POST['action_type'])) {
        $date = null;
        if (empty($dateRaw)) {
            $errors['date'] = "La date est requise.";
        } else {
            $dateObj = DateTime::createFromFormat('Y-m-d', $dateRaw);
            if (!$dateObj || $dateObj->format('Y-m-d') !== $dateRaw) {
                $errors['date'] = "La date est invalide.";
            } else {
                $date = $dateObj->format('Y-m-d');
            }
        }

        if (empty($title))   $errors['title']   = "Le titre est requis.";
        if (empty($content)) $errors['content'] = "Le contenu est requis.";
        if (!$idUser)        $errors['auth']    = "Utilisateur non connecté.";
    }
}

try {
    $dsn  = "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'] . ";charset=utf8mb4";
    $conn = new PDO($dsn, $_ENV['DB_LOGIN'], $_ENV['DB_PWD'], [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);

    // DELETE
    if ($_SERVER['REQUEST_METHOD'] === 'POST'
        && isset($_POST['action_type'])
        && $_POST['action_type'] === 'delete'
        && !empty($idsToDelete)) {

        $placeholders = implode(',', array_fill(0, count($idsToDelete), '?'));
        $stmtDelete = $conn->prepare("DELETE FROM POST WHERE idPost IN ($placeholders)");
        $stmtDelete->execute($idsToDelete);
        $deleteSuccess = true;
        header("Location: ./?action=createPost&deleted=1");
        exit();
    }

    // INSERT
    if ($_SERVER['REQUEST_METHOD'] === 'POST'
        && !isset($_POST['action_type'])
        && empty($errors)) {

        $stmt = $conn->prepare("
            INSERT INTO POST (title, content, date_)
            VALUES (:title, :content, :date)
        ");
        $stmt->bindParam(':title',   $title,   PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':date',    $date,    PDO::PARAM_STR);        
        $stmt->execute();
        $insertSuccess = true;
        header("Location: ./?action=createPost&success=1");
        exit();
    }

        
    $stmtPosts = $conn->query("SELECT idPost, title FROM POST ORDER BY date_ DESC");
    $posts = $stmtPosts->fetchAll();

} catch (PDOException $e) {
    error_log("Erreur BDD : " . $e->getMessage());
    $errors['db'] = $e->getMessage();
}
?>