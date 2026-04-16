
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
</head>
<body>
    <div class="blog">
    <h2>Mes articles</h2>

        <?php
        $posts = getPosts();
         if (!empty($posts)) : ?>
            <?php foreach ($posts as $post) : ?>
                <article>
                    <h3><?= htmlspecialchars($post['title']) ?></h3>
                    <p><?= htmlspecialchars($post['content']) ?></p>
                    <p><?= $post['date_'] ?></p>
                </article>
            <?php endforeach; ?>
        <?php else : ?>
            <p>Aucun article trouvé.</p>
        <?php endif; ?>
    </div>
</body>
</html>