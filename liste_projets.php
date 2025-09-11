<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['type'] !== 'donateur') {
    header('Location: login.php');
    exit();
}

// Récupération des projets valides
$today = date('Y-m-d');
$stmt = $conn->prepare("SELECT * FROM projet WHERE date_limite >= ? AND montant_collecte < montant_total");
$stmt->bind_param("s", $today);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Projets disponibles - HelpHub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2 class="mb-4 text-primary">📋 Projets d'aide disponibles</h2>

  <?php while ($projet = $result->fetch_assoc()): ?>
    <div class="card mb-3">
      <div class="card-body">
        <h5 class="card-title"><?php echo htmlspecialchars($projet['titre']); ?></h5>
        <p class="card-text"><?php echo nl2br(htmlspecialchars($projet['description'])); ?></p>
        <p>Montant total : <?php echo $projet['montant_total']; ?> DT</p>
        <p>Montant collecté : <?php echo $projet['montant_collecte']; ?> DT</p>
        <p>Date limite : <?php echo $projet['date_limite']; ?></p>
        <a href="details_projet.php?id=<?php echo $projet['id']; ?>" class="btn btn-success">Participer</a>
      </div>
    </div>
  <?php endwhile; ?>

</div>
</body>
</html> 