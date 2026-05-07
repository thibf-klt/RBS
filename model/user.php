<?php
 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
 
require_once ROOT . "/model/connect.php";
 
/**
 * 
 * @param int $idUser
 * @return array|false
 */
function getUsers(int $idUser) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * FROM USER_ WHERE idUser = :idUser");
        $req->bindValue(':idUser', $idUser, PDO::PARAM_INT);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}
 
/**
 * 
 * @param string $email
 * @return array|false
 */
function getUserByMail(string $email) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * FROM USER_ WHERE email = :email");
        $req->bindValue(':email', $email, PDO::PARAM_STR);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC); // retourne false si aucun résultat
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}
 
/**
 * 
 * @param string $email
 * @param string $password
 * @return bool
 */
function addUser(string $email, string $password): bool {
    try {
        $cnx     = connexionPDO();
        $pwdHash = password_hash($password, PASSWORD_DEFAULT); // ← password_hash, plus crypt()
        $req     = $cnx->prepare("INSERT INTO USER_ (email, password) VALUES (:email, :password)");
        $req->bindValue(':email',    $email,   PDO::PARAM_STR);
        $req->bindValue(':password', $pwdHash, PDO::PARAM_STR);
        return $req->execute();
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}
 
if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/', __FILE__)) {
    header('Content-Type: text/plain');
 
    echo "=== getUsers(1) ===\n";
    print_r(getUsers(1));
 
    echo "\n=== getUserByMail('mathieu@gmail.com') ===\n";
    print_r(getUserByMail("mathieu@gmail.com"));
 
    echo "\n=== addUser('test@test.com', 'monMotDePasse') ===\n";
    $ok = addUser("test@test.com", "monMotDePasse");
    echo $ok ? "Utilisateur ajouté avec succès.\n" : "Échec de l'ajout.\n";
}
?>
