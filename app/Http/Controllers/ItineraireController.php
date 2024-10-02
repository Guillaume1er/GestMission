<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Itineraire; // N'oubliez pas d'importer le modèle Itineraire

class ItineraireController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'depart.*' => 'required|string|max:255',
            'arrive.*' => 'required|string|max:255',
            'allerRetour.*' => 'boolean',
            'distance_Km.*' => 'required|numeric|min:0',
            'distance_total_km.*' => 'required|numeric|min:0',
        ]);

        foreach ($data['depart'] as $index => $depart) {
            Itineraire::create([
                'depart' => $depart,
                'arrive' => $data['arrive'][$index],
                'aller_retour' => isset($data['allerRetour'][$index]) ? 1 : 0,
                'distance_km' => $data['distance_Km'][$index],
                'distance_total_km' => $data['distance_total_km'][$index],
                // Ajoutez d'autres champs nécessaires selon votre table 'itinéraire'
            ]);
        }
        

        return view('mission.itineraire');
    }
}
