<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SchemeRegisterController extends Controller
{
    public function show() {
        return view('SchemeCreation');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'starting_year' => 'required|integer|min:1900|max:2100',
        ]);

        dd($validatedData);
    }
}
