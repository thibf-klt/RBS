<?php

try {
    // Connexion PDO
    $dsn  = "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'] . ";charset=utf8mb4";
    $conn = new PDO($dsn, $_ENV['DB_LOGIN'], $_ENV['DB_PWD'], [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);
    // password hashing
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Secure insertion
    $stmt = $conn->prepare("
        INSERT INTO USER_ (name, firstName, phoneNumber, email, password, isAdmin)
        VALUES (:name, :firstName, :phoneNumber, :email, :password, :isAdmin)
    ");
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
    $stmt->bindParam(':phoneNumber', $phoneNumber, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR); 
    $stmt->bindParam(':isAdmin', $isAdmin, PDO::PARAM_STR);
    $stmt->execute();

    $insertSuccess = true;

} catch (PDOException $e) {
    
    error_log("Erreur BDD : " . $e->getMessage());
    $errors['db'] = "Une erreur est survenue, veuillez réessayer.";
}
?>