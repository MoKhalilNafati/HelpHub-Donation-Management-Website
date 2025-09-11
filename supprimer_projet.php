<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['type'] !== 'association') {
    header('Location: login.php');
    exit();
}

$id_projet = $_GET['id'] ?? null;

if (!$id_projet) {
    $_SESSION['error'] = "Projet non spécifié.";
    header("Location: mes_projets.php");
    exit();
}

// Vérifier qu’il appartient à l’association
$stmt = $conn->prepare("SELECT * FROM projet WHERE id = ? AND id_association = ?");
$stmt->bind_param("ii", $id_projet, $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    $_SESSION['error'] = "Projet introuvable ou non autorisé.";
    header("Location: mes_projets.php");
    exit();
}

// Vérifier s’il a reçu des dons
$stmt = $conn->prepare("SELECT COUNT(*) AS total_dons FROM don WHERE id_projet = ?");
$stmt->bind_param("i", $id_projet);
$stmt->execute();
$total_dons = $stmt->get_result()->fetch_assoc()['total_dons'];

if ($total_dons > 0) {
    $_SESSION['error'] = "Impossible de supprimer un projet ayant reçu des dons.";
    header("Location: mes_projets.php");
    exit();
}

// Supprimer
$stmt = $conn->prepare("DELETE FROM projet WHERE id = ?");
$stmt->bind_param("i", $id_projet);
$stmt->execute();

$_SESSION['success'] = "Projet supprimé avec succès.";
header("Location: mes_projets.php"); 