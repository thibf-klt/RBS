
window.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.formEdit');
    if (!form) return;

    const posts  = JSON.parse(form.dataset.posts);
    const select = document.getElementById('edit_id');
    if (!select || posts.length === 0) return;

    function fillFields(id) {
        const post = posts.find(p => p.idPost == id);
        if (post) {
            document.getElementById('editTitle').value   = post.title;
            document.getElementById('editContent').value = post.content;
        }
    }

    fillFields(select.value);

    select.addEventListener('change', function () {
        fillFields(this.value);
    });
});