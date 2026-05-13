<div class="blog">
  <a href="index.php?action=post"><h2>Mes articles</h2></a>
  <div class="displayPost">
    <?php if (!empty($posts)) : ?>
      <?php foreach ($posts as $post) : ?>
        <section class="post">
          <article role="article"
                   tabindex="0"
                   data-id="<?= $post['idPost'] ?>"
                   data-title="<?= htmlspecialchars($post['title']) ?>"
                   data-content="<?= htmlspecialchars($post['content']) ?>"
                   data-date="<?= $post['date_'] ?>">
            <h3><?= htmlspecialchars($post['title']) ?></h3>
            <p><?= htmlspecialchars(substr($post['content'], 0, 100)) ?>…</p>
            <p><?= $post['date_'] ?></p>
          </article>
        </section>
      <?php endforeach; ?>
    <?php else : ?>
      <p>Aucun article trouvé.</p>
    <?php endif; ?>
  </div>
</div>

<!-- Modal -->
<div class="modal-backdrop" id="modalBackdrop" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
  <div class="modal">
    <button class="modal-close" id="modalClose" aria-label="Fermer">&times;</button>
    <h3 id="modalTitle"></h3>
    <p id="modalContent"></p>
    <p id="modalDate"></p>
    <a href="#" id="modalLink"></a>
  </div>
</div>