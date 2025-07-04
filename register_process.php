<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $department = $_POST['department'];
    $role = $_POST['role'];

    $query = "INSERT INTO users (username, password, department_id, role) VALUES ('$username', '$password', '$department', '$role')";
    if ($conn->query($query)) {
        if ($role == 'candidat') {
            header("Location: dashboard_candidat.php");
        } else {
            header("Location: dashboard_electeur.php");
        }
    } else {
        echo "Erreur : " . $conn->error;
    }
}
?>
