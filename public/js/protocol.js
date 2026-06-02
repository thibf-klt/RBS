
document.getElementById('idClientDelete').addEventListener('change', function() {
    const idClient = this.value;
    const protocolSelect = document.getElementById('listProtocolsUser');
    
    // Réinitialise le sélecteur de protocoles
    protocolSelect.innerHTML = '<option value="">-- Sélectionner un protocole --</option>';
    
    if (idClient === '') return; // Si aucun client n'est sélectionné, on s'arrête

    // Appel AJAX vers votre contrôleur/routeur
    fetch(`./?action=getProtocolsByClient&idClient=${idClient}`)
        .then(response => response.json())
        .then(protocols => {
            protocols.forEach(protocol => {
                const option = document.createElement('option');
                option.value = protocol.idPr;
                option.textContent = protocol.title;
                protocolSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Erreur lors de la récupération des protocoles:', error));
});
