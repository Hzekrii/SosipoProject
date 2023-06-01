<?php

namespace App\Http\Controllers;


use App\Models\Recette;
use App\Models\Rubrique;
use App\Models\Solde;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class RecetteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $rubriques = Rubrique::where('for', false)->get();
        $data = ['rubriques' => $rubriques];
        return view('recette.add', $data);
    }

    public function show()
    {
        $recettes = Recette::get();
        $rubriques = Rubrique::where('for', false)->get();
        $users = User::get();
        $data = [
            'recettes' => $recettes,
            'users' => $users,
            'rubriques' => $rubriques,
        ];
        return view('recette.show', $data);
    }

    public function add(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'montant' => 'numeric',
            'feuille' => 'required|mimes:pdf',
            'designation' => 'required|max:1000',
        ]);

        // Find the corresponding rubrique based on the input
        $rubrique = Rubrique::find($request->rubrique);

        // If the rubrique is for "Augmentation de la banque"
        if ($rubrique->libelle == "Augmentation de la banque") {
            // Check if the year has already been entered in Solde
            if (Solde::first()->annee == date('Y')) {
                // Redirect with an error message
                return redirect('recette/show')->with('error', 'L’année a déjà été saisie dans Solde.');
            }
        }

        // Create a new Recette instance
        $recette = new Recette;

        // Set the input fields to the corresponding properties of the Recette instance
        $recette->designation = $request->designation;
        $recette->montant = $request->montant;
        $recette->modepaiement = $request->modepaiement;
        $recette->rubrique_id = $request->rubrique;
        $recette->approuve = false;
        $recette->user_id = auth()->id();

        // Store the uploaded PDF file in storage/app/public directory
        $pdfPath = $request->file('feuille')->store();

        // Save the PDF file path to the database
        $recette->feuille = $pdfPath;
        $recette->save();

        // Redirect with a success message
        return redirect('recette/show')->with('success', 'Recette enregistrée avec succès.');
    }


    public function edit($id)
    {
        $rubriques = Rubrique::where('for', false)->get();
        $recette = Recette::find($id);
        $data = [
            'recette' => $recette,
            'rubriques' => $rubriques,
        ];
        return view('recette.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'montant' => 'numeric',
            'feuille' => 'mimes:pdf',
            'designation' => 'required|max:1000',
        ]);
        $recette = Recette::find($id);
        // Check if recette has been approved
        if ($recette->approuve && $request->montant != $recette->montant) {
            return back()->withError("We don't do that here.");
        }
        $rubrique = Rubrique::find($request->rubrique);

        // If the rubrique is for "Augmentation de la banque"
        if ($rubrique->libelle == "Augmentation de la banque") {
            // Check if the year has already been entered in Solde
            if (Solde::first()->annee == date('Y')) {
                // Redirect with an error message
                return redirect('recette/show')->with('error', 'L’année a déjà été saisie dans Solde.');
            }
        }
        $recette->designation = $request->designation;
        $recette->montant = $request->montant;
        if ($request->modepaiement)
            $recette->modepaiement = $request->modepaiement;
        $recette->rubrique_id = $request->rubrique;
        $recette->user_id = auth()->id();

        if (file_exists($request->feuille)) {
            // Store the PDF file in storage/app/public directory
            $pdfPath = $request->file('feuille')->store();
            // Save the PDF file path to the database
            $recette->feuille = $pdfPath;
        } else {
            $recette->feuille = "NULL";
        }

        $recette->save();

        // Redirect back with a success message
        return redirect()->route('recette.show')->with('success', 'Recette enregistré avec succes.');
    }
    public function viewPdf($path)
    {
        $filePath = storage_path('app/' . $path);
        if (File::exists($filePath)) {
            return response()->file($filePath, [
                'Content-Type' => 'application/pdf',
            ]);
        }

        // If the file doesn't exist, return a 404 response
        abort(404);
    }

    public function destroy($id)
    {
        $recette = Recette::find($id);
        if (!$recette->approuve) {
            $recette->delete();
            Storage::delete('app/', $recette->feuille);
            return back()->withSuccess('Supprimer avec succes.');
        }
        return back()->withError('Vous ne pouvez pas supprimer cet recette.');
    }
}
