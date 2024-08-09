<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use App\Models\Responsableintervention;
use App\Models\Typeintervention;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class interventionController extends Controller
{
    public function index()
    {
        $interventions = Intervention::with(['vehicule', 'responsableIntervention', 'typeIntervention'])
        ->orderBy('created_at', 'desc')
        ->get();
        return view('intervention.index', compact('interventions'));
    }

    public function show(Request $request)
    {
        $typeInterventions = Typeintervention::all();
        $responsableInterventions = Responsableintervention::all();
        $vehicules = Vehicule::all();
        
        return view('intervention.add', compact('typeInterventions', 'responsableInterventions', 'vehicules'));
    }

    public function consulter(Request $request, $id)
    {
        $intervention = Intervention::find($id);

        if (!$intervention) {
            return redirect()->route('interventions')
                ->with('error', 'Intervention non trouvé.');
        }
        return view('intervention.update', compact('intervention'));
    }


    public function store(Request $request)
    {
        //  dd($request->all());

        $validated = $request->validate([
        'datePrevue' => ['nullable', 'date'],
        'dateIntervention' => ['required', 'date'],
        'objetIntervention' => ['required', 'string'],
        'kilometrageIntervention' => ['nullable', 'integer'],
        'pannesSurvenues' => ['nullable', 'string'],
        'reparationEffectue' => ['nullable', 'string'],
        'coutGlobal' => ['nullable', 'numeric'],
        'validationIntervention' => ['required', 'boolean'],
        'vehicule_id' => ['required', 'exists:vehicules,id'], 
        'typeIntervention_id' => ['required', 'exists:typeinterventions,id'],
        'responsableIntervention_id' => ['required', 'exists:responsableinterventions,id'],
        ]);

        $intervention = new Intervention();
        $intervention->datePrevue = $request->datePrevue;
        $intervention->dateIntervention = $request->dateIntervention;
        $intervention->objetIntervention = $request->objetIntervention;
        $intervention->kilometrageIntervention = $request->kilometrageIntervention;
        $intervention->pannesSurvenues = $request->pannesSurvenues;
        $intervention->reparationEffectue = $request->reparationEffectue;
        $intervention->coutGlobal = $request->coutGlobal;
        $intervention->validationIntervention = $request->validationIntervention;
        $intervention->vehicule_id = $request->vehicule_id;
        $intervention->typeIntervention_id = $request->typeIntervention_id;
        $intervention->responsableIntervention_id = $request->responsableIntervention_id;

        $intervention->save();

        return redirect()->route('interventions')
            ->with('success', 'Intervention créée avec succès.');
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());

        $validated = $request->validate([
           'datePrevue' => ['nullable', 'date'],
        'dateIntervention' => ['required', 'date'],
        'objetIntervention' => ['required', 'string'],
        'kilometrageIntervention' => ['nullable', 'integer'],
        'pannesSurvenues' => ['nullable', 'string'],
        'reparationEffectue' => ['nullable', 'string'],
        'coutGlobal' => ['nullable', 'numeric'],
       
        ]);

        $intervention = Intervention::find($id);

        if (!$intervention) {
            return redirect()->route('interventions')
                ->with('error', 'Intervention non trouvée.');
        }

        $intervention->datePrevue = $request->datePrevue;
        $intervention->dateIntervention = $request->dateIntervention;
        $intervention->objetIntervention = $request->objetIntervention;
        $intervention->kilometrageIntervention = $request->kilometrageIntervention;
        $intervention->pannesSurvenues = $request->pannesSurvenues;
        $intervention->reparationEffectue = $request->reparationEffectue;
        $intervention->coutGlobal = $request->coutGlobal;
       

       

        $intervention->update();


        return redirect()->route('interventions')
            ->with('success', 'Intervention modifiée avec succès.');
    }

    public function delete($id)
    {
        $intervention = Intervention::find($id);
        if (!$intervention) {
            return redirect()->route('interventions')
                ->with('error', 'Intervention non trouvée.');
        }

        $intervention->delete();
        return redirect()->route('interventions')
            ->with('success', 'Intervention supprimée avec succès.');
    }

}
