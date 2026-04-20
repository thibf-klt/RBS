fetch("https://citation.lecog.fr/public/api/random-quote.php")
    .then(response => {
        if (response.ok) {
            console.log("Requête réussie - Statut : " + response.status);
            return (response.json())
        }
        throw new Error("Erreur d'accès à la ressource - Statut : " + response.status);
    })
    .then(data => displayQuote(data))
    .catch(error => alert("Erreur :" + error));

//extract quote and authom from the data gotten from api (json)    
function displayQuote(dataArticle) {
    
    //display text
    let quote = document.querySelector("#text");
    quote.innerText = dataArticle.text;

    //display author
    //let author = document.querySelector("#author.name");  
    //author.innerText = dataArticle.author;           

}    
