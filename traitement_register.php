<?php
session_start();
include 'config.php'; // <- uses $conn (mysqli)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role = $_POST['role'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $cin = $_POST['cin'];
    $email = $_POST['email'];
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];

    $success = false; // will store if insert succeeded

    if ($role === 'association') {
        $nom_association = $_POST['nom_association'] ?? '';
        $identifiant_fiscal = $_POST['id_fiscal'] ?? '';
        $adresse_association = $_POST['adresse_association'] ?? '';
        $logo = null;

        if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
            $fileType = mime_content_type($_FILES['logo']['tmp_name']);
            if (in_array($fileType, ['image/png', 'image/jpeg'])) {
                $logo = file_get_contents($_FILES['logo']['tmp_name']);
            } else {
                $_SESSION['error'] = "Format d'image invalide. Veuillez télécharger un fichier PNG ou JPG.";
                header('Location: register.php');
                exit();
            }
        }

        $stmt = $conn->prepare("
            INSERT INTO association 
            (nom, prenom, email, cin, nom_association, adresse_association, identifiant_fiscal, logo, pseudo, mot_de_passe)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        // Attention: bind real variable, not null_placeholder
        $stmt->bind_param(
            "ssssssssss",
            $nom,
            $prenom,
            $email,
            $cin,
            $nom_association,
            $adresse_association,
            $identifiant_fiscal,
            $logo,
            $pseudo,
            $password
        );

        $success = $stmt->execute();
        $stmt->close();

    } else if ($role === 'donateur') {
        $stmt = $conn->prepare("
            INSERT INTO donateur 
            (nom, prenom, email, cin, pseudo, mot_de_passe)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param(
            "ssssss",
            $nom,
            $prenom,
            $email,
            $cin,
            $pseudo,
            $password
        );

        $success = $stmt->execute();
        $stmt->close();
    }

    $conn->close();

    if ($success) {
        $_SESSION['message'] = "Inscription réussie !";
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['error'] = "Erreur lors de l'inscription.";
        header('Location: register.php');
        exit();
    }
}
?>
