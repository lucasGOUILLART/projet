#pragma once
#include "game.h"

typedef struct Node {
    Game* game;
    char* chemin;
    struct Node* next;
    struct Node* parent; // Ajout du parent pour reconstruire le chemin
    struct Node* actuel;
} Node;

typedef struct {
    Node* front;
    Node* rear;
} File;

File* create_file();
int enfile(File* f, Game* g, const char* chemin, Node* parent);
Node* defile(File* f);
int est_vide(File* f);
void free_file(File* f);
