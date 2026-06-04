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

    const clientSelect   = document.getElementById('idClientDelete');
    const exerciseSelect = document.getElementById('listExercicesUser');

    if (!clientSelect || !exerciseSelect) return;

    clientSelect.addEventListener('change', function () {
        const idClient = this.value;

        exerciseSelect.innerHTML = '<option value="">-- Sélectionner un exercice --</option>';
        if (idClient === '') return;

        fetch(`./?action=getExercisesByClient&idClient=${idClient}`)
            .then(response => response.json())
            .then(exercises => {
                
                exercises.forEach(exercise => {
                    const option       = document.createElement('option');
                    option.value       = exercise.idEx;
                    option.textContent = exercise.title;
                    exerciseSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Erreur:', error));
    });

});