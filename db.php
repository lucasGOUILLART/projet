<?php
// fonction pour se connecter à la base de données
function ConnexionBaseDonnees() {
    $host = "localhost";
    $db = "projet";       
    $user = "root"; 
    $pass = "root";    

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
}
?>