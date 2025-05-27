<?php

$host = $_ENV['PG_HOST'];
$port = $_ENV['PG_PORT'];
$db = $_ENV['PG_DB'];
$user = $_ENV['PG_USER'];
$password = $_ENV['PG_PASSWORD'];
$endpoint = $_ENV['PG_ENDPOINT'];

$connection_string = "host=" . $host . " port=" . $port . " dbname=" . $db . " user=" . $user . " password=" . $password . " options='endpoint=" . $endpoint . "' sslmode=require";

$dbconn = pg_connect($connection_string);

if (!$dbconn) {
    die("Connection failed: " . pg_last_error());
}
echo "Connected successfully";

<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
// Démarrer la session
session_start();
// test

require_once "page/jeux/deplacement.php";
require_once "db.php";
require_once "page/jeux/grille.php";
require_once "page/jeux/vehicule.php";

$pdo = ConnexionBaseDonnees(); 

if (!isset($_SESSION['id_user']) || empty($_SESSION['id_user'])) {
    // Rediriger vers la page de connexion si non connecté
    header('Location: login.php');
    exit();
}

// Fonction pour initialiser la session
function initialiserSession() {
    if (!isset($_SESSION['vehicules'])) {
        $_SESSION['vehicules'] = obtenirDictionnaireVehicules();
        $_SESSION['actif'] = 'rouge'; 
    }
}

function voitureRougeEstASortie2($grid) {
    $rows = count($grid);
    $cols = count($grid[0]);
    $colSortie = $cols - 1; // dernière colonne
    $trouve = false;
    // Détecte le mode de jeu : singleplayer ou autre
    $redirectUrl = 'index.php';
    
    for ($i = 0; $i < $rows; $i++) {
        if (strtoupper($grid[$i][$colSortie]) === 'R') {
            $trouve = true;
            echo '<div id="victoire-overlay"><div class="victoire-message">Congratulations! The red car has exited!<br><br><a href="' . $redirectUrl . '" class="bouton">New game grid</a></div></div>';
            $_SESSION['vehicules'] = obtenirDictionnaireVehicules();
            $_SESSION['actif'] = 'rouge'; 
            break;
        }
    }
    return $trouve;
}
// IMPORTANT
// ne pas toucher au code suivant 
// Exécution du code principal 
initialiserSession();
gererSelectionVehicule();

if (isset($_POST['action']) && in_array($_POST['action'], ['gauche', 'droite', 'haut', 'bas'])) {
    $_SESSION['vehicules'] = traiterDeplacement($_SESSION['vehicules'], $_POST['action']);
}
$vehicules = $_SESSION['vehicules'];
$grille = genererGrille($vehicules);
voitureRougeEstASortie2($grille);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RUSH HOUR</title>
    <link rel="stylesheet" href="style.css">
    <script>
    window.addEventListener('click', function () {
        const audio = document.getElementById('bgAudio');
        audio.muted = false;
        audio.play();
    }, { once: true });

    
    </script>

</head>
<body>
<audio id="bgAudio" autoplay loop muted>
  <source src="soundboard/musique_fond.mp3" type="audio/mpeg">
  Votre navigateur ne supporte pas la lecture audio.
</audio>
<header> 
    <?php if (isset($_SESSION['id_user'])): ?>
        <!-- Groupe ONLINE + Tires -->
        <div class="status-group">
            <nav>
                <ul class="menu">
                    <li class="deroulant">
                        <a href="#" style="color: white; font-weight: bold;" onclick="event.preventDefault(); this.nextElementSibling.classList.toggle('show');">
                            ONLINE / MENU
                        </a>
                        <ul class="sous">
                            <li><a href="account.php">My account</a></li>
                            <li><a href="Achievement.php">Achievement</a></li>
                            <li><a href="singleplayer.php">Single player</a></li>
                            <li><a href="page\jeux/createurDeNiveau.php">Map creation</a></li>
                            <li><a href="Autoclicker.php">Auto clicker</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <br>
            <?php
                $id = $_SESSION['id_user'];
                $stmt = $pdo->prepare("SELECT coins FROM user WHERE Id_user = ?");
                $stmt->execute([$id]);
                $user = $stmt->fetch();
                $tires = $user ? (int)$user['coins'] : 0;
                echo '<a class="bouton" id="coins-display" href="#">Tires: ' . htmlspecialchars($tires) . '</a>';
            ?>
        </div>

    <?php else: ?>
        <div class="status-group">
            <a class="bouton" href="login.php" style="color: white; font-weight: bold;">OFFLINE</a>
        </div>
    <?php endif; ?>

    <div class="RUSH_HOUR">
    <h1>RUSH <br> HOUR</h1>
    </div>

    <?php if (isset($_SESSION['id_user'])): ?>
        <a class="bouton" href="logout.php">Disconnect</a>
    <?php else: ?>
        <a class="bouton" href="login.php">Login</a>
    <?php endif; ?>
</header>



<?php
if (isset($_SESSION['id_user'])) {
    echo "<h2 class='progessiontexte'>Welcome, " . htmlspecialchars($_SESSION['pseudo']) . " !</h2>";
} else {
    echo "<h2 class='progessiontexte'>Welcome, log in to save your progress!</h2>";
}
?>
<div class="grille_jeu">
    <div class="grille_bouton">
        <div class="grille">
            <?php 
                afficherGrille($grille, $vehicules); 
            ?>
        </div>
        <form method="post" class="vehicules">
        <strong>Véhicule :</strong>
        <?php foreach ($_SESSION['vehicules'] as $nom => $v) : ?>
            <button type="submit" name="vehicule" value="<?= htmlspecialchars($nom) ?>"
                <?= $_SESSION['actif'] === $nom ? 'style="font-weight:bold;"' : '' ?>>
                <?= ucfirst($nom) ?>
            </button>
        <?php endforeach; ?>
        </form>
        <form method="post" class="actions">
            <div class="step">
                <button id="High" type="submit" name="action" value="haut">ᐃ</button>
                <button id="Left" type="submit" name="action" value="gauche">ᐊ</button>
                <button id="Down" type="submit" name="action" value="bas">ᐁ</button>
                <button id="Right" type="submit" name="action" value="droite">ᐅ</button>
            </div>
        </form>
    <form method="post" class="solveur">
            <button id="buttonsolver" type="button" onclick="openHelp()">?</button>
            <script>
            function openHelp() {
                const helpWindow = document.createElement('div');
                helpWindow.style.position = 'fixed';
                helpWindow.style.top = '50%';
                helpWindow.style.left = '50%';
                helpWindow.style.transform = 'translate(-50%, -50%)';
                helpWindow.style.background = '#fff';
                helpWindow.style.padding = '20px';
                helpWindow.style.border = '2px solid #333';
                helpWindow.style.zIndex = 1000;
                helpWindow.innerHTML = `
                    <p>Règle :<br>
                        - L'objectif est de sortir la voiture rouge du parking en bougeant les autres voitures<br>
                        - Cliquer sur le bouton de la voiture que vous voulez déplacer<br>
                        - Déplacer la avec les boutons ou les flèches <br>
                        - Puis refaite pareil jusqu'a temps que la voitures rouges sorte du parking<br>
                        <br>
                    Besoins d'aide ?<br>
                        - Cliquez sur le bouton "Help" pour obtenir un indice<br>
                        - Cliquez sur le bouton "Solver" pour obtenir la solution<br>
                        ATTENTION : Une aide coute des pneus <br>
                        100 pneus pour un indice<br>
                        1000 pnues pour la solution<br>
                        <br>
                    Comment obtenir des pneus ?<br>
                        - Gagner une partie et obtenez 100 pneus <br>
                        - Obtenez des pneus sur l'Autoclicker<br>
                        - Obtenez des pneus en débloquant des succès <br>
                        Succès :<br>
                        - Bronze : 10 pneus<br>
                        - Argent : 50 pneus<br>
                        - Or : 100 pneus<br>
                        - Platine : 500 pneus<br>
                    </p>
                    <button onclick="this.parentNode.remove()">Fermer</button>
                `;
                document.body.appendChild(helpWindow);
            }

            // Met à jour dynamiquement le nombre de coins après Help ou Resolve
            function updateCoinsDisplay() {
                fetch('coins.php')
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const coinsDisplay = document.getElementById('coins-display');
                            if (coinsDisplay) {
                                coinsDisplay.textContent = 'Tires: ' + data.coins;
                            }
                        }
                    });
            }
            </script>
            <button id="buttonsolver" type="submit" name="action" value="help_hint">Help</button>
            <?php
            // Exécuter detectVehicles lors du clic sur "Help"
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'help_hint') {
                require_once "page/jeux/deplacement.php"; // S'assurer que la fonction est disponible
                detectVehicles("../new_solver_vinfini/x64/Debug/text.txt");
                $output = [];
                $return_code = 0;
                exec('./monprogramme', $output, $return_code);
                $contenu = file_get_contents('../new_solver_vinfini/x64/Debug/result.txt');
                echo nl2br($contenu);
            }
            ?>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'help_hint' && isset($_SESSION['id_user'])) {
                $id = $_SESSION['id_user'];
                // Vérifier le solde actuel
                $stmt = $pdo->prepare("SELECT coins FROM user WHERE Id_user = ?");
                $stmt->execute([$id]);
                $user = $stmt->fetch();
                if ($user && $user['coins'] >= 100) {
                $stmt = $pdo->prepare("UPDATE user SET coins = coins - 100 WHERE Id_user = ?");
                $stmt->execute([$id]);
                // Mettre à jour la session si besoin
                $_SESSION['coins'] = $user['coins'] - 100;
                echo "<script>
                    const msg = document.createElement('div');
                    msg.style.position = 'fixed';
                    msg.style.top = '50%';
                    msg.style.left = '50%';
                    msg.style.transform = 'translate(-50%, -50%)';
                    msg.style.background = '#fff';
                    msg.style.padding = '20px';
                    msg.style.border = '2px solid green';
                    msg.style.zIndex = 1001;
                    msg.innerHTML = \"<p class='achievement-progress' style='color:green;'>100 tires taken out for help.</p><button onclick='this.parentNode.remove()'>Close</button>\";
                    document.body.appendChild(msg);
                    updateCoinsDisplay();
                    setTimeout(function(){ window.location.replace(window.location.pathname + window.location.search); }, 1500);
                </script>";
                exit;
                } else {
                echo "<script>
                    const msg = document.createElement('div');
                    msg.style.position = 'fixed';
                    msg.style.top = '50%';
                    msg.style.left = '50%';
                    msg.style.transform = 'translate(-50%, -50%)';
                    msg.style.background = '#fff';
                    msg.style.padding = '20px';
                    msg.style.border = '2px solid red';
                    msg.style.zIndex = 1001;
                    msg.innerHTML = \"<p class='achievement-progress' style='color:red;'>You don't have enough tires.</p><button onclick='this.parentNode.remove()'>Close</button>\";
                    document.body.appendChild(msg);
                </script>";
                echo "<script>window.location.href = window.location.pathname + window.location.search;</script>";
                exit;
                }
            }
            ?>
            <button id="buttonsolver" type="submit" name="action" value="help_resolve">Resolve</button>
            <?php
            // Exécuter detectVehicles lors du clic sur "Resolve"
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'help_resolve') {
                // On suppose que $grille est déjà généré plus haut
                require_once "page/jeux/deplacement.php"; // Assurez-vous que la fonction est dans ce fichier
                detectVehicles("result.txt");
            }
            ?>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'help_resolve' && isset($_SESSION['id_user'])) {
                $id = $_SESSION['id_user'];
                // Vérifier le solde actuel
                $stmt = $pdo->prepare("SELECT coins FROM user WHERE Id_user = ?");
                $stmt->execute([$id]);
                $user = $stmt->fetch();
                if ($user && $user['coins'] >= 1000) {
                $stmt = $pdo->prepare("UPDATE user SET coins = coins - 1000 WHERE Id_user = ?");
                $stmt->execute([$id]);
                // Mettre à jour la session si besoin
                $_SESSION['coins'] = $user['coins'] - 1000;
                echo "<script>
                    const msg = document.createElement('div');
                    msg.style.position = 'fixed';
                    msg.style.top = '50%';
                    msg.style.left = '50%';
                    msg.style.transform = 'translate(-50%, -50%)';
                    msg.style.background = '#fff';
                    msg.style.padding = '20px';
                    msg.style.border = '2px solid green';
                    msg.style.zIndex = 1001;
                    msg.innerHTML = \"<p class='achievement-progress' style='color:green;'>1000 tires taken out for help.</p><button onclick='this.parentNode.remove()'>Close</button>\";
                    document.body.appendChild(msg);
                    updateCoinsDisplay();
                    setTimeout(function(){ window.location.replace(window.location.pathname + window.location.search); }, 1500);
                </script>";
                exit;
                } else {
                echo "<script>
                    const msg = document.createElement('div');
                    msg.style.position = 'fixed';
                    msg.style.top = '50%';
                    msg.style.left = '50%';
                    msg.style.transform = 'translate(-50%, -50%)';
                    msg.style.background = '#fff';
                    msg.style.padding = '20px';
                    msg.style.border = '2px solid red';
                    msg.style.zIndex = 1001;
                    msg.innerHTML = \"<p class='achievement-progress' style='color:red;'>You don't have enough tires.</p><button onclick='this.parentNode.remove()'>Close</button>\";
                    document.body.appendChild(msg);
                </script>";
                exit;
                }
            }
            ?>
        </form>

    </div>
</div>
<form method="post" class="difficulty">
        <button type="submit" name="action" value="easy">Easy</button>
        <button type="submit" name="action" value="middle">Middle</button>
        <button type="submit" name="action" value="hard">Hard</button>
    </form>
<div class="leaderboard">
    <p class="achievement-progress"> Le classement est inexistant</p>
</div>
<br>
<br>
<br>
<div class="statsperso">
    <?php
    // Si l'utilisateur est connecté, afficher ses stats
    if (isset($_SESSION['id_user'])) {
        $id = $_SESSION['id_user'];
        $stmt = $pdo->prepare("SELECT * FROM score_perso WHERE Id_user = ?");
        $stmt->execute([$id]);
        $score = $stmt->fetch();
        if ($score) {
            echo "<h3>Statistiques personnelles</h3>";
            echo "<table class='stats-table'>";
            echo "<tr><th>Nombre de parties</th><th>Nombre de coups</th><th>Top coups</th></tr>";
            echo "<tr>";
            echo "<td>" . htmlspecialchars($score['Nombre_parties']) . "</td>";
            echo "<td>" . htmlspecialchars($score['Nombres_coups']) . "</td>";
            echo "<td>" . htmlspecialchars($score['Top_coups']) . "</td>";
            echo "</tr>";
            echo "</table>";
        } else {
            echo "<p class='achievement-progress'>No statistics found for your account.</p>";
        }
    }
    ?>
</div>



</body>
</html>
