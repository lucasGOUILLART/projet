<?php
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
                        $imagePath = "image/c_{$couleurTrouvee}_{$suffix}.png";
                    }else{
                        if ($pos === 0) {
                            $suffix = "avant";
                        } elseif ($pos === $taille - 1) {
                            $suffix = "arriere";
                        }
                        $imagePath = "image/{$couleurTrouvee}_{$suffix}.png";
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

?>