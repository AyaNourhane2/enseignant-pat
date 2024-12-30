<?php

use App\Http\Controllers\EnseignantController;
use Illuminate\Support\Facades\Route;

Route::prefix('enseignants')->group(function () {
    Route::post('/register', [EnseignantController::class, 'register']); // Création de compte
    Route::get('/profil/{id}', [EnseignantController::class, 'getProfil']); // Récupérer le profil
    Route::put('/profil/{id}', [EnseignantController::class, 'updateProfil']); // Mise à jour du profil
    Route::post('/projets', [EnseignantController::class, 'createProjet']); // Créer un projet
    Route::get('/projets', [EnseignantController::class, 'getProjets']); // Voir tous les projets
    Route::put('/projets/{id}', [EnseignantController::class, 'updateProjet']); // Modifier un projet
    Route::delete('/projets/{id}', [EnseignantController::class, 'deleteProjet']); // Supprimer un projet
});
