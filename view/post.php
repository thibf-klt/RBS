<div class="blog">
        <a href="index.php?action=post"><h2>Mes articles</h2></a>
        <div class="displayPost">
        <?php
        
        if (!empty($posts)) : ?>
            <?php foreach ($posts as $post) : ?>
                <div class="post">
                <a href="index.php?action=post">
                    <article>
                        <h3><?= htmlspecialchars($post['title']) ?></h3>
                        <p><?= htmlspecialchars($post['content']) ?></p>
                        <p><?= $post['date_'] ?></p>
                    </article>
                </a>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>Aucun article trouvé.</p>
        <?php endif; ?>
        </div>

    </div>