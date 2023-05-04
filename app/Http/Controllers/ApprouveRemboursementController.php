<?php

namespace App\Http\Controllers;
use App\Models\Remboursement;
use App\Models\Credit;
use Illuminate\Http\Request;
use App\Models\Solde;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ApprouveRemboursementController extends Controller
{
    public function index()
    {
        // Get all rubriques where 'for' column is true
        $credits = Credit::get();
        // Get all users
        $users = User::get();
        // Get all invalid depenses (where 'approuve' column is false)
        $remboursementsInvalide = Remboursement::where('approuve', false)->get();

        // Create an array of data to be passed to the view
        $data = [
            'remboursementsInvalide' => $remboursementsInvalide,
            'users' => $users,
            'credits' => $credits,
        ];

        // Load the 'approuve.showRemboursement' view with the data
        return view('approuve.showRemboursement', $data);
    }

    public function approved($id)
    {
        // Find the Depense with the given $id
        $remboursement = Remboursement::find($id);
        // Set 'approuve' column to true
        $remboursement->approuve = true;

        // Get the Solde with id "1"
        $solde = Solde::where('annee',date('Y'))->get()->first();
        // Subtract the remboursement amount from the bank balance
        $solde->banque += $remboursement->montant;
        // Save the Solde and remboursement changes to the database
        $solde->save();
        $remboursement->save();
        // Redirect to the same page with a success message
        return redirect()->route('approuve.remboursement.show')->withSuccess('Le remboursement approuvé avec succès.');
    }

    public function destroy($id)
    {
        // Find the Depense with the given $id
        $remboursement = Remboursement::find($id);
        // Delete the remboursement from the database
        $remboursement->delete();
        // Delete the file associated with the remboursement from the storage
        Storage::delete('app/', $remboursement->feuille);

        // Redirect back to the same page with a success message
        return back()->withSuccess('remboursement annulée avec succès.');
    }
}
