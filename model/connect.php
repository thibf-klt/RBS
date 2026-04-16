<?php

function connexionPDO() {
    try{
        $conn = new PDO("mysql:host=".$_ENV['DB_HOST'].";dbname=".$_ENV['DB_NAME'], $_ENV['DB_LOGIN'], $_ENV['DB_PWD']);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "CONNEXION REUSSIE";
        return $conn;        
    }

    catch(PDOException $e){
        echo "Erreur : " . $e->getMessage();
    }
}

?>