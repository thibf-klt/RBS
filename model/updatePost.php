
<?php


try {
    // Connexion PDO
    $dsn  = "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'] . ";charset=utf8mb4";
    $conn = new PDO($dsn, $_ENV['DB_LOGIN'], $_ENV['DB_PWD'], [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);

    // Secure insertion
    $stmt = $conn->prepare("
        INSERT INTO POST (title, content, date_)
        VALUES (:title, :content, :date)
    ");
    $stmt->bindParam(':title',   $title,   PDO::PARAM_STR);
    $stmt->bindParam(':content', $content, PDO::PARAM_STR);
    $stmt->bindParam(':date',    $date,    PDO::PARAM_STR);
    $stmt->execute();

    $insertSuccess = true;

} catch (PDOException $e) {
    
    error_log("Erreur BDD : " . $e->getMessage());
    $errors['db'] = "Une erreur est survenue, veuillez réessayer.";
}
?>