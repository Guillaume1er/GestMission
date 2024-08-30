<?php

namespace App\Http\Controllers;

use App\Models\Detailmission;
use App\Models\Mission;
use App\Models\Personnel;
use App\Models\LieuMission;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class DetailMissionController extends Controller
{
    public function index($id)
    {
        $mission = Detailmission::find($id);
        $mission_id = $mission->mission_id;

        // Récupérer les personnels avec tous les détails associés au mission_id spécifié
        $personnels = Detailmission::where('mission_id', $mission_id)
            ->with('personnel')
            ->get()
            ->pluck('personnel')
            ->unique('id');

        // dd($personnels);
        $lieux_mission = LieuMission::all(); // Liste des lieux de mission
        $vehicules = Vehicule::all(); // Liste des véhicules

        return view('detail_mission.index', compact('mission', 'personnels', 'lieux_mission', 'vehicules'));
    }
    

    public function store(Request $request) {
        // dd($request->all());

        $validated = $request->validate([
            'dateTraitementMission' => ['required', 'date'],
            'dateDepart' => ['required', 'date'],
            'dateRetour' =>  ['required', 'date'],
            'nbrJour' =>  ['required', 'numeric'],
            'nbrNuit' =>  ['required', 'numeric'],
            'coutNuite' =>  ['numeric'],
            'montantNuite' =>  ['numeric'],
            'nbrRepas' =>  ['numeric'],
            'coutRepas' =>  ['numeric'],
            'montantRepas' =>  ['numeric'],
            'montantMission' =>  ['numeric'],
            'montantAvance' =>  ['numeric'],
            'montantReste' =>  ['numeric'],
            'dateSignatureOm' => ['date'],
            'refOm' => ['string'],
            'montantPaye' => ['numeric'],
            'observation' => ['string'],
            'dateDernierPayement' => ['date'],
            'payementJustifie' => ['string'],
        ]);

        $mission = new Mission();
            $mission->dateTraitementMission = $request->dateTraitementMission;
            $mission->dateDepart = $request->dateDepart;
            $mission->dateRetour = $request->dateRetour;
            $mission->nbrJour = $request->nbrJour;
            $mission->nbrNuit = $request->nbrNuit;
            $mission->coutNuite = $request->coutNuite;
            $mission->montantNuite = $request->montantNuite;
            $mission->nbrRepas = $request->nbrRepas;
            $mission->coutRepas = $request->coutRepas;
            $mission->montantRepas = $request->montantRepas;
            $mission->montantMission = $request->montantMission;
            $mission->montantAvance = $request->montantAvance;
            $mission->montantReste = $request->montantReste;
            $mission->dateSignatureOm = $request->dateSignatureOm;
            $mission->refOm = $request->refOm;
            $mission->montantPaye = $request->montantPaye;
            $mission->observation = $request->observation;
            $mission->dateDernierPayement = $request->dateDernierPayement;
            $mission->payementJustifie = $request->payementJustifie;

            $mission->save();

            return redirect()->route('detail_mission.index')->with('success', 'Mission validée avec succès.');
                         
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'dateDepart' => ['required', 'date'],
            'dateRetour' => ['required', 'date'],
            'lieuMission_id' => ['nullable', 'exists:lieumissions,id'],
            'moyenDeDeplacement' => ['nullable', 'string'],
            'vehicule_id' => ['nullable', 'exists:vehicules,id'],
            'refOm' => ['nullable', 'string'],
            'dateTraitementMission' => ['nullable', 'date'],
            'nbrJour' => ['nullable', 'numeric'],
            'nbrNuit' => ['nullable', 'numeric'],
            'coutNuite' => ['nullable', 'numeric'],
            'montantNuite' => ['nullable', 'numeric'],
            'nbrRepas' => ['nullable', 'numeric'],
            'coutRepas' => ['nullable', 'numeric'],
            'montantRepas' => ['nullable', 'numeric'],
            'montantMission' => ['nullable', 'numeric'],
            'montantAvance' => ['nullable', 'numeric'],
            'montantReste' => ['nullable', 'numeric'],
            'dateSignatureOm' => ['nullable', 'date'],
            'montantPaye' => ['nullable', 'numeric'],
            'observation' => ['nullable', 'string'],
            'dateDernierPayement' => ['nullable', 'date'],
            'payementJustifie' => ['nullable', 'string'],
            'statut' => ['required', 'string'],
        ]);

        $detailMission = Detailmission::findOrFail($id);
        $detailMission->update($validated);

        return redirect()->route('detail-missions', ['id' => $detailMission->mission_id])
                         ->with('success', 'Détails de la mission mis à jour avec succès.');
    }
}