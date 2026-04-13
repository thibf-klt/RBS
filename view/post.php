
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
</head>
<body>
    <h2>Blog</h2>

    <?php if (!empty($posts)) : ?>
        <?php foreach ($posts as $post) : ?>
            <article>
                <h3><?= htmlspecialchars($post['title']) ?></h3>
                <p><?= htmlspecialchars($post['content']) ?></p>
            </article>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Aucun article trouvé.</p>
    <?php endif; ?>

</body>
</html>