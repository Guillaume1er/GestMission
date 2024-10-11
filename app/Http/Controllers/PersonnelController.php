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

    public function consulter(Request $request, $id)
    {
        $indices = Indice::all();
        $rangs = Rang::all();

        $personnel = Personnel::find($id);

        // dd($personnel);

        if (!$personnel) {
            return redirect()->route('personnels')
                ->with('error', 'personnel non trouvé.');
        }
        return view('personnel.update', compact('personnel', 'rangs', 'indices'));
    }



    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'nomPrenomsPersonnel' => ['required', 'string'],
            'numeroMatricule' => ['required', 'string', 'unique:personnels,numeroMatricule'],
            'civilite' =>  ['required', 'string'],
            'contact' =>  ['required', 'string', 'max:12'],
            'email' =>  ['required', 'email'],
            'adresse' => ['required', 'string'],
            'fonction' => ['required', 'string'],
            'numIfu' => ['nullable ', 'min:13'],
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
        $personnel->fonction = $request->fonction;
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
            'nomPrenomsPersonnel' => ['required', 'string'],
            'numeroMatricule' => ['required', 'string', 'unique:personnels,numeroMatricule'],
            'civilite' =>  ['required', 'string'],
            'contact' =>  ['required', 'string', 'max:20'],
            'email' =>  ['required', 'email'],
            'adresse' => ['required', 'string'],
            'numIfu' => ['nullable', 'min:13'],
            'rang_id' => ['required', 'exists:rangs,id'],
            'indice_id' =>  ['required', 'exists:indices,id'],
        ]);

        $personnel = Personnel::find($id);

        if (!$personnel) {
            return redirect()->route('personnels')
                ->with('error', 'Personnel non trouvé.');
        }

        $personnel->nomPrenomsPersonnel = $request->nomPrenomsPersonnel;
        $personnel->numeroMatricule = $request->numeroMatricule;
        $personnel->civilite = $request->civilite;
        $personnel->contact = $request->contact;
        $personnel->email = $request->email;
        $personnel->adresse = $request->adresse;
        $personnel->numIfu = $request->numIfu;
        $personnel->rang_id = $request->rang_id;
        $personnel->indice_id = $request->indice_id;



        $personnel->update();


        return redirect()->route('personnels')
            ->with('success', 'Personnel modifié avec succès.');
    }


    public function delete($id)
    {
        $personnel = Personnel::find($id);
        if (!$personnel) {
            return redirect()->route('personnels')
                ->with('error', 'Personnel non trouvé.');
        }

        $personnel->delete();
        return redirect()->route('personnels')
            ->with('success', 'Personnel supprimé avec succès.');
    }
}
