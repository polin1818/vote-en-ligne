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
    $email = $_POST['email'];
    $motdepasse = $_POST['motdepasse'];

    // Vérification des informations de connexion
    $stmt = $conn->prepare("SELECT * FROM administrateurs WHERE email = ?");
    $stmt->execute([$email]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($motdepasse, $admin['mot_de_passe'])) {
        $_SESSION['admin_id'] = $admin['id'];
        header("Location: admin_dashboard.php"); // Redirection vers le tableau de bord
        exit;
    } else {
        echo "Identifiants incorrects.";
    }
}
?>

<h2>Connexion Administrateur</h2>
<form method="post" action="admin_login.php">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="motdepasse" placeholder="Mot de passe" required>
    <button type="submit">Se connecter</button>
</form>
