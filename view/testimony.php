<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/style/style.css">
    <title>Témoignages</title>
</head>
<body>
    <div class="testimony">
        <h2>Témoignages</h2>

        <?php
        $testimonies = getTestimonies();
        if (!empty($testimonies)) : ?>
            <?php foreach ($testimonies as $testimony) : ?>
    

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
    </div>
</body>
</html>
