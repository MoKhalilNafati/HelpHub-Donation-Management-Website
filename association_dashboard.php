<?php
session_start();
include 'config.php';

if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'association') {
    header("Location: login.php");
    exit();
}

$pseudo = htmlspecialchars($_SESSION['pseudo']);

// Récupérer ID et NON le logo
$stmt = $conn->prepare("SELECT id FROM association WHERE pseudo = ?");
$stmt->bind_param("s", $pseudo);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($associationId);
$stmt->fetch();
$stmt->close();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Association - HelpHub</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
<div class="hero text-center rounded p-5 mb-4 d-flex flex-column align-items-center">
<div class="d-flex align-items-center mb-4">
    <img src="afficher.php?id=<?php echo $associationId; ?>" alt="Logo de l'association" style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;">
    <h2 class="display-4 mb-0">Bienvenue, <?php echo $pseudo; ?> 🏢</h2>
</div>

    <p class="lead">Vous pouvez gérer vos projets humanitaires ici.</p>
</div>



    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success text-center">
            <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>

    <div class="row g-4 text-center features">
        <div class="col-md-3">
            <div class="feature-box p-4">
                <i class="bi bi-plus-circle text-primary"></i>
                <h4 class="mt-3">Ajouter un projet</h4>
                <a href="ajouter_projet.php" class="btn btn-outline-primary mt-2 w-100">➕ Créer</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="feature-box p-4">
                <i class="bi bi-folder2-open text-info"></i>
                <h4 class="mt-3">Mes projets</h4>
                <a href="mes_projets.php" class="btn btn-outline-info mt-2 w-100">📂 Voir</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="feature-box p-4">
                <i class="bi bi-gear text-warning"></i>
                <h4 class="mt-3">Modifier le profil</h4>
                <a href="modifier_profil_assoc.php" class="btn btn-outline-warning mt-2 w-100">⚙️ Profil</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="feature-box p-4">
                <i class="bi bi-box-arrow-right text-danger"></i>
                <h4 class="mt-3">Déconnexion</h4>
                <a href="index.php" class="btn btn-outline-danger mt-2 w-100">🚪 Quitter</a>
            </div>
        </div>
    </div>
</div>

<footer class="footer text-center py-4 mt-5">
    <p>HelpHub - Tous droits réservés.</p>
</footer>

</body>
</html> 