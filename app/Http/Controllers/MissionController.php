<?php

namespace App\Http\Controllers;

use App\Models\Exercicebudgetaire;
use App\Models\Mission;
use App\Models\Organisateur;
use App\Models\Detailmission;
use App\Models\Lieumission;
use App\Models\Personnel;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
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


    public function detailMission($id)
    {

        $detail_mission_id = Detailmission::where('mission_id', $id)->first()->id;

        // dd($detail_mission_id);

        return view('detail_mission.index', compact('detail_mission_id'));
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
        // DB::beginTransaction();

        // try {
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
        // DB::commit();

        return redirect()->route('missions')
            ->with('success', 'Mission créée avec succès.');
        // } catch (\Exception $e) {
        //     DB::rollBack();
        // }
        return redirect()->back()->withErrors('Une erreur est survenue lors de la création de la mission. Veuillez réessayer');
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


    public function validation($id)
    {
        // dd($id);
        $personnels = Personnel::all();

        $lieux_mission = Lieumission::all();

        // Récupérer la mission avec les détails liés, y compris les personnels
        $mission = Mission::with('detailMission.personnel')->findOrFail($id);

        // Récupérer les personnels à partir des détails de la mission
        $personnelsSelect = $mission->detailMission->map(function ($detailMission) {
            return $detailMission->personnel;
        });

        // Trouver le détail de la mission correspondant au personnel
        // $detailMission_personnel = Detailmission::where('mission_id', $id)->get();
        $detailMission_personnel = $mission->detailMission->map(function ($detailMission) {
            return $detailMission;
        });


        // dd($detailMission_personnel);

        return view('mission.validation', compact('personnels', 'personnelsSelect', 'mission', 'lieux_mission', 'detailMission_personnel'));
    }


    public function validationStore(Request $request, $id)
    {
        // dd($request->all());

        $mission = Mission::find($id);

        foreach ($request->personnel_ids as $personnelId) {
            $detailMission = Detailmission::where('mission_id', $mission->id)
                ->where('personnel_id', $personnelId)
                ->first();

            if ($detailMission) {
                if (isset($request->dateDepart[$personnelId])) {
                    $detailMission->dateDepart = $request->dateDepart[$personnelId];
                }
                if (isset($request->dateRetour[$personnelId])) {
                    $detailMission->dateRetour = $request->dateRetour[$personnelId];
                }
                if (isset($request->lieuMission_id[$personnelId])) {
                    $detailMission->lieuMission_id = $request->lieuMission_id[$personnelId];
                }
                $detailMission->save();
            }
        }


        return redirect()->route('missions', $id)->with('success', 'Mission validée avec succès.');
    }


    public function showValidationForm($id)
    {
        $lieux_mission  = Lieumission::all();

        $detailMission = Personnel::find($id);
        // dd($detailMission);


        $vehicules = Vehicule::all();

        return view('mission.detail', compact('detailMission', 'vehicules', 'lieux_mission'));
    }


    // Méthode pour valider la mission et enregistrer les informations
    public function validateMission(Request $request, $id)
    {
        // dd($request->all());

        $validatedData = $request->validate([
            'refOm' => 'required|string',
            'dateDepart' => 'required|date',
            'dateRetour' => 'required|date',
            'moyenDeDeplacement' => 'required|string',
            'vehicule_id' => 'nullable|exists:vehicules,id',
            'lieuMission_id' => 'required',
        ]);

        $detailMission = Detailmission::where('personnel_id', $id)->firstOrFail();
        // Récupérer l'ID de la mission
        $mission_id = $detailMission->mission_id;


        $detailMission->refOm = $request->refOm;
        $detailMission->dateDepart = $request->dateDepart;
        $detailMission->dateRetour = $request->dateRetour;
        $detailMission->moyenDeDeplacement = $request->moyenDeDeplacement;
        $detailMission->vehicule_id = $request->vehicule_id;
        $detailMission->lieuMission_id = $request->lieuMission_id;
        $detailMission->statut = $request->statut;

        // Calculer le nombre de jours entre dateRetour et dateDepart
        $dateDepart = \Carbon\Carbon::parse($request->dateDepart);
        $dateRetour = \Carbon\Carbon::parse($request->dateRetour);
        $detailMission->nbrJour = $dateRetour->diffInDays($dateDepart);

        $detailMission->nbrNuit = $detailMission->nbrJour - 1;

        $detailMission->coutNuite = $detailMission->personnel->indice->montantNuite;

        $detailMission->montantNuite =  $detailMission->coutNuite * $detailMission->nbrNuit;

        $detailMission->nbrRepas = $detailMission->nbrJour - 1;

        $detailMission->coutRepas = $detailMission->personnel->indice->montantRepas;

        $detailMission->montantRepas = $detailMission->coutRepas * $detailMission->nbrRepas;

        $detailMission->montantMission = $detailMission->montantNuite + $detailMission->montantRepas;

        // $detailMission->montantAvance =  $detailMission->montantMission - $detailMission->montantAvance;

        $detailMission->montantReste = $detailMission->montantMission - $detailMission->montantAvance;

        //  dd($detailMission->personnel->indice->montantNuite);

        $detailMission->save();

        return redirect()->route('validation-mission', $mission_id)->with('success', 'Personnel validé avec succès.');
    }
    public function showValidatedDetails($id)
    {
        // Trouver les détails de mission pour le personnel spécifié
        $detailMission = Detailmission::where('personnel_id', $id)->firstOrFail();
        $mission = Mission::findOrFail($detailMission->mission_id);

        // Trouver le personnel associé aux détails de la mission
        $personnel = Personnel::findOrFail($detailMission->personnel_id);

        // Obtenir toutes les options pour les véhicules et lieux de mission
        $vehicules = Vehicule::all();
        $lieux_mission = Lieumission::all();

        return view('mission.show_details', [
            'detailMission' => $detailMission,
            'personnel' => $personnel,
            'mission' => $mission,
            'vehicules' => $vehicules,
            'lieux_mission' => $lieux_mission
        ]);
    }
    public function traitement($id)
    {
        // dd($id);
        $personnels = Personnel::all();

        $lieux_mission = Lieumission::all();

        // Récupérer la mission avec les détails liés, y compris les personnels
        $mission = Mission::with('detailMission.personnel')->findOrFail($id);

        // Récupérer les personnels à partir des détails de la mission
        $personnelsSelect = $mission->detailMission->map(function ($detailMission) {
            return $detailMission->personnel;
        });

        // Trouver le détail de la mission correspondant au personnel
        // $detailMission_personnel = Detailmission::where('mission_id', $id)->get();
        $detailMission_personnel = $mission->detailMission->map(function ($detailMission) {
            return $detailMission;
        });


        // dd($detailMission_personnel);

        return view('mission.traitement', compact('personnels', 'personnelsSelect', 'mission', 'lieux_mission', 'detailMission_personnel'));
    }


    public function traitementMission($id)
    {
        // Récupérer les personnels à partir des détails de la mission
        $detailMission_personnel = Detailmission::where('personnel_id', $id)->firstOrFail();

        // Mettre à jour la date de traitement avec la date actuelle
        $detailMission_personnel->dateTraitementMission = now();

        // Récupérer l'utilisateur connecté
        $user = auth()->user();
        $detailMission_personnel->traiteurMission = $user->name; 

        // Mettre à jour la date annuler traitement à null
        $detailMission_personnel->dateAnnulerTraitement = null;

        // dd($detailMission_personnel->traiteurMission);

        $detailMission_personnel->save();

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Le traitement a été effectué avec succès.');
    }
    
    public function traitementMissionAnnuler($id)
    {
        // Récupérer les personnels à partir des détails de la mission
        $detailMission_personnel = Detailmission::where('personnel_id', $id)->firstOrFail();

        // Mettre à jour la date de traitement avec la date actuelle
        $detailMission_personnel->dateAnnulerTraitement = now();

        // Mettre à jour la date de traitement à null
        $detailMission_personnel->dateTraitementMission = null;

        // Récupérer l'utilisateur connecté
        $user = auth()->user();
        $detailMission_personnel->annulateurTraitement = $user->name; // ou $user->nom, selon votre modèle d'utilisateur


        $detailMission_personnel->save();

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Le traitement a été annulé avec succès.');
    }
    
}
