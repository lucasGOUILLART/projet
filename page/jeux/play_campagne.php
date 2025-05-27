<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();


require_once "deplacement.php";
require_once "../../db.php"; 
require_once "vehicule.php";


function getCodeMapById($id_map) {
    $host = 'localhost';
    $dbname = 'projet';
    $username = 'root';
    $password = 'root';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT code_map FROM map WHERE id_map = :id_map");
        $stmt->bindParam(':id_map', $id_map, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result && isset($result['code_map'])) {
            // Convert the PHP array string to an actual array
            return eval('return ' . $result['code_map'] . ';');
        } else {
            return null;
        }
    } catch (PDOException $e) {
        // Handle error as needed
        return null;
    }
}
$pdo = ConnexionBaseDonnees(); // etablir la connexion (grace à la fonction ConnexionBaseDonnees se trouvant dans le fichier db.php)



function initialiserSession() {
    // Réinitialiser la session si le niveau change ou si les vehicules ne sont pas définis
    if (!isset($_SESSION['vehicules']) || !isset($_SESSION['level']) || $_SESSION['level'] != $_GET['level']) {
        $_SESSION['vehicules'] = getCodeMapById($_GET['level']);
        $_SESSION['actif'] = 'rouge'; // véhicule sélectionné par défaut
        $_SESSION['level'] = $_GET['level'];
    }
}

function genererGrille($vehicules) {
    $grille = array_fill(0, 6, array_fill(0, 6, "."));
    
    foreach ($vehicules as $couleur => $v) {
        for ($i = 0; $i < $v['taille']; $i++) {
            $xi = $v['x'] + ($v['dir'] === 'V' ? $i : 0);
            $yi = $v['y'] + ($v['dir'] === 'H' ? $i : 0);
            $grille[$xi][$yi] = strtoupper(substr($couleur, 0, 1));
        }
    }
    
    return $grille;
}
function afficherGrille($grille, $vehicules) {
    echo "<table class='grille'>";
    foreach ($grille as $i => $ligne) {
        echo "<tr>";
        foreach ($ligne as $j => $case) {
            $class = "";

            if ($i === 2 && $j === 5) {
                $class = "end";
            } elseif ($case) {
                $class = "name_case";
            }

            echo "<td class='$class'>";

            $case = $grille[$i][$j];
            if ($case !== ".") {
                $couleurTrouvee = null;
                foreach ($vehicules as $couleur => $v) {
                    if (strtoupper(substr($couleur, 0, 1)) === $case) {
                        $couleurTrouvee = $couleur;
                        $vehicule = $v;
                        break;
                    }
                }

                if ($couleurTrouvee) {
                    $dir = $vehicule['dir'];
                    $taille = $vehicule['taille'];
                    $x = $vehicule['x'];
                    $y = $vehicule['y'];

                    $pos = 0;
                    if ($dir === 'H' && $i === $x) {
                        $pos = $j - $y;
                    } elseif ($dir === 'V' && $j === $y) {
                        $pos = $i - $x;
                    }
                    if ($v['taille']==3){
                        if ($pos === 0) {
                            $suffix = "avant";
                        } elseif ($pos === $taille - 1) {
                            $suffix = "arriere";
                        } else {
                            $suffix = "milieu"; // Optionnel
                        }
                        $imagePath = "../../image/c_{$couleurTrouvee}_{$suffix}.png";
                    }else{
                        if ($pos === 0) {
                            $suffix = "avant";
                        } elseif ($pos === $taille - 1) {
                            $suffix = "arriere";
                        }
                        $imagePath = "../../image/{$couleurTrouvee}_{$suffix}.png";
                    }
                    if ($dir === 'H') {
                        $rotationClass =  "rotate-90";
                    } else{
                        $rotationClass =  "rotate-180";
                    }
                    
                    
                    echo "<img src='$imagePath' alt='$couleurTrouvee' class='{$rotationClass}_{$suffix}'>";
                } else {
                    echo $case;
                }
            }

            echo "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

// IMPORTANT
initialiserSession();
gererSelectionVehicule();

if (isset($_POST['action']) && in_array($_POST['action'], ['gauche', 'droite', 'haut', 'bas'])) {
    $_SESSION['vehicules'] = traiterDeplacement($_SESSION['vehicules'], $_POST['action']);
}
$grille = genererGrille($_SESSION['vehicules']);

// Vérification si la voiture rouge est à la sortie après chaque déplacement
voitureRougeEstASortie($grille);

// Fin important
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RUSH HOUR</title>
    <link rel="stylesheet" href="../../style.css">
    <script>
    // Active le son au premier clic de l'utilisateur
    window.addEventListener('click', function () {
        const audio = document.getElementById('bgAudio');
        audio.muted = false;
        audio.play();
    }, { once: true });

    
    </script>

</head>
<body>
<audio id="bgAudio" autoplay loop muted>
  <source src="../../soundboard/musique_fond.mp3" type="audio/mpeg">
  Votre navigateur ne supporte pas la lecture audio.
</audio>
<header> 
    <a class="bouton" href="../../singleplayer.php">Back</a>
    <h1>RUSH<br>HOUR</h1>
    <a class="bouton" href="../../index.php">Home</a>
</header>

<?php
$pseudo = isset($_SESSION['pseudo']) ? $_SESSION['pseudo'] : "";
echo "<h2 class='progessiontexte'>Welcome, " . htmlspecialchars($pseudo) . " !</h2>";
?>
<div class="grille_jeu">
    <div class="grille_bouton">
        <div class="grille">
            <?php
            $vehicules = $_SESSION['vehicules'];
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
            </script>
            <button id="buttonsolver" type="submit" name="action" value="help_hint">Help</button>
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
                </script>";
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
                }
            }
            ?>
            <button id="buttonsolver" type="submit" name="action" value="help_resolve">Resolve</button>
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
                </script>";
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
                }
            }
            ?>
        </form>

    </div>
</div>


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
            echo "<p>Nombre de parties : " . $score['Nombre_parties'] . "</p>";
            echo "<p>Nombre de coups : " . $score['Nombres_coups'] . "</p>";
            echo "<p>Top coups : " . htmlspecialchars($score['Top_coups']) . "</p>";
        } else {
            echo "<p class='achievement-progress'>No statistics found for your account.</p>";
        }
    }
    ?>
</div>



</body>
</html>
