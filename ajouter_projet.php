<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['type'] !== 'association') {
    header("Location: login.php");
    exit();
}

$id_association = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $montant_total = floatval($_POST['montant_total']);
    $date_limite = $_POST['date_limite'];

    if ($montant_total <= 0) {
        $error = "Le montant total doit être supérieur à 0.";
    } elseif ($date_limite < date('Y-m-d')) {
        $error = "La date limite ne peut pas être dans le passé.";
    } else {
        $stmt = $conn->prepare("INSERT INTO projet (id_association, titre, description, montant_total, date_limite) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issds", $id_association, $titre, $description, $montant_total, $date_limite);
        $stmt->execute();

        $_SESSION['message'] = "Projet ajouté avec succès ✅";
        header("Location: mes_projets.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Ajouter un projet - HelpHub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h2 class="text-primary fw-bold mb-4">➕ Ajouter un nouveau projet</h2>

    <?php if (!empty($error)): ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <div class="card shadow-sm p-4">
      <form method="POST">
        <div class="mb-3">
          <label for="titre" class="form-label">Titre du projet</label>
          <input type="text" class="form-control" name="titre" id="titre" required>
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea name="description" class="form-control" id="description" rows="4" required></textarea>
        </div>

        <div class="mb-3">
          <label for="montant_total" class="form-label">Montant à collecter (DT)</label>
          <input type="number" class="form-control" name="montant_total" id="montant_total" step="0.01" min="1" required>
        </div>

        <div class="mb-3">
          <label for="date_limite" class="form-label">Date limite</label>
          <input type="date" class="form-control" name="date_limite" id="date_limite" required>
        </div>

        <div class="d-flex justify-content-between">
          <a href="association_dashboard.php" class="btn btn-outline-secondary">⬅ Retour</a>
          <button type="submit" class="btn btn-success">Créer le projet</button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>