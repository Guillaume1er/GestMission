<?php

namespace App\Http\Controllers;

use App\Models\Exercicebudgetaire;
use Illuminate\Http\Request;

class ExercicebudgetaireController extends Controller
{
    public function index()
    {
        $exercicebudgetaires = Exercicebudgetaire::orderBy('created_at', 'desc')->get();
        return view('exercice_budgetaire.index', compact('exercicebudgetaires'));
    }

    public function show()
    {
        return view('exercice_budgetaire.add');
    }

    public function consulter(Request $request, $id)
    {
        $exercicebudgetaire = Exercicebudgetaire::find($id);
        if (!$exercicebudgetaire) {
            return redirect()->route('exercices-budgetaire')
            ->with('error', 'Exercice budgetaire non trouvé.');
        }
        return view('exercice_budgetaire.update', compact('exercicebudgetaire'));
    }


    public function store(Request $request)
    {
        // dd($request->all());

        $validated = $request->validate([
            'exerciceBudgetaire' => ['required', 'integer'],
            'nombreTotalMission' => ['required', 'integer'],
            'clotureExercice' => ['boolean'],
        ]);

        $exercicebudgetaire = new Exercicebudgetaire();
        $exercicebudgetaire->exerciceBudgetaire = $request->exerciceBudgetaire;
        $exercicebudgetaire->nombreTotalMission = $request->nombreTotalMission;
        $exercicebudgetaire->clotureExercice = $request->clotureExercice;

        if ($request->clotureExercice) {
            $exercicebudgetaire->clotureExercice = true;
        } else {
            $exercicebudgetaire->clotureExercice = false;
        }

        $exercicebudgetaire->save();

        return redirect()->route('exercices-budgetaire')
        ->with('success', 'Exercice budgetaire créé avec succès.');
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());

        $validated = $request->validate([
            'exerciceBudgetaire' => ['required', 'integer'],
            'nombreTotalMission' => ['required', 'integer'],
            'clotureExercice' => ['boolean'],
        ]);

        $exercicebudgetaire = Exercicebudgetaire::find($id);

        if (!$exercicebudgetaire) {
            return redirect()->route('exercices-budgetaire')
            ->with('error', 'Exercice budgetaire non trouvé.');
        }

        $exercicebudgetaire->exerciceBudgetaire = $request->exerciceBudgetaire;
        $exercicebudgetaire->nombreTotalMission = $request->nombreTotalMission;
        $exercicebudgetaire->clotureExercice = $request->clotureExercice;

        if ($request->clotureExercice) {
            $exercicebudgetaire->clotureExercice = true;
        } else {
            $exercicebudgetaire->clotureExercice = false;
        }

        $exercicebudgetaire->update();


        return redirect()->route('exercices-budgetaire')
        ->with('success', 'Exercice budgetaire modifié avec succès.');
    }

    public function delete($id)
    {
        $exercicebudgetaire = Exercicebudgetaire::find($id);

        if (!$exercicebudgetaire) {
            return redirect()->route('exercices-budgetaire')
            ->with('error', 'Exercice budgetaire non trouvé.');
        }

        $exercicebudgetaire->delete();
        return redirect()->route('exercices-budgetaire')
        ->with('success', 'Exercice budgetaire supprimé avec succès.');
    }
}
