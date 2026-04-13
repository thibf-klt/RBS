<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Témoignages</title>
</head>
<body>

    <h1>Témoignages</h1>

    <?php if (!empty($testimonies)) : ?>
        <?php foreach ($testimonies as $testimony) : ?>
            <article style="margin-bottom: 2em; border-bottom: 1px solid #ccc; padding-bottom: 1em;">

                <h2>
                    <?= htmlspecialchars($testimony['title'] ?? 'Sans titre') ?>
                </h2>

                <p>
                    <?= htmlspecialchars($testimony['content'] ?? '') ?>
                </p>

                <p>
                    <em>
                        <?php if (!empty($testimony['author'])) : ?>
                            <?= htmlspecialchars($testimony['author']) ?>
                        <?php else : ?>
                            Cette personne ne souhaite plus que son nom soit cité.
                        <?php endif; ?>
                    </em>
                </p>

            </article>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Aucun témoignage disponible pour le moment.</p>
    <?php endif; ?>

</body>
</html>
