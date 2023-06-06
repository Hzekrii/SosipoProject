<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'libelle' => 'required|max:255'
        ]);

        Categorie::create([
            'libelle' => $request->input('libelle')
        ]);

        return redirect()->route('adherents.create')->with('success', 'Categorie created successfully.');
    }

    public function edit(Categorie $Categorie)
    {
        return view('categories.edit', compact('Categorie'));
    }

    public function update(Request $request, Categorie $category)
    {

        $libelle = $request->input('libelle');

        $category = Categorie::find($category->id);


        $category->libelle = $libelle;
        $category->save();

        return redirect()->route('adherents.create')->with('success', 'Categorie updated successfully.');
    }


    public function destroy( $id)
    {
        $Categorie = Categorie::find($id);
        $Categorie->delete();

        return back()->with('success', 'Categorie deleted successfully.');
    }
}
