#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include "game.h"

Game* create_game(int nb_col) {
    Game* g = malloc(sizeof(Game));
    g->taille = nb_col;
    g->nb_vehicules = 0;
    for (int i = 0; i < nb_col; i++)
        for (int j = 0; j < nb_col; j++)
            g->plateau[i][j] = ' ';
    return g;
}

void free_game(Game* g) {
    for (int i = 0; i < g->nb_vehicules; i++)
        free_vehicule(g->vehicules[i]);
    free(g);
}

int pose_vehicule(Game* g, Vehicule* v) {
    if (v->direction == 'H') {
        if (v->coord_x + v->taille > g->taille) return 0;
        for (int i = 0; i < v->taille; i++)
            if (g->plateau[v->coord_y][v->coord_x + i] != ' ') return 0;
        for (int i = 0; i < v->taille; i++)
            g->plateau[v->coord_y][v->coord_x + i] = v->nom;
    }
    else {
        if (v->coord_y + v->taille > g->taille) return 0;
        for (int i = 0; i < v->taille; i++)
            if (g->plateau[v->coord_y + i][v->coord_x] != ' ') return 0;
        for (int i = 0; i < v->taille; i++)
            g->plateau[v->coord_y + i][v->coord_x] = v->nom;
    }
    g->vehicules[g->nb_vehicules++] = v;
    return 1;
}

int est_fini(Game* g) {
    return g->plateau[2][g->taille - 1] == 'R';
}

void afficher_game(Game* g) {
    for (int i = 0; i < g->taille; i++) {
        printf("|");
        for (int j = 0; j < g->taille; j++)
            printf(" %c |", g->plateau[i][j]);
        printf("\n");
    }
}

Game** mouvements_possibles(Game* g, Vehicule* v, int* nb_moves) {
    Game** solutions = malloc(4 * sizeof(Game*)); // max 4 mouvements
    *nb_moves = 0;
    int x = v->coord_x;
    int y = v->coord_y;
    int t = v->taille;
    char d = v->direction;
    char couleur = v->nom;
    int numero = 0;
    switch (couleur) {
    case 'R': numero = 1; break;  // rouge
    case 'J': numero = 2; break;  // jaune
    case 'B': numero = 3; break;  // bleu
    case 'V': numero = 4; break;  // vert
    case 'O': numero = 5; break;  // orange
    case 'M': numero = 6; break;  // magenta
    case 'C': numero = 7; break;  // cyan
    case 'G': numero = 8; break;  // gris
    case 'A': numero = 9; break;  // argent
    case 'N': numero = 10; break; // noir
    case 'D': numero = 11; break; // doré
    case 'L': numero = 12; break; // lavende
    case 'E': numero = 13; break; // emeraude
    case 'S': numero = 14; break; // savir
    }


    if (d == 'H') {
        // Déplacement à gauche
        if (x > 0 && g->plateau[y][x - 1] == ' ') {
            Game* new_game = create_game(g->taille);
            for (int i = 0; i < g->nb_vehicules; i++) {
                Vehicule* src = g->vehicules[i];
                Vehicule* clone = create_vehicule(src->type_v, src->direction, src->coord_x, src->coord_y, src->nom);
                if (src->nom == v->nom) clone->coord_x--;
                pose_vehicule(new_game, clone);
            }

            new_game->last_move_coup = 1;
            new_game->last_move_voiture = numero;
            new_game->last_move_taille = t;


            solutions[(*nb_moves)++] = new_game;
        }
        // Déplacement à droite
        if ((x + t < g->taille) && g->plateau[y][x + t] == ' ') {
            Game* new_game = create_game(g->taille);
            for (int i = 0; i < g->nb_vehicules; i++) {
                Vehicule* src = g->vehicules[i];
                Vehicule* clone = create_vehicule(src->type_v, src->direction, src->coord_x, src->coord_y, src->nom);
                if (src->nom == v->nom) clone->coord_x++;
                pose_vehicule(new_game, clone);
            }
            new_game->last_move_coup = 2;
            new_game->last_move_voiture = numero;
            new_game->last_move_taille = t;

            solutions[(*nb_moves)++] = new_game;
        }
    }
    else if (d == 'V') {
        // Déplacement vers le haut
        if (y > 0 && g->plateau[y - 1][x] == ' ') {
            Game* new_game = create_game(g->taille);
            for (int i = 0; i < g->nb_vehicules; i++) {
                Vehicule* src = g->vehicules[i];
                Vehicule* clone = create_vehicule(src->type_v, src->direction, src->coord_x, src->coord_y, src->nom);
                if (src->nom == v->nom) clone->coord_y--;
                pose_vehicule(new_game, clone);
            }
            new_game->last_move_coup = 3;
            new_game->last_move_voiture = numero;
            new_game->last_move_taille = t;

            solutions[(*nb_moves)++] = new_game;
        }
        // Déplacement vers le bas
        if ((y + t < g->taille) && g->plateau[y + t][x] == ' ') {
            Game* new_game = create_game(g->taille);
            for (int i = 0; i < g->nb_vehicules; i++) {
                Vehicule* src = g->vehicules[i];
                Vehicule* clone = create_vehicule(src->type_v, src->direction, src->coord_x, src->coord_y, src->nom);
                if (src->nom == v->nom) clone->coord_y++;
                pose_vehicule(new_game, clone);
            }
            new_game->last_move_coup = 4;
            new_game->last_move_voiture = numero;
            new_game->last_move_taille = t;

            solutions[(*nb_moves)++] = new_game;
        }
    }

    // Affichage debug
    /*for (int i = 0; i < *nb_moves; i++) {
        printf("Solution %d:\n", i + 1);
        afficher_game(solutions[i]);
    }*/
    return solutions;
}


