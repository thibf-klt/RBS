
<div class="auth">
    <?php if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/', __FILE__)): ?>
        <?php die('Erreur : ' . basename(__FILE__)); ?>
    <?php endif; ?>

    <h1>Connexion</h1>

    <?php if (!empty($erreur)): ?>
        <p class="error"><?= htmlspecialchars($erreur, ENT_QUOTES | ENT_HTML5, 'UTF-8')  ?></p>
    <?php endif; ?>

    <form action="./?action=authentification" method="POST" class="form"> 
        <label for="email">Votre email&nbsp;:</label>
        <input type="email" name="email" id="email" placeholder="Email de connexion"
               required aria-label="Entrez votre email de connexion" aria-required="true"/><br/>
        <label for="password">Votre mot de passe&nbsp;:</label>
        <input type="password" name="password" id="password" placeholder="Mot de passe"
               required aria-label="Entrez votre mot de passe" aria-required="true"/><br/>

        <input type="submit" aria-label="bouton de connexion" class="buttonService" value="Connexion"/>
    </form>
</div>