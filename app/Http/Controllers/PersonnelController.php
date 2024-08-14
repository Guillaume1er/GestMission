<?php

namespace App\Http\Controllers;

use App\Models\Indice;
use Illuminate\Http\Request;
use App\Models\Personnel;
use App\Models\Rang;

class PersonnelController extends Controller
{
    public function index()
    {
        $personnels = Personnel::with(['indice', 'rang'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('personnel.index', compact('personnels'));
    }

    public function show()
    {
        $indices = Indice::all();
        $rangs = Rang::all();

        return view('personnel.add', compact('indices', 'rangs'));
    }

    public function consulter($id)
    {
        $indices = Indice::all();
        $rangs = Rang::all();

        $personnel = Personnel::find($id);

        // dd($personnel);

        if (!$personnel) {
            return redirect()->route('personnels')
                ->with('error', 'personnel non trouvé.');
        }
        return view('personnel.update', compact('personnel', 'rangs', 'personnels'));
    }



    public function store(Request $request)
    {
        //   dd($request->all());
        $validated = $request->validate([
            'nomPrenomsPersonnel' => ['required', 'string'],
            'numeroMatricule' => ['required', 'string'],
            'civilite' =>  ['required', 'string'],
            'contact' =>  ['required', 'string', 'max:20'],
            'email' =>  ['required', 'email'],
            'adresse' => ['required', 'string'],
            'numIfu' => ['nullable', 'string'],
            'rang_id' => ['required', 'exists:rangs,id'],
            'indice_id' =>  ['required', 'exists:indices,id'],


        ]);

        // if ($request->validate->fails()) {
        //     return redirect()->back()
        //                     ->withErrors($validated)
        //                     ->withInput();
        // }



        $personnel = new Personnel();
        $personnel->nomPrenomsPersonnel = $request->nomPrenomsPersonnel;
        $personnel->numeroMatricule = $request->numeroMatricule;
        $personnel->civilite = $request->civilite;
        $personnel->contact = $request->contact;
        $personnel->email = $request->email;
        $personnel->adresse = $request->adresse;
        $personnel->numIfu = $request->numIfu;
        $personnel->rang_id = $request->rang_id;
        $personnel->indice_id = $request->indice_id;



        $personnel->save();

        return redirect()->route('personnels')
            ->with('success', 'Personnel créé avec succès.');
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());   

        $validated = $request->validate([
            'plaquePersonnel' => ['required', 'string'],
            'kilometrageDepart' => ['required', 'integer'],
            'responsablePersonnel' =>  ['required', 'string'],
            'contactResponsable' =>  ['required', 'string'],
            'etatPersonnel' =>  ['required', 'string'],
            // 'autorisationSortie' => ['nullable', 'boolean'],
            'dateAutorisation' => ['nullable'],
            // 'dateEnregistrementPersonnel' => ['date'],                
            'immatriculation' =>  ['required', 'string'],
            'PersonnelPool' => ['nullable', 'boolean'],
            'motifDesautorisation' => ['nullable', 'string'],
            'dateDesautorisation' =>  ['nullable'],
            // 'kilometrageActuel' =>  ['required', 'integer'],
            // 'kilometrageAlerte' =>  ['required', 'integer'],
            // 'dateDerniereMission' =>  ['required', 'date'],
            'dateAcquisition' =>  ['required', 'date'],
            'typePersonnel_id' =>  ['required', 'exists:typePersonnels,id'],
            'marque_id' =>  ['required', 'exists:marques,id'],
        ]);

        $personnel = Personnel::find($id);

        if (!$personnel) {
            return redirect()->route('Personnels')
                ->with('error', 'Personnel non trouvé.');
        }

        $personnel->plaquePersonnel = $request->plaquePersonnel;
        $personnel->kilometrageDepart = $request->kilometrageDepart;
        $personnel->responsablePersonnel = $request->responsablePersonnel;
        $personnel->contactResponsable = $request->contactResponsable;
        $personnel->etatPersonnel = $request->etatPersonnel;
        // $personnel->autorisationSortie = $request->autorisationSortie;
        $personnel->dateAutorisation = $request->dateAutorisation;
        // $request->dateEnregistrementPersonnel = date('Y-m-d');
        $personnel->dateEnregistrementPersonnel = $request->input('dateEnregistrementPersonnel') ?? now();
        $personnel->immatriculation = $request->immatriculation;
        $personnel->PersonnelPool = $request->PersonnelPool;
        $personnel->motifDesautorisation = $request->motifDesautorisation;
        $personnel->dateDesautorisation = $request->dateDesautorisation;
        // $personnel->kilometrageActuel = $request->kilometrageActuel;
        // $personnel->kilometrageAlerte = $request->kilometrageAlerte;
        // $personnel->dateDerniereMission = $request->dateDerniereMission;
        $personnel->dateAcquisition = $request->dateAcquisition;
        $personnel->typePersonnel_id = $request->typePersonnel_id;
        $personnel->marque_id = $request->marque_id;


        if ($personnel->autorisationSortie) {
            $personnel->autorisationSortie = true;
        } else {
            $personnel->autorisationSortie = false;
        }

        if ($personnel->PersonnelPool) {
            $personnel->PersonnelPool = true;
        } else {
            $personnel->PersonnelPool = false;
        }

        $personnel->update();


        return redirect()->route('Personnels')
            ->with('success', 'Personnel modifié avec succès.');
    }


    public function showAutorisationForm(Personnel $personnel)
    {
        return view('Personnel.autorisation', compact('Personnel'));
    }

    // Traite la soumission du formulaire d'autorisation
    public function autoriser(Request $request, Personnel $personnel)
    {
        $request->validate([
            'kilometrageDepart' => 'required|integer',
            'dateAutorisation' => 'required|date',
        ]);

        $personnel->update([
            'kilometrageDepart' => $request->kilometrageDepart,
            'dateAutorisation' => $request->dateAutorisation,
            'autorisationSortie' => true,
        ]);

        return redirect()->route('Personnels')->with('success', 'Autorisation enregistrée avec succès.');
    }



    // Traite la soumission du formulaire de désautorisation
    public function desautoriser(Request $request, Personnel $personnel)
    {
        $request->validate([
            'motifDesautorisation' => 'required|string|max:255',
            'dateDesautorisation' => 'required|date',
        ]);

        $personnel->update([
            'motifDesautorisation' => $request->motifDesautorisation,
            'dateDesautorisation' => $request->dateDesautorisation,
            'autorisationSortie' => false,
        ]);

        return redirect()->route('Personnels')->with('success', 'Désautorisation enregistrée avec succès.');
    }




    public function delete($id)
    {
        $personnel = Personnel::find($id);
        if (!$personnel) {
            return redirect()->route('Personnels')
                ->with('error', 'Personnel non trouvé.');
        }

        $personnel->delete();
        return redirect()->route('Personnels')
            ->with('success', 'Personnel supprimé avec succès.');
    }
}
