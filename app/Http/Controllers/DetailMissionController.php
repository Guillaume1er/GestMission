<?php

namespace App\Http\Controllers;

use App\Models\Detailmission;
use App\Models\Mission;
use App\Models\Personnel;
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

        return view('detail_mission.index', compact('mission', 'personnels'));
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
}
