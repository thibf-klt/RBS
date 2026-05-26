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

<div class="protocol">
    <h1>Mes protocoles</h1>

    <?php if (empty($protocoles)): ?>
        <p>Aucun protocole disponible pour le moment.</p>

    <?php else: ?>
        <ul>
            <?php foreach ($protocoles as $p): ?>
                <li>
                    <strong><?= htmlspecialchars($p["title"]) ?></strong>
                    — <?= htmlspecialchars($p["date_"]) ?>
                    <a href="./?action=downloadPdf&id=<?= $p["idProt"] ?>">
                        <button class="buttonSophro">Télécharger</button>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

</div>
</body>
</html>