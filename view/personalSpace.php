<?php
if (!isset($_SESSION["email"])) {
    header("Location: ./?action=connexion");
    exit();
}
?>
<div class="perso">
<h3>Bienvenue dans votre espace, <?php echo htmlspecialchars($_SESSION["email"]); ?> !</h3>
<a href="index.php?action=exercise"> 
    <button class="buttonEx">Voir mes exercices</button>
</a>
<a href="index.php?action=protocol"> 
    <button class="buttonEx">Voir mon protocole</button>
</a>
</div>