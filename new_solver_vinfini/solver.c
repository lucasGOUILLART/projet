#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include "solver.h"
#include "file.h"
#include "game.h"

#include <stdio.h>
#include <stdlib.h>

char* concatener(const char* chaine1, const char* chaine2) {
    // Calcul de la longueur des chaenes
    size_t longueur1 = 0, longueur2 = 0;

    // Calcul manuel des longueurs
    while (chaine1[longueur1] != '\0') longueur1++;
    while (chaine2[longueur2] != '\0') longueur2++;

    // Allocation de memoire pour la chaine concatenee (+1 pour '\0')
    char* resultat = (char*)malloc((longueur1 + longueur2 + 1) * sizeof(char));
    if (resultat == NULL) {
        perror("Erreur d'allocation m�moire");
        return NULL;
    }

    // Copie manuelle de chaine1
    for (size_t i = 0; i < longueur1; i++) {
        resultat[i] = chaine1[i];
    }

    // Copie manuelle de chaine2
    for (size_t i = 0; i < longueur2; i++) {
        resultat[longueur1 + i] = chaine2[i];
    }

    // Terminaison de la chaine
    resultat[longueur1 + longueur2] = '\0';

    return resultat;
}


char* solver(Game* g) {
    File* file = create_file();
	if (file == NULL) {
		return NULL;
	}
    int check = enfile(file, g, "", NULL);
	if (check == NULL) {
		free_file(file);
		return NULL;
	}
    int cmp = 0;

    //modif
    char deja_verif[20000][6][6];
	int nbr_deja_verif = 0;



    while (!est_vide(file)) {
        Node* n = defile(file);
        Game* current = n->game;
        char* chemin = n->chemin;

        if( nbr_deja_verif < 20000){
            for (int i = 0; i < 6; i++) { //on ajoute a la liste des plateau check 
                for (int j = 0; j < 6; j++) {
                    deja_verif[nbr_deja_verif][i][j] = current->plateau[i][j];
                }
            }
            nbr_deja_verif++;}
		else {
			return NULL;
		}
        for (int vi = 0; vi < current->nb_vehicules; vi++) {
            Vehicule* v = current->vehicules[vi];
            int nb_moves;
            Game** moves = mouvements_possibles(current, v, &nb_moves);


            for (int i = 0; i < nb_moves; i++) {
                Game* config = moves[i];


                char* coup_actu = NULL;
                if (config->last_move_coup == 1) {
                    coup_actu = " a gauche,";
                }
                else if (config->last_move_coup == 2) {
                    coup_actu = " a droite,";
                }
                else if (config->last_move_coup == 3) {
                    coup_actu = " en haut,";
                }
                else if (config->last_move_coup == 4) {
                    coup_actu = " en bas,";
                }

                char* couleur = NULL;
                if (config->last_move_taille == 3) {
                    switch (config->last_move_voiture) {
                    case 1:  couleur = " Camion rouge";    break;
                    case 2:  couleur = " Camion jaune";    break;
                    case 3:  couleur = " Camion bleue";    break;
                    case 4:  couleur = " Camion verte";    break;
                    case 5:  couleur = " Camion orange";   break;
                    case 6:  couleur = " Camion magenta";  break;
                    case 7:  couleur = " Camion cyan";     break;
                    case 8:  couleur = " Camion grise";    break;
                    case 9:  couleur = " Camion argent";   break;
                    case 10: couleur = " Camion noire";    break;
                    case 11: couleur = " Camion doree";    break;
                    case 12: couleur = " Camion lavende";  break;
                    case 13: couleur = " Camion emeraude"; break;
                    case 14: couleur = " Camion saphir";   break;
                    default: couleur = " Camion inconnue"; break;
                    }
                }
                else {
                    switch (config->last_move_voiture) {
                    case 1:  couleur = " Voiture rouge";    break;
                    case 2:  couleur = " Voiture jaune";    break;
                    case 3:  couleur = " Voiture bleue";    break;
                    case 4:  couleur = " Voiture verte";    break;
                    case 5:  couleur = " Voiture orange";   break;
                    case 6:  couleur = " Voiture magenta";  break;
                    case 7:  couleur = " Voiture cyan";     break;
                    case 8:  couleur = " Voiture grise";    break;
                    case 9:  couleur = " Voiture argent";   break;
                    case 10: couleur = " Voiture noire";    break;
                    case 11: couleur = " Voiture doree";    break;
                    case 12: couleur = " Voiture lavende";  break;
                    case 13: couleur = " Voiture emeraude"; break;
                    case 14: couleur = " Voiture saphir";   break;
                    default: couleur = " Voiture inconnue"; break;
                    }
                }



                char* mouvement_fait = concatener(couleur, coup_actu);


                char* new_chemin = concatener(chemin, mouvement_fait);





                if (est_fini(config)) {

                    char* chemin_solution = _strdup(n->chemin);
                    free_file(file);
                    free_game(config);
                    free(moves);
                    free_game(current);
                    free(n);

                    return chemin_solution;
                }//si on a pas deja check le chemin


                bool trouve_identique = false;

                for (int k = 0; k < nbr_deja_verif; k++) {
                    bool identique = true;
                    for (int i = 0; i < 6 && identique; i++) {
                        for (int j = 0; j < 6; j++) {
                            if (deja_verif[k][i][j] != config->plateau[i][j]) {
                                identique = false;
                                break;
                            }
                        }
                    }

                    if (identique) {
                        trouve_identique = true;
                        break; // Pas besoin de verifier les autres
                    }
                }

                if (!trouve_identique) {
                    // Aucun plateau identique trouve, donc on enfile
                    check = enfile(file, config, new_chemin, n);
					if (check == NULL) {
						free_file(file);
						free_game(config);
						free(moves);
						free(new_chemin);
						free_game(current);
						free(n);
						return NULL;
					}
                }
            }
            free(moves);
        }

        free_game(current);
        free(n);
        cmp++;
    }

    free_file(file);
    return NULL;
}