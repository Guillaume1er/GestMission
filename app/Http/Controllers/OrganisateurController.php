<?php

namespace App\Http\Controllers;

use App\Models\Organisateur;
use Illuminate\Http\Request;

class OrganisateurController extends Controller
{
    public function index() {
        $organisateurs = Organisateur::all();
        return view('organisateur.index', compact('organisateurs'));
    }



    public function show (Request $request) {
        return view('organisateur.add');
    }


    
    public function consulter (Request $request, $id) {
        $organisateur = Organisateur::find($id);
        return view('organisateur.update', compact('organisateur'));
    }


    public function store (Request $request) {
        $validated = $request->validate([
            'nomOrganisateur' =>['required', 'max:255'],
        ]);

        // dd($request->all());

        $organisateur = Organisateur::create([
            'nomOrganisateur' => $validated['nomOrganisateur'],
        ]);

        return redirect()->route('organisateurs')
                         ->with('success', 'Organisateur crée avec succès.');
    }



    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nomOrganisateur' =>['required', 'string', 'max:255'],
        ]);

        $Organisateur = Organisateur::find($id);
        $Organisateur->nomOrganisateur = $request->nomOrganisateur;
        
        $Organisateur->update();

        return redirect()->route('organisateurs')
                        ->with('success', 'Organisateur modifié avec succès.');
    }



    public function delete($id)
    {
        $Organisateur = Organisateur::find($id);
        $Organisateur->delete();
        return redirect()->route('organisateurs')
                         ->with('success', 'Organisateur supprimé avec succès.');
    }
}
