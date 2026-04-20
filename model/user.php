<?php

include_once "connect.php";

/*récupère les informations d'un utilisateur à partir de son identifiant
* return array
 */
function getUsers($idUser) {

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from USER_ where idUser=:idUser");
        $req->bindValue(':idUser', $idUser, PDO::PARAM_INT);
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        
    } catch (PDOException $e) {
        die( "Erreur !: " . $e->getMessage() );
    }
    return $result;
}

/*récupère les informations d'un utilisateur à partir de son adress mail
* return array or false
*/
function getUserByMail($email) {

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from USER_ where email=:email");
        $req->bindValue(':email', $email, PDO::PARAM_STR);
        $req->execute();
        
        $result = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die( "Erreur !: " . $e->getMessage() );
    }
    return $result;
}

/* add new user in database with email and password
*retrun boolean
*/
function addUser($email, $password) {
    try {
        $cnx = connexionPDO();

        $pwdCrypt = crypt($password, "sel");
        $req = $cnx->prepare("insert into user (mail, password) values(:mail,:password)");
        $req->bindValue(':email', $email, PDO::PARAM_STR);
        $req->bindValue(':password', $pwdCrypt, PDO::PARAM_STR);
        
        $result = $req->execute();
    } catch (PDOException $e) {
        die( "Erreur !: " . $e->getMessage() );
    }
    return $result;
}



if ( $_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__) ) {
    // prog principal de test
    header('Content-Type:text/plain');

    echo "getUsers() : \n";
    print_r(getUsers());

    echo "getUserByMail(\"mathieu@gmail.dom\") : \n";
    print_r(getUserByMail("mathieu@gmail.dom"));

    echo "addUser('mathieu@gmail.dom', 'azerty', 'mat') : \n";
    addUser("mathieu@gmail.dom", "azerty", "mat");
}
?>
