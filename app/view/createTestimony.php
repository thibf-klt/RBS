<div class="logout">
<?php if (isset($_SESSION['email'])): ?>
    <p>Bonjour, <?= htmlspecialchars($_SESSION['email']) ?></p>
    <a href="index.php?action=logout"> 
        <button class="buttonService">Se déconnecter</button>
    </a>
<?php endif; ?>
</div>
<div id="form">
    <h1>Ajout d'un avis</h1>

    <?php if (!empty($insertSuccess)): ?>
        <div class="success">
            <p>L'avis a bien été ajouté !</p>
        </div>
    <?php else: ?>

        <?php if (isset($errors['db'])): ?>
            <p class="error"><?= htmlspecialchars($errors['db']) ?></p>
        <?php endif; ?>

        <form action="updateTestimony.php" method="post">

            <p>
                <label for="title">Titre :</label><br>
                <input type="text" maxlength="30" name="title" id="title"
                       placeholder="Titre"
                       value="<?= htmlspecialchars($_POST['title'] ?? '') ?>">
                <?php if (isset($errors['title'])): ?>
                    <br><span class="error"><?= $errors['title'] ?></span>
                <?php endif; ?>
            </p>

            <p>
                <label for="content">Texte :</label><br>
                <textarea maxlength="300" name="content" id="content"
                    placeholder="Votre texte ici"><?= htmlspecialchars($_POST['content'] ?? '') ?></textarea>
                <?php if (isset($errors['content'])): ?>
                    <br><span class="error"><?= $errors['content'] ?></span>
                <?php endif; ?>
            </p>

            <p>
                <label for="date">Date :</label><br>
                <input type="date" name="date" id="date"
                       value="<?= htmlspecialchars($_POST['date'] ?? '') ?>">
                <?php if (isset($errors['date'])): ?>
                    <br><span class="error"><?= $errors['date'] ?></span>
                <?php endif; ?>
            </p>

            <p><input type="submit" class="buttonSophro" value="Enregistrer"></p>

        </form>

    <?php endif; ?>
</div>