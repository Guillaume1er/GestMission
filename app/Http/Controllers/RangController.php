<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rang;

class RangController extends Controller
{

    public function index()
    {
        $rangs = Rang::orderBy('created_at', 'desc')->get();
        return view('rang.index', compact('rangs'));
    }

    public function show(Request $request)
    {
        return view('rang.add');
    }

    public function consulter(Request $request, $id)
    {
        $rang = Rang::find($id);
        if (!$rang) {
            return redirect()->route('rangs')
                ->with('error', 'Type intervention non trouvé.');
        }
        return view('rang.update', compact('rang'));
    }


    public function store(Request $request)
    {
        // dd($request->all());

        $validated = $request->validate([
            'nomRang' => ['required', 'max:255'],
           
        ]);

        $rang = new Rang();
        $rang->nomRang= $request->nomRang;
       

        

        $rang->save();

        return redirect()->route('rangs')
            ->with('success', 'Rang créé avec succès.');
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());

        $validated = $request->validate([
            'nomRang' => ['required', 'max:255'],
        ]);

        $rang = Rang::find($id);

        if (!$rang) {
            return redirect()->route('rangs')
                ->with('error', 'rang non trouvé.');
        }

        $rang->nomRang= $request->nomRang;

        $rang->update();


        return redirect()->route('rangs')
            ->with('success', 'rang modifié avec succès.');
    }

    public function delete($id)
    {
        $rang = Rang::find($id);
        if (!$rang) {
            return redirect()->route('rangs')
                ->with('error', 'rang non trouvé.');
        }

        $rang->delete();
        return redirect()->route('rangs')
            ->with('success', 'rang supprimé avec succès.');
    }
}

