<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enseignant;
use Illuminate\Support\Facades\Hash;

class EnseignantController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:enseignants',
            'password' => 'required|string|min:8',
        ]);

        $enseignant = Enseignant::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json(['message' => 'Compte enseignant créé avec succès'], 201);
    }

    public function getProfil($id)
    {
        $enseignant = Enseignant::find($id);
        if (!$enseignant) {
            return response()->json(['message' => 'Enseignant introuvable'], 404);
        }

        return response()->json($enseignant);
    }

    public function updateProfil(Request $request, $id)
    {
        $enseignant = Enseignant::find($id);
        if (!$enseignant) {
            return response()->json(['message' => 'Enseignant introuvable'], 404);
        }

        $enseignant->update($request->only(['nom', 'prenom', 'email']));

        return response()->json(['message' => 'Profil mis à jour avec succès']);
    }

    public function createProjet(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'mots_cles' => 'nullable|string',
            'technologies' => 'nullable|string',
        ]);

        $projet = Projet::create($validated);
        $enseignant = auth()->user();
        $enseignant->projets()->attach($projet->id);

        return response()->json(['message' => 'Projet créé avec succès', 'projet' => $projet], 201);
    }

    public function getProjets()
    {
        $projets = auth()->user()->projets;
        return response()->json($projets);
    }

    public function updateProjet(Request $request, $id)
    {
        $projet = auth()->user()->projets()->find($id);
        if (!$projet) {
            return response()->json(['message' => 'Projet introuvable'], 404);
        }

        $projet->update($request->all());

        return response()->json(['message' => 'Projet mis à jour avec succès']);
    }

    public function deleteProjet($id)
    {
        $projet = auth()->user()->projets()->find($id);
        if (!$projet) {
            return response()->json(['message' => 'Projet introuvable'], 404);
        }

        $projet->delete();

        return response()->json(['message' => 'Projet supprimé avec succès']);
    }
}
