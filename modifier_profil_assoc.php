<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['type'] !== 'association') {
    header('Location: login.php');
    exit();
}

$id = $_SESSION['user_id'];

// Récupérer les infos actuelles
$stmt = $conn->prepare("SELECT * FROM association WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Modifier profil - HelpHub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2 class="text-primary mb-4">⚙️ Modifier mon profil</h2>
  <div id="error-message" class="alert alert-danger d-none"></div>
  <div class="card shadow-sm p-4">
  <form method="POST" action="traitement_modifier_profil_assoc.php" enctype="multipart/form-data">
  <div class="mb-3">
    <label class="form-label">Nom de l'association</label>
    <input type="text" class="form-control" name="nom_association" value="<?= htmlspecialchars($data['nom_association']) ?>" >
  </div>

  <div class="mb-3">
    <label class="form-label">Adresse email</label>
    <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($data['email']) ?>" >
  </div>

  <div class="mb-3">
    <label class="form-label">Adresse</label>
    <textarea class="form-control" name="adresse_association" rows="3"><?= htmlspecialchars($data['adresse_association']) ?></textarea>
  </div>

  <div class="mb-3">
    <label class="form-label">Identifiant fiscal</label>
    <input type="text" class="form-control" name="identifiant_fiscal" value="<?= htmlspecialchars($data['identifiant_fiscal']) ?>" >
  </div>

  <div class="mb-3">
    <label class="form-label">Changer de logo</label>
    <input type="file" class="form-control" name="logo">
  </div>

  <hr class="my-4">

  <h5 class="text-secondary mb-3">🔒 Changer le mot de passe</h5>

  <div class="mb-3">
    <label class="form-label">Nouveau mot de passe</label>
    <input type="password" class="form-control" name="new_password" placeholder="Laisser vide si inchangé">
  </div>

  <div class="mb-3">
    <label class="form-label">Confirmer le nouveau mot de passe</label>
    <input type="password" class="form-control" name="confirm_password" placeholder="Confirmez le nouveau mot de passe">
  </div>

  <div class="d-flex justify-content-between">
    <a href="association_dashboard.php" class="btn btn-outline-secondary">⬅ Retour</a>
    <button type="button" onclick="submitProfileModification()" class="btn btn-success">💾 Enregistrer</button>
    </div>
</form>
  </div>
</div>
<script src="register_validation.js"></script>

</body>
</html>