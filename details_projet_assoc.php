<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['type'] !== 'association') {
    header("Location: login.php");
    exit();
}

$id_projet = $_GET['id'] ?? null;
$id_association = $_SESSION['user_id'];

if (!$id_projet) {
    echo "Projet introuvable.";
    exit();
}

$stmt = $conn->prepare("SELECT * FROM projet WHERE id = ? AND id_association = ?");
$stmt->bind_param("ii", $id_projet, $id_association);
$stmt->execute();
$projet = $stmt->get_result()->fetch_assoc();

if (!$projet) {
    echo "Accès interdit ou projet inexistant.";
    exit();
}

$stmt = $conn->prepare("
    SELECT d.montant, d.date_don, donateur.nom, donateur.prenom
    FROM don d
    JOIN donateur ON d.id_donateur = donateur.id
    WHERE d.id_projet = ?
    ORDER BY d.date_don DESC
");
$stmt->bind_param("i", $id_projet);
$stmt->execute();
$dons = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Détails projet - HelpHub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2 class="text-success mb-4"><?php echo htmlspecialchars($projet['titre']); ?></h2>
  <p><?php echo nl2br(htmlspecialchars($projet['description'])); ?></p>
  <p><strong>Montant collecté :</strong> <?php echo $projet['montant_collecte']; ?> DT / <?php echo $projet['montant_total']; ?> DT</p>
  <p><strong>Date limite :</strong> <?php echo $projet['date_limite']; ?></p>

  <h4 class="mt-4">📋 Liste des participations :</h4>
  <?php if ($dons->num_rows > 0): ?>
    <ul class="list-group mt-3">
      <?php while ($don = $dons->fetch_assoc()): ?>
        <li class="list-group-item">
          <?= $don['nom'] ?> <?= $don['prenom'] ?> — <?= $don['montant'] ?> DT (<?= $don['date_don'] ?>)
        </li>
      <?php endwhile; ?>
    </ul>
  <?php else: ?>
    <div class="alert alert-info mt-3">Aucun don reçu pour ce projet pour le moment.</div>
  <?php endif; ?>

  <a href="mes_projets.php" class="btn btn-outline-secondary mt-4">⬅ Retour à mes projets</a>
</div>
</body>
</html>