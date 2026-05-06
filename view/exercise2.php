
    <h2>Liste des exercices</h2>

    <?php if (!empty($exercises)) : ?>
        <?php foreach ($exercises as $exercise) : ?>
            <article>
                <h3><?= htmlspecialchars($exercise['title']) ?></h3>
                <p><?= htmlspecialchars($exercise['description']) ?></p>

                <?php if (!empty($exercise['mediaUrl'])) : ?>
                    <p>
                        <a href="<?= htmlspecialchars($exercise['mediaUrl']) ?>" target="_blank">
                            Voir le média
                        </a>
                    </p>
                <?php endif; ?>

                <?php if (!empty($exercise['pdfUrl'])) : ?>
                    <p>
                        <a href="<?= htmlspecialchars($exercise['pdfUrl']) ?>" target="_blank">
                            Télécharger le PDF
                        </a>
                    </p>
                <?php endif; ?>
            </article>
            <hr>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Aucun exercice trouvé.</p>
    <?php endif; ?>

</body>
</html>