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
    <h3>Bienvenue dans votre espace, <?= htmlspecialchars($_SESSION["email"]) ?> !</h3>

    <span class="buttons">
        <a href="index.php?action=updateDataUser">
            <button class="buttonSophro">Gérer mes détails personnels</button>
        </a>
        <a href="index.php?action=exercise">
            <button class="buttonSophro">Voir mes exercices</button>
        </a>
        <a href="index.php?action=manageTestimony">
            <button class="buttonSophro">Gérer son témoignage</button>
        </a>
        <a href="index.php?action=viewProtocol">
            <button class="buttonSophro">Voir mon protocole</button>
        </a>
    </span>


</div>