<?php
session_start();
require_once "db.php";
header('Content-Type: application/json');

if (!isset($_SESSION['id_user'])) {
    echo json_encode(['success' => false, 'coins' => 0]);
    exit;
}

$pdo = ConnexionBaseDonnees();
$id = $_SESSION['id_user'];
$stmt = $pdo->prepare("SELECT coins FROM user WHERE Id_user = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();
$coins = $user ? (int)$user['coins'] : 0;
echo json_encode(['success' => true, 'coins' => $coins]);
