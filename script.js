document.addEventListener("DOMContentLoaded", function() {
    fetchResults(); // Charger les résultats lors du chargement de la page

    // Rafraîchir les résultats toutes les 10 secondes
    setInterval(fetchResults, 10000);
});

function fetchResults() {
    fetch('fetch_results.php')
        .then(response => response.json())
        .then(data => {
            const resultsDiv = document.getElementById('results');
            resultsDiv.innerHTML = ''; // Effacer les anciens résultats

            data.forEach(row => {
                const card = document.createElement('div');
                card.classList.add('result-card');
                card.innerHTML = `
                    <h3>${row.prenom} ${row.nom}</h3>
                    <p>Poste: ${row.poste}</p>
                    <p>Total de votes: ${row.total_votes}</p>
                `;
                resultsDiv.appendChild(card);
            });
        })
        .catch(error => console.error('Erreur lors du chargement des résultats:', error));
}

document.addEventListener("DOMContentLoaded", function() {
    fetchResults(); // Charger les résultats lors du chargement de la page

    // Rafraîchir les résultats toutes les 10 secondes
    setInterval(fetchResults, 10000);
});

function fetchResults() {
    fetch('fetch_results.php')
        .then(response => response.json())
        .then(data => {
            const resultsDiv = document.getElementById('results');
            resultsDiv.innerHTML = ''; // Effacer les anciens résultats

            data.forEach(row => {
                const card = document.createElement('div');
                card.classList.add('result-card');
                card.innerHTML = `
                    <h3>${row.prenom} ${row.nom}</h3>
                    <p>Poste: ${row.poste}</p>
                    <p>Total de votes: ${row.total_votes}</p>
                `;
                resultsDiv.appendChild(card);
            });
        })
        .catch(error => console.error('Erreur lors du chargement des résultats:', error));
}
