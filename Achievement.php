<?php
session_start();

$host = "localhost";
$db = "projet";    
$user = "root";            
$pass = "root";                
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("connection error : " . $e->getMessage());
}

if (!isset($_SESSION['id_user'])) {
    header('Location: login.php');
    exit();
}

$id_user = $_SESSION['id_user'];

$sql = "SELECT a.nom, a.description, a.icone, ua.date_debloque IS NOT NULL AS debloque
        FROM achievement a
        LEFT JOIN user_achievement ua ON a.id_achievement = ua.id_achievement AND ua.id_user = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id_user]);
$achievements = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Succès</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header> 
    <a class="bouton" href="index.php">back</a>
    <h1>RUSH <br> HOUR</h1>
</header>
<br>
<h2 class="achievementh2">Achievements unlocked</h2>

<div class="achievements-container">
    <?php foreach ($achievements as $a): ?>
        <div class="achievement <?= $a['debloque'] ? 'unlocked' : 'locked' ?>">
            <img src="img/achievements/<?= htmlspecialchars($a['icone']) ?>" alt="<?= htmlspecialchars($a['nom']) ?>">
            <h3><?= htmlspecialchars($a['nom']) ?></h3>
            <p><?= htmlspecialchars($a['description']) ?></p>
        </div>
    <?php endforeach; ?>
</div>
<?php
$total = count($achievements);
$unlocked = 0;
foreach ($achievements as $a) {
    if ($a['debloque']) $unlocked++;
}
$percent = $total > 0 ? round(($unlocked / $total) * 100) : 0;
?>
<div class="achievement-progress">
    <p>You have finished the achievements at <?= $percent ?> %</p>
</div>
</body>
</html>
