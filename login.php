<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion - HelpHub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css"> <!-- Custom CSS file -->
</head>
<body>
  <!-- Hero Section -->
  <section class="hero text-white text-center py-5 d-flex align-items-center" style="background: linear-gradient(to right, #FF6F61, #6A11CB);">
    <div class="container">
      <h1 class="display-4 fw-bold">Bienvenue sur HelpHub</h1>
      <p class="lead">Connectez-vous pour accéder à votre espace.</p>
    </div>
  </section>

  <!-- Login Form -->
  <section class="login-form py-5 bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
          <div class="card shadow-lg rounded-3 p-4">
            <h2 class="text-center mb-4 fw-bold text-primary">Connexion</h2>
            <?php
session_start();
if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger text-center">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']);
}
?>

            <form method="POST" action="traitement_login.php" >
              <div class="mb-3">
                <label for="pseudo" class="form-label">Pseudo</label>
                <input type="text" class="form-control" name="pseudo" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" name="password" required>
              </div>
              <div class="d-flex justify-content-center gap-2 mt-3">
                <button type="submit" class="btn btn-primary px-5 py-3">Se connecter</button>
                <a href="index.php" class="btn btn-outline-secondary px-5 py-3">Retour à l'accueil</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer class="footer py-4 text-center" style="background: #2c3e50; color: white;">
    <p>&copy; 2025 HelpHub. Tous droits réservés.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 