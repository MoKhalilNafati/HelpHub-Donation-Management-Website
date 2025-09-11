<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['type'] !== 'donateur') {
    header('Location: login.php');
    exit();
}

if (!isset($_GET['id'])) {
    echo "Projet introuvable.";
    exit();
}

$id_projet = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM projet WHERE id = ?");
$stmt->bind_param("i", $id_projet);
$stmt->execute();
$projet = $stmt->get_result()->fetch_assoc();

if (!$projet) {
    echo "Projet non trouvé.";
    exit();
}

$montant_restant = $projet['montant_total'] - $projet['montant_collecte'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Détails projet</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2 class="text-primary mb-3"><?php echo htmlspecialchars($projet['titre']); ?></h2>
  <p><?php echo nl2br(htmlspecialchars($projet['description'])); ?></p>
  <p><strong>Montant total :</strong> <?php echo $projet['montant_total']; ?> DT</p>
  <p><strong>Montant collecté :</strong> <?php echo $projet['montant_collecte']; ?> DT</p>
  <p><strong>Montant restant :</strong> <?php echo $montant_restant; ?> DT</p>
  <p><strong>Date limite :</strong> <?php echo $projet['date_limite']; ?></p>

  <?php if ($montant_restant > 0 && $projet['date_limite'] >= date('Y-m-d')): ?>
    <hr>
    <h4>💸 Participer à ce projet</h4>
    <form method="POST" action="participer.php">
      <input type="hidden" name="id_projet" value="<?php echo $id_projet; ?>">
      <div class="mb-3">
        <label for="montant" class="form-label">Montant à donner (DT)</label>
        <input type="number" name="montant" class="form-control" min="1" max="<?php echo $montant_restant; ?>" required>
      </div>
      <button type="submit" class="btn btn-success">Participer</button>
    </form>
  <?php else: ?>
    <div class="alert alert-info mt-4">Ce projet est terminé ou entièrement financé.</div>
  <?php endif; ?>
</div>
</body>
</html>