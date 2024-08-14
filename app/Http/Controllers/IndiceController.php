<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Indice;

class IndiceController extends Controller
{
    
    public function index()
    {
        $indices = Indice::orderBy('created_at', 'desc')->get();
        return view('indice.index', compact('indices'));
    }

    public function show(Request $request)
    {
        return view('indice.add');
    }

    public function consulter(Request $request, $id)
    {
        $indice = Indice::find($id);
        if (!$indice) {
            return redirect()->route('indices')
                ->with('error', 'Indice non trouvé.');
        }
        return view('indice.update', compact('indice'));
    }


    public function store(Request $request)
    {
        // dd($request->all());

        $validated = $request->validate([
            'code' => ['required', 'max:255'],
            'montantNuite' => ['numeric' ],
            'montantRepas' => ['numeric'],
        ]);

        $indice = new Indice();
        $indice->code = $request->code;
        $indice->montantNuite= $request->montantNuite;
        $indice->montantRepas = $request->montantRepas;

        

        $indice->save();

        return redirect()->route('indices')
            ->with('success', 'Indice créé avec succès.');
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());

        $validated = $request->validate([
            'code' => ['required', 'max:255'],
            'montantNuite' => ['numeric', ],
            'montantRepas' => ['numeric'],
        ]);

        $indice = Indice::find($id);

        if (!$indice) {
            return redirect()->route('indices')
                ->with('error', 'Indice non trouvé.');
        }

        $indice->code = $request->code;
        $indice->montantNuite= $request->montantNuite;
        $indice->montantRepas = $request->montantRepas;

        $indice->update();


        return redirect()->route('indices')
            ->with('success', 'Indice modifié avec succès.');
    }

    public function delete($id)
    {
        $indice = Indice::find($id);
        if (!$indice) {
            return redirect()->route('indices')
                ->with('error', 'Indice non trouvé.');
        }

        $indice->delete();
        return redirect()->route('indices')
            ->with('success', 'Indice supprimé avec succès.');
    }
}
