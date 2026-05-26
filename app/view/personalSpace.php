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
            <button class="buttonSophro">Ajouter/Supprimer un témoignage</button>
        </a>
    </span>

    <!-- Liste des protocoles -->
    <div class="protocol">
        <h4>Mes protocoles</h4>
        <?php if (empty($protocoles)): ?>
            <p>Aucun protocole disponible pour le moment.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($protocoles as $p): ?>
                    
                    <li>
                        <strong><?= htmlspecialchars($p["title"]) ?></strong>
                        — <?= htmlspecialchars($p["date_"]) ?>
                        <a href="index.php?action=downloadPdf&id=<?= $p["idPr"] ?>">
                            <button class="buttonSophro">Télécharger</button>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

</div>