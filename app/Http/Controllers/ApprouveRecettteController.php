<?php

namespace App\Http\Controllers;

use App\Models\Recette;
use App\Models\Rubrique;
use App\Models\Solde;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApprouveRecettteController extends Controller
{
    public function index()
    {
        $rubriques = Rubrique::where('for', true)->get();
        $users = User::get();
        $recettesInvalide = Recette::where('approuve', false)->get();
        $data = [
            'recettesInvalide' => $recettesInvalide,
            'users' => $users,
            'rubriques' => $users,
        ];
        return view('approuve.showRecette', $data);
    }
    public function approved($id)
    {
        $recette = Recette::find($id);
        $recette->approuve = true;
        $solde = Solde::where('annee',date('Y'))->first();
        if ($recette->modepaiement == "1") {
            $solde->banque += $recette->montant;
        } else  $solde->caisse += $recette->montant;
        $solde->save();
        $recette->save();
        return back()->withSuccess('La recette aprouvé avec succes.');
    }


    public function destroy($id)
    {
        $recette = Recette::find($id);
        $recette->delete();
        Storage::delete('app/', $recette->feuille);
        return back()->withSuccess('Recette annulé avec succes.');
    }
}
