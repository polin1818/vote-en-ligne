<?php
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des informations du formulaire
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $motdepasse = password_hash($_POST['motdepasse'], PASSWORD_DEFAULT); // Hachage du mot de passe

    // Insertion de l'administrateur dans la base de données
    $stmt = $conn->prepare("INSERT INTO administrateurs (nom, email, mot_de_passe) VALUES (?, ?, ?)");
    if ($stmt->execute([$nom, $email, $motdepasse])) {
        echo "Inscription réussie. Vous pouvez maintenant vous connecter.";
        header("location: admin_login.php");
    } else {
        echo "Erreur lors de l'inscription. Veuillez réessayer.";
    }
}
?>

<h2>Inscription Administrateur</h2>
<form method="post" action="admin_register.php">
    <input type="text" name="nom" placeholder="Nom" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="motdepasse" placeholder="Mot de passe" required>
    <button type="submit">S'inscrire</button>
</form>
