<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        // dd($users);
        return view('user.index', compact('users'));
    }

    public function show (Request $request) {
        return view('user.add');
    }
    
    public function consulter (Request $request, $id) {
        $user = User::find($id);
        return view('user.update', compact('user'));
    }

    public function store (Request $request) {

        $validated = $request->validate([
            'name' =>['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => 'required|string',
            'role' => 'required|string',
        ]);

        // dd($request->all());

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('users')
                         ->with('success', 'Utilisateur créé avec succès.');
    }

    public function update(Request $request, $id)
    {
        
        $validated = $request->validate([
            'name' =>['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'role' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = $request->password;

        $user->update();

        return redirect()->route('users')
                        ->with('success', 'Utilisateur modifié avec succès.');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users')
                         ->with('success', 'Utilisateur supprimé avec succès.');
    }
}
