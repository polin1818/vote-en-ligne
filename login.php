<?php
// db.php et session_start()

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $result = $conn->query("SELECT * FROM users WHERE username = '$username'");
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        if ($user['role'] == 'candidat') {
            header("Location: dashboard_candidat.php");
        } else {
            header("Location: dashboard_electeur.php");
        }
    } else {
        echo "Identifiant ou mot de passe incorrect.";
    }
}
