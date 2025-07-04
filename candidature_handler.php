<?php
session_start();

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
$poste = $_POST['poste'];
$description = $_POST['description'];
$user_id = $_SESSION['utilisateur_id'];

// Gestion de l'upload de l'image
if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
    $photoName = $_FILES['photo']['name'];
    $photoTmpName = $_FILES['photo']['tmp_name'];
    $photoExtension = pathinfo($photoName, PATHINFO_EXTENSION);
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    
    // Vérifier l'extension de l'image
    if (in_array(strtolower($photoExtension), $allowedExtensions)) {
        // Vérifier si le dossier "uploads" existe, sinon le créer
        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true);
        }
        
        $photoNewName = 'uploads/' . uniqid() . '-' . basename($photoName);
        
        // Déplacer l'image dans le dossier "uploads"
        if (move_uploaded_file($photoTmpName, $photoNewName)) {
            // Enregistrement de la candidature dans la base de données
            try {
                $stmt = $conn->prepare("INSERT INTO candidature (utilisateur_id, poste, description, photo) VALUES (:user_id, :poste, :description, :photo)");
                $stmt->bindParam(':user_id', $user_id);
                $stmt->bindParam(':poste', $poste);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':photo', $photoNewName);
                $stmt->execute();

                echo "Votre candidature a été envoyée avec succès !";
                header("location:vote_handler.php");
            } catch (PDOException $e) {
                echo "Erreur lors de l'envoi de la candidature : " . $e->getMessage();
            }
        } else {
            echo "Erreur lors du téléchargement de la photo.";
        }
    } else {
        echo "Type de fichier non supporté. Veuillez télécharger une image au format JPG, JPEG, PNG ou GIF.";
    }
} else {
    echo "Veuillez sélectionner une photo valide.";
}
?>
