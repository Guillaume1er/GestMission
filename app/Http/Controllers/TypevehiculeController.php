<?php

namespace App\Http\Controllers;

use App\Models\Typevehicule;
use Illuminate\Http\Request;


class TypevehiculeController extends Controller
{
    public function index() {
        $typevehicules = Typevehicule::orderBy('created_at', 'desc')->get();
        return view('type_vehicule.index', compact('typevehicules'));
    }



    public function show (Request $request) {
        return view('type_vehicule.add');
    }


    
    public function consulter (Request $request, $id) {
        $typevehicule = Typevehicule::find($id);
        return view('type_vehicule.update', compact('typevehicule'));
    }


    public function store (Request $request) {
        $validated = $request->validate([
            'typeVehicule' =>['required', 'max:255'],
            
            
        ]);

        // dd($request->all());

        $typevehicule = new Typevehicule();
        $typevehicule->typeVehicule = $request->typeVehicule;
       

        $typevehicule->save();

        return redirect()->route('types-vehicule')
                         ->with('success', 'Type véhicule créé avec succès.');
    }



    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'typeVehicule' =>['required', 'string', 'max:255'],
            
        ]);

        $typevehicule = Typevehicule::find($id);
        $typevehicule->typeVehicule = $request->typeVehicule;
       

        
        
        $typevehicule->update();

        return redirect()->route('types-vehicule')
                        ->with('success', 'Type véhicule modifié avec succès.');
    }



    public function delete($id)
    {
        $typevehicule = Typevehicule::find($id);
        $typevehicule->delete();
        return redirect()->route('types-vehicule')
                         ->with('success', 'Type véhicule supprimé avec succès.');
    }
}
