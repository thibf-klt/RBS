
<div class="auth">
<?php

if ( $_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__) ) {
    die('Erreur : '.basename(__FILE__));
}

?>

    <h2>Connexion</h2>

<?php if (!empty($erreur)) : ?>
    <p class="error"><?= htmlspecialchars($erreur) ?></p>
<?php endif; ?>

    <form action="./?action=connexion" method="POST">
        <label for="email">Votre email&nbsp;:</label>
        <input type="text" name="email" placeholder="Email de connexion" required aria-label="Entrez votre email de connexion" aria-required="true"/><br />
        <label for="password">Votre mot de passe&nbsp;:</label>
        <input type="password" name="password" placeholder="Mot de passe"  required aria-label="Entrez votre mot de passe" aria-required="true"/><br />
        <input type="submit" aria-label="bouton de connexion"/>

    </form>
    <br />
</div>

</body>
</html>