<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Lieumission;
use App\Models\Ville;
use Illuminate\Http\Request;

class LieuMissionController extends Controller
{
    public function index()
    {
        $lieumissions = Lieumission::all();
        $departements = Departement::all();
        $villes = Ville::all();

        return view('lieu_mission.index', compact('departements', 'villes', 'lieumissions'));
    }

    public function show()
    {
        $villes = Ville::all();
        $departements = Departement::all();

        return view('lieu_mission.add', compact('departements','villes'));
    }


    public function getVilles($departement)
    {
        // Récupérer les villes du département
        $villes = Ville::where('departement_id', $departement)->pluck('nomVille', 'id');

        // Retourner les villes au format JSON
        return response()->json($villes);
    }


    public function consulter(Request $request, $id)
    {
        $departements = Departement::all();

        $lieumission = Lieumission::find($id);

        if (!$lieumission) {
            return redirect()->route('lieux-mission')
                            ->with('error', 'Lieu mission non trouvé.');
        }
        return view('lieu_mission.update', compact('lieumission', 'departements'));
    }


    public function store(Request $request)
    {
        //  dd($request->all());

        $validated = $request->validate([
            'departement_id' => ['required', 'max:255'],
            'commune' => ['string', 'max:255'],
            'distance' => ['integer'],
        ]);

        $lieumission = new Lieumission();

        $lieumission->departement_id = $request->departement_id;
        $lieumission->commune = $request->commune;
        $lieumission->distance = $request->distance;
        $lieumission->nuite = $request->nuite;

        if($lieumission->nuite) {
            $lieumission->nuite = true;
        } else {
            $lieumission->nuite = false;
        }

        $lieumission->save();

        return redirect()->route('lieux-mission')
            ->with('success', 'Lieu mission créé avec succès.');
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());

        $validated = $request->validate([
            'departement_id' => ['required', 'max:255'],
            'commune' => ['string', 'max:255'],
            'distance' => ['integer'],
        ]);

        $lieumission = Lieumission::find($id);

        if (!$lieumission) {
            return redirect()->route('lieux-mission')
                ->with('error', 'Lieu mission non trouvé.');
        }

        $lieumission->departement_id = $request->departement_id;
        $lieumission->commune = $request->commune;
        $lieumission->distance = $request->distance;
        $lieumission->nuite = $request->nuite;

        $lieumission->update();


        return redirect()->route('lieux-mission')
                        ->with('success', 'Lieu mission modifié avec succès.');
    }

    public function delete($id)
    {
        $lieumission = Lieumission::find($id);
        if (!$lieumission) {
            return redirect()->route('lieux-mission')
                            ->with('error', 'Lieu mission non trouvé.');
        }

        $lieumission->delete();
        return redirect()->route('lieux-mission')
                        ->with('success', 'Lieu mission supprimé avec succès.');
    }
}
