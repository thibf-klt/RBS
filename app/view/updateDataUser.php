<div class="logout">
<?php if (isset($_SESSION['email'])): ?>
    <p>Bonjour, <?= htmlspecialchars($_SESSION['email']) ?></p>
    <div class="choice">
    <a href="index.php?action=logout"> 
        <button class="buttonService">Se déconnecter</button>
    </a>
    <a href="index.php?action=personalSpace"> 
        <button class="buttonService">Retour menu</button>
    </a>
    </div> 
<?php endif; ?>
</div>
<main id="updateData">
    
    <h1>Changer le mot de passe</h1>

    <?php if ($passwordSuccess): ?>
        <div class="success"><p>Mot de passe mis à jour !</p></div>
    <?php endif; ?>

    <form action="index.php?action=updateDataUser" method="post">
        <p>
            <label for="currentPassword">Mot de passe actuel :</label>
            <input type="password" name="currentPassword" id="currentPassword" required>
            <?php if (isset($errors['currentPassword'])): ?>
                <br><span class="error"><?= $errors['currentPassword'] ?></span>
            <?php endif; ?>
        </p>
        <p>
            <label for="newPassword">Nouveau mot de passe :</label>
            <input type="password" name="newPassword" id="newPassword" minlength="8" maxlength="12" required>
            <?php if (isset($errors['newPassword'])): ?>
                <br><span class="error"><?= $errors['newPassword'] ?></span>
            <?php endif; ?>
        </p>
        <p>
            <label for="confirmPassword">Confirmer le mot de passe :</label>
            <input type="password" name="confirmPassword" id="confirmPassword" required>
            <?php if (isset($errors['confirmPassword'])): ?>
                <br><span class="error"><?= $errors['confirmPassword'] ?></span>
            <?php endif; ?>
        </p>
        <p><input type="submit" name="changePassword" class="buttonSophro" value="Changer le mot de passe"></p>
    </form>

    <form action="index.php?action=deleteDataUser" method="post">
    <h2>Supprimer mon compte</h2>
    <p>Attention, cette action est irréversible !</p>

    
    <label for="confirmDeletePassword">Confirmez votre mot de passe :</label>
    <input type="password" id="confirmDeletePassword" name="confirmDeletePassword" required>

    <input type="submit" name="deleteAccount" class="buttonSophro" value="Supprimer mon compte">
</form>
</main>

</body>
</html>