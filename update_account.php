<?php
session_start();

// Connexion à la base de données
$host = "localhost";
$db = "projet";
$user = "root";
$pass = "root";
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if (!isset($_SESSION['id_user'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit();
}

$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $pseudo = trim($_POST['pseudo'] ?? '');
    $birthdate = trim($_POST['birthdate'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email === '' || $pseudo === '' || $birthdate === '') {
        $error = 'Tous les champs obligatoires doivent être remplis.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Email invalide.';
    } else {
        // Vérifier si l'email est déjà utilisé par un autre utilisateur
        $stmt = $pdo->prepare("SELECT Id_user FROM user WHERE Adresse_mail = ? AND Id_user != ?");
        $stmt->execute([$email, $_SESSION['id_user']]);
        if ($stmt->fetch()) {
            $error = 'Cet email est déjà utilisé.';
        } else {
            // Préparer la requête de mise à jour
            $sql = "UPDATE user SET Adresse_mail = ?, Pseudo = ?, Date_de_naissance = ?";
            $params = [$email, $pseudo, $birthdate];
            if (!empty($password)) {
                $sql .= ", Pass_word = ?";
                $params[] = password_hash($password, PASSWORD_DEFAULT);
            }
            $sql .= " WHERE Id_user = ?";
            $params[] = $_SESSION['id_user'];
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute($params)) {
                $_SESSION['email'] = $email;
                $_SESSION['pseudo'] = $pseudo;
                $_SESSION['birthdate'] = $birthdate;
                $success = true;
            } else {
                $error = 'Erreur lors de la mise à jour.';
            }
        }
    }
    if ($success) {
        header('Location: account.php?success=1');
        exit();
    }
}
