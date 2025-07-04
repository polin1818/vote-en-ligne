<?php
session_start();

// Vérifiez que l'utilisateur est connecté
if (!isset($_SESSION['utilisateur_id'])) {
    die("Accès refusé. Veuillez vous connecter.");
}

// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'vote_universite');

// Vérifiez la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

$utilisateur_id = $_SESSION['utilisateur_id']; // Récupérer l'ID de l'utilisateur connecté

// Votre code continue ici
if (isset($_SESSION['error_message'])) {
    echo "<p style='color: red; font-weight: bold; text-align: center;'>" . $_SESSION['error_message'] . "</p>";
    unset($_SESSION['error_message']);
}

if (isset($_SESSION['success_message'])) {
    echo "<p style='color: green; font-weight: bold; text-align: center;'>" . $_SESSION['success_message'] . "</p>";
    unset($_SESSION['success_message']);
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Vote</title>
    <link rel="stylesheet" href="style.css">
<style>
    /* General Styling */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.vote-section {
    text-align: center;
    padding: 20px;
}

h2 {
    color: #333;
}

/* Grid Container for Candidates */
.candidates-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
    padding: 20px;
}

/* Card Styling */
.candidate-card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    overflow: hidden;
    width: 100%;
    max-width: 250px;
    padding: 15px;
    text-align: center;
    transition: transform 0.2s;
}

.candidate-card:hover {
    transform: scale(1.05);
}

.candidate-card img {
    width: 100%;
    height: auto;
    border-radius: 8px;
}

.candidate-card h3 {
    margin: 10px 0;
    font-size: 1.2em;
    color: #333;
}

.candidate-card p {
    font-size: 0.9em;
    color: #666;
    margin: 5px 0;
}

.vote-button {
    margin-top: 10px;
    padding: 10px 15px;
    font-size: 0.9em;
    color: #fff;
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.2s;
}

.vote-button:hover {
    background-color: #0056b3;
}

/* Responsive Layout */
@media (min-width: 768px) {
    .candidate-card {
        width: calc(50% - 20px); /* Two cards per row */
    }
}

@media (min-width: 1024px) {
    .candidate-card {
        width: calc(33.33% - 20px); /* Three cards per row */
    }
}

</style>
</head>
<body>

<section class="vote-section">
    <h2>Votez pour votre candidat</h2>
   <button type="submit" class="vote-button"> <a href="resultat_vote.php">Consultez les resultats</a></button>
    <div class="candidates-container">
        
        <?php
        // Database query for candidates information
        $sql = "SELECT candidature.id AS candidat_id, photo, prenom, nom, poste, sexe, filiere, departement 
                FROM candidature 
                INNER JOIN utilisateur ON candidature.utilisateur_id = utilisateur.id";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="candidate-card">';
                echo '<img src="' . htmlspecialchars($row['photo']) . '" alt="Photo du candidat">';
                echo '<h3>' . htmlspecialchars($row['prenom']) . ' ' . htmlspecialchars($row['nom']) . '</h3>';
                echo '<p>Poste: ' . htmlspecialchars($row['poste']) . '</p>';
                echo '<p>Sexe: ' . htmlspecialchars($row['sexe']) . '</p>';
                echo '<p>Filière: ' . htmlspecialchars($row['filiere']) . '</p>';
                echo '<p>Département: ' . htmlspecialchars($row['departement']) . '</p>';

                // Vote button
                if (isset($row['candidat_id'])) {
                    echo '<form action="vote_handler.php" method="post">';
                    echo '<input type="hidden" name="utilisateur_id" value="' . htmlspecialchars($utilisateur_id) . '">';
                    echo '<input type="hidden" name="candidature_id" value="' . htmlspecialchars($row['candidat_id']) . '">';
                    echo '<button type="submit" class="vote-button">Voter</button>';
                    echo '</form>';
                }
                echo '</div>';
            }
        } else {
            echo '<p>Aucun candidat disponible pour le moment.</p>';
        }

        // Close database connection
        $conn->close();
        ?>
    </div>
</section>


</body>
</html>
