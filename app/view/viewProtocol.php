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
    <a href="index.php?action=personalSpace"> 
        <button class="buttonService">Retour menu</button>
    </a>
    </div> 
    <?php endif; ?>
</div>


    <!-- List of protocols -->
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
                        <a href="index.php?action=downloadProtocol&id=<?= $p["idPr"] ?>">
                            <button class="buttonSophro">Télécharger</button>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>