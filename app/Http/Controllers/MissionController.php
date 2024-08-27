<?php

namespace App\Http\Controllers;

use App\Models\Exercicebudgetaire;
use App\Models\Mission;
use App\Models\Organisateur;
use App\Models\Detailmission;
use App\Models\Personnel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MissionController extends Controller
{
    public function index()
    {
        $missions = Mission::with(['exerciceBudgetaire', 'organisateur'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('mission.index', compact('missions'));
    }

    public function show()
    {
        $organisateurs = Organisateur::all();
        $exerciceBudgetaires = Exercicebudgetaire::all();
        $personnels = Personnel::with(['rang', 'indice'])->get();

        return view('mission.add', compact('organisateurs', 'exerciceBudgetaires', 'personnels'));
    }

    public function consulter(Request $request, $id)
    {
        $organisateurs = Organisateur::all();
        $exerciceBudgetaires = Exercicebudgetaire::all();
        $mission_id = Mission::find($id)->id;
        // $personnelsSelectionnes = $mission->detailMissions()->with('personnel.rang', 'personnel.indice')->get();
        // $personnelsSelect = Detailmission::where('mission_id', $mission);

        // Récupérer la mission avec les détails liés, y compris les personnels
        $mission = Mission::with('detailMission.personnel')->findOrFail($mission_id);

        // Récupérer les personnels à partir des détails de la mission
        $personnelsSelect = $mission->detailMission->map(function ($detailMission) {
            return $detailMission->personnel;
        });

        // dd($personnelsSelect);

        $personnels = Personnel::all();

        if (!$mission) {
            return redirect()->route('missions')
                ->with('error', 'Mission non trouvée.');
        }

        return view('mission.update', compact('mission', 'organisateurs', 'exerciceBudgetaires', 'personnels', 'personnelsSelect'));
    }




    public function store(Request $request)
    {
        // dd($request->all());

        $validated = $request->validate([
            'nomMission' => ['required', 'string'],
            'objetMission' => ['required', 'string'],
            'dateMission' =>  ['required', 'date'],
            'dateDebutMission' =>  ['required', 'date'],
            'dateFinMission' =>  ['required', 'date'],
            // 'imputation' => ['required', 'string'],
            // 'previsionBBudgetaire' => ['required', 'number'],
            'observationMission' =>  ['string'],
            'etatMission' =>  ['string'],
            'nbrVehicule' =>  ['numeric'],
            // 'typeMission' =>  ['required', 'string'],
            'nbrTotalNuite' =>  ['numeric'],
            'nbrTotalRepas' =>  ['numeric'],
            'montantTotalNuite' =>  ['numeric'],
            'montantTotalRepas' =>  ['numeric'],
            'montantTotalMission' =>  ['numeric'],
            'personnel_ids.*' => ['exists:personnels,id'],
            'exerciceBudgetaire_id' => ['required'],
            'organisateur_id' => ['required'],
        ]);

        // Démarrer une transaction
        DB::beginTransaction();

        try {
            $mission = new Mission();
            $mission->nomMission = $request->nomMission;
            $mission->objetMission = $request->objetMission;
            $mission->dateMission = $request->dateMission;
            $mission->dateDebutMission = $request->dateDebutMission;
            $mission->dateFinMission = $request->dateFinMission;
            // $mission->imputation = $request->imputation;
            // $mission->previsionBBudgetaire = $request->previsionBBudgetaire;
            $mission->autorisateur1 = $request->autorisateur1;
            $mission->autorisateur2 = $request->autorisateur2;
            $mission->autorisateur3 = $request->autorisateur3;
            $mission->observationMission = $request->observationMission;
            $mission->etatMission = $request->etatMission;
            $mission->nbrVehicule = $request->nbrVehicule;
            // $mission->typeMission = $request->typeMission;
            $mission->nbrTotalNuite = $request->nbrTotalNuite;
            $mission->nbrTotalRepas = $request->nbrTotalRepas;
            $mission->montantTotalNuite = $request->montantTotalNuite;
            $mission->montantTotalRepas = $request->montantTotalRepas;
            $mission->montantTotalMission = $request->montantTotalMission;
            $mission->organisateur_id = $request->organisateur_id;
            $mission->exerciceBudgetaire_id = $request->exerciceBudgetaire_id;

            $mission->save();

            // Enregistrer les personnels associés à la mission
            $personnelIds = $request->input('personnel_ids', []);

            foreach ($personnelIds as $personnelId) {
                $detailMission = new Detailmission();
                $detailMission->mission_id = $mission->id;
                $detailMission->personnel_id = $personnelId;

                $detailMission->save();
            }

            // Tout s'est bien passé, donc on valide la transaction
            DB::commit();

            return redirect()->route('missions')
                ->with('success', 'Mission créée avec succès.');
        } catch (\Exception $e) {
            // En cas d'erreur, on annule la transaction
            DB::rollBack();

            // Retourner l'erreur ou gérer comme souhaité
            return redirect()->back()->withErrors('Une erreur est survenue lors de la création de la mission. Veuillez réessayer');
        }
    }




    public function update(Request $request, $id)
    {
        // dd($request->all());

        $validated = $request->validate([
            'nomMission' => ['required', 'string'],
            'objetMission' => ['required', 'string'],
            'dateMission' =>  ['required', 'date'],
            'dateDebutMission' =>  ['required', 'date'],
            'dateFinMission' =>  ['required', 'date'],
            // 'imputation' => ['required', 'string'],
            // 'previsionBBudgetaire' => ['required', 'number'],
            'observationMission' =>  ['string'],
            'etatMission' =>  ['string'],
            'nbrVehicule' =>  ['numeric'],
            // 'typeMission' =>  ['required', 'string'],
            'nbrTotalNuite' =>  ['numeric'],
            'nbrTotalRepas' =>  ['numeric'],
            'montantTotalNuite' =>  ['numeric'],
            'montantTotalRepas' =>  ['numeric'],
            'montantTotalMission' =>  ['numeric'],
            'personnel_ids.*' => ['exists:personnels,id'],
            'exerciceBudgetaire_id' => ['required'],
            'organisateur_id' => ['required'],
        ]);

        $mission = Mission::find($id);

        if (!$mission) {
            return redirect()->route('missions')
                ->with('error', 'Mission non trouvée.');
        }
        DB::beginTransaction();

        try {
            $mission->nomMission = $request->nomMission;
            $mission->objetMission = $request->objetMission;
            $mission->dateMission = $request->dateMission;
            $mission->dateDebutMission = $request->dateDebutMission;
            $mission->dateFinMission = $request->dateFinMission;
            // $mission->imputation = $request->imputation;
            // $mission->previsionBBudgetaire = $request->previsionBBudgetaire;
            $mission->autorisateur1 = $request->autorisateur1;
            $mission->autorisateur2 = $request->autorisateur2;
            $mission->autorisateur3 = $request->autorisateur3;
            $mission->observationMission = $request->observationMission;
            $mission->etatMission = $request->etatMission;
            $mission->nbrVehicule = $request->nbrVehicule;
            // $mission->typeMission = $request->typeMission;
            $mission->nbrTotalNuite = $request->nbrTotalNuite;
            $mission->nbrTotalRepas = $request->nbrTotalRepas;
            $mission->montantTotalNuite = $request->montantTotalNuite;
            $mission->montantTotalRepas = $request->montantTotalRepas;
            $mission->montantTotalMission = $request->montantTotalMission;
            $mission->organisateur_id = $request->organisateur_id;
            $mission->exerciceBudgetaire_id = $request->exerciceBudgetaire_id;

            $mission->update();

            // Récupérer les identifiants des personnels à partir de la requête
            $personnelIds = $request->input('personnel_ids', []);

            // Supprimer les anciens personnels associés à la mission
            Detailmission::where('mission_id', $mission->id)->delete();

            // Enregistrer les nouveaux personnels associés à la mission
            foreach ($personnelIds as $personnelId) {
                $detailMission = new Detailmission();
                $detailMission->mission_id = $mission->id;
                $detailMission->personnel_id = $personnelId;
                $detailMission->save();
            }

            // Tout s'est bien passé, donc on valide la transaction
            DB::commit();

            return redirect()->route('missions')
                ->with('success', 'Mission créée avec succès.');
        } catch (\Exception $e) {
            // En cas d'erreur, on annule la transaction
            DB::rollBack();

            // Retourner l'erreur ou gérer comme souhaité
            return redirect()->back()->withErrors('Une erreur est survenue lors de la création de la mission. Veuillez réessayer');
        }

        $mission->update();


        return redirect()->route('missions')
            ->with('success', 'Mission modifiée avec succès.');
    }



    public function delete($id)
    {
        $mission = Mission::find($id);
        if (!$mission) {
            return redirect()->route('missions')
                ->with('error', 'Mission non trouvée.');
        }

        $mission->delete();
        return redirect()->route('missions')
            ->with('success', 'Mission supprimée avec succès.');
    }
}
