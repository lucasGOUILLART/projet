<?php
include_once "vehicule.php";
include_once "grille.php";

//creation du niveau 1, avec 2 voiture et 1 camion et la voiture rouge
// on va donc definir les vehicules puis les placer sur la grille
// puis on va afficher la grille
//on cree la grille
$grille = grille();
//definition des vehicules
$voiture1 = new Vehicule(0, 3, "V", "V", "B");
$voiture2 = new Vehicule(4, 4, "H", "V", "B");
$camion = new Vehicule(0, 4, "V", "C", "C");
// la voiture rouge apparait au coordonnées de l'entree du niveau
//on definit l'entree et la sortie du niveau avec les classes Entree et Sortie
//voiture rouge par rapport a l'entree
// On place la voiture rouge à la sortie pour tester la détection
$voitureRouge = new Vehicule(2, 4, "H", "V", "R"); // colonne 4 si la voiture fait 2 cases de long


//placement des vehicules sur la grille
$grille = placerVehicule($grille, $voiture1);
$grille = placerVehicule($grille, $voiture2);
$grille = placerVehicule($grille, $camion);
$grille = placerVehicule($grille, $voitureRouge);

// Vérification si la voiture rouge est à la sortie après placement
include_once "deplacement.php";
voitureRougeEstASortie($grille);

afficherGrille($grille);
?>