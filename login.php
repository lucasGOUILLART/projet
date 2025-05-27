<?php
session_start();

// Connexion à la base de données
require_once "db.php";
$pdo = ConnexionBaseDonnees(); // etablir la connexion (grace à la fonction ConnexionBaseDonnees se trouvant dans le fichier db.php)

$erreur = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $motdepasse = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM user WHERE Adresse_mail = ?");
    $stmt->execute([$email]);
    $utilisateur = $stmt->fetch();

    if ($utilisateur) {
        if (password_verify($motdepasse, $utilisateur['Pass_word'])) {
            $_SESSION['id_user'] = $utilisateur['Id_user'];
            $_SESSION['pseudo'] = $utilisateur['Pseudo'];
            header("Location: index.php");
            exit();
        } else {
            $erreur = "Incorrect password.";
        }
    } else {
        $erreur = "Email address not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Log in - RUSH HOUR</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header> 
    <a class="bouton" href="index.php">back</a>
    <h1>RUSH <br> HOUR</h1>
</header>

<?php if (!empty($erreur)) : ?>
    <p style="color: red; text-align: center;"><?= htmlspecialchars($erreur) ?></p>
<?php endif; ?>

<div class="container">
    <form class="form1" method="POST" action="">
        <h2>Log in</h2>
        <br>
        <input type="email" id="email" name="email" placeholder="Email address" required><br><br>
        <input type="password" id="password" name="password" placeholder="Password" required><br><br>

        <button class="bouton2" type="submit" onclick="document.getElementById('prout-audio').play();">Log in</button><br>
        <audio id="prout-audio" src="soundboard/prout.mp3"></audio>
        <p>No account yet ? <a href="registration.php">No account yet?</a></p>
    </form>
</div>

</body>
</html>
