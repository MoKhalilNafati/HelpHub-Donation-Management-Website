<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['type'] !== 'association') {
    header('Location: login.php');
    exit();
}

$id_projet = $_GET['id'] ?? null;
$id_association = $_SESSION['user_id'];

if (!$id_projet) {
    echo "Projet non spécifié.";
    exit();
}

// Récupérer les données du projet
$stmt = $conn->prepare("SELECT * FROM projet WHERE id = ? AND id_association = ?");
$stmt->bind_param("ii", $id_projet, $id_association);
$stmt->execute();
$projet = $stmt->get_result()->fetch_assoc();

if (!$projet) {
    echo "Projet introuvable ou accès non autorisé.";
    exit();
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $montant_total = floatval($_POST['montant_total']);
    $date_limite = $_POST['date_limite'];

    // Vérification basique
    if ($montant_total <= 0) {
        $error = "Le montant total doit être supérieur à 0.";
    } elseif ($date_limite < date('Y-m-d')) {
        $error = "La date limite ne peut pas être dans le passé.";
    } else {
        $stmt = $conn->prepare("UPDATE projet SET titre = ?, description = ?, montant_total = ?, date_limite = ? WHERE id = ? AND id_association = ?");
        $stmt->bind_param("ssdssi", $titre, $description, $montant_total, $date_limite, $id_projet, $id_association);
        $stmt->execute();

        $_SESSION['message'] = "✅ Projet modifié avec succès.";
        header("Location: mes_projets.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Modifier projet - HelpHub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
<div id="error-message" class="alert alert-danger d-none"></div>

  <h2 class="text-warning mb-4">✏️ Modifier le projet</h2>



  <div class="card shadow-sm p-4">
  <div id="error-message" class="alert alert-danger d-none"></div>

    <form method="POST">
      <div class="mb-3">
        <label for="titre" class="form-label">Titre</label>
        <input type="text" name="titre" id="titre" class="form-control" required value="<?= htmlspecialchars($projet['titre']) ?>">
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" rows="4" class="form-control" required><?= htmlspecialchars($projet['description']) ?></textarea>
      </div>

      <div class="mb-3">
        <label for="montant_total" class="form-label">Montant total (DT)</label>
        <input type="number" step="0.01" name="montant_total" id="montant_total" class="form-control" min="1" required value="<?= $projet['montant_total'] ?>">
      </div>

      <div class="mb-3">
        <label for="date_limite" class="form-label">Date limite</label>
        <input type="date" name="date_limite" id="date_limite" class="form-control" required value="<?= $projet['date_limite'] ?>">
      </div>

      <div class="d-flex justify-content-between">
        <a href="mes_projets.php" class="btn btn-outline-secondary">⬅ Retour</a>
        <button type="button" onclick="submitProfileModification()" class="btn btn-warning">💾 Enregistrer les modifications</button>
      </div>
    </form>
  </div>
</div>
</body>
</html> 