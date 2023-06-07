<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Models\Adherent;
use Illuminate\Http\Request;
use App\Models\Solde;
use App\Models\Rubrique;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ApprouveCreditController extends Controller
{
    public function index()
    {
        // Get all rubriques where 'for' column is true
        $rubriques = Rubrique::where('for', true)->get();
        // Get all users
        $users = User::get();
        // Get all invalid depenses (where 'approuve' column is false)
        $creditsInvalide = Credit::where('approuve', false)->get();

        // Create an array of data to be passed to the view
        $data = [
            'creditsInvalide' => $creditsInvalide,
            'users' => $users,
            'rubriques' => $rubriques,
        ];

        // Load the 'approuve.showDepense' view with the data
        return view('approuve.showCredit', $data);
    }

    public function approved($id)
    {
        // Find the Depense with the given $id
        $credit = Credit::find($id);
        // Set 'approuve' column to true
        $credit->approuve = true;

        // Get the Solde with id "1"
        $solde = Solde::where('annee', date('Y'))->get()->first();

        // Check the mode of payment for the Depense
        if ($credit->modepaiement == "1") {

            // Subtract the credit amount from the bank balance

            $solde->banque -= $credit->montant;
        } else {

            // Subtract the credit amount from the cash balance
            $solde->caisse -= $credit->montant;
        }

        // Save the Solde and credit changes to the database
        $solde->save();
        $credit->save();

        // Redirect to the same page with a success message
        return back()->withSuccess('Le Crédit approuvé avec succès.');
    }

    public function destroy($id)
    {
        // Find the Depense with the given $id
        $credit = Credit::find($id);
        // Delete the credit from the database
        $credit->delete();
        // Delete the file associated with the credit from the storage
        Storage::delete('app/', $credit->file);

        // Redirect back to the same page with a success message
        return back()->withSuccess('Crédit annulée avec succès.');
    }
}
