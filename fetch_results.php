<?php
$conn = new mysqli('localhost', 'root', '', 'vote_universite');

if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

$sql = "SELECT utilisateur.nom, utilisateur.prenom, candidature.poste, COUNT(votes.id) AS total_votes 
        FROM utilisateur 
        LEFT JOIN candidature ON utilisateur.id = candidature.utilisateur_id 
        LEFT JOIN votes ON candidature.id = votes.candidature_id 
        WHERE utilisateur.statut = 'candidat' 
        GROUP BY utilisateur.id 
        ORDER BY candidature.poste, total_votes DESC";

$result = $conn->query($sql);
$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);
$conn->close();
?>
