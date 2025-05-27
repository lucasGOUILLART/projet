<?php
function deplacerVehicule($vehicule, $action, $grille) {
    $dir = $vehicule['dir'];
    $taille = $vehicule['taille'];
    $x = $vehicule['x'];
    $y = $vehicule['y'];
    
    switch ($action) {
        case 'gauche':
            if ($dir === 'H' && $y > 0) {
                $newY = $y - 1;
                if ($grille[$x][$newY] === ".") {
                    $vehicule['y'] = $newY;
                }
            }
            break;
        case 'droite':
            if ($dir === 'H' && ($y + $taille) < 6) {
                $newY = $y + $taille;
                if ($grille[$x][$newY] === ".") {
                    $vehicule['y']++;
                }
            }
            break;
        case 'haut':
            if ($dir === 'V' && $x > 0) {
                $newX = $x - 1;
                if ($grille[$newX][$y] === ".") {
                    $vehicule['x'] = $newX;
                }
            }
            break;
        case 'bas':
            if ($dir === 'V' && ($x + $taille) < 6) {
                $newX = $x + $taille;
                if ($grille[$newX][$y] === ".") {
                    $vehicule['x']++;
                }
            }
            break;
    }
    
    return $vehicule;
}

// Fonction pour obtenir le dictionnaire des véhicules par défaut
function obtenirDictionnaireVehicules() {
    return [
        'rouge' => ['x' => 2, 'y' => 0, 'dir' => 'H', 'taille' => 2],
        'jaune'  => ['x' => 0, 'y' => 0, 'dir' => 'V', 'taille' => 2],
        'bleu' => ['x' => 0, 'y' => 1, 'dir' => 'H', 'taille' => 2],
        'vert' => ['x' => 0, 'y' => 3, 'dir' => 'H', 'taille' => 2],
        'orange' => ['x' => 0, 'y' => 5, 'dir' => 'V', 'taille' => 2],
        'magenta' => ['x' => 1, 'y' => 3, 'dir' => 'V', 'taille' => 3],
        'cyan' => ['x' => 3, 'y' => 1, 'dir' => 'H', 'taille' => 2],
        'gris' => ['x' =>3, 'y' => 4, 'dir' => 'H', 'taille' => 2],
        'argent' => ['x' => 4, 'y' => 0, 'dir' => 'H', 'taille' => 2],
        'noir' => ['x' => 4, 'y' => 2, 'dir' => 'H', 'taille' => 2],
        'dore' => ['x' => 4, 'y' => 4, 'dir' => 'V', 'taille' => 2]
    ];
}

// Fonction pour gérer le changement de véhicule actif
function gererSelectionVehicule() {
    if (isset($_POST['vehicule'])) {
        $_SESSION['actif'] = $_POST['vehicule'];
    }
}

// Fonction pour traiter un déplacement
function traiterDeplacement($vehicules, $action) {
    $vehiculeActif = $_SESSION['actif'];
    $grille = genererGrille($vehicules);
    
    if (isset($vehicules[$vehiculeActif])) {
        $vehicules[$vehiculeActif] = deplacerVehicule(
            $vehicules[$vehiculeActif],
            $action,
            $grille
        );
    }
    
    return $vehicules;
}

?>