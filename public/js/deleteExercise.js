
    const idClient = this.value;
    const exerciseSelect = document.getElementById('listExercicesUser');
    exerciseSelect.innerHTML = '<option value="">-- Sélectionner un exercice --</option>';
    if (idClient === '') return;

    fetch(`./?action=getExercisesByClient&idClient=${idClient}`)
        .then(response => response.json())
        .then(exercises => {
            exercises.forEach(exercise => {
                const option = document.createElement('option');
                option.value = exercise.idEx;
                option.textContent = exercise.title;
                exerciseSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Erreur:', error));
});
