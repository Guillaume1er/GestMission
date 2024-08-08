<?php

namespace App\Http\Controllers;

use App\Models\marque;
use Illuminate\Http\Request;

class marqueController extends Controller
{
    public function index() {
        $marques = Marque::all();
        return view('marque.index', compact('marques'));
    }



    public function show (Request $request) {
        return view('marque.add');
    }


    
    public function consulter (Request $request, $id) {
        $marque = Marque::find($id);
        return view('marque.update', compact('marque'));
    }


    public function store (Request $request) {
        $validated = $request->validate([
            'marque' =>['required', 'max:255'],
        ]);

        // dd($request->all());

        $marque = Marque::create([
            'marque' => $validated['marque'],
        ]);

        return redirect()->route('marques')
                         ->with('success', 'Marque créée avec succès.');
    }



    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'marque' =>['required', 'string', 'max:255'],
        ]);

        $marque = Marque::find($id);
        $marque->marque = $request->marque;
        
        $marque->update();

        return redirect()->route('marques')
                        ->with('success', 'Marque modifiée avec succès.');
    }



    public function delete($id)
    {
        $marque = Marque::find($id);
        $marque->delete();
        return redirect()->route('marques')
                         ->with('success', 'Marque supprimée avec succès.');
    }
}
