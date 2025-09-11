<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];

    // Check in donateur
    $stmt = $conn->prepare("SELECT id, mot_de_passe FROM donateur WHERE pseudo = ?");
    $stmt->bind_param("s", $pseudo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($password === $user['mot_de_passe']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['type'] = 'donateur';
            session_write_close(); 
            header('Location: donateur_dashboard.php');
            exit();
        }
    }

    // Check in association
    $stmt = $conn->prepare("SELECT id, mot_de_passe FROM association WHERE pseudo = ?");
    $stmt->bind_param("s", $pseudo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($password === $user['mot_de_passe']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['type'] = 'association';
            session_write_close(); 
            header('Location: association_dashboard.php');
            exit();
        }
    }

    // If nothing matched
    $_SESSION['error'] = "Identifiants invalides.";
    header('Location: login.php');
    exit();
}
?>