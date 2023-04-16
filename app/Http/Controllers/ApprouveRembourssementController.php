<?php

namespace App\Http\Controllers;
use App\Models\Rembourssement;
use App\Models\Credit;
use Illuminate\Http\Request;
use App\Models\Solde;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ApprouveRembourssementController extends Controller
{
    public function index()
    {
        // Get all rubriques where 'for' column is true
        $credits = Credit::get();
        // Get all users
        $users = User::get();
        // Get all invalid depenses (where 'approuve' column is false)
        $rembourssementsInvalide = Rembourssement::where('approuve', false)->get();

        // Create an array of data to be passed to the view
        $data = [
            'rembourssementsInvalide' => $rembourssementsInvalide,
            'users' => $users,
            'credits' => $credits,
        ];

        // Load the 'approuve.showDepense' view with the data
        return view('approuve.showRembourssement', $data);
    }

    public function approved($id)
    {
        // Find the Depense with the given $id
        $rembourssement = Rembourssement::find($id);
        // Set 'approuve' column to true
        $rembourssement->approuve = true;

        // Get the Solde with id "1"
        $solde = Solde::where('annee',date('Y'))->get()->first();
        // Subtract the rembourssement amount from the bank balance
        $solde->banque += $rembourssement->montant;
        // Save the Solde and rembourssement changes to the database
        $solde->save();
        $rembourssement->save();
        // Redirect to the same page with a success message
        return redirect()->route('approuve.rembourssement.show')->withSuccess('Le Rembourssement approuvé avec succès.');
    }

    public function destroy($id)
    {
        // Find the Depense with the given $id
        $rembourssement = Rembourssement::find($id);
        // Delete the rembourssement from the database
        $rembourssement->delete();
        // Delete the file associated with the rembourssement from the storage
        Storage::delete('app/', $rembourssement->feuille);

        // Redirect back to the same page with a success message
        return back()->withSuccess('Rembourssement annulée avec succès.');
    }
}
