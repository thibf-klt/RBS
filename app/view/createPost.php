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

<span class="success">
<?php if ($insertSuccess): ?>
    <p style="color:green;">Article ajouté avec succès !</p>
<?php endif; ?>
</span>
    <form action="./?action=createPost" method="POST" class="form">
        <label for="title">Titre&nbsp;:</label>
        <input type="text" name="title" placeholder="Titre de l'article" required aria-label="Entrez le titre de l'article" aria-required="true"/><br />
        <label for="content">Contenu&nbsp;:</label>
        <input type="text" name="content" placeholder="Contenu ded l'article" required aria-label="Entrez le contenu de l'article" aria-required="true"/><br />
        <label for="date">Date&nbsp;:</label>
        <input type="date" name="date" placeholder="Contenu ded l'article" required aria-label="Entrez le contenu de l'article" aria-required="true"/><br />
        <button type="submit" class="buttonSophro">Ajouter l'article</button>
</form>
 
      
</div>
</body>
</html>