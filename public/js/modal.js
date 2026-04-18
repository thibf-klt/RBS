
function openModal(el) {
    document.getElementById('modal-title').textContent   = el.dataset.title;
    document.getElementById('modal-content').textContent = el.dataset.content;
    document.getElementById('modal-date').textContent    = el.dataset.date;
    document.getElementById('postModal').classList.add('active');
}

function closeModal() {
    document.getElementById('postModal').classList.remove('active');
}

// Ferme si clic en dehors du contenu
function closeModalOutside(event) {
    if (event.target.id === 'postModal') closeModal();
}

// Ferme avec la touche Échap
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeModal();
});
