<?php

namespace App\Http\Controllers;

use App\Models\Adherent;
use App\Models\Depense;
use App\Models\Document;
use App\Models\Recette;
use App\Models\Rubrique;
use App\Models\Credit;
use App\Models\Remboursement;
use App\Models\Solde;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class ChartsController extends Controller
{

    public $selectedYear;
    public function __construct()
    {
        $this->selectedYear = Carbon::now()->year;
    }
    public function chart(Request $request)
    {
        $this->selectedYear = request('year');
        if (!$this->selectedYear) {

            $this->selectedYear = Carbon::now()->year;
        }
        // Fetch the recette and depense rubrique data
        $recetteRubrique = $this->recetteRubrique();
        $depenseRubrique = $this->depenseRubrique();
        // Prepare the chart data
        $data = [
            // 'solde' => $this->soldeStatistics(),
            'recetteRubrique' => $recetteRubrique,
            'depenseRubrique' => $depenseRubrique,
            'counts' => $this->count(),
            'total' => $this->getTotalDepencesAndRecettes(),
            'selectedYear' => $this->selectedYear,
            'years' => $this->years(),
            'categories' => $this->adherentBycategory(),
        ];

        // Pass the chart data to the view
        return view('home', compact('data'));
    }

    public function getTotalDepencesAndRecettes()
    {
        // Revenue $
        $totalRevenue = Recette::whereYear('created_at', $this->selectedYear)->sum('montant');
        $totalRevenue += Remboursement::whereYear('created_at', $this->selectedYear)->sum('montant');

        // Expenses $
        $totalExpenses = Depense::whereYear('created_at', $this->selectedYear)->sum('montant');
        $totalExpenses += Credit::whereYear('created_at', $this->selectedYear)->sum('montant');

        return compact('totalExpenses', 'totalRevenue');
    }

    // public function soldeStatistics()
    // {
    //     // Fetch the solde data for the current year
    //     $soldeData = Solde::whereYear('annee', $this->selectedYear)->orderBy('annee')->get();

    //     // Extract the years, caisse, and banque values from the data
    //     $years = $soldeData->pluck('annee');
    //     $caisseValues = $soldeData->pluck('caisse');
    //     $banqueValues = $soldeData->pluck('banque');

    //     // Get the latest caisse and banque values
    //     $latestSolde = Solde::whereYear('annee', $this->selectedYear)->orderBy('annee', 'desc')->first();
    //     $latestCaisse = $latestSolde->caisse;
    //     $latestBanque = $latestSolde->banque;

    //     $data = [
    //         'years' => $years,
    //         'caisseValues' => $caisseValues,
    //         'banqueValues' => $banqueValues,
    //         'latestCaisse' => $latestCaisse,
    //         'latestBanque' => $latestBanque,
    //     ];

    //     // Pass the data to the view
    //     return $data;
    // }
    public function recetteRubrique()
    {
        $rubriques = Rubrique::where('for', false)->get();
        $data = [];
        foreach ($rubriques as $rubrique) {
            if ($rubrique->libelle !== 'Augmentation de la banque') {
                $amount = Recette::whereYear('created_at', $this->selectedYear)->where('rubrique_id', $rubrique->id)->where('approuve', true)->sum('montant');
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
            $amount = Depense::whereYear('created_at', $this->selectedYear)->where('rubrique_id', $rubrique->id)->where('approuve', true)->sum('montant');
            $data[] = ['label' => $rubrique->libelle, 'amount' => $amount];
        }
        return $data;
    }

    public function count()
    {
        $numberOfRecettes = Recette::where('approuve', true)->whereYear('created_at', $this->selectedYear)->count();
        $numberOfDepenses = Depense::where('approuve', true)->whereYear('created_at', $this->selectedYear)->count();
        $numberOfCredits = Credit::where('approuve', true)->whereYear('created_at', $this->selectedYear)->count();
        $numberOfRembourssements = Remboursement::where('approuve', true)->whereYear('created_at', $this->selectedYear)->count();
        $numberOfDocuments = Document::whereYear('created_at', $this->selectedYear)->count();
        $numberOfAdherents = Adherent::whereYear('created_at', $this->selectedYear)->count();

        $credits = Credit::where('approuve', true)->whereYear('created_at', $this->selectedYear)->get();
        $completeCredits = 0;
        $incompleteCredits = 0;
        foreach ($credits as $credit) {
            $remainingBalance = $credit->montant - $credit->remboursements()->sum('montant');
            if ($remainingBalance == 0) {
                $completeCredits++;
            } else {
                $incompleteCredits++;
            }
        }

        $solde = Solde::where('annee', $this->selectedYear)->first();
        $banqueSolde = $solde->banque;
        $caisseSolde = $solde->caisse;

        $data = compact(
            'numberOfRecettes',
            'completeCredits',
            'incompleteCredits',
            'numberOfDepenses',
            'numberOfCredits',
            'numberOfRembourssements',
            'numberOfDocuments',
            'numberOfAdherents',
            'banqueSolde',
            'caisseSolde'
        );

        return $data;
    }
    public function years()
    {
        return Solde::pluck('annee')->sort()->toArray();
    }
    public function adherentBycategory()
    {

        $categories = Adherent::join('categories', 'adherents.categorie_id', '=', 'categories.id')
            ->select('categories.libelle', DB::raw('COUNT(*) as count'))
            ->groupBy('categories.libelle')
            ->pluck('count', 'libelle');
        return  $categories;
    }

    public function generatePDF()
    {
        // Fetch the recette and depense data
        $recetteData = $this->recetteRubrique();
        $depenseData = $this->depenseRubrique();
        // Create the PDF
        $pdf = new Dompdf();
        $numberOfAdherents = Adherent::whereYear('created_at', $this->selectedYear)->count();
        // Pass the data to the view file
        $data = [
            'recetteData' => $recetteData,
            'depenseData' => $depenseData,
            'year' => $this->selectedYear,
            'numberOfAdherents' => $numberOfAdherents,
        ];

        // Load the view file containing the table HTML
        $html = view('pdf.report', $data)->render();

        // Load the HTML into Dompdf
        $pdf->loadHtml($html);

        // Set paper size and orientation (optional)
        $pdf->setPaper('A4', 'portrait');

        // Render the PDF
        $pdf->render();

        // Generate a unique filename for the PDF
        $filename = 'rapport_financier_pour_' . $this->selectedYear . '_' . uniqid() . '.pdf';

        // Create the response with PDF content
        $response = Response::make($pdf->output(), 200);

        // Set the appropriate headers for PDF download
        $response->header('Content-Type', 'application/pdf');
        $response->header('Content-Disposition', 'attachment; filename="' . $filename . '"');

        return $response;
    }
}
