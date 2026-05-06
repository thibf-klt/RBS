const backdrop = document.getElementById('modalBackdrop');
const modalClose = document.getElementById('modalClose');

// Ouvrir la modale au clic sur un article
document.querySelectorAll('.post article').forEach(article => {
  article.addEventListener('click', () => {
    document.getElementById('modalTitle').textContent   = article.dataset.title;
    document.getElementById('modalContent').textContent = article.dataset.content;
    document.getElementById('modalDate').textContent    = article.dataset.date;
    document.getElementById('modalLink').href = `index.php?action=post&id=${article.dataset.id}`;
    backdrop.classList.add('open');
  });

  // Accessibilité clavier
  article.addEventListener('keydown', e => {
    if (e.key === 'Enter') article.click();
  });
});

// Fermer via le bouton, le fond, ou Échap
modalClose.addEventListener('click', () => backdrop.classList.remove('open'));
backdrop.addEventListener('click', e => {
  if (e.target === backdrop) backdrop.classList.remove('open');
});
document.addEventListener('keydown', e => {
  if (e.key === 'Escape') backdrop.classList.remove('open');
});