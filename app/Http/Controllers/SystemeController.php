<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Systeme;

class SystemeController extends Controller
{
    // Méthode pour afficher le formulaire
    public function index()
    {
        $systemes = Systeme::all(); // Récupérer les données si elles existent déjà
        return view('mission.systeme', compact('systemes'));
    }

    // Méthode pour enregistrer ou mettre à jour les informations
    public function store(Request $request)
    {
        $validated = $request->validate([
            'consommation_vehicule_km' => 'required|numeric',
            'prix_essence_litre' => 'required|numeric',
        ]);

        // Mettre à jour ou créer l'entrée dans la table systeme
        Systeme::updateOrCreate(
            ['id' => 1],
            [
                'consommation_vehicule_km' => $validated['consommation_vehicule_km'],
                'prix_essence_litre' => $validated['prix_essence_litre'],
            ]
        );

        return redirect()->route('mission.systemeshow')->with('success', 'Les informations ont été enregistrées avec succès.');
    }
    public function show()
    {
        $systeme = Systeme::first(); 
        return view('mission.systemeshow', compact('systeme')); 
    }
}
