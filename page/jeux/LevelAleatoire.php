<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);




function generateRandomLevel() {
    // Création d'une grille vide 6x6 pour la détection de collision
    $grid = array_fill(0, 6, array_fill(0, 6, 0));
    
    // Dictionnaire pour stocker les positions des véhicules
    $vehicles = [];
    
    // Ajout de la voiture rouge (obligatoire)
    $redRow = 2; // 3ème ligne (index 2)
    $redCol = rand(0, 3); // Position aléatoire qui permet à la voiture de tenir sur la grille
    
    // Placer la voiture rouge sur la grille
    $grid[$redRow][$redCol] = 1;
    $grid[$redRow][$redCol + 1] = 1;
    
    // Ajouter la voiture rouge au dictionnaire
    $vehicles[1] = [
        'id' => 1,
        'couleur' => 'rouge',
        'taille' => 2,
        'direction' => 'horizontal',
        'ligne' => $redRow,
        'colonne' => $redCol
    ];
    
    // Déterminer combien de véhicules supplémentaires ajouter (maximum 10)
    $additionalVehicles = rand(0, 10);
    $vehicleId = 2;
    
    // Placer les véhicules supplémentaires
    for ($i = 0; $i < $additionalVehicles; $i++) {
        // Taille du véhicule: voiture (2) ou camion (3)
        $taille = (rand(0, 1) == 0) ? 2 : 3;
        
        // Direction: horizontale ou verticale
        $direction = (rand(0, 1) == 0) ? 'horizontal' : 'vertical';
        
        // Couleur aléatoire
        $colors = ['bleu', 'vert', 'jaune', 'violet', 'orange', 'rose', 'marron', 'gris', 'cyan', 'noir'];
        $couleur = $colors[rand(0, count($colors) - 1)];
        
        // Essayer de placer le véhicule (maximum 50 tentatives)
        $attempts = 0;
        $placed = false;
        
        while (!$placed && $attempts < 50) {
            $attempts++;
            
            $ligne = rand(0, 5);
            $colonne = rand(0, 5);
            
            // Vérifier si le véhicule rentre sur la grille
            if (($direction == 'horizontal' && $colonne + $taille > 6) ||
                ($direction == 'vertical' && $ligne + $taille > 6)) {
                continue;
            }
            
            // Vérifier si l'espace est libre
            $free = true;
            for ($j = 0; $j < $taille; $j++) {
                if ($direction == 'horizontal') {
                    if ($grid[$ligne][$colonne + $j] != 0) {
                        $free = false;
                        break;
                    }
                } else {
                    if ($grid[$ligne + $j][$colonne] != 0) {
                        $free = false;
                        break;
                    }
                }
            }
            
            // Si l'espace est libre, placer le véhicule
            if ($free) {
                for ($j = 0; $j < $taille; $j++) {
                    if ($direction == 'horizontal') {
                        $grid[$ligne][$colonne + $j] = $vehicleId;
                    } else {
                        $grid[$ligne + $j][$colonne] = $vehicleId;
                    }
                }
                
                $vehicles[$vehicleId] = [
                    'id' => $vehicleId,
                    'couleur' => $couleur,
                    'taille' => $taille,
                    'direction' => $direction,
                    'ligne' => $ligne,
                    'colonne' => $colonne
                ];
                
                $vehicleId++;
                $placed = true;
            }
        }
    }
    
    return $vehicles;
}

function convertVehiclesFormat($vehicles) {
    $result = [];
    foreach ($vehicles as $veh) {
        $dir = ($veh['direction'] === 'horizontal') ? 'H' : 'V';
        $result[$veh['couleur']] = [
            'x' => $veh['ligne'],
            'y' => $veh['colonne'],
            'dir' => $dir,
            'taille' => $veh['taille']
        ];
    }
    return $result;
}

function writeVehiclesToFile($vehicles, $filename = "../../new_solver_vinfini/x64/Debug/text.txt") {
    // Écrit les données des véhicules au format demandé
    $contenu = '';
    foreach ($vehicles as $couleur => $vehicule) {
        $contenu .= "[{$couleur},{$vehicule['x']},{$vehicule['y']},{$vehicule['dir']},{$vehicule['taille']}]\n";
    }
    
    // Écrit les nouvelles données dans le fichier
    file_put_contents($filename, $contenu);
}

function validateAndGenerateLevel() {
    // Lancer le solver pour vérifier si le niveau a une solution
    $solverPath = "../../new_solver_vinfini/x64/Debug/Projet1.exe";
    $resultFile = "../../new_solver_vinfini/x64/Debug/result.txt";
    
    $maxRetries = 10;
    $retryCount = 0;
    
    do {
        // Génération d'un niveau aléatoire
        $randomLevel = generateRandomLevel();
        $formattedLevel = convertVehiclesFormat($randomLevel);
        writeVehiclesToFile($formattedLevel);

        // Exécuter le solver
        $output = [];
        exec($solverPath, $output, $returnVar);

        // Lire le résultat
        if (file_exists($resultFile)) {
            $result = trim(file_get_contents($resultFile));
            
            if ($result === "A") {
                if ($retryCount < $maxRetries - 1) {
                    echo "<p style='color: orange;'>Le niveau généré n'a pas de solution. Tentative " . ($retryCount + 1) . "/$maxRetries...</p>";
                }
                $retryCount++;
            } else {
                if ($retryCount > 0) {
                    echo "<p style='color: green;'>Niveau valide trouvé après $retryCount tentative(s)!</p>";
                } else {
                    echo "<p style='color: green;'>Le niveau généré a une solution!</p>";
                }
                echo "<p>Solution: $result</p>";
                echo '<pre>';
                print_r($formattedLevel);
                echo '</pre>';
                return $formattedLevel;
            }
        } else {
            echo "<p style='color: red;'>Erreur: Le fichier result.txt n'a pas été créé.</p>";
            $retryCount++;
        }
    } while ($retryCount < $maxRetries);
    
    echo "<p style='color: red;'>Impossible de générer un niveau avec solution après $maxRetries tentatives.</p>";
    return null;
}

// Appeler la fonction
$finalLevel = validateAndGenerateLevel();


