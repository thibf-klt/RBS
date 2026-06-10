<?php
if (!isset($_SESSION["email"])) {
    header("Location: ./?action=connexion");
    exit();
}
?>
<div class="logout">
    <?php if (isset($_SESSION['email'])): ?>
        <p>Bonjour, <?= htmlspecialchars($_SESSION['email']) ?></p>
        <div class="choice">
            <a href="index.php?action=logout">
                <button class="buttonService">Se déconnecter</button>
            </a>
            <a href="index.php?action=backoffice">
                <button class="buttonService">Retour menu</button>
            </a>
        </div>
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
        <p class="success">Article ajouté avec succès !</p>
    <?php endif; ?>

    <form action="./?action=createPost" method="POST" class="form">
        <label for="title">Titre&nbsp;:</label>
        <input type="text" name="title" id="title" placeholder="Titre de l'article"
               required aria-label="Entrez le titre de l'article"/><br/>

        <label for="content">Contenu&nbsp;:</label>
        <textarea class="postContent" name="content" id="content" placeholder="Contenu de l'article"
                  required aria-label="Entrez le contenu de l'article"></textarea><br/>

        <button type="submit" class="buttonSophro">Ajouter l'article</button>
    </form>
</div>

<div class="deletePost">
    <h2>Suppression d'un article du blog</h2>

    <?php if ($deleteSuccess ?? false): ?>
        <p style="color:green;">Article(s) supprimé(s) avec succès !</p>
    <?php endif; ?>

    <form action="./?action=createPost" method="POST">
        <input type="hidden" name="action_type" value="delete"/>

        <?php if (!empty($posts)): ?>
            <ul>
                <?php foreach ($posts as $post): ?>
                    <li style="display:flex; justify-content:space-between; align-items:center;">
                        <span>
                            <?= htmlspecialchars($post['title']) ?>
            
                            <small style="color:grey;">
                                <?= date('d/m/Y', strtotime($post['date_'])) ?>
                            </small>
                        </span>
                        <input type="checkbox" name="delete_ids[]" value="<?= (int)$post['idPost'] ?>"/>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucun article pour le moment.</p>
        <?php endif; ?>

        <button type="submit" class="buttonService">Supprimer l'article</button>
    </form>
</div>