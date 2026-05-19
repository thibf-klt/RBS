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
    
    <form action="./?action=createPost" method="POST" class="form">
        <label for="title">Titre&nbsp;:</label>
        <input type="text" name="title" placeholder="Titre de l'article" required aria-label="Entrez le titre de l'article" aria-required="true"/><br />
        <label for="content">Contenu&nbsp;:</label>
        <input type="text" name="content" placeholder="Contenu ded l'article" required aria-label="Entrez le contenu de l'article" aria-required="true"/><br />
        <label for="date">Date&nbsp;:</label>
        <input type="date" name="content" placeholder="Contenu ded l'article" required aria-label="Entrez le contenu de l'article" aria-required="true"/><br />
        <a href="index.php?action=addProtocol"> 
        <button class="buttonSophro">Ajouter l'article</button>
    </a>    
</form>
    
    
    
</div>
</body>
</html>