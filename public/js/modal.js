const backdrop = document.getElementById('modalBackdrop');
const modalClose = document.getElementById('modalClose');

if (backdrop && modalClose) {

// Open the modal by clicking on a post
document.querySelectorAll('.post article').forEach(article => {
  article.addEventListener('click', () => {
    document.getElementById('modalTitle').textContent   = article.dataset.title;
    document.getElementById('modalContent').textContent = article.dataset.content;
    document.getElementById('modalDate').textContent    = article.dataset.date; 
    document.getElementById('modalLink').href = `index.php?action=post&id=${article.dataset.id}`;
    backdrop.classList.add('open');
  });

  // Keyboard accessibility
  article.addEventListener('keydown', e => {
    if (e.key === 'Enter') article.click();
  });
});

// Close the modal
modalClose.addEventListener('click', () => backdrop.classList.remove('open'));
backdrop.addEventListener('click', e => {
  if (e.target === backdrop) backdrop.classList.remove('open');
});
document.addEventListener('keydown', e => {
  if (e.key === 'Escape') backdrop.classList.remove('open');
});
}