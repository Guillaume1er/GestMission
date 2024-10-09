<?php

namespace App\Http\Controllers;

use App\Models\Exercicebudgetaire;
use App\Models\Mission;
use App\Models\Organisateur;
use App\Models\Detailmission;
use App\Models\Lieumission;
use App\Models\Personnel;
use App\Models\Vehicule;
use App\Models\Itineraire;
use App\Models\Systeme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class MissionController extends Controller
{
    public function index()
    {
        $missions = Mission::with(['exerciceBudgetaire', 'organisateur', 'detailMission'])
            ->orderBy('created_at', 'desc')
            ->get();

            foreach ($missions as $mission) {
                $mission->hasNullDateValidation = $mission->hasNullDateValidation();
            }
            // dd($missions); 

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
    $validated = $request->validate([
        'nomMission' => ['required', 'string'],
        'objetMission' => ['required', 'string'],
        'dateMission' =>  ['required', 'date'],
        'dateDebutMission' =>  ['required', 'date'],
        'dateFinMission' =>  ['required', 'date'],
        'observationMission' =>  ['string'],
        'etatMission' =>  ['string'],
        'nbrVehicule' =>  ['numeric'],
        'nbrTotalNuite' =>  ['numeric'],
        'nbrTotalRepas' =>  ['numeric'],
        'montantTotalNuite' =>  ['numeric'],
        'montantTotalRepas' =>  ['numeric'],
        'montantTotalMission' =>  ['numeric'],
        'personnel_ids.*' => ['exists:personnels,id'],
        'exerciceBudgetaire_id' => ['required'],
        'organisateur_id' => ['required'],
    ]);

    try {
        // Démarre une transaction
        DB::beginTransaction();

        $mission = new Mission();
        $mission->nomMission = $request->nomMission;
        $mission->objetMission = $request->objetMission;
        $mission->dateMission = $request->dateMission;
        $mission->dateDebutMission = $request->dateDebutMission;
        $mission->dateFinMission = $request->dateFinMission;
        $mission->autorisateur1 = $request->autorisateur1;
        $mission->autorisateur2 = $request->autorisateur2;
        $mission->autorisateur3 = $request->autorisateur3;
        $mission->observationMission = $request->observationMission;
        $mission->etatMission = $request->etatMission;
        $mission->nbrVehicule = $request->nbrVehicule;
        $mission->nbrTotalNuite = $request->nbrTotalNuite;
        $mission->nbrTotalRepas = $request->nbrTotalRepas;
        $mission->montantTotalNuite = $request->montantTotalNuite;
        $mission->montantTotalRepas = $request->montantTotalRepas;
        $mission->montantTotalMission = $request->montantTotalMission;
        $mission->organisateur_id = $request->organisateur_id;
        $mission->exerciceBudgetaire_id = $request->exerciceBudgetaire_id;
        $mission->save();

        // Enregistrement des personnels associés à la mission
        $personnelIds = $request->input('personnel_ids', []);

        foreach ($personnelIds as $personnelId) {
            $detailMission = new Detailmission();
            $detailMission->mission_id = $mission->id;
            $detailMission->personnel_id = $personnelId;
            $detailMission->save(); // Enregistre chaque détail de la mission
        }

        // Si tout se passe bien, valide la transaction
        DB::commit();

        return redirect()->route('missions')->with('success', 'Mission créée avec succès');
    } catch (\Exception $e) {
        // En cas d'erreur, annule la transaction
        DB::rollBack();

        // Retourne une erreur avec le message approprié
        return redirect()->back()->withErrors('Une erreur est survenue lors de la création de la mission !!! Veuillez réessayer.');
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


            DB::commit();

            return redirect()->route('missions')
                ->with('success', 'Mission modifier avec succès.');
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


    public function showValidationForm($id, $mission_id)
    {
        $mission_id = $mission_id;
        // dd($mission_id);
        $lieux_mission  = Lieumission::all();

        $detailMission = Personnel::find($id);
        // dd($detailMission);


        $vehicules = Vehicule::all();

        return view('mission.detail', compact('detailMission', 'vehicules', 'lieux_mission', 'mission_id'));
    }


    public function validateMission(Request $request, $id) {

        $personnel = Personnel::findOrFail($id);

        $mission_id = $request->detailMission_id;

        // Récupère le premier détail de mission correspondant à ce personnel
        $detailMission = $personnel->missions()->first();
        $detailMission_id = $detailMission->id;

        $personnel = Personnel::findOrFail($id);

        // Récupère directement le premier détail de mission correspondant au personnel
        $detailMission = $personnel->missions()->where('personnel_id', $id)
                                                ->where('mission_id', $mission_id)
                                                ->firstOrFail();  
        // dd($detailMission);
        
            // Règles de validation variables en fonction de l'action
        if ($request->action === 'invalidate') {
            // Champs optionnels pour l'invalidation
            $validatedData = $request->validate([
                'refOm' => 'nullable|string',
                'dateDepart' => 'nullable|date',
                'dateRetour' => 'nullable|date',
                'moyenDeDeplacement' => 'nullable|string',
                'vehicule_id' => 'nullable|exists:vehicules,id',
                'lieuMission_id' => 'nullable',
            ]);
        } else {
            // Champs requis pour la validation
            $validatedData = $request->validate([
                'refOm' => 'required|string',
                'dateDepart' => 'required|date',
                'dateRetour' => 'required|date|after_or_equal:dateDepart',
                'moyenDeDeplacement' => 'required|string',
                'vehicule_id' => 'nullable|exists:vehicules,id',
                'lieuMission_id' => 'required',
            ]);
        }

        if ($request->action === 'invalidate') {
            // Seulement mettre à jour la date et le statut pour l'invalidation
            $detailMission->dateAnnulerValidation = now();
            $detailMission->statut = 'non validé';
        } else {
            // Mise à jour complète pour la validation
            $detailMission->refOm = $request->refOm;
            $detailMission->dateDepart = $request->dateDepart;
            $detailMission->dateRetour = $request->dateRetour;
            $detailMission->moyenDeDeplacement = $request->moyenDeDeplacement;
            $detailMission->vehicule_id = $request->vehicule_id;
            $detailMission->lieuMission_id = $request->lieuMission_id;
            $detailMission->statut = 'validé';

            // Calculs associés aux jours, nuits, repas, etc.
            $dateDepart = \Carbon\Carbon::parse($request->dateDepart);
            $dateRetour = \Carbon\Carbon::parse($request->dateRetour);

            $detailMission->nbrJour = $dateRetour->diffInDays($dateDepart);
            $detailMission->nbrNuit = $detailMission->nbrJour - 1;
            $detailMission->coutNuite = $detailMission->personnel->indice->montantNuite;
            $detailMission->montantNuite =  $detailMission->coutNuite * $detailMission->nbrNuit;
            $detailMission->nbrRepas = $detailMission->lieuxMission->nombreRepas ?? 1;
            $detailMission->coutRepas = $detailMission->personnel->indice->montantRepas;
            $detailMission->montantRepas = $detailMission->coutRepas * $detailMission->nbrRepas;
            $detailMission->montantMission = $detailMission->montantNuite + $detailMission->montantRepas;
            $detailMission->montantReste = $detailMission->montantMission - $detailMission->montantAvance;
    }

    // Enregistrer la validation ou l'invalidation
    $detailMission->validateur = auth()->user()->name;
    $detailMission->save();

    // Message personnalisé en fonction de l'action
    $message = $request->action === 'invalidate' ? 'Personnel invalidé avec succès.' : 'Personnel validé avec succès.';

    return redirect()->route('validation-mission', $mission_id)->with('success', $message);
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
        $detailMission_personnel = $mission->detailMission->filter(function ($detailMission) {
            return $detailMission->statut !== 'non traité';
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
        // $detailMission_personnel->dateAnnulerTraitement = null;

        // dd($detailMission_personnel->traiteurMission);

        $detailMission_personnel->save();

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Le traitement a été effectué avec succès.');
    }

    public function AnnulerValidation($id)
    {
        // Récupérer les personnels à partir des détails de la mission
        $detailMission_personnel = Detailmission::where('personnel_id', $id)->firstOrFail();

        // Mettre à jour la date de traitement avec la date actuelle
        $detailMission_personnel->dateAnnulerValidation = now();

        // Mettre à jour la date de traitement à null
        $detailMission_personnel->dateValidation = null;
        $detailMission_personnel->validateur = null;
        $detailMission_personnel->statut = "non traité";

        // Récupérer l'utilisateur connecté
        $user = auth()->user();
        $detailMission_personnel->annulateurTraitement = $user->name;


        $detailMission_personnel->save();

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'La validation a été annulé avec succès.');
    }

    public function showVehicules($mission_id)
    {
        // Récupérer la mission
        $mission = Mission::findOrFail($mission_id);

        // Récupérer les détails de mission avec les véhicules associés et le statut "validé"
        $detailMissions = DetailMission::with('vehicule')
            ->where('mission_id', $mission_id)
            ->where('statut', 'validé') // Filtrer par statut "validé"
            ->get();

        // Initialiser un tableau pour stocker les véhicules
        $vehicules = [];

        // Parcourir les détails de mission et récupérer les informations des véhicules
        foreach ($detailMissions as $detailMission) {
            if ($detailMission->vehicule) { // Vérifie si un véhicule est attribué
                $plaque = $detailMission->vehicule->plaqueVehicule;

                // Ajouter uniquement si ce véhicule n'est pas déjà dans le tableau
                if (!isset($vehicules[$plaque])) {
                    $vehicules[$plaque] = [ // Utiliser la plaque comme clé pour éviter les doublons
                        'id' => $detailMission->vehicule->id,
                        'plaqueVehicule' => $plaque,
                        'dateDepart' => $detailMission->dateDepart,
                        'dateRetour' => $detailMission->dateRetour,
                        'lieuMission' => $detailMission->lieuMission->commune ?? 'Non spécifié',
                        'distanceVehiculeMission' => $detailMission->distanceVehiculeMission,
                        'volumeCarburant' => $detailMission->volumeCarburant,



                    ];
                }
            }
        }
        $lieuMission = $detailMission->lieuMission;
        $commune = $lieuMission ? $lieuMission->commune : 'Non spécifiée';

        // Conversion du tableau associatif en tableau indexé pour la vue
        $vehicules = array_values($vehicules);

        // Retourner la vue avec 'compact'
        return view('mission.deplacement', compact('vehicules', 'mission'));
    }

    public function showItineraire($mission_id, $vehicule_id,  $mode = 'edit')
    {
        // Récupérer la mission
        $mission = Mission::findOrFail($mission_id);
        $systeme = Systeme::first(); 
        $vehicule = Vehicule::findOrFail($vehicule_id);

        // Récupérer le détail de mission avec le véhicule associé et le statut "validé"
        $detailMission = DetailMission::with('vehicule', 'lieuMission')
            ->where('mission_id', $mission_id)
            ->where('vehicule_id', $vehicule_id)
            ->where('statut', 'validé')
            ->firstOrFail();
        // dd($detailMission);


        // Récupérer la plaque du véhicule
        $plaqueVehicule = $detailMission->vehicule->plaqueVehicule;

        // Récupérer le lieu de mission à partir du détail de la mission
        $lieuMission = $detailMission->lieuMission;
        //  dd($lieuMission);


        // Vérifier que le lieu de mission existe
        $commune = $lieuMission ? $lieuMission->commune : 'Non spécifiée';

        // Récupérer la distance depuis le modèle 'lieumission'
        $distance = $lieuMission ? $lieuMission->distance : 'Non spécifiée';
        // Récupérer la distance totale du véhicule
        $distanceVehiculeMission = $detailMission->distanceVehiculeMission;
        $volumeCarburant = $detailMission->volumeCarburant;

        // Récupère les informations du premier enregistrement dans systeme
       
        $consommationVehicule = $systeme->consommation_vehicule_km;

        $mission = Mission::find($mission_id);

        $itineraireEnregistres = Itineraire::where('mission_id', $mission_id)->get();

        // Mode 'view' pour afficher les informations
        $mode = session('mode', 'edit');

       
        // Retourner la vue avec les données nécessaires
        return view('mission.itineraire', compact('detailMission', 'plaqueVehicule', 'mission', 'lieuMission', 'distance', 'commune', 'mode', 'itineraireEnregistres', 'distanceVehiculeMission', 'consommationVehicule','systeme', 'distanceVehiculeMission', 'volumeCarburant', 'vehicule'));
    }

    public function storeItineraire(Request $request)
    {
        // Validation des entrées
        $request->validate([
            'depart.*' => 'required|string',
            'arrive.*' => 'required|string',
            'allerRetour.*' => 'nullable|boolean',
            'distance_Km.*' => 'required|numeric',
            'lieuMission_id' => 'required|integer', 
            'vehicule_id' => 'required|integer', 
        ]);
    
        // Obtenir l'identifiant de la mission et du véhicule
        $missionId = $request->input('mission_id');
        $vehiculeId = $request->input('vehicule_id');
        $lieuMissionId = $request->input('lieuMission_id');
    
        // Récupérer les données système pour la consommation de carburant et le prix de l'essence
        $systeme = Systeme::find(1);
        $consommationVehicule = $systeme->consommation_vehicule_km; // Consommation de carburant par km
        $prixEssence = $systeme->prix_essence_litre;
    
        // Calculer la distance totale
        $totalDistance = 0;
        foreach ($request->input('distance_Km') as $index => $distance) {
            $isAllerRetour = $request->input('allerRetour')[$index] ?? false;
            $distanceTotal = $isAllerRetour ? $distance * 2 : $distance;
            $totalDistance += $distanceTotal;
        }
    
        // Calculer le volume d'essence total pour cette mission
        $volumeCarburant = $totalDistance * $consommationVehicule;
    
        // Calculer le montant du carburant 
        $montantCarburant = $volumeCarburant * $prixEssence;
    
        // Enregistrer le volume d'essence et le montant de carburant dans le DetailMission pour le véhicule sélectionné
        $detailMission = DetailMission::where('mission_id', $missionId)
            ->where('vehicule_id', $vehiculeId)
            ->first();
    
        // Vérifiez si le détail de la mission existe pour le véhicule
        if ($detailMission) {
            // Mettez à jour les champs requis dans le DetailMission
            $detailMission->distanceVehiculeMission = $totalDistance;
            $detailMission->volumeCarburant = $volumeCarburant;
            $detailMission->montant_carburant = $montantCarburant;
            $detailMission->save(); // Enregistrez les changements
        }
    
    
        foreach ($request->input('depart') as $index => $depart) {
            Itineraire::create([
                'mission_id' => $missionId,
                'depart' => $depart,
                'arrive' => $request->input('arrive')[$index],
                'allerRetour' => $request->input('allerRetour')[$index] ?? 0,
                'distance_km' => $request->input('distance_Km')[$index],
                'distance_total_km' => ($request->input('allerRetour')[$index] ?? false) ? $request->input('distance_Km')[$index] * 2 : $request->input('distance_Km')[$index],
                'vehicule_id' => $vehiculeId,
                'lieuMission_id' =>  $lieuMissionId,
            ]);
        }
    
        // Enregistrer l'itinéraire terminé avec succès
        return redirect()->back()->with('success', 'Les informations de l\'itinéraire et de la mission ont été enregistrées avec succès.');
    }

    public function showItineraires($vehiculeId)
{
    // Récupérer tous les itinéraires associés au véhicule sélectionné
    $itineraireList = Itineraire::where('vehicule_id', $vehiculeId)->get();

    // Retourner la vue avec la liste des itinéraires
    return view('itineraire.index', compact('itineraireList'));
}

    
}
