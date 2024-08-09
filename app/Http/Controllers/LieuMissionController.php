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
        $departements = Departement::all();
        $villes = Ville::all();

        return view('lieu_mission.add', compact('departements','villes'));
    }

    public function consulter(Request $request, $id)
    {
        $lieumission = Lieumission::find($id);

        if (!$lieumission) {
            return redirect()->route('lieux-mission')
                            ->with('error', 'Lieu mission non trouvé.');
        }
        return view('lieu_mission.update', compact('lieumission'));
    }


    public function store(Request $request)
    {
        // dd($request->all());

        $validated = $request->validate([
            'nomDepartement' => ['required', 'max:255'],
            'nomVille' => ['nullable', 'max:255'],
            'distance' => ['boolean'],
        ]);

        $lieumission = new Lieumission();
        $lieumission->nomDepartement = $request->nomDepartement;
        $lieumission->nomVille = $request->nomVille;
        $lieumission->distance = $request->distance;

        $lieumission->save();

        return redirect()->route('lieux-mission')
            ->with('success', 'Lieu mission créé avec succès.');
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());

        $validated = $request->validate([
           'nomDepartement' => ['required', 'max:255'],
            'nomVille' => ['nullable', 'max:255'],
            'distance' => ['boolean'],
        ]);

        $lieumission = Lieumission::find($id);

        if (!$lieumission) {
            return redirect()->route('lieux-mission')
                ->with('error', 'Lieu mission non trouvé.');
        }

        $lieumission->nomDepartement = $request->nomDepartement;
        $lieumission->nomVille = $request->nomVille;
        $lieumission->distance = $request->distance;

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
