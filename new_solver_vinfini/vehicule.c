#include <stdlib.h>
#include <string.h>
#include "vehicule.h"

Vehicule* create_vehicule(const char* type_v, char direction, int coord_x, int coord_y, char nom) {
    Vehicule* v = malloc(sizeof(Vehicule));
	if (v == NULL) {
		return NULL;
	}
    v->type_v = _strdup(type_v);
    v->direction = direction;
    v->coord_x = coord_x;
    v->coord_y = coord_y;
    v->nom = nom;
    v->taille = (strcmp(type_v, "Camion") == 0) ? 3 : 2;
    return v;
}

void free_vehicule(Vehicule* v) {
    free(v->type_v);
    free(v);
}
