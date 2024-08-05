<?php

namespace App\Http\Controllers;

use App\Models\banque;
use App\Models\User;
use Illuminate\Http\Request;

class BanqueController extends Controller
{
    public function index() {
        $banques = banque::all();

        return view('banque.index', compact('banques'));
    }

    public function create() {
        return view('users.create'); 
    }


    public function store(Request $request) {
        $validated = $request->validate([
            'code' => 'required|string',
            'sigle' => 'required|string',
            'nom' => 'required|string',
            'agence' => 'required|string',
        ]);

        User::create([
            'code' => $validated['code'],
            'sigle' => $validated['sigle'],
            'nom' => $validated['nom'],
            'agence' => $validated['agence'],
        ]);
    
        return redirect()->route('banque.index')->with('success', 'Banque créée avec succès.');
    }


    public function update(Request $request, $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $request->filled('password') ? bcrypt($validated['password']) : $user->password,
        ]);

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }




}
