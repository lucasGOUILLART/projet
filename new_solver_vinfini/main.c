#include <stdio.h>
#include "game.h"
#include "vehicule.h"
#include "solver.h"

char* lire_fichier_texte(const char* nom_fichier) {
    static char buffer[8192];  
    FILE* fichier = fopen(nom_fichier, "r");

    if (!fichier) {
        perror("Erreur d'ouverture du fichier");
        return NULL;
    }

    size_t lu = fread(buffer, 1, 8192 - 1, fichier);
    buffer[lu] = '\0';  

    fclose(fichier);
    return buffer;
}

void parse_vehicules(const char* input, Vehicule* liste[MAX_VEHICULES], int* nb_vehicules) {
    *nb_vehicules = 0;
    const char* ptr = input;

    while (*ptr && *nb_vehicules < MAX_VEHICULES) {
        if (*ptr == '[') {
            ptr++; // skip '['

            // Lire la couleur
            char couleur[20] = { 0 };
            int i = 0;
            while (*ptr != ',' && *ptr && i < 19) {
                couleur[i++] = *ptr++;
            }
            couleur[i] = '\0';
            if (*ptr == ',') ptr++; 

            // Lire x
            int x = 0;
            while (isdigit(*ptr)) {
                x = x * 10 + (*ptr - '0');
                ptr++;
            }
            if (*ptr == ',') ptr++;

            // Lire y
            int y = 0;
            while (isdigit(*ptr)) {
                y = y * 10 + (*ptr - '0');
                ptr++;
            }
            if (*ptr == ',') ptr++;

            // Lire direction
            char dir = *ptr;
            ptr++;
            if (*ptr == ',') ptr++;

            // Lire taille 
            int taille = 0;
            while (isdigit(*ptr)) {
                taille = taille * 10 + (*ptr - '0');
                ptr++;
            }

            // Attendre le caractère ']'
            while (*ptr && *ptr != ']') ptr++;
            if (*ptr == ']') ptr++;
            char lettre = couleur[0];
            if (lettre >= 'a' && lettre <= 'z') {
                lettre = lettre - ('a' - 'A');  
            }
            // Créer le véhicule
            Vehicule* v = create_vehicule(couleur, dir, y, x, lettre);//on echange x et y
            if (v) {
                liste[*nb_vehicules] = v;
                (*nb_vehicules)++;
            }
        }
        else {
            ptr++; // avance dans le texte si on n'est pas sur un véhicule
        }
    }
}

void ecrireDansFichier(const char* nomFichier, const char* texte) {
    FILE* fichier = fopen(nomFichier, "w");  // "w" ecrase le contenu du fichier
    if (fichier == NULL) {
        perror("Erreur lors de l'ouverture du fichier");
        return;
    }

    fprintf(fichier, "%s", texte);  // Écriture du texte dans le fichier
    fclose(fichier);  // Fermeture du fichier
}

int main() {
    Game* g = create_game(6);
    Vehicule* v1 = NULL;
	Vehicule* v2 = NULL;
	Vehicule* v3 = NULL;
	Vehicule* v4 = NULL;
	Vehicule* v5 = NULL;
	Vehicule* v6 = NULL;
	Vehicule* v7 = NULL;
	Vehicule* v8 = NULL;
	Vehicule* v9 = NULL;
	Vehicule* v10 = NULL;
	Vehicule* v11 = NULL;
	Vehicule* v12 = NULL;
	Vehicule* v13 = NULL;
	Vehicule* v14 = NULL;


    char* contenu = lire_fichier_texte("text.txt");
    
    Vehicule* vehicules[15];
    int nb = 0;
    parse_vehicules(contenu, vehicules, &nb);
    
    
    for (int i = 0; i < nb; ++i) {
        pose_vehicule(g, vehicules[i]);
    }
    
    if (v1) pose_vehicule(g, v1);
    if (v2) pose_vehicule(g, v2);
    if (v3) pose_vehicule(g, v3);
    if (v4) pose_vehicule(g, v4);
    if (v5) pose_vehicule(g, v5);
    if (v6) pose_vehicule(g, v6);
    if (v7) pose_vehicule(g, v7);
    if (v8) pose_vehicule(g, v8);
    if (v9) pose_vehicule(g, v9);
    if (v10) pose_vehicule(g, v10);
    if (v11) pose_vehicule(g, v11);
    if (v12) pose_vehicule(g, v12);
    if (v13) pose_vehicule(g, v13);
    if (v14) pose_vehicule(g, v14);

    //afficher_game(g);
    char* res = solver(g);
    if (res != NULL) {
        ecrireDansFichier("result.txt", res);
        free(res);
    }
    else {
        ecrireDansFichier("result.txt", "Aucune solution trouvee ou erreur lors de la resolution.");
   
    }
    return 0;
}
