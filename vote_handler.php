<?php
session_start();

// Vérifiez que l'utilisateur est connecté
if (!isset($_SESSION['utilisateur_id'])) {
    header("Location: connexion.html"); // Redirigez vers la page de connexion
    exit;
}

// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'vote_universite');

// Vérifiez la connexion
if ($conn->connect_error) {
    header("Location: erreur.php");
    exit;
}

// Vérifiez que l'ID de la candidature est défini
if (!isset($_POST['candidature_id']) || empty($_POST['candidature_id'])) {
    header("Location: page_vote.php?error=missing_data");
    exit;
}

$utilisateur_id = $_SESSION['utilisateur_id'];
$candidature_id = $_POST['candidature_id'];

// Récupérez le poste correspondant à la candidature
$stmt = $conn->prepare("SELECT poste FROM candidature WHERE id = ?");
$stmt->bind_param("i", $candidature_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // Redirigez avec un message d'erreur si la candidature n'existe pas
    $_SESSION['error_message'] = "La candidature sélectionnée n'existe pas.";
    header("Location: page_vote.php");
    exit;
}

$row = $result->fetch_assoc();
$poste = $row['poste'];

// Vérifiez si l'utilisateur a déjà voté pour ce poste en utilisant une jointure
$stmt = $conn->prepare("
    SELECT votes.id FROM votes
    JOIN candidature ON votes.candidature_id = candidature.id
    WHERE votes.utilisateur_id = ? AND candidature.poste = ?
");
$stmt->bind_param("is", $utilisateur_id, $poste);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Si l'utilisateur a déjà voté pour ce poste, on lui affiche un message
    $_SESSION['error_message'] = "Vous avez déjà voté pour ce poste.";
    header("Location: page_vote.php");
    exit;
} else {
    // Insérer un nouveau vote
    $stmt = $conn->prepare("INSERT INTO votes (utilisateur_id, candidature_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $utilisateur_id, $candidature_id);
    
    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Votre vote a été pris en compte avec succès.";
        header("Location: resultat_vote.php");
        exit;
    } else {
        $_SESSION['error_message'] = "Erreur lors de l'enregistrement du vote : " . $stmt->error;
        header("Location: page_vote.php");
        exit;
    }
}

// Fermer la connexion à la base de données
$stmt->close();
$conn->close();
?>
