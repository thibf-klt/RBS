
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