<?php

namespace App\Http\Controllers;

use App\Models\Typeintervention;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\If_;

class TypeinterventionController extends Controller
{
    public function index()
    {
        $typeinterventions = Typeintervention::orderBy('created_at', 'desc')->get();
        return view('type_intervention.index', compact('typeinterventions'));
    }

    public function show(Request $request)
    {
        return view('type_intervention.add');
    }

    public function consulter(Request $request, $id)
    {
        $typeintervention = Typeintervention::find($id);
        if (!$typeintervention) {
            return redirect()->route('types-intervention')
                ->with('error', 'Type intervention non trouvé.');
        }
        return view('type_intervention.update', compact('typeintervention'));
    }


    public function store(Request $request)
    {
        // dd($request->all());

        $validated = $request->validate([
            'typeIntervention' => ['required', 'max:255'],
            'description' => ['nullable', 'max:255'],
            'livretBord' => ['boolean'],
        ]);

        $typeintervention = new Typeintervention();
        $typeintervention->typeIntervention = $request->typeIntervention;
        $typeintervention->description = $request->description;
        $typeintervention->livretBord = $request->livretBord;

        if ($request->livretBord) {
            $typeintervention->livretBord = true;
        } else {
            $typeintervention->livretBord = false;
        }

        $typeintervention->save();

        return redirect()->route('types-intervention')
            ->with('success', 'Type intervention créé avec succès.');
    }

    public function update(Request $request, $id)
    {
        dd($request->all());

        $validated = $request->validate([
            'typeIntervention' => ['required', 'max:255'],
            'description' => ['nullable', 'max:255'],
            'livretBord' => ['boolean'],
        ]);

        $typeintervention = Typeintervention::find($id);

        if (!$typeintervention) {
            return redirect()->route('types-intervention')
                ->with('error', 'Type intervention non trouvé.');
        }

        $typeintervention->typeIntervention = $request->typeIntervention;
        $typeintervention->description = $request->description;
        $typeintervention->livretBord = $request->livretBord;

        if ($typeintervention->livretBord) {
            $typeintervention->livretBord = true;
        } else {
            $typeintervention->livretBord = false;
        }

        $typeintervention->update();


        return redirect()->route('types-intervention')
            ->with('success', 'Type intervention modifié avec succès.');
    }

    public function delete($id)
    {
        $typeintervention = Typeintervention::find($id);
        if (!$typeintervention) {
            return redirect()->route('types-intervention')
                ->with('error', 'Type intervention non trouvé.');
        }

        $typeintervention->delete();
        return redirect()->route('types-intervention')
            ->with('success', 'Type intervention supprimé avec succès.');
    }
}
