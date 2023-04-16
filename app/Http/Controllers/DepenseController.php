<?php

namespace App\Http\Controllers;


use App\Models\Depense;
use App\Models\Rubrique;
use App\Models\Solde;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DepenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $rubriques = Rubrique::where('for', true)->get();
        $data = ['rubriques' => $rubriques];
        return view('depense.add', $data);
    }

    public function show()
    {
        $depenses = Depense::get();
        $rubriques = Rubrique::where('for', true)->get();
        $users = User::get();
        $data = [
            'depenses' => $depenses,
            'users' => $users,
            'rubriques' => $rubriques,
        ];
        return view('depense.show', $data);
    }

    public function add(Request $request)
    {
        $request->validate([
            'montant' => 'numeric',
            'feuille' => 'required|mimes:pdf',
            'designation' => 'required|max:1000',
        ]);
        $solde = Solde::find("1");
        if ($request->modepaiement == "1") {
            if ($solde->banque - $request->montant < 0)
                return back()->withError('Solde banque insuffisant.');
        } else {
            if ($solde->caisse - $request->montant < 0)
                return back()->withError('Solde caisse insuffisant.');
        }
        $depense = new Depense;
        $depense->designation = $request->designation;
        $depense->montant = $request->montant;
        $depense->modepaiement = $request->modepaiement;
        $depense->rubrique_id = $request->rubrique;
        $depense->approuve = false;
        $depense->user_id = auth()->id();
        // Store the PDF file in storage/app/public directory
        $pdfPath = $request->file('feuille')->store();
        // Save the PDF file path to the database
        $depense->feuille = $pdfPath;
        $depense->save();
        // Redirect back with a success message
        return redirect('depense/show')->with('success', 'Depense enregistre avec succes.');
    }


    public function edit($id)
    {
        $rubriques = Rubrique::where('for', true)->get();
        $depense = Depense::find($id);
        $data = [
            'depense' => $depense,
            'rubriques' => $rubriques,
        ];
        return view('depense.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'montant' => 'numeric',
            'feuille' => 'mimes:pdf',
            'designation' => 'required|max:1000',
        ]);
        $solde = Solde::find("1");
        if ($request->modepaiement == "1") {
            if ($solde->banque - $request->montant < 0)
                return back()->withError('Solde banque insuffisant.');
        } else {
            if ($solde->caisse - $request->montant < 0)
                return back()->withError('Solde caisse insuffisant.');
        }
        $depense = Depense::find($id);
        // Check if Depense has been approved
        if ($depense->approuve && $request->montant != $depense->montant) {
            return back()->withError("We don't do that here.");
        }
        $depense->designation = $request->designation;
        $depense->montant = $request->montant;
        $depense->modepaiement = $request->modepaiement;
        $depense->rubrique_id = $request->rubrique;
        $depense->user_id = auth()->id();

        if (file_exists($request->feuille)) {
            // Store the PDF file in storage/app/public directory
            $pdfPath = $request->file('feuille')->store();
            // Save the PDF file path to the database
            $depense->feuille = $pdfPath;
        } else {
            $depense->feuille = "NULL";
        }

        $depense->save();

        // Redirect back with a success message
        return redirect()->route('depense.show')->with('success', 'Depense enregistré avec succes.');
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
        $depense = Depense::find($id);
        if (!$depense->approuve) {
            $depense->delete();
            Storage::delete('app/', $depense->feuille);
            return back()->withSuccess('Supprimer avec succes.');
        }
        return back()->withError('Vous ne pouvez pas supprimer cet Depense.');
    }

}
