<div class="logout">
<?php if (isset($_SESSION['email'])): ?>
    <p>Bonjour, <?= htmlspecialchars($_SESSION['email']) ?></p>
    <a href="index.php?action=logout"> 
        <button class="buttonService">Se déconnecter</button>
    </a>
<?php endif; ?>
</div>
<div id="updateData">
    <h1>Modifier les données personnelles</h1>

    <?php if ($updateSuccess): ?>
        <div class="success"><p>Vos données ont bien été mises à jour !</p></div>
    <?php endif; ?>
    <?php if (isset($errors['db'])): ?>
        <p class="error"><?= htmlspecialchars($errors['db']) ?></p>
    <?php endif; ?>

    <form action="index.php?action=updateDataUser" method="post">
        <p>
            <label for="name">Nom :</label>
            <input type="text" maxlength="30" name="name" id="name"
                value="<?= htmlspecialchars($_POST['name'] ?? $userData['name'] ?? '') ?>">
            <?php if (isset($errors['name'])): ?>
                <br><span class="error"><?= $errors['name'] ?></span>
            <?php endif; ?>
        </p>
        <p>
            <label for="firstName">Prénom :</label>
            <input type="text" maxlength="30" name="firstName" id="firstName"
                value="<?= htmlspecialchars($_POST['firstName'] ?? $userData['firstName'] ?? '') ?>">
            <?php if (isset($errors['firstName'])): ?>
                <br><span class="error"><?= $errors['firstName'] ?></span>
            <?php endif; ?>
        </p>
        <p>
            <label for="phoneNumber">Numéro de téléphone :</label>
            <input type="tel" name="phoneNumber" id="phoneNumber"
                pattern="[0-9]{10}" required
                value="<?= htmlspecialchars($_POST['phoneNumber'] ?? $userData['phoneNumber'] ?? '') ?>">
            <?php if (isset($errors['phoneNumber'])): ?>
                <br><span class="error"><?= $errors['phoneNumber'] ?></span>
            <?php endif; ?>
        </p>
        <p>
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" size="30" required
                value="<?= htmlspecialchars($_POST['email'] ?? $userData['email'] ?? '') ?>">
            <?php if (isset($errors['email'])): ?>
                <br><span class="error"><?= $errors['email'] ?></span>
            <?php endif; ?>
        </p>
        <p><input type="submit" class="buttonSophro" value="Enregistrer"></p>
    </form>

    <hr>

    <h2>Changer le mot de passe</h2>

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
</div>

</body>
</html>