<?php

if ( $_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__) ) {
    die('Erreur : '.basename(__FILE__));
}

?>
<h1>Connexion</h1>
<form action="./?action=connexion" method="POST">

    <input type="text" name="email" placeholder="Email de connexion" /><br />
    <input type="password" name="password" placeholder="Mot de passe"  /><br />
    <input type="submit" />

</form>
<br />

