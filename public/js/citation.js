
fetch("https://api.quotable.io/random")
    .then(response => {
        if (response.ok) {
            console.log("Requête réussie - Statut : " + response.status);
            return (response.json())
        }
        throw new Error("Erreur d'accès à la ressource - Statut : " + response.status);
    })
    .then(data => displayQuote(data))
    .catch(error => alert("Erreur :" + error));

function displayQuote(dataArticle) {
    
    //display text
    let quote = document.querySelector("#quote");
    quote.innerText = dataArticle.content;

    //display author
    let author = document.querySelector("#author");  
    author.innerText = dataArticle.author;           

}    
