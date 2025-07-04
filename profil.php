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

// Récupérer les informations de l'utilisateur connecté
$utilisateur_id = $_SESSION['utilisateur_id'];
$stmt = $conn->prepare("SELECT * FROM utilisateur WHERE id = ?");
$stmt->bind_param("i", $utilisateur_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Afficher les informations en fonction du statut de l'utilisateur
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* style.css */

body {
    font-family: Arial, sans-serif;
    background-color: #f4f6f9;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.profile-section {
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
    width: 80%;
    max-width: 600px;
    padding: 20px;
    text-align: center;
}

.profile-section h2 {
    font-size: 24px;
    color: #333;
    margin-bottom: 10px;
}

.user-info, .election-info {
    text-align: left;
    padding: 10px 15px;
    border-bottom: 1px solid #e0e0e0;
    margin-bottom: 10px;
}

.user-info p, .election-info p {
    margin: 8px 0;
    font-size: 16px;
    color: #555;
}

.user-info p strong, .election-info p strong {
    color: #333;
}

h3 {
    font-size: 20px;
    color: #007bff;
    margin-top: 20px;
}

.btn {
    display: inline-block;
    padding: 10px 20px;
    margin-top: 15px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #0056b3;
}

.election-info {
    background-color: #f9f9f9;
    border-radius: 5px;
    padding: 15px;
    margin-top: 10px;
}

.election-info p {
    font-size: 15px;
}

    </style>
</head>
<body>

<section class="profile-section">
    <h2>Profil de <?php echo htmlspecialchars($user['nom']); ?></h2>

    <!-- Informations personnelles -->
    <div class="user-info">
        <p><strong>Nom :</strong> <?php echo htmlspecialchars($user['nom']); ?></p>
        <p><strong>Statut :</strong> <?php echo htmlspecialchars($user['statut']); ?></p>
    </div>

    <?php if ($user['statut'] === 'electeur') : ?>
        <!-- Section pour les électeurs -->
        <h3>Section pour les électeurs</h3>
        <p>Vous pouvez accéder à la page de vote et voir les élections en cours.</p>
        <a href="page_vote.php" class="btn">Accéder au vote</a>

    <?php elseif ($user['statut'] === 'candidat') : ?>
        <!-- Section pour les candidats -->
        <h3>Section pour les candidats</h3>

        <?php
        // Récupérer le nombre de votes pour le candidat
        $stmt = $conn->prepare("SELECT COUNT(*) as total_votes FROM votes WHERE candidature_id = ?");
        $stmt->bind_param("i", $utilisateur_id); // Ici, nous supposons que l'ID de l'utilisateur est aussi l'ID de la candidature
        $stmt->execute();
        $voteCount = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        ?>

        <p><strong>Nombre de votes actuels :</strong> <?php echo $voteCount['total_votes']; ?></p>

    <?php endif; ?>

    <!-- Section pour afficher les élections en cours -->
    <h3>Élections en cours</h3>
    <?php
    // Requête pour obtenir les élections en cours
    $result = $conn->query("SELECT * FROM elections WHERE statut = 'en cours'");
    if ($result->num_rows > 0) {
        while ($election = $result->fetch_assoc()) {
            echo '<div class="election-info">';
            echo '<p><strong>Élection :</strong> ' . htmlspecialchars($election['titre']) . '</p>';
            echo '<p><strong>Date de début :</strong> ' . htmlspecialchars($election['date_debut']) . '</p>';
            echo '<p><strong>Date de fin :</strong> ' . htmlspecialchars($election['date_fin']) . '</p>';
            echo '</div>';
        }
    } else {
        echo '<p>Aucune élection en cours.</p>';
    }

    $conn->close();
    ?>
</section>

</body>
</html>
