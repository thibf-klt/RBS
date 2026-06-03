
document.querySelector("form").addEventListener("submit", function (e) {
    const pdf   = document.getElementById("exercisePdf").files.length;
    const media = document.getElementById("exerciseMedia").files.length;
    const err   = document.getElementById("fileError");

    if (!pdf && !media) {
        e.preventDefault();
        err.style.display = "block";
    } else {
        err.style.display = "none";
    }
});

document.querySelector("#exercise form").addEventListener("submit", function (e) {
    const pdf   = document.getElementById("exercisePdf").files.length;
    const media = document.getElementById("exerciseMedia").files.length;
    const err   = document.getElementById("fileError");
    if (!pdf && !media) {
        e.preventDefault();
        err.style.display = "block";
    } else {
        err.style.display = "none";
    }
});

// --- Exercises according to selected client ---
document.getElementById("idClientDelete").addEventListener("change", function () {
    const idClient = this.value;
    const select   = document.getElementById("listExercicesUser");

    select.innerHTML = "<option value=''>-- Sélectionner un exercice --</option>";
    if (!idClient) return;

    fetch("./?action=getExercisesByClient&idClient=" + idClient)
        .then(r => r.json())
        .then(exercises => {
            exercises.forEach(ex => {
                const opt = document.createElement("option");
                opt.value       = ex.idExercise;
                opt.textContent = ex.title;
                select.appendChild(opt);
            });
        })
        .catch(() => {
            select.innerHTML = "<option value=''>Erreur de chargement</option>";
        });
});
