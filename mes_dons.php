<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['type'] !== 'donateur') {
    header('Location: login.php');
    exit();
}

$id_donateur = $_SESSION['user_id'];
$stmt = $conn->prepare("
    SELECT p.titre, p.description, d.montant, d.date_don
    FROM don d
    JOIN projet p ON d.id_projet = p.id
    WHERE d.id_donateur = ?
    ORDER BY d.date_don DESC
");
$stmt->bind_param("i", $id_donateur);
$stmt->execute();
$result = $stmt->get_result();

// Total
$stmt_total = $conn->prepare("SELECT SUM(montant) AS total FROM don WHERE id_donateur = ?");
$stmt_total->bind_param("i", $id_donateur);
$stmt_total->execute();
$total = $stmt_total->get_result()->fetch_assoc()['total'] ?? 0;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mes participations - HelpHub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2 class="mb-4 text-success">💰 Mes participations</h2>

  <div class="mb-3">
    <p class="fw-bold">Montant total donné : <?php echo $total; ?> DT</p>
    <a href="donateur_dashboard.php" class="btn btn-outline-primary">🏠 Retour au tableau de bord</a>
  </div>

  <?php if ($result->num_rows > 0): ?>
    <?php while ($don = $result->fetch_assoc()): ?>
      <div class="card mb-3">
        <div class="card-body">
          <h5 class="card-title"><?php echo htmlspecialchars($don['titre']); ?></h5>
          <p><?php echo htmlspecialchars($don['description']); ?></p>
          <p>Montant donné : <?php echo $don['montant']; ?> DT</p>
          <p>Date : <?php echo $don['date_don']; ?></p>
        </div>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <div class="alert alert-info">Vous n'avez participé à aucun projet pour le moment.</div>
  <?php endif; ?>
</div>
</body>
</html>