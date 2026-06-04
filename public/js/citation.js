
fetch("https://quoteslate.vercel.app/api/quotes/random")
    .then(response => {
        if (response.ok) {
            console.log("Requête réussie - Statut : " + response.status);
            return response.json();
        }
        // Distinguish the different types of HTML errors
        if (response.status === 404) throw new Error("Ressource introuvable (404)");
        if (response.status === 429) throw new Error("Trop de requêtes, réessaie plus tard (429)");
        if (response.status >= 500) throw new Error("Erreur serveur - Statut : " + response.status);
        throw new Error("Erreur inattendue - Statut : " + response.status);
    })
    .then(data => {
        // Verify that the data is present
        if (!data.quote || !data.author) throw new Error("Données incomplètes dans la réponse");
        displayQuote(data);
    })
    .catch(error => {
        console.error("Détail de l'erreur :", error); 
        alert("Erreur : " + error.message);           
    });

function displayQuote(dataArticle) {
    document.querySelector("#quote").innerText = dataArticle.quote;
    document.querySelector("#author").innerText = dataArticle.author;
}