<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link rel="stylesheet" href="./public/style/style.css">
    <title>Riwanon Breton - Bienvenue</title>
</head>
<body>
<div class="auth">
<?php

if ( $_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__) ) {
    die('Erreur : '.basename(__FILE__));
}

?>

    <h2>Connexion</h2>
    <form action="./?action=connexion" method="POST">

        <input type="text" name="email" placeholder="Email de connexion" /><br />
        <input type="password" name="password" placeholder="Mot de passe"  /><br />
        <input type="submit" />

    </form>
    <br />
</div>

</body>
</html>