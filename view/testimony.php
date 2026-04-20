
<div class="testimony">
    <a href="index.php?action=testimony"><h2>Témoignages</h2></a>

    <?php
    //$testimonies = getTestimonies();
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
