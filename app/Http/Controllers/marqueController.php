<?php

namespace App\Http\Controllers;

use App\Models\marque;
use Illuminate\Http\Request;

class marqueController extends Controller
{
    public function index() {
        $marques = marque::all();

        return view('marque.index', compact('marques'));
    }

    public function store(Request $request ) {
        $validated = $request->validate([
            'marque' => 'required|string',
        ]);
    }
}
