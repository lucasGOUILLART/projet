<?php
function detectVehicles($filename = "../new_solver_vinfini/x64/Debug/text.txt") {
    // Supprime le contenu existant du fichier
    file_put_contents($filename, '');
    
    // Vérifie si les données des véhicules existent dans la session
    if (isset($_SESSION['vehicules'])) {
        // Écrit les données des véhicules au format demandé
        $contenu = '';
        foreach ($_SESSION['vehicules'] as $id => $vehicule) {
            $contenu .= "[{$id},{$vehicule['x']},{$vehicule['y']},{$vehicule['dir']},{$vehicule['taille']}]\n";
        }
        
        // Écrit les nouvelles données dans le fichier
        file_put_contents($filename, $contenu);
    }
}



// Vérifie si la voiture rouge occupe la case de sortie (dernière colonne, sur n'importe quelle ligne)
function voitureRougeEstASortie($grid) {
    $rows = count($grid);
    $cols = count($grid[0]);
    $colSortie = $cols - 1; // dernière colonne
    $trouve = false;
    // Détecte le mode de jeu : singleplayer ou autre
    $levelActuel = isset($_GET['level']) ? (int)$_GET['level'] : 1;
    $nextLevel = $levelActuel + 1;
    $redirectUrl = '../../index.php';
    $redirectUrl2 = 'play_campagne.php?level=' . ($_GET['level'] + 1);
    for ($i = 0; $i < $rows; $i++) {
        if (strtoupper($grid[$i][$colSortie]) === 'R') {
            $trouve = true;
            echo '<div id="victoire-overlay"><div class="victoire-message">Congratulations! The red car has exited!<br><br><a href="' . $redirectUrl . '" class="bouton">Back to Home</a><br><br><a href="' . $redirectUrl2 . '" class="bouton">Next level</a></div></div>';
            $_SESSION['vehicules'] = getCodeMapById($_GET['level']);
            $_SESSION['actif'] = 'rouge'; // véhicule sélectionné par défaut
            $_SESSION['level'] = $_GET['level'];
            break;
        }
    }
    return $trouve;
}

?>