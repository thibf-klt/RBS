
document.addEventListener('DOMContentLoaded', function () {

    const exerciseForm = document.querySelector("#exercise form");
    if (exerciseForm) {
        exerciseForm.addEventListener('submit', function (e) {
            const pdf   = document.getElementById('exercisePdf').files.length;
            const media = document.getElementById('exerciseMedia').files.length;
            const err   = document.getElementById('fileError');
            if (!pdf && !media) {
                e.preventDefault();
                err.style.display = 'block';
            } else {
                err.style.display = 'none';
            }
        });
    }

});