<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['type'] !== 'association') {
    header("Location: login.php");
    exit();
}

$id_association = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM projet WHERE id_association = ? ORDER BY date_limite DESC");
$stmt->bind_param("i", $id_association);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mes projets - HelpHub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2 class="mb-4 text-primary">📂 Mes projets</h2>



  <?php while ($projet = $result->fetch_assoc()): ?>
    <div class="card mb-3">
      <div class="card-body">
        <h5 class="card-title"><?php echo htmlspecialchars($projet['titre']); ?></h5>
        <p class="card-text"><?php echo nl2br(htmlspecialchars($projet['description'])); ?></p>
        <p><strong>Montant collecté :</strong> <?php echo $projet['montant_collecte']; ?> DT / <?php echo $projet['montant_total']; ?> DT</p>
        <p><strong>Date limite :</strong> <?php echo $projet['date_limite']; ?></p>

        <a href="details_projet_assoc.php?id=<?php echo $projet['id']; ?>" class="btn btn-outline-primary btn-sm">📄 Voir les dons</a>
        <a href="modifier_projet.php?id=<?php echo $projet['id']; ?>" class="btn btn-outline-warning btn-sm">✏ Modifier</a>
        <a href="supprimer_projet.php?id=<?php echo $projet['id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">🗑 Supprimer</a>
      </div>
    </div>
  <?php endwhile; ?>

  <a href="association_dashboard.php" class="btn btn-secondary mt-4">⬅ Retour</a>
</div>
</body>
</html>