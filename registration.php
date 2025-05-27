<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once "db.php";
$pdo = ConnexionBaseDonnees(); // etablir la connexion (grace à la fonction ConnexionBaseDonnees se trouvant dans le fichier db.php)

if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$errors = [];
$inputs = [
    'pseudo' => '',
    'date_naissance' => '',
    'tel' => '',
    'email' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération et nettoyage
    foreach ($inputs as $field => &$value) {
        $value = trim($_POST[$field] ?? '');
        if ($value === '') {
            $errors[$field] = "Le champ $field est requis.";
        }
    }
    unset($value);

    if (!preg_match('/^[\p{L}\d\s_-]{3,20}$/u', $inputs['pseudo'])) {
        $errors['pseudo'] = "Pseudo invalide (3-20 caractères, lettres, chiffres, - ou _).";
    }

    if (!filter_var($inputs['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email invalide.";
    }

    if (!preg_match('/^0[1-9](\d{2}){4}$/', $inputs['tel'])) {
        $errors['tel'] = "Numéro de téléphone invalide.";
    }

    $password = $_POST['password'] ?? '';
    $password2 = $_POST['password2'] ?? '';
    if ($password === '' || $password2 === '') {
        $errors['password'] = "Mot de passe requis.";
    } elseif ($password !== $password2) {
        $errors['password'] = "Les mots de passe ne correspondent pas.";
    } elseif (
        strlen($password) < 8 ||
        !preg_match('/[A-Z]/', $password) ||
        !preg_match('/[a-z]/', $password) ||
        !preg_match('/\d/', $password)
    ) {
        $errors['password'] = "Mot de passe trop faible.";
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT 1 FROM user WHERE Adresse_mail = ?");
        $stmt->execute([$inputs['email']]);
        if ($stmt->fetchColumn()) {
            $errors['email'] = "Cet email est déjà utilisé.";
        }
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("
            INSERT INTO user (Pseudo, Date_de_naissance, Numero_de_tel, Adresse_mail, Pass_word, Date_creation_compte)
            VALUES (:pseudo, :dob, :tel, :email, :pwd, :created)
        ");
        $stmt->execute([
            ':pseudo' => $inputs['pseudo'],
            ':dob' => $inputs['date_naissance'],
            ':tel' => $inputs['tel'],
            ':email' => $inputs['email'],
            ':pwd' => password_hash($password, PASSWORD_DEFAULT),
            ':created' => date('Y-m-d H:i:s') // <- Cette ligne ajoute la date actuelle
        ]);


        header("Location: login.php?success=1");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header> 
    <a class="bouton" href="index.php">Accueil</a>
    <h1>RUSH <br> HOUR</h1>
</header>



<?php if (!empty($errors)): ?>
    <div class="errors">
        <?php foreach ($errors as $error): ?>
            <p><?= htmlspecialchars($error) ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<div class="container">
<form class="form1" method="post" novalidate>
    <h2>Inscription</h2>
    <input type="text" name="pseudo" placeholder="Pseudo" value="<?= htmlspecialchars($inputs['pseudo']) ?>" required><br><br>
    <input type="date" name="date_naissance" value="<?= htmlspecialchars($inputs['date_naissance']) ?>" required><br><br>
    <input type="tel" name="tel" placeholder="Téléphone" value="<?= htmlspecialchars($inputs['tel']) ?>" required><br><br>
    <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($inputs['email']) ?>" required><br><br>
    <input type="password" name="password" placeholder="Mot de passe" required><br><br>
    <input type="password" name="password2" placeholder="Confirmez le mot de passe" required><br><br>
    <button type="submit">S'inscrire</button>
</form>
</div>
</body>
</html>
