#pragma once
#include <stdbool.h>


typedef struct {
    char* type_v;
    int taille;
    char direction; // 'H' ou 'V'
    int coord_x;
    int coord_y;
    char nom;
} Vehicule;

Vehicule* create_vehicule(const char* type_v, char direction, int coord_x, int coord_y, char nom);

void free_vehicule(Vehicule* v);