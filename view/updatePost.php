
<div id="form">
    <h1>Ajout d'un article de blog</h1>

    <?php if (!empty($insertSuccess)): ?>
        <div class="success">
            <p>L'article a bien été ajouté !</p>
            <a href="index.php" class="button">Ajouter un autre article</a>
        </div>
    <?php else: ?>

        <?php if (isset($errors['db'])): ?>
            <p class="error"><?= htmlspecialchars($errors['db']) ?></p>
        <?php endif; ?>

        <form action="updatePost.php" method="post">

            <p>
                <label for="title">Titre :</label>
                <input type="text" maxlength="30" name="title" id="title"
                       placeholder="Titre"
                       value="<?= htmlspecialchars($_POST['title'] ?? '') ?>">
                <?php if (isset($errors['title'])): ?>
                    <br><span class="error"><?= $errors['title'] ?></span>
                <?php endif; ?>
            </p>

            <p>
                <label for="content">Texte :</label>
                <textarea maxlength="300" name="content" id="content"
                          placeholder="Texte de l'article"><?= htmlspecialchars($_POST['content'] ?? '') ?></textarea>
                <?php if (isset($errors['content'])): ?>
                    <br><span class="error"><?= $errors['content'] ?></span>
                <?php endif; ?>
            </p>

            <p>
                <label for="date">Date :</label>
                <input type="date" name="date" id="date"
                       value="<?= htmlspecialchars($_POST['date'] ?? '') ?>">
                <?php if (isset($errors['date'])): ?>
                    <br><span class="error"><?= $errors['date'] ?></span>
                <?php endif; ?>
            </p>

            <p><input type="submit" class="button" value="Enregistrer"></p>

        </form>

    <?php endif; ?>
</div>