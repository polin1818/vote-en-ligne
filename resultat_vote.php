<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats du Vote</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Style général */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Centrer le titre et la section */
        .result-section {
            text-align: center;
            max-width: 1000px;
            width: 100%;
            padding: 20px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);
        }

        .result-section h2 {
            font-size: 2em;
            color: #333;
            margin-bottom: 20px;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 10px;
            display: inline-block;
        }

        /* Style pour les titres de poste */
        .poste-title {
            font-size: 1.5em;
            color: #333;
            margin-top: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
            text-align: left;
        }

        /* Style des petites cartes */
        .result-card {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            margin: 10px;
            width: calc(33% - 20px);
            display: inline-block;
            vertical-align: top;
            text-align: center;
            position: relative;
            transition: transform 0.3s ease;
        }

        /* Effet de gagnant */
        .winner {
            border: 2px solid #FFD700;
            background-color: #fffae6;
        }
        .winner::before {
            content: "🏆 En tête !";
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: #FFD700;
            color: #fff;
            padding: 5px;
            border-radius: 5px;
            font-weight: bold;
            font-size: 0.8em;
        }

        .result-card h3 {
            font-size: 1.1em;
            margin: 10px 0;
            color: #4CAF50;
        }
        .result-card p {
            margin: 5px 0;
            color: #666;
            font-size: 0.9em;
        }

        /* Barre de progression */
        .progress-bar {
            width: 100%;
            background-color: #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
            margin-top: 10px;
        }
        .progress {
            height: 8px;
            background-color: #4CAF50;
            border-radius: 8px;
            transition: width 0.4s ease;
        }
        body {
            font-family: Arial, sans-serif;
            transition: background-color 0.3s, color 0.3s;
        }
        .dark-mode {
            background-color: #121212;
            color: #ffffff;
        }
        .result-card {
            background-color: #f9f9f9;
            color: #333;
            border: 1px solid #ddd;
            padding: 1rem;
            margin: 1rem;
            border-radius: 8px;
            transition: background-color 0.3s, color 0.3s;
        }
        .dark-mode .result-card {
            background-color: #333;
            color: #f9f9f9;
        }
        .toggle-dark-mode {
            cursor: pointer;
            padding: 0.5rem 1rem;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            margin: 1rem;
        }
    </style>
</head>
<body>

<section class="result-section">
    <h2>Résultats du Vote par Poste</h2>
    <input type="text" id="searchInput" placeholder="Rechercher un candidat..." onkeyup="searchCandidate()">

    <!-- Bouton pour activer le mode sombre -->
<button class="toggle-dark-mode" onclick="toggleDarkMode()">Activer le Mode Sombre</button>
    <?php
    $conn = new mysqli('localhost', 'root', '', 'vote_universite');

    if ($conn->connect_error) {
        die("Échec de la connexion : " . $conn->connect_error);
    }

    // Récupérer les postes uniques
    $postesQuery = "SELECT DISTINCT poste FROM candidature";
    $postesResult = $conn->query($postesQuery);

    if ($postesResult->num_rows > 0) {
        while ($posteRow = $postesResult->fetch_assoc()) {
            $poste = $posteRow['poste'];

            // Calculer le nombre total de votes pour ce poste
            $totalVotesQuery = "SELECT COUNT(votes.id) as total_votes FROM votes 
                                LEFT JOIN candidature ON votes.candidature_id = candidature.id 
                                WHERE candidature.poste = '$poste'";
            $totalVotesResult = $conn->query($totalVotesQuery);
            $totalVotesRow = $totalVotesResult->fetch_assoc();
            $totalVotes = $totalVotesRow['total_votes'];

            echo '<div class="poste-title">Poste : ' . htmlspecialchars($poste) . '</div>';

            // Récupérer les candidats et leurs votes pour ce poste
            $sql = "SELECT utilisateur.nom, utilisateur.prenom, COUNT(votes.id) AS total_votes 
                    FROM utilisateur 
                    LEFT JOIN candidature ON utilisateur.id = candidature.utilisateur_id 
                    LEFT JOIN votes ON candidature.id = votes.candidature_id 
                    WHERE utilisateur.statut = 'candidat' AND candidature.poste = '$poste' 
                    GROUP BY utilisateur.id 
                    ORDER BY total_votes DESC";

            $result = $conn->query($sql);
            $isFirst = true;

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $voteCount = $row['total_votes'];
                    $percentage = ($totalVotes > 0) ? ($voteCount / $totalVotes) * 100 : 0;
                    $percentageFormatted = number_format($percentage, 2);

                    // Marquer le gagnant pour chaque poste avec une classe spéciale
                    $cardClass = $isFirst ? 'result-card winner' : 'result-card';
                    $isFirst = false;

                    echo '<div class="' . $cardClass . '">';
                    echo '<h3>' . htmlspecialchars($row['prenom']) . ' ' . htmlspecialchars($row['nom']) . '</h3>';
                    echo '<p>Total de votes : ' . htmlspecialchars($voteCount) . '</p>';
                    echo '<p>Pourcentage : ' . $percentageFormatted . '%</p>';
                    echo '<div class="progress-bar"><div class="progress" style="width:' . $percentageFormatted . '%;"></div></div>';
                    echo '</div>';
                }
            } else {
                echo '<p>Aucun vote pour ce poste pour l\'instant.</p>';
            }
        }
    } else {
        echo '<p>Aucun poste trouvé.</p>';
    }

    $conn->close();
    ?>

</section>
<script>
    function toggleDarkMode() {
        document.body.classList.toggle('dark-mode');
    }
    function searchCandidate() {
    const input = document.getElementById('searchInput');
    const filter = input.value.toLowerCase();
    const cards = document.querySelectorAll('.result-card');

    cards.forEach(card => {
        const name = card.querySelector('h3').innerText.toLowerCase();
        if (name.includes(filter)) {
            card.style.display = "";
        } else {
            card.style.display = "none";
        }
    });
}
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

</script>
<script src="script.js"></script>
</body>
</html>
