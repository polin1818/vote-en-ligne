<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

// Connexion à la base de données
$host = 'localhost';
$dbname = 'vote_universite';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Récupération des élections
$elections = $conn->query("SELECT * FROM elections");

while ($row = $elections->fetch(PDO::FETCH_ASSOC)) {  // Correction ici, utilisation de fetch() avec PDO::FETCH_ASSOC
    echo "<h3>" . htmlspecialchars($row['titre']) . "</h3>";
    echo "<p>Description: " . htmlspecialchars($row['description']) . "</p>";
    echo "<p>Date de début: " . htmlspecialchars($row['date_debut']) . "</p>";
    echo "<p>Date de fin: " . htmlspecialchars($row['date_fin']) . "</p>";
    echo "<a href='modifier_election.php?id=" . $row['id'] . "'>Modifier</a> | ";
    echo "<a href='supprimer_election.php?id=" . $row['id'] . "'>Supprimer</a>";
}
?>
