<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Credit;
use App\Models\Solde;
use App\Models\Rembourssement;
use App\Models\Rubrique;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class RembourssementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $credits=Credit::get();
        $data=[
            'title'=>$des='Ajouter Un Remboursement',
            'description'=>$des,
            'credits'=>$credits,
        ];
       return view('rembourssement.add',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     $credits=Credit::get();
    //     $data=[
    //         'title'=>$des='Ajouter Un Remboursement',
    //         'description'=>$des,
    //         'credits'=>$credits,
    //     ];
    //     return view('remboursement.create',$data);
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'designation'=>'required|min:7',
            'credit_id'=>'required',
            'montant' => 'required',
            'date_remboursement' => 'required',
            'feuille' => 'required|file|mimes:pdf',

        ]);


        $credit=Credit::find($request->credit_id);
         
        $year=Carbon::createFromFormat('Y-m-d',$credit->date_credit)->year;
        $solde=Solde::where('annee',$year)->pluck('id')->first();
        $remboursement=new Rembourssement();
        $remboursement->credit_id=request('credit_id');
        $remboursement->designation=request('designation');
        $remboursement->montant=request('montant');
        $remboursement->approuve=false;
        $remboursement->solde_id=$solde;
        $remboursement->date_remboursement=request('date_remboursement');
        $remboursement->feuille=request('feuille')->store();
        $remboursement->save();
        $success = "Ajout avec success";
        return back()->withSuccess($success);
    }

    /**
     * Display the specified resource.
     */
    public function show(Rembourssement $remboursement)
    {
        $rembourssement = Rembourssement::get();
        $rubriques = Rubrique::where('for', true)->get();
        $users = User::get();
        $data = [
            'rembourssements' => $rembourssement,
            'users' => $users,
            'rubriques' => $rubriques,
        ];
        return view('rembourssement.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rembourssement=Rembourssement::find($id);
        $credits=Credit::get();
        $data=[
            'title'=>$des='Modifier Un Rembourssement',
            'description'=>$des,
            'credits'=>$credits,
            'rembourssement'=>$rembourssement,

        ];
        return view('rembourssement.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'designation'=>'required|min:7',
            'credit_id'=>'required',
            'montant' => 'required',
            'date_remboursement' => 'required',
            'feuille' => 'required|file|mimes:pdf',
        ]);
        // $solde = Solde::find("1");
        // if ($request->modepaiement == "1") {
        //     if ($solde->banque - $request->montant < 0)
        //         return back()->withError('Solde banque insuffisant.');
        // } else {
        //     if ($solde->caisse - $request->montant < 0)
        //         return back()->withError('Solde caisse insuffisant.');
        // }
        $rembourssement = rembourssement::find($id);
        // Check if Depense has been approved
        // if ($rembourssement->approuve && $request->montant != $rembourssement->montant) {
        //     return back()->withError("We don't do that here.");
        // }
        $rembourssement->designation=$request->designation;
        $rembourssement->credit_id=$request->credit_id;
        $rembourssement->montant = $request->montant;
        $rembourssement->date_remboursement = $request->date_remboursement;

        // $rembourssement->user_id = auth()->id();

        if (file_exists($request->feuille)) {
            // Store the PDF file in storage/app/public directory
            $pdfPath = $request->file('feuille')->store();
            // Save the PDF file path to the database
            $rembourssement->feuille = $pdfPath;
        } else {
            $rembourssement->feuille = "NULL";
        }

        $rembourssement->save();

        // Redirect back with a success message
        return redirect()->route('rembourssement.show')->with('success', 'Remboursement enregistré avec succes.');
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
    public function destroy( $id)
    {
        $rembourssement = Rembourssement::find($id);
        if (!$rembourssement->approuve) {
            $rembourssement->delete();
            Storage::delete('app/', $rembourssement->feuille);
            return back()->withSuccess('Suppression avec succes.');
        }
        return back()->withError('Vous ne pouvez pas supprimer cet rembourssement.');
    }
}
