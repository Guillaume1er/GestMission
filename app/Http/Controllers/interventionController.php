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
        $interventions = Intervention::orderBy('created_at', 'desc')->get();
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
            // 'refIntervention' => ['required', 'string'],
            // 'numeroIntervention' => ['nullable','string'],
            // 'datePrevue' => ['nullable', 'date'],
            // 'dateIntervention' => ['nullable', 'date'],
            // 'objetIntervention' => ['require', 'string'],
            // 'kilometrageIntervention' => ['integer', 'nullable'],
            // 'panneSurvenues' => ['nullable', 'string'],
            // 'reparationsEffectuees' => ['nullable', 'string'],
            // 'coutGlobal' => ['nullable', 'decimal'],
            // 'validationIntervention' => ['boolean', 'nullable'],
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
        dd($request->all());

        $validated = $request->validate([
            'typeIntervention' => ['required', 'max:255'],
            'description' => ['nullable', 'max:255'],
            'livretBord' => ['boolean'],
        ]);

        $intervention = Intervention::find($id);

        if (!$intervention) {
            return redirect()->route('interventions')
                ->with('error', 'Intervention non trouvée.');
        }

        $intervention->typeIntervention = $request->typeIntervention;
        $intervention->description = $request->description;
        $intervention->livretBord = $request->livretBord;

        if ($intervention->livretBord) {
            $intervention->livretBord = true;
        } else {
            $intervention->livretBord = false;
        }

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
