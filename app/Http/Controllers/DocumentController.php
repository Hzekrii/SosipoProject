<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Solde;
use App\Models\type_courrier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $Type_courriers = type_courrier::get();
        $data = ['types' => $Type_courriers];
        return view('document.add', $data);
    }

    public function show()
    {
        $documents = Document::get();
        $type_courriers = type_courrier::get();
        $users = User::get();
        $data = [
            'documents' => $documents,
            'users' => $users,
            'types' => $type_courriers,
        ];
        return view('document.show', $data);
    }

    public function add(Request $request)
    {
        $request->validate([
            'feuille' => 'required|mimes:pdf',
            'designation' => 'required|max:1000',
        ]);

        $document = new Document;
        $document->designation = $request->designation;
        $document->nature = $request->nature;
        $document->type_courrier_id = $request->type;
        $document->user_id = auth()->id();
        // Store the PDF file in storage/app/public directory
        $pdfPath = $request->file('feuille')->store();
        // Save the PDF file path to the database
        $document->feuille = $pdfPath;
        $document->save();
        // Redirect back with a success message
        return redirect('document/show')->with('success', 'document enregistre avec succes.');
    }


    public function edit($id)
    {
        $Type_courriers = type_courrier::get();
        $document = Document::find($id);
        $data = [
            'document' => $document,
            'types' => $Type_courriers,
        ];
        return view('document.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'montant' => 'numeric',
            'feuille' => 'mimes:pdf',
            'designation' => 'required|max:1000',
        ]);

        $document = Document::find($id);

        $document->designation = $request->designation;
        $document->nature = $request->nature;
        $document->Type_courrier_id = $request->Type_courrier;
        $document->user_id = auth()->id();

        if (file_exists($request->feuille)) {
            // Store the PDF file in storage/app/public directory
            $pdfPath = $request->file('feuille')->store();
            // Save the PDF file path to the database
            $document->feuille = $pdfPath;
        } else {
            $document->feuille = "NULL";
        }

        $document->save();

        // Redirect back with a success message
        return redirect()->route('document.show')->with('success', 'document enregistré avec succes.');
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

    public function destroy($id)
    {
        $document = Document::find($id);
        $document->delete();
        Storage::delete('app/', $document->feuille);
        return back()->withSuccess('Supprimer avec succes.');
    }
}
