<?php
include 'config.php'; // Include the database configuration file
include 'traitement_login.php'; // Include the login processing script


// Count all donateurs from the don table
$count_query = $conn->query("SELECT COUNT(DISTINCT id_donateur) AS total FROM don");
$count_result = $count_query->fetch_assoc();
$total_donateurs = $count_result['total'];

// Get last donateur’s ID and donation amount
$last_query = $conn->query("
  SELECT don.montant, don.date_don, donateur.nom, donateur.prenom
  FROM don
  JOIN donateur ON don.id_donateur = donateur.id
  ORDER BY don.date_don DESC
  LIMIT 1
");
$last_don = $last_query->fetch_assoc();
$last_donateur = $last_don ? $last_don['prenom'] . ' ' . $last_don['nom'] : 'Aucun';
$last_amount = $last_don['montant'] ?? '0';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HelpHub - Accueil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css"> <!-- Custom CSS file -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"> <!-- Bootstrap Icons -->
</head>
<body>
  <!-- Hero Section -->
  <section class="hero text-white text-center py-5 d-flex align-items-center" style="background: linear-gradient(to right, #FF6F61, #6A11CB);">
    <div class="container">
      <h1 class="display-4 fw-bold">Bienvenue sur HelpHub</h1>
      <p class="lead">Une plateforme innovante de collecte de dons pour des causes importantes.</p>
      <div class="d-flex justify-content-center gap-4 mt-4">
        <a href="login.php" class="btn btn-light btn-lg shadow-sm px-5 py-3">Connexion</a>
        <a href="register.php" class="btn btn-outline-light btn-lg shadow-sm px-5 py-3">Inscription</a>
      </div>
    </div>
  </section>

  <!-- About Section -->
  <section class="about py-5 bg-dark text-white">
    <div class="container text-center">
      <h2 class="mb-4 fw-bold">À propos de HelpHub</h2>
      <p class="lead fs-4">
        Rejoignez-nous et soutenez des projets solidaires grâce à une plateforme facile et sécurisée. Ensemble, changeons le monde !
      </p>
    </div>
  </section>

  <!-- Features Section -->
  <section class="features py-5 bg-light">
    <div class="container">
      <h2 class="text-center mb-5 fw-bold text-primary">Nos Fonctionnalités</h2>
      <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="feature-box p-4 text-center shadow-lg rounded-3 bg-white">
            <i class="bi bi-heart-fill display-4 text-danger mb-3"></i>
            <h4 class="fw-bold">Soutenez des projets</h4>
            <p>Les associations peuvent créer des projets et collecter des fonds pour les financer.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="feature-box p-4 text-center shadow-lg rounded-3 bg-white">
            <i class="bi bi-people-fill display-4 text-info mb-3"></i>
            <h4 class="fw-bold">Rejoignez une communauté</h4>
            <p>Faites partie d'une communauté solidaire et engagez-vous pour de belles causes.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="feature-box p-4 text-center shadow-lg rounded-3 bg-white">
            <i class="bi bi-check-circle-fill display-4 text-success mb-3"></i>
            <h4 class="fw-bold">Suivi transparent</h4>
            <p>Suivez l'avancée des projets et l'impact de chaque don.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="container my-5">
  <div class="row justify-content-center g-4">

  <section class="stats-section py-5 bg-light">
  <div class="container">
    <h2 class="text-center mb-4 fw-bold text-primary">Statistiques des dons</h2>
    <div class="row justify-content-center g-4">
      
      <!-- Total Donateurs Card -->
      <div class="col-md-5" >
        <div class="card text-white bg-success shadow-lg h-100 rounded-4">
          <div class="card-body text-center p-4">
            <h4 class="card-title">👥 Nombre total de donateurs</h4>
            <p class="display-4 fw-bold"><?= $total_donateurs ?></p>
          </div>
        </div>
      </div>

      <!-- Last Donateur Card -->
      <div class="col-md-5" >
        <div class="card text-white bg-info shadow-lg h-100 rounded-4">
          <div class="card-body text-center p-4">
            <h4 class="card-title">🕊️ Dernier donateur</h4>
            <p class="h5">Donateur : <strong><?= htmlspecialchars($last_donateur) ?></strong></p>
            <p class="h5">Montant : <strong><?= $last_amount ?> TND</strong></p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>



  <!-- Footer -->
  <footer class="footer py-4 text-center" style="background: #2c3e50; color: white;">
    <p>&copy; 2025 HelpHub. Tous droits réservés.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>