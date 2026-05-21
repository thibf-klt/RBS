<div class="logout">
    <?php if (isset($_SESSION['email'])): ?>
        <p>Bonjour, <?= htmlspecialchars($firstName . ' ' . $name) ?></p>
        <a href="index.php?action=logout">
            <button class="buttonService">Se déconnecter</button>
        </a>
    <?php endif; ?>
</div>

<div id="form">
    <h2>Ajout d'un témoignage</h2>
    <p>(vous ne pouvez en avoir qu'un sur le site)</p>
    <?php if (!empty($insertSuccess)): ?>
        <div class="success">
            <p>Le témoignage a bien été ajouté !</p>
        </div>
    <?php else: ?>
        <?php if (isset($errors['db'])): ?>
            <p class="error"><?= htmlspecialchars($errors['db']) ?></p>
        <?php endif; ?>
        <form action="index.php?action=manageTestimony" method="post">

            <p>
                <label>Auteur :</label><br>
                <input type="text" 
                       value="<?= htmlspecialchars($firstName . ' ' . $name) ?>" 
                       disabled>
            </p>

            <p>
                <label for="title">Titre :</label><br>
                <input type="text" maxlength="30" name="title" id="title"
                       placeholder="Titre"
                       value="<?= htmlspecialchars($_POST['title'] ?? '') ?>">
                <?php if (isset($errors['title'])): ?>
                    <br><span class="error"><?= htmlspecialchars($errors['title']) ?></span>
                <?php endif; ?>
            </p>

            <p>
                <label for="content">Texte :</label><br>
                <textarea maxlength="300" name="content" id="content"
                          placeholder="Votre texte ici"><?= htmlspecialchars($_POST['content'] ?? '') ?></textarea>
                <?php if (isset($errors['content'])): ?>
                    <br><span class="error"><?= htmlspecialchars($errors['content']) ?></span>
                <?php endif; ?>
            </p>

            <p>
                <label for="date">Date :</label><br>
                <input type="date" name="date" id="date"
                       value="<?= htmlspecialchars($_POST['date'] ?? '') ?>">
                <?php if (isset($errors['date'])): ?>
                    <br><span class="error"><?= htmlspecialchars($errors['date']) ?></span>
                <?php endif; ?>
            </p>

            <p><input type="submit" class="buttonSophro" value="Enregistrer"></p>
        </form>
    <?php endif; ?>
</div>

<div class="deletePost">
    <h2>Suppression d'un témoignage</h2>
    <?php if ($deleteSuccess ?? false): ?>
        <p>Témoignage(s) supprimé(s) avec succès !</p>
    <?php endif; ?>
    <form action="index.php?action=manageTestimony" method="POST">
        <input type="hidden" name="action_type" value="delete" />
        <?php if (!empty($posts)): ?>
            <ul>
                <?php foreach ($posts as $post): ?>
                    <li>
                        <span><?= htmlspecialchars($post['title']) ?></span>
                        <input type="checkbox" name="delete_ids[]" value="<?= (int)$post['idTest'] ?>" />
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucun témoignage pour le moment.</p>
        <?php endif; ?>
        <button type="submit" class="buttonService">Supprimer le témoignage</button>
    </form>
</div>