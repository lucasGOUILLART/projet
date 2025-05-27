#pragma once
#include "vehicule.h"

#define MAX_VEHICULES 20
#define TAILLE_MAX 6

typedef struct {
    char plateau[TAILLE_MAX][TAILLE_MAX];
    Vehicule* vehicules[MAX_VEHICULES];
    int nb_vehicules;
    int taille;
    int last_move_voiture;//Couleur de voiture qui a bougé
    int last_move_coup;//1=Gauche, 2=Droite, 3=Haut, 4=Bas
    int last_move_taille;//Taille de la voiture qui a bougé
} Game;

Game* create_game(int nb_col);
void free_game(Game* g);
int pose_vehicule(Game* g, Vehicule* v);
int est_fini(Game* g);
void afficher_game(Game* g);
Game** mouvements_possibles(Game* g, Vehicule* v, int* nb_moves);