<?php

namespace App\Http\Controllers;

use App\Models\Marque;
use App\Models\Typevehicule;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class VehiculeController extends Controller
{
    public function index() {
        $vehicules = Vehicule::with(['typeVehicule', 'marque'])
        ->orderBy('created_at', 'desc')
        ->get();
        
        return view('vehicule.index', compact('vehicules'));
    }

    public function show() {
        $marques = Marque::all();
        $vehicules = Typevehicule::all();
        
        return view('vehicule.add', compact('marques', 'vehicules'));
    }
    
    public function consulter(Request $request, $id) {
        $marques = Marque::all();
        $vehicules = Typevehicule::all();
       
        $vehicule = Vehicule::find($id);

        // dd($vehicule);

        if (!$vehicule) {
            return redirect()->route('vehicules')
                             ->with('error', 'vehicule non trouvé.');
        }
        return view('vehicule.update', compact('vehicule', 'marques', 'vehicules'));
    }

   

    public function store(Request $request) {
        //   dd($request->all());
        $validated = $request->validate([
            'plaqueVehicule' => ['required', 'string'],
            'kilometrageDepart' => ['required', 'integer'],
            'responsableVehicule' =>  ['required', 'string'],
            'contactResponsable' =>  ['required', 'string'],
            'etatVehicule' =>  ['required', 'string'],
            // 'autorisationSortie' => ['nullable', 'boolean'],
             'dateAutorisation' => ['nullable'],
            // 'dateEnregistrementVehicule' => ['date'],                
            'immatriculation' =>  ['required', 'string'],
            'vehiculePool' => ['nullable' , 'boolean'],
             'motifDesautorisation' => ['nullable' , 'string'],
             'dateDesautorisation' =>  ['nullable'],
            // 'kilometrageActuel' =>  ['required', 'integer'],
            // 'kilometrageAlerte' =>  ['required', 'integer'],
            // 'dateDerniereMission' =>  ['required', 'date'],
            'dateAcquisition' =>  ['required', 'date'],
            'typeVehicule_id' =>  ['required', 'exists:typevehicules,id'],
            'marque_id' =>  ['required', 'exists:marques,id'],
        ]);

        // if ($request->validate->fails()) {
        //     return redirect()->back()
        //                     ->withErrors($validated)
        //                     ->withInput();
        // }

        

        $vehicule = new Vehicule();
        $vehicule->plaqueVehicule = $request->plaqueVehicule;
        $vehicule->kilometrageDepart = $request->kilometrageDepart;
        $vehicule->responsableVehicule = $request->responsableVehicule;
        $vehicule->contactResponsable = $request->contactResponsable;
        $vehicule->etatVehicule = $request->etatVehicule ;
        // $vehicule->autorisationSortie = $request->autorisationSortie;
         $vehicule->dateAutorisation = $request->dateAutorisation;
        // $request->dateEnregistrementVehicule = date('Y-m-d');
        $vehicule->dateEnregistrementVehicule = $request->input('dateEnregistrementVehicule') ?? now();
        $vehicule->immatriculation = $request->immatriculation;
        $vehicule->vehiculePool = $request->vehiculePool;
         $vehicule->motifDesautorisation = $request->motifDesautorisation;
        $vehicule->dateDesautorisation = $request->dateDesautorisation;
        // $vehicule->kilometrageActuel = $request->kilometrageActuel;
        // $vehicule->kilometrageAlerte = $request->kilometrageAlerte;
        // $vehicule->dateDerniereMission = $request->dateDerniereMission;
        $vehicule->dateAcquisition = $request->dateAcquisition;
        $vehicule->typeVehicule_id = $request->typeVehicule_id;
        $vehicule->marque_id = $request->marque_id;

    

        if($vehicule->vehiculePool){
            $vehicule->vehiculePool = true ;
        } else {
            $vehicule->vehiculePool = false ; 
        } 
        
        $vehicule->save();

        return redirect()->route('vehicules')
                         ->with('success', 'Vehicule créé avec succès.');
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());   

        $validated = $request->validate([
           'plaqueVehicule' => ['required', 'string'],
            'kilometrageDepart' => ['required', 'integer'],
            'responsableVehicule' =>  ['required', 'string'],
            'contactResponsable' =>  ['required', 'string'],
            'etatVehicule' =>  ['required', 'string'],
            // 'autorisationSortie' => ['nullable', 'boolean'],
             'dateAutorisation' => ['nullable'],
            // 'dateEnregistrementVehicule' => ['date'],                
            'immatriculation' =>  ['required', 'string'],
            'vehiculePool' => ['nullable' , 'boolean'],
             'motifDesautorisation' => ['nullable' , 'string'],
             'dateDesautorisation' =>  ['nullable'],
            // 'kilometrageActuel' =>  ['required', 'integer'],
            // 'kilometrageAlerte' =>  ['required', 'integer'],
            // 'dateDerniereMission' =>  ['required', 'date'],
            'dateAcquisition' =>  ['required', 'date'],
            'typeVehicule_id' =>  ['required', 'exists:typevehicules,id'],
            'marque_id' =>  ['required', 'exists:marques,id'],
        ]);

        $vehicule = Vehicule::find($id);
        
        if (!$vehicule) {
            return redirect()->route('vehicules')
                             ->with('error', 'Vehicule non trouvé.');
        }

        $vehicule->plaqueVehicule = $request->plaqueVehicule;
        $vehicule->kilometrageDepart = $request->kilometrageDepart;
        $vehicule->responsableVehicule = $request->responsableVehicule;
        $vehicule->contactResponsable = $request->contactResponsable;
        $vehicule->etatVehicule = $request->etatVehicule ;
        // $vehicule->autorisationSortie = $request->autorisationSortie;
         $vehicule->dateAutorisation = $request->dateAutorisation;
        // $request->dateEnregistrementVehicule = date('Y-m-d');
        $vehicule->dateEnregistrementVehicule = $request->input('dateEnregistrementVehicule') ?? now();
        $vehicule->immatriculation = $request->immatriculation;
        $vehicule->vehiculePool = $request->vehiculePool;
         $vehicule->motifDesautorisation = $request->motifDesautorisation;
        $vehicule->dateDesautorisation = $request->dateDesautorisation;
        // $vehicule->kilometrageActuel = $request->kilometrageActuel;
        // $vehicule->kilometrageAlerte = $request->kilometrageAlerte;
        // $vehicule->dateDerniereMission = $request->dateDerniereMission;
        $vehicule->dateAcquisition = $request->dateAcquisition;
        $vehicule->typeVehicule_id = $request->typeVehicule_id;
        $vehicule->marque_id = $request->marque_id;


        if($vehicule->autorisationSortie){
            $vehicule->autorisationSortie = true ;
        } else {
            $vehicule->autorisationSortie = false ;
        } 

        if($vehicule->vehiculePool){
            $vehicule->vehiculePool = true ;
        } else {
            $vehicule->vehiculePool = false ;
        } 
        
        $vehicule->update();


        return redirect()->route('vehicules')
                         ->with('success', 'Vehicule modifié avec succès.');
    }


    public function showAutorisationForm(Vehicule $vehicule)
    {
        return view('vehicule.autorisation', compact('vehicule'));
    }

    // Traite la soumission du formulaire d'autorisation
    public function autoriser(Request $request, Vehicule $vehicule)
    {
        $request->validate([
            'kilometrageDepart' => 'required|integer',
            'dateAutorisation' => 'required|date',
        ]);

        $vehicule->update([
            'kilometrageDepart' => $request->kilometrageDepart,
            'dateAutorisation' => $request->dateAutorisation,
            'autorisationSortie' => true,
        ]);

        return redirect()->route('vehicules')->with('success', 'Autorisation enregistrée avec succès.');
    }



    // Traite la soumission du formulaire de désautorisation
    public function desautoriser(Request $request, Vehicule $vehicule)
    {
        $request->validate([
            'motifDesautorisation' => 'required|string|max:255',
            'dateDesautorisation' => 'required|date',
        ]);

        $vehicule->update([
            'motifDesautorisation' => $request->motifDesautorisation,
            'dateDesautorisation' => $request->dateDesautorisation,
            'autorisationSortie' => false,
        ]);

        return redirect()->route('vehicules')->with('success', 'Désautorisation enregistrée avec succès.');
    }




    public function delete($id)
    {
        $vehicule = Vehicule::find($id);
        if (!$vehicule) {
            return redirect()->route('vehicules')
                             ->with('error', 'Vehicule non trouvé.');
        }

        $vehicule->delete();
        return redirect()->route('vehicules')
                         ->with('success', 'Vehicule supprimé avec succès.');
    }
}
