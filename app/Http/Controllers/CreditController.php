<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Credit;
use App\Models\User;
use App\Models\Adherent;
use App\Models\Rembourssement;
use App\Models\Solde;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
class CreditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    
    $adherents=Adherent::get();
        $data=[  
            'title'=>$des='Ajouter Un Crédit',
            'description'=>$des,
            'adherents'=>$adherents,
        ];
        return view('credit.add',$data);
}


    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     $adherents=Adherent::get();
    //     $data=[  
    //         'title'=>$des='Ajouter Un Crédit',
    //         'description'=>$des,
    //         'adherents'=>$adherents,
    //     ];
    //     return view('credit.create',$data);
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'designation'=>'required|min:7',
            'adherent_id'=>'required',
            'montant' => 'required',
            'modepaiement' => 'required',
            'date_credit' => 'required',
            'file' => 'required|file|mimes:pdf',
            
        ]);

        $year=Carbon::createFromFormat('Y-m-d',$request->date_credit)->year;
        $solde=Solde::where('annee',$year)->pluck('id')->first();
        
        //  dd($solde);
        $credit=new Credit(); 
        $credit->adherent_id=request('adherent_id');
        $credit->designation=request('designation');
        $credit->montant=request('montant');
        $credit->approuve=false;
        $credit->solde_id=$solde;
        $credit->modepaiement=request('modepaiement');
        $credit->date_credit=request('date_credit');
        $credit->file=request('file')->store();
        $credit->save();
        $success = "Ajout avec success";
        return back()->withSuccess($success);
        
        }
        
    /**
     * Display the specified resource.
     */
    public function show(Credit $credit)
    {
        $sommes = Rembourssement::selectRaw('credit_id, SUM(montant) as sum')
                          ->where('approuve',1)
                          ->groupBy('credit_id')
                          ->get();
   
        $credits = Credit::simplePaginate(5);

        $restes = array();
        foreach($credits as $credit) {
            $restes[] = [
                'credit' => $credit->id,
                'reste' => $credit->montant - ($sommes->where('credit_id', $credit->id)->first()->sum ?? 0),
            ];
        }
        
        $users = User::get();
        $data = [
            'credits' => $credits,
            'users' => $users,
            'restes' => $restes,
        ];
        return view('credit.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    
    public function edit($id)
    {
        $credit = Credit::find($id);
        $adherents=Adherent::get(); 
        $data=[
            'title'=>$des='Modifier Un Crédit',
            'description'=>$des,
            'credit'=>$credit,
            'adherents'=>$adherents,
        ];
        return view('credit.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'designation'=>'required|min:7',
            'adherent_id'=>'required',
            'montant' => 'required',
            'modepaiement' => 'required',
            'date_credit' => 'required',
            'file' => 'required|file|mimes:pdf',
        ]);
        $solde = Solde::find("1");
        
        if ($request->modepaiement == "1") {
            if ($solde->banque - $request->montant < 0)
                return back()->withError('Solde banque insuffisant.');
        } else {
            if ($solde->caisse - $request->montant < 0)
                return back()->withError('Solde caisse insuffisant.');
        }
        $credit = Credit::find($id);
        // Check if Depense has been approved
        if ($credit->approuve && $request->montant != $credit->montant) {
            return back()->withError("We don't do that here.");
        }
        $credit->designation = $request->designation;
        $credit->montant = $request->montant;
        $credit->modepaiement = $request->modepaiement;
        $credit->adherent_id = $request->adherent_id;
        $credit->date_credit = $request->date_credit;
        $credit->approuve=$credit->approuve;
            
        // $credit->user_id = auth()->id();

        if (file_exists($request->file)) {
            // Store the PDF file in storage/app/public directory
            $pdfPath = $request->file('file')->store();
            // Save the PDF file path to the database
            $credit->file = $pdfPath;
        } else {
            $credit->file = "NULL";
        }

        $credit->save();

        // Redirect back with a success message
        return redirect()->route('credit.show')->with('success', 'Credit enregistré avec succes.');
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
        
        $credit = credit::find($id);
        if (!$credit->approuve) {
            $credit->delete();
            Storage::delete('app/', $credit->file);
            return back()->withSuccess('Suppression avec succes.');
        }
        return back()->withError('Vous ne pouvez pas supprimer cet credit.');

    }
    public function afficher(Credit $credit){
        $pdf = $credit->file;
        // dd($pdf);
        if ($pdf) {
            $pathToFile = storage_path("app/{$pdf}");
            $headers = [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="credit'.$credit->id.'-credit-file.pdf"',
            ];
            return response()->file($pathToFile, $headers);
            // dd($pathToFile);
        } else {
            return abort(404);
        }
    }
}
?>