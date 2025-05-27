<?php
session_start();

// Connexion à la BDD
$host = "localhost";
$db = "projet";    
$user = "root";            
$pass = "root"; // Pour MAMP, généralement c'est root/root
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur connexion BDD : " . $e->getMessage());
}

// Vérifie que l'utilisateur est connecté
if (!isset($_SESSION['id_user'])) {
    header('Location: login.php');
    exit();
}

$id_user = $_SESSION['id_user'];

// Ajoute 1 pièce si clic
if (isset($_POST['click'])) {
    $stmt = $pdo->prepare("UPDATE user SET coins = coins + 1 WHERE id_user = ?");
    $stmt->execute([$id_user]);
}

// Récupère le total de pièces
$stmt = $pdo->prepare("SELECT coins FROM user WHERE id_user = ?");
$stmt->execute([$id_user]);
$coins = $stmt->fetchColumn();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Clicker RUSH HOUR</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header> 
        <a class="bouton" href="index.php">back</a>
        <h1>RUSH <br> HOUR</h1>
    </header>
    <h1 class="clicker">Clicker - Win tires !</h1><br><br><br>

    <form method="POST">
        <button class="coin-button" name="click" style="background:none;border:none;padding:0;cursor:pointer;">
            <img src="image/pneu.png" alt="+1 pièce" style="width:64px;height:64px;">
        </button>
    </form>
    <br><br><br>
    <div class="coins">
        You have <strong><?= $coins ?></strong> tire<?= $coins > 1 ? 's' : '' ?>.
    </div>

</body>
</html>
