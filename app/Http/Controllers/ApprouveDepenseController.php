<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use App\Models\Rubrique;
use App\Models\Solde;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApprouveDepenseController extends Controller
{
    public function index()
    {
        // Get all rubriques where 'for' column is true
        $rubriques = Rubrique::where('for', true)->get();
        // Get all users
        $users = User::get();
        // Get all invalid depenses (where 'approuve' column is false)
        $depensesInvalide = Depense::where('approuve', false)->get();

        // Create an array of data to be passed to the view
        $data = [
            'depensesInvalide' => $depensesInvalide,
            'users' => $users,
            'rubriques' => $rubriques,
        ];

        // Load the 'approuve.showDepense' view with the data
        return view('approuve.showDepense', $data);
    }

    public function approved($id)
    {
        // Find the Depense with the given $id
        $depense = Depense::find($id);
        // Set 'approuve' column to true
        $depense->approuve = true;

        // Get the Solde with id "1"
        $solde = Solde::where('annee',date('Y'))->get()->first();

        // Check the mode of payment for the Depense
        if ($depense->modepaiement == "1") {

            // Subtract the Depense amount from the bank balance
            $solde->banque -= $depense->montant;
        } else {
            
            // Subtract the Depense amount from the cash balance
            $solde->caisse -= $depense->montant;
        }

        // Save the Solde and Depense changes to the database
        $solde->save();
        $depense->save();

        // Redirect to the same page with a success message
        return back()->withSuccess('La depense approuvé avec succès.');
    }

    public function destroy($id)
    {
        // Find the Depense with the given $id
        $depense = Depense::find($id);
        // Delete the Depense from the database
        $depense->delete();
        // Delete the file associated with the Depense from the storage
        Storage::delete('app/', $depense->feuille);

        // Redirect back to the same page with a success message
        return back()->withSuccess('Dépense annulée avec succès.');
    }
}
