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
<div class="perso">
    <h3>Bienvenue dans l'espace d'administration du site, <?php echo htmlspecialchars($_SESSION["email"]); ?> !</h3>
        <span class="buttons">
            <a href="index.php?action=updateUser"> 
            <button class="buttonSophro">Gérer les comptes des clients</button>
            </a>
            <a href="index.php?action=createProtocol"> 
            <button class="buttonSophro">Ajouter un protocole</button>
            </a>
            <a href="index.php?action=createExercise"> 
            <button class="buttonSophro">Ajouter des exercices</button>
            </a>
            <a href="index.php?action=createPost"> 
            <button class="buttonSophro">Gérer le blog</button>
            </a>
        </span>
</div>
