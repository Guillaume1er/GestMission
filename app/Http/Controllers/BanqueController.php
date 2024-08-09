<?php

namespace App\Http\Controllers;

use App\Models\banque;
use App\Models\User;
use Illuminate\Http\Request;

class BanqueController extends Controller
{
    public function index()
    {
        $banques = banque::orderBy('created_at', 'desc')->get();

        return view('banque.index', compact('banques'));
    }

    public function show()
    {
        return view('banque.add');
    }

    public function consulter(Request $request, $id)
    {
        $banque = Banque::find($id);
        if (!$banque) {
            return redirect()->route('banques')
                ->with('error', 'Banque non trouvée.');
        }
        return view('banque.update', compact('banque'));
    }

    public function create()
    {
        return view('banque.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string',
            'sigle' => 'required|string',
            'nom' => 'required|string',
            'agence' => 'required|string',
        ]);

        Banque::create([
            'code' => $validated['code'],
            'sigle' => $validated['sigle'],
            'nom' => $validated['nom'],
            'agence' => $validated['agence'],
        ]);

        return redirect()->route('banques')->with('success', 'Banque créée avec succès.');
    }


    public function update(Request $request, $id)
    {
        // dd($request->all());

        $validated = $request->validate([
            'code' => 'required|string',
            'sigle' => 'required|string',
            'nom' => 'required|string',
            'agence' => 'required|string',
        ]);

        $banque = Banque::find($id);

        if (!$banque) {
            return redirect()->route('banques')
            ->with('error', 'Banque non trouvée.');
        }

        $banque->code = $request->code;
        $banque->sigle = $request->sigle;
        $banque->nom = $request->nom;
        $banque->agence = $request->agence;
        $banque->update();

        return redirect()->route('banques')->with('success', 'Banque modifiée avec succès.');
    }


    public function delete($id)
    {
        $banque = Banque::find($id);
        if (!$banque) {
            return redirect()->route('banques')
                ->with('error', 'Banque non trouvée.');
        }

        $banque->delete();

        return redirect()->route('banques')
            ->with('success', 'Banque supprimée avec succès.');
    }
}
