<div class="logout">
<?php if (isset($_SESSION['email'])): ?>
    <p>Bonjour, <?= htmlspecialchars($_SESSION['email']) ?></p>
    <a href="index.php?action=logout"> 
        <button class="buttonService">Se déconnecter</button>
    </a>
<?php endif; ?>
</div>
<div id="form">
    <h1>Ajout d'un.e client.e</h1>

    <?php if (!empty($insertSuccess)): ?>
    <div class="success">
        <p>Le/la client.e a bien été ajouté !</p>
    </div>
<?php endif; ?>

        <?php if (isset($errors['db'])): ?>
            <p class="error"><?= htmlspecialchars($errors['db']) ?></p>
        <?php endif; ?>

        <form action="index.php?action=updateUser" method="post">

            <p>
                <label for="name">Nom :</label>
                <input type="text" maxlength="30" name="name" id="name"
                       placeholder="Nom"
                       value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                <?php if (isset($errors['name'])): ?>
                    <br><span class="error"><?= $errors['name'] ?></span>
                <?php endif; ?>
            </p>

            <p>
                <label for="firstName">Prénom :</label>
                <input type="text" maxlength="30" name="firstName" id="firstName"
                          placeholder="Prénom" value="<?= htmlspecialchars($_POST['firstName'] ?? '') ?>">

                <?php if (isset($errors['firstName'])): ?>
                    <br><span class="error"><?= $errors['firstName'] ?></span>
                <?php endif; ?>
            </p>

            <p>
                <label for="phoneNumber">Numéro de téléphone :</label>
                <input type="tel" name="phoneNumber" id="phoneNumber" placeholder="0601020304"
                    pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" required
                    value="<?= htmlspecialchars($_POST['phoneNumber'] ?? '') ?>">
                <?php if (isset($errors['phoneNumber'])): ?>
                    <br><span class="error"><?= $errors['phoneNumber'] ?></span>
                <?php endif; ?>
            </p>

            <p>
                <label for="email">Email :</label>
                <input type="email" name="email" id="email" placeholder="prenom(.)nom@quelquechose.bzh"
                       pattern="+@exemple\.com" size="30" required 
                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                <?php if (isset($errors['email'])): ?>
                    <br><span class="error"><?= $errors['email'] ?></span>
                <?php endif; ?>
            </p>

            <p>
                <label for="password">Mot de passe :</label>
                <input type="password" name="password" minlength="8" maxlength="12" required id="password"
                     ?>
                <?php if (isset($errors['password'])): ?>
                    <br><span class="error"><?= $errors['password'] ?></span>
                <?php endif; ?>
            </p>

            <p><input type="submit" class="buttonSophro" value="Enregistrer"></p>

        </form>

</div>

<div id="deleteUser">
    <h1>Suppression d'un.e client.e</h1>

    <?php if (!empty($deleteSuccess)): ?>
        <div class="success"><p>Le/la client.e a bien été supprimé !</p></div>
    <?php endif; ?>

    <?php if (isset($errors['selection'])): ?>
        <p class="error"><?= htmlspecialchars($errors['selection']) ?></p>
    <?php endif; ?>

    <form action="index.php?action=updateUser" method="post">
        <ul>
            <?php
            $users = getAllUsers();
            if (empty($users)): ?>
                <li>Aucun client trouvé.</li>
            <?php else:
                foreach ($users as $user): ?>
                    <li>
                        <label>
                            <input type="checkbox" name="delete_ids[]" value="<?= (int)$user['idUser'] ?>">
                            <?= htmlspecialchars($user['firstName']) ?>
                            <?= htmlspecialchars($user['name']) ?>
                        </label>
                    </li>
            <?php endforeach;
            endif; ?>
        </ul>
        <p><input type="submit" name="deleteSelected" class="buttonService" value="Suppression du/de la client.e"></p>
    </form>
</div>