#include <stdlib.h>
#include <string.h>
#include "file.h"

File* create_file() {
    File* f = malloc(sizeof(File));
    if (f == NULL) {
        return NULL;
    }
    f->front = f->rear = NULL;
    return f;
}

int enfile(File* f, Game* g, const char* chemin, Node* parent) {
    Node* n = malloc(sizeof(Node));
	if (n == NULL) {
		return NULL;
	}
    n->game = g;
    n->chemin = _strdup(chemin);
    n->next = NULL;
    n->parent = parent; // Initialisation du parent
    if (f->rear)
        f->rear->next = n;
    else
        f->front = n;
    f->rear = n;
	return 1;
}

Node* defile(File* f) {
    if (!f->front) return NULL;
    Node* n = f->front;
    f->front = f->front->next;
    if (!f->front) f->rear = NULL;
    return n;
}

int est_vide(File* f) {
    return f->front == NULL;
}

void free_file(File* f) {
    while (!est_vide(f)) {
        Node* n = defile(f);
        free(n->chemin);
        free_game(n->game);
        free(n);
    }
    free(f);
}