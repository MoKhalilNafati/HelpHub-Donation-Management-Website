<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['type'] !== 'donateur') {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_projet = $_POST['id_projet'];
    $montant = floatval($_POST['montant']);
    $id_donateur = $_SESSION['user_id'];

    // Vérifier projet valide
    $stmt = $conn->prepare("SELECT montant_total, montant_collecte, date_limite FROM projet WHERE id = ?");
    $stmt->bind_param("i", $id_projet);
    $stmt->execute();
    $projet = $stmt->get_result()->fetch_assoc();

    if (!$projet) {
        die("Projet introuvable.");
    }

    $reste = $projet['montant_total'] - $projet['montant_collecte'];

    if ($montant <= 0 || $montant > $reste || $projet['date_limite'] < date('Y-m-d')) {
        die("Montant invalide ou projet expiré.");
    }

    // Enregistrer le don
    $date = date('Y-m-d');
    $stmt = $conn->prepare("INSERT INTO don (id_donateur, id_projet, date_don, montant) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iisd", $id_donateur, $id_projet, $date, $montant);
    $stmt->execute();

    // Mettre à jour le montant_collecte du projet
    $stmt = $conn->prepare("UPDATE projet SET montant_collecte = montant_collecte + ? WHERE id = ?");
    $stmt->bind_param("di", $montant, $id_projet);
    $stmt->execute();

    $_SESSION['message'] = "Merci pour votre don de $montant DT 🙏 !";
    header("Location: mes_dons.php");
    exit();
} else {
    header("Location: liste_projets.php");
    exit();
} 