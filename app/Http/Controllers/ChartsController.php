<?php

namespace App\Http\Controllers;

use App\Models\Adherent;
use App\Models\Depense;
use App\Models\Document;
use App\Models\Recette;
use App\Models\Rubrique;
use App\Models\Credit;
use App\Models\Rembourssement;
use App\Models\Solde;
use Illuminate\Http\Request;

class ChartsController extends Controller
{


    public function chart()
    {

        // Fetch the recette and depense rubrique data
        $recetteRubrique = $this->recetteRubrique();
        $depenseRubrique = $this->depenseRubrique();

        // Prepare the chart data
        $data = [
            'solde' => $this->soldeStatistics(),
            'recetteRubrique' => $recetteRubrique,
            'depenseRubrique' => $depenseRubrique,
            'counts' => $this->count(),
        ];

        // Pass the chart data to the view
        return view('home', compact('data'));
    }

    public function recetteRubrique()
    {
        $rubriques = Rubrique::where('for', false)->get();
        $data = [];
        foreach ($rubriques as $rubrique) {
            if ($rubrique->libelle !== 'Augmentation de la banque') {
                $amount = Recette::where('rubrique_id', $rubrique->id)->where('approuve', true)->sum('montant');
                $data[] = ['label' => $rubrique->libelle, 'amount' => $amount];
            }
        }
        return $data;
    }
    public function depenseRubrique()
    {
        $rubriques = Rubrique::where('for', true)->get();
        $data = [];
        foreach ($rubriques as $rubrique) {
            $amount = Depense::where('rubrique_id', $rubrique->id)->where('approuve', true)->sum('montant');
            $data[] = ['label' => $rubrique->libelle, 'amount' => $amount];
        }
        return $data;
    }

    public function soldeStatistics()
    {
        // Fetch all the solde data
        $soldeData = Solde::orderBy('annee')->get();

        // Extract the years, caisse, and banque values from the data
        $years = $soldeData->pluck('annee');
        $caisseValues = $soldeData->pluck('caisse');
        $banqueValues = $soldeData->pluck('banque');

        // Get the latest caisse and banque values
        $latestSolde = Solde::orderBy('annee', 'desc')->first();
        $latestCaisse = $latestSolde->caisse;
        $latestBanque = $latestSolde->banque;
        $data = [
            'years' => $years,
            'caisseValues' => $caisseValues,
            'banqueValues' => $banqueValues,
            'latestCaisse' => $latestCaisse,
            'latestBanque' => $latestBanque,
        ];
        // Pass the data to the view
        return $data;
    }
    public function count()
    {
        $numberOfRecettes = Recette::get()->where('approuve', true)->count();
        $numberOfDepenses = Depense::get()->where('approuve', true)->count();
        $numberOfCredits = Credit::get()->where('approuve', true)->count();
        $numberOfRembourssements = Rembourssement::get()->where('approuve', true)->count();
        $numberOfDocuments = Document::get()->count();
        $numberOfAdherents = Adherent::get()->count();
        
        $solde = Solde::get()->where('annee', date('Y'))->first();
        $banqueSolde = $solde->banque;
        $caisseSolde = $solde->caisse;
        $data = compact('numberOfRecettes', 'numberOfDepenses','numberOfCredits','numberOfRembourssements', 'numberOfDocuments', 'numberOfAdherents', 'banqueSolde', 'caisseSolde');
    return $data;
    }
}
