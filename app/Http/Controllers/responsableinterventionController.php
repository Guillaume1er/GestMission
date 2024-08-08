<?php

namespace App\Http\Controllers;

use App\Models\Responsableintervention;
use Illuminate\Http\Request;

class responsableinterventionController extends Controller
{
    public function index() {
        $responsableinterventions = Responsableintervention::all();
        return view('responsable_intervention.index', compact('responsableinterventions'));
    }



    public function show (Request $request) {
        return view('responsable_intervention.add');
    }


    
    public function consulter (Request $request, $id) {
        $responsableintervention = Responsableintervention::find($id);
        return view('responsable_intervention.update', compact('responsableintervention'));
    }


    public function store (Request $request) {
        $validated = $request->validate([
            'nomResponsable' =>['required', 'max:255'],
        ]);

        // dd($request->all());

        $responsableintervention = Responsableintervention::create([
            'nomResponsable' => $validated['nomResponsable'],
        ]);

        return redirect()->route('responsables-intervention')
                         ->with('success', 'Responsable intervention créé avec succès.');
    }



    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nomResponsable' =>['required', 'string', 'max:255'],
        ]);

        $responsableintervention = Responsableintervention::find($id);
        $responsableintervention->nomResponsable= $request->nomResponsable;
        
        $responsableintervention->update();

        return redirect()->route('responsables-intervention')
                        ->with('success', 'Responsable intervention modifié avec succès.');
    }



    public function delete($id)
    {
        $responsableintervention = Responsableintervention::find($id);
        $responsableintervention->delete();
        return redirect()->route('responsables-intervention')
                         ->with('success', 'Responsable intervention supprimé avec succès.');
    }
}
