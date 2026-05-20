
<div class="testimony">
    <a href="index.php?action=testimony"><h2>Témoignages</h2></a>

  <div class="displayPost">
    <?php if (!empty($testimonies)) : ?>
      <?php foreach ($testimonies as $testimony) : ?>
        <section class="post">
          <article role="article"
                   tabindex="0"
                   data-id="<?= $testimony['idTest'] ?>"
                   data-title="<?= htmlspecialchars($testimony['title']) ?>"
                   data-content="<?= htmlspecialchars($testimony['content']) ?>"
                   data-date="<?= $testimony['date_'] ?>">  
                   
            <h3><?= htmlspecialchars($testimony['title']) ?></h3>
            <p><?= htmlspecialchars(substr($testimony['content'], 0, 100)) ?>…</p>
            <p><?= $testimony['date_'] ?></p>
            <p><?= htmlspecialchars($testimony['firstName'] . ' ' . $testimony['name']) ?></p>
          </article>
        </section>
      <?php endforeach; ?>
    <?php else : ?>
      <p>Aucun témoignage disponible pour le moment.</p>
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
    <p class="modalAuthor"></p>
    <a href="#" id="modalLink"></a>
  </div>
</div>