<?php
session_start();

// === Fonctions de logique ===
function resetGrille()
{
    unset($_SESSION['vehicule']);
    unset($_SESSION['historique']);
    header('Location: ' . strtok($_SERVER["REQUEST_URI"], '?'));
    exit;
}

function ajouterVehicule($type, $direction, $couleur, $x, $y)
{
    $types_valides = ['voiture', 'camion'];
    $directions_valides = ['horizontal', 'vertical'];
    $couleurs_valides = ['rouge', 'bleu', 'vert', 'jaune'];

    if (
        in_array($type, $types_valides) &&
        in_array($direction, $directions_valides) &&
        in_array($couleur, $couleurs_valides) &&
        !($couleur === 'rouge' && $type === 'camion')
    ) {
        if ($couleur === 'rouge') {
            if ($y !== 2 || $x < 0 || $x > 3) return;
        }

        if (!isset($_SESSION['vehicule'])) {
            $_SESSION['vehicule'] = [];
        }

        if (!isset($_SESSION['vehicule'][$couleur])) {
            $taille = ($type === 'voiture') ? 2 : 3;
            $dir = ($direction === 'horizontal') ? 'H' : 'V';
            $_SESSION['vehicule'][$couleur] = ['x' => $x, 'y' => $y, 'dir' => $dir, 'taille' => $taille];

            $_SESSION['historique'][] = $couleur;
        }
    }
}

function annulerDernierCoup()
{
    if (!empty($_SESSION['historique'])) {
        $dernier = array_pop($_SESSION['historique']);
        unset($_SESSION['vehicule'][$dernier]);
    }
}

function gererFormulaires()
{
    if (isset($_GET['reset']) && $_GET['reset'] === '1') {
        resetGrille();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'] ?? '';
        if ($action === 'ajouter') {
            ajouterVehicule($_POST['type'], $_POST['direction'], $_POST['couleur'], intval($_POST['x']), intval($_POST['y']));
        } elseif ($action === 'annuler') {
            annulerDernierCoup();
        }
    }
}

// === Fonctions d'affichage ===
function afficherCase($i, $j, $taille)
{
    $classes = 'case';
    $rougePlacee = isset($_SESSION['vehicule']['rouge']);
    $contenu = '';

    if ($i === 2 && $j >= 0 && $j <= 2 && !$rougePlacee) {
        $classes .= ' surbrillance-rouge';
    }

    if (isset($_SESSION['vehicule'])) {
        foreach ($_SESSION['vehicule'] as $couleur => $vehicule) {
            $vx = $vehicule['x'];
            $vy = $vehicule['y'];
            $dir = $vehicule['dir'];
            $tailleVehicule = $vehicule['taille'];

            for ($k = 0; $k < $tailleVehicule; $k++) {
                $tx = ($dir === 'H') ? $vx + $k : $vx;
                $ty = ($dir === 'V') ? $vy + $k : $vy;
                if ($dir === 'H') {
                    $rotationClass =  "rotate-90";
                } else{
                    $rotationClass =  "rotate-180";
                }

                if ($tx === $j && $ty === $i) {
                    // Déterminer la position (avant, milieu, arriere)
                    if ($tailleVehicule === 2) {
                        $position = ($k === 0) ? 'avant' : 'arriere';
                        $image = "../../image/{$couleur}_{$position}.png";
                        $imgClass = "{$rotationClass}_{$position}";
                    } else {
                        $position = ($k === 0) ? 'avant' : (($k === 1) ? 'milieu' : 'arriere');
                        $image = "../../image/c_{$couleur}_{$position}.png";
                        $imgClass = "{$rotationClass}_{$position}";
                    }

                    $contenu = '<img src="' . $image . '" class="' . $imgClass . '">';
                    break 2;
                }
            }
        }
    }

    echo '<div class="' . $classes . '" onclick="caseCliquee(' . $i . ',' . $j . ')">' . $contenu . '</div>';
}

function afficherGrille($taille = 6)
{
    echo '<style>
        .grille { display: grid; grid-template-columns: repeat(' . $taille . ', 100px); grid-template-rows: repeat(' . $taille . ', 100px); gap: 2px; }
        .case {
            width: 100px; height: 100px;
            background-image: url("/projet/image/background.png"); background-size: cover;
            display: flex; align-items: center; justify-content: center; font-size: 2em;
            cursor: pointer;
        }
        .surbrillance-rouge { background-color: rgba(255, 0, 0, 0.4); background-blend-mode: multiply; }
        .reset-btn, .annuler-btn { margin: 10px 10px 20px 0; font-size: 1em; padding: 8px 16px; }
    </style>';

       echo '<div class="grille">';
    for ($i = 0; $i < $taille; $i++) {
        for ($j = 0; $j < $taille; $j++) {
            afficherCase($i, $j, $taille);
        }
    }
    echo '</div>';

    echo '<form id="formAjout" method="POST" style="display:none;">
        <input type="hidden" name="type" id="type">
        <input type="hidden" name="direction" id="direction">
        <input type="hidden" name="couleur" id="couleur">
        <input type="hidden" name="x" id="x">
        <input type="hidden" name="y" id="y">
        <input type="hidden" name="action" value="ajouter">
    </form>';

    echo '<script>
        function caseCliquee(ligne, colonne) {
            const voitureRougePlacee = ' . (isset($_SESSION['vehicule']['rouge']) ? 'true' : 'false') . ';
            if (!voitureRougePlacee && ligne === 2 && colonne >= 0 && colonne <= 2) {
                document.getElementById("type").value = "voiture";
                document.getElementById("direction").value = "horizontal";
                document.getElementById("couleur").value = "rouge";
                document.getElementById("x").value = colonne;
                document.getElementById("y").value = ligne;
                document.getElementById("formAjout").submit();
                return;
            }
            let type = prompt("Quel type de véhicule ? (voiture/camion)");
            let direction = prompt("Quelle direction ? (horizontal/vertical)");
            let couleur = prompt("Quelle couleur ? (noir/bleu/vert/jaune)");
            let action = prompt("Quelle action ? (ajouter/annuler)");
            if (action !== "ajouter") return;
            document.getElementById("type").value = type;
            document.getElementById("direction").value = direction;
            document.getElementById("couleur").value = couleur;
            document.getElementById("x").value = colonne;
            document.getElementById("y").value = ligne;
            document.getElementById("formAjout").submit();
        }
    </script>';
}
function afficherBouton()
{
    echo '<form method="POST" style="display:inline;">
            <input type="hidden" name="action" value="annuler">
            <button id="buttonsolver" type="submit">Annuler le dernier coup</button>
          </form>';
    echo '<br><a href="?reset=1"><button id="buttonsolver">Réinitialiser la grille</button></a>';

 
}


// === Lancement de la page ===
function run()
{
    gererFormulaires();
    afficherGrille();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RUSH HOUR</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
<header> 
    <a class="bouton" href="../../index.php">Back to home</a>
    <h1>RUSH<br>HOUR</h1>
    <a class="bouton" href="../../logout.php">Disconnect</a>
</header>
<h2 class='progessiontexte'>Create your level</h2>
<div class="grille_jeu">
    <div class="grille_bouton">
        <div class="grille">
            <?php
            run();
            ?>
        </div>
        <form method="post" class="CreationMap">
            <?php
            afficherBouton();
            ?>
        </form>
    </div>
</div>
</body>
</html>