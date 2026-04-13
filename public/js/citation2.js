// Exemple complet d'intégration avec gestion d'erreurs
const API_BASE_URL = 'https://api.quotable.io';

// Fonction pour récupérer une citation aléatoire
async function getRandomQuote() {
    try {
        const response = await fetch(`${API_BASE_URL}/random`);
        
        if (!response.ok) {
            throw new Error(`Erreur HTTP: ${response.status}`);
        }
        
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Erreur lors de la récupération de la citation:', error);
        throw error;
    }
}
// Exemple d'utilisation avec affichage dans le DOM
async function displayRandomQuote() {
    try {
        const quoteData = await getRandomQuote();
        document.getElementById('#quote').textContent = quoteData.content;
    
    } catch (error) {
        document.getElementById('quote-container').innerHTML = 
            `
Impossible de charger la citation. Veuillez réessayer.
`;
    }
}