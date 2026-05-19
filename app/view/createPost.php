<?php
if (!isset($_SESSION["email"])) {
    header("Location: ./?action=connexion");
    exit();
}
?>
<div class="logout">
    <?php if (isset($_SESSION['email'])): ?>
        <p>Bonjour, <?= htmlspecialchars($_SESSION['email']) ?></p>
        <a href="index.php?action=logout">
            <button class="buttonService">Se déconnecter</button>
        </a>
    <?php endif; ?>
</div>

<div id="createProtocol">
    <h2>Ajout d'un article au blog</h2>

    <?php if (!empty($errors)): ?>
        <ul class="errors">
            <?php foreach ($errors as $err): ?>
                <li style="color:red;"><?= htmlspecialchars($err) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php if ($insertSuccess): ?>
        <p style="color:green;">Article ajouté avec succès !</p>
    <?php endif; ?>

    <form action="./?action=createPost" method="POST" class="form">
        <label for="title">Titre&nbsp;:</label>
        <input type="text" name="title" placeholder="Titre de l'article" required aria-label="Entrez le titre de l'article" aria-required="true"/><br />

        <label for="content">Contenu&nbsp;:</label>
        <input type="text" name="content" placeholder="Contenu de l'article" required aria-label="Entrez le contenu de l'article" aria-required="true"/><br />

        <label for="date">Date&nbsp;:</label>
        <input type="date" name="date" required aria-label="Entrez la date de l'article" aria-required="true"/><br />

        <button type="submit" class="buttonSophro">Ajouter l'article</button>
    </form>
</div>

<div class="deletePost">
    <h2>Suppression d'un article du blog</h2>

    <?php if ($deleteSuccess ?? false): ?>
        <p style="color:green;">Article(s) supprimé(s) avec succès !</p>
    <?php endif; ?>

    <form action="./?action=createPost" method="POST">
        <input type="hidden" name="action_type" value="delete" />

        <?php if (!empty($posts)): ?>
    <ul style="list-style:none; padding:0;">
        <?php foreach ($posts as $post): ?>
            <li style="display:flex; justify-content:space-between; align-items:center;">
                <span><?= htmlspecialchars($post['title']) ?></span>
                <input type="checkbox" name="delete_ids[]" value="<?= (int)$post['idPost'] ?>" />
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucun article pour le moment.</p>
<?php endif; ?>

        <button type="submit" class="buttonService">Supprimer l'article</button>
    </form>
</div>
</body>
</html>