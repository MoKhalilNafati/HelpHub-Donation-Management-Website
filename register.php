<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription - HelpHub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css"> <!-- Custom CSS file -->
</head>

<body>
  <!-- Hero Section -->
  <section class="hero text-white text-center py-5 d-flex align-items-center" style="background: linear-gradient(to right, #FF6F61, #6A11CB);">
    <div class="container">
      <h1 class="display-4 fw-bold">Bienvenue sur HelpHub</h1>
      <p class="lead">Créez votre compte pour rejoindre une cause solidaire.</p>
    </div>
  </section>

  <!-- Registration Form -->
  <section class="register-form py-5 bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
          <div class="card shadow-lg rounded-3 p-4">
            <h2 class="text-center mb-4 fw-bold text-primary">Créer un compte</h2>

            <form method="POST" action="traitement_register.php" enctype="multipart/form-data" >
              <!-- Error Message -->
            <div id="error-message" class="alert alert-danger d-none" role="alert"></div>
              <div class="mb-3">
                <label for="role" class="form-label">Rôle</label>
                <select class="form-select" id="role" name="role" required>
                  <option value="">Choisir...</option>
                  <option value="association">Responsable Association</option>
                  <option value="donateur">Donateur</option>
                </select>
              </div>

              <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" name="nom" required>
              </div>
              <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" name="prenom" required>
              </div>
              <div class="mb-3">
                <label for="cin" class="form-label">CIN</label>
                <input type="text" class="form-control" name="cin" pattern="\d{8}" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" required>
              </div>
              <div class="mb-3">
                <label for="pseudo" class="form-label">Pseudo</label>
                <input type="text" class="form-control" name="pseudo" pattern="[A-Za-z]+" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" name="password" >
              </div>
              <div class="mb-3">
  <label for="confirm_password" class="form-label">Confirmer le mot de passe</label>
  <input type="password" class="form-control" name="confirm_password" required>
</div>
              <!-- Specific Fields for Association -->
              <div id="associationFields" style="display: none;">
                <div class="mb-3">
                  <label for="nom_association" class="form-label">Nom de l'association</label>
                  <input type="text" class="form-control" name="nom_association">
                </div>
                <div class="mb-3">
                  <label for="adresse_association" class="form-label">Adresse</label>
                  <input type="text" class="form-control" name="adresse_association">
                </div>
                <div class="mb-3">
                  <label for="id_fiscal" class="form-label">Identifiant fiscal</label>
                  <input type="text" class="form-control" name="id_fiscal" >
                </div>
                <div class="mb-3">
                  <label for="logo" class="form-label">Logo de l'association</label>
                  <input type="file" class="form-control" name="logo">
                </div>
              </div>

              <div class="d-flex justify-content-center gap-2 mt-3">
              <button type="button"onclick="submitRegistration()"  class="btn btn-primary px-5 py-3">S'inscrire</button>
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
  <script src="register_validation.js"></script>
</body>
</html>