<?php
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
$prenom = $_POST['prenom'];
$telephone = $_POST['phone'];
$filiere = $_POST['filiere'];
$departement = $_POST['departement'];
$statut = $_POST['statut'];
$sexe = $_POST['sexe'];
$motdepasse = password_hash($_POST['motdepasse'], PASSWORD_DEFAULT);

// Insertion des données dans la base de données
try {
    $stmt = $conn->prepare("INSERT INTO utilisateur (nom, prenom, filiere, departement, statut, sexe, motdepasse, telephone) VALUES (:nom, :prenom, :filiere, :departement, :statut, :sexe, :motdepasse, :telephone)");
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':filiere', $filiere);
    $stmt->bindParam(':departement', $departement);
    $stmt->bindParam(':statut', $statut);
    $stmt->bindParam(':sexe', $sexe);
    $stmt->bindParam(':motdepasse', $motdepasse);
    $stmt->bindParam(':telephone', $telephone);
    $stmt->execute();

    // Redirection après inscription réussie
    header("Location: connexion.html");
    exit;
} catch (PDOException $e) {
    echo "Erreur lors de l'inscription : " . $e->getMessage();
}
?>
