document.addEventListener('DOMContentLoaded', function () {

    const clientSelect   = document.getElementById('idClientDelete');
    const protocolSelect = document.getElementById('listProtocolsUser');

    if (!clientSelect || !protocolSelect) return;

    clientSelect.addEventListener('change', function () {
        const idClient = this.value;

        protocolSelect.innerHTML = '<option value="">-- Sélectionner un protocole --</option>';
        if (idClient === '') return;

        fetch(`./?action=getProtocolsByClient&idClient=${idClient}`)
            .then(response => response.json())
            .then(protocols => {
                protocols.forEach(protocol => {
                    const option       = document.createElement('option');
                    option.value       = protocol.idPr;
                    option.textContent = protocol.title;
                    protocolSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Erreur lors de la récupération des protocoles:', error));
    });

});