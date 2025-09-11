<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['type'] !== 'association') {
    header('Location: login.php');
    exit();
}

$id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_association = $_POST['nom_association'];
    $email = $_POST['email'];
    $adresse = $_POST['adresse_association'];
    $identifiant_fiscal = $_POST['identifiant_fiscal'];

    $logo = null;

    if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
        $logo = file_get_contents($_FILES['logo']['tmp_name']);
    }

    // Update association information
    if ($logo !== null) {
        $stmt = $conn->prepare("
            UPDATE association 
            SET nom_association = ?, email = ?, adresse_association = ?, identifiant_fiscal = ?, logo = ?
            WHERE id = ?
        ");
        
        $null_placeholder = null;
        $stmt->bind_param("ssssbi", 
            $nom_association, 
            $email, 
            $adresse, 
            $identifiant_fiscal, 
            $null_placeholder, 
            $id
        );
        $stmt->send_long_data(4, $logo);
    } else {
        $stmt = $conn->prepare("
            UPDATE association 
            SET nom_association = ?, email = ?, adresse_association = ?, identifiant_fiscal = ?
            WHERE id = ?
        ");
        $stmt->bind_param("ssssi", 
            $nom_association, 
            $email, 
            $adresse, 
            $identifiant_fiscal, 
            $id
        );
    }

    $stmt->execute();
    $stmt->close();

    // Update password without hash
    if (!empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        if ($new_password === $confirm_password) {
            // Pas de hash ici !
            $stmt = $conn->prepare("UPDATE association SET mot_de_passe = ? WHERE id = ?");
            $stmt->bind_param("si", $new_password, $id);
            $stmt->execute();
            $stmt->close();
        } else {
            $_SESSION['error'] = "❌ Les mots de passe ne correspondent pas.";
            header("Location: modifier_profil_assoc.php");
            exit();
        }
    }

    $conn->close();

    $_SESSION['message'] = "✅ Profil mis à jour avec succès.";
    header("Location: association_dashboard.php");
    exit();
}
?>
