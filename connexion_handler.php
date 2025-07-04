<?php
// Démarrer la session
session_start();

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

// Récupération des données du formulaire
$nom = $_POST['nom'];
$motdepasse = $_POST['motdepasse'];

// Vérification des informations de connexion
$stmt = $conn->prepare("SELECT * FROM utilisateur WHERE nom = :nom");
$stmt->bindParam(':nom', $nom);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($motdepasse, $user['motdepasse'])) {
    // Connexion réussie : stockage des informations utilisateur dans la session
    $_SESSION['utilisateur_id'] = $user['id'];
    $_SESSION['nom'] = $user['nom'];
    $_SESSION['statut'] = $user['statut'];

    // Redirection vers la page de vote ou de candidature selon le statut
    if ($user['statut'] === 'electeur') {
        header("Location: page_vote.php");
    } else if ($user['statut'] === 'candidat') {
        header("Location: page_candidature.php");
    }
    exit;
} else {
    // Échec de connexion
    echo "Nom d'utilisateur ou mot de passe incorrect.";
}
?>
