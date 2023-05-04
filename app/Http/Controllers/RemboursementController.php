<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Credit;
use App\Models\Solde;
use App\Models\Remboursement;
use App\Models\Rubrique;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class RemboursementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $credits = Credit::get();
        $data = [
            'title' => $des = 'Ajouter Un Remboursement',
            'description' => $des,
            'credits' => $credits,
        ];
        return view('remboursement.add', $data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

            $request->validate([
            'designation' => 'required',
            'credit_id' => 'required',
            'montant' => 'required',
            'date_remboursement' => 'required',
            'feuille' => 'required|file|mimes:pdf',
            ]);
            $credit = Credit::find($request->credit_id);
            $year = Carbon::parse($credit->date_credit)->year;
            $solde = Solde::where('annee', $year)->firstOrFail();

            $reste = $credit->montant - $credit->remboursements->sum('montant');
            if ($request->montant > $reste) {
            return back()->withErrors(['montant' => 'Le montant du remboursement ne peut pas être supérieur au reste du crédit.']);
            }


            $remboursement = new Remboursement();

            $remboursement->credit_id = $request->credit_id;
            $remboursement->designation = $request->designation;
            $remboursement->montant = $request->montant;
            $remboursement->approuve = false;
            $remboursement->solde_id = $solde->id;
            $remboursement->date_remboursement = $request->date_remboursement;
            $remboursement->feuille = $request->file('feuille')->store(
                
            );
            $remboursement->save();

            $success = "Ajout avec succès";
            return back()->withSuccess($success);
    }



    /**
     * Display the specified resource.
     */
    public function show(Remboursement $remboursement)
    {
        $remboursement = Remboursement::get();
        $rubriques = Rubrique::where('for', true)->get();
        $users = User::get();
        $data = [
            'remboursements' => $remboursement,
            'users' => $users,
            'rubriques' => $rubriques,
        ];
        return view('remboursement.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $remboursement = Remboursement::find($id);
        $credits = Credit::get();
        $data = [
            'title' => $des = 'Modifier Un remboursement',
            'description' => $des,
            'credits' => $credits,
            'remboursement' => $remboursement,

        ];
        return view('remboursement.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'designation' => 'required',
            'credit_id' => 'required',
            'montant' => 'required',
            'date_remboursement' => 'required',
            'feuille' => 'required|file|mimes:pdf',
        ]);

        $remboursement = Remboursement::find($id);

        $remboursement->designation = $request->designation;
        $remboursement->credit_id = $request->credit_id;
        $remboursement->montant = $request->montant;
        $remboursement->date_remboursement = $request->date_remboursement;



        if (file_exists($request->feuille)) {
            // Store the PDF file in storage/app/public directory
            $pdfPath = $request->file('feuille')->store();
            // Save the PDF file path to the database
            $remboursement->feuille = $pdfPath;
        } else {
            $remboursement->feuille = "NULL";
        }

        $remboursement->save();

        // Redirect back with a success message
        return redirect()->route('remboursement.show')->with('success', 'Remboursement enregistré avec succes.');
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
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $remboursement = Remboursement::find($id);
        if (!$remboursement->approuve) {
            $remboursement->delete();
            Storage::delete('app/', $remboursement->feuille);
            return back()->withSuccess('Suppression avec succes.');
        }
        return back()->withError('Vous ne pouvez pas supprimer cet remboursement.');
    }

    public function getRemainingBalance($id)
    {
    $credit = Credit::findOrFail($id);
    $remainingBalance = $credit->montant - $credit->remboursements()->sum('montant');
    return response()->json(floatval($remainingBalance));
    }


}
