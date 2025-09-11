<?php
session_start();
include 'config.php';

if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'donateur') {
    header("Location: login.php");
    exit();
}

$pseudo = htmlspecialchars($_SESSION['pseudo']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Donateur - HelpHub</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="hero text-center rounded p-5 mb-4">
        <h2 class="display-4">Bienvenue, <?php echo $pseudo; ?> 🙋</h2>
        <p class="lead">Découvrez des projets et faites un impact !</p>
    </div>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success text-center">
            <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>

    <div class="row g-4 text-center features">
        <div class="col-md-4">
            <div class="feature-box p-4">
                <i class="bi bi-search-heart text-primary"></i>
                <h4 class="mt-3">Explorer les projets</h4>
                <a href="liste_projets.php" class="btn btn-outline-primary mt-2 w-100">🔍 Chercher</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-box p-4">
                <i class="bi bi-clock-history text-success"></i>
                <h4 class="mt-3">Mes participations</h4>
                <a href="mes_dons.php" class="btn btn-outline-success mt-2 w-100">🧾 Historique</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-box p-4">
                <i class="bi bi-box-arrow-right text-danger"></i>
                <h4 class="mt-3">Déconnexion</h4>
                <a href="index.php" class="btn btn-outline-danger mt-2 w-100">🚪 Quitter</a>
            </div>
        </div>
    </div>
</div>

<footer class="footer text-center py-4 mt-5">
    <p> HelpHub - Tous droits réservés.</p>
</footer>

</body>
</html>