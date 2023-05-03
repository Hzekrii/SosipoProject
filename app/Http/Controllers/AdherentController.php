<?php

namespace App\Http\Controllers;

use App\Models\Adherent;
use App\Models\Categorie;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PhpParser\Node\Expr\New_;

class AdherentController extends Controller
{
    public function index()
    {
        $adherents = Adherent::all();
        return view('adherents.index', compact('adherents'));
    }

    public function create()
    {
        $categories = Categorie::all();
        return view('adherents.add', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
        'matricule' => 'required|unique:adherents',
        'name' => 'required',
        'prenom' => 'required',
        'cin' => 'required|unique:adherents',
        'categorie_id' => 'required|exists:categories,id',
        'nb_enfant' => 'required|integer|min:0',
        'date' => 'nullable|date',
        'situation_maritale' => 'nullable|integer|between:1,4',
        ]);

        // Create a new Adherent object and fill it with the validated data
        $adherent = new Adherent();
        $adherent->fill($validatedData);

        // Save the Adherent object to the database
        $adherent->save();

        // Redirect the user to the view of the newly created Adherent object
        return redirect()->route('adherents.index');
    }


    public function show(Adherent $adherent)
    {
        $adherents = Adherent::all();
        return view('adherents.show', compact('adherent'));
    }

    public function edit(Adherent $adherent)
    {
        $categories = Categorie::all();
        return view('adherents.edit', compact('adherent', 'categories'));
    }

    public function update(Request $request, Adherent $adherent)
    {
        $validatedData = $request->validate([
            'matricule' => 'required|unique:adherents,matricule,' . $adherent->id . '|max:255',
            'name' => 'required|max:255',
            'prenom' => 'required|max:255',
            'cin' => 'required|unique:adherents,cin,' . $adherent->id . '|max:255',
            'categorie_id' => 'nullable|exists:categories,id',
            'nb_enfant' => 'required|integer|min:0',
            'situation_maritale' => 'required|max:255',
        ]);
        $adherent->update($validatedData);
        return redirect()->route('adherents.show', $adherent);
    }

    public function destroy(Adherent $adherent)
    {
        $adherent->delete();
        return redirect()->route('adherents.index');
    }
}

