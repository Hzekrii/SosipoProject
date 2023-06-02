<?php

use App\Http\Controllers\AdherentController;
use App\Http\Controllers\ApprouveRecettteController;
use App\Http\Controllers\ApprouveDepenseController;
use App\Http\Controllers\ApprouveCreditController;
use App\Http\Controllers\ApprouveremboursementController;
use App\Http\Controllers\ChartsController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\remboursementController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FunctionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RecetteController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Models\Credit;
use App\Models\remboursement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;


Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/home');
    } else {
        return view('auth.login');
    }
})->name('login')->middleware('preventBackHistory');



Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/login', [LoginController::class, 'check'])->name('check');
Route::post('/register', [RegisterController::class, 'register'])->name('post.register');

Route::middleware('auth')->group(function () {
    /* User */
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/user/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/update', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/destroy', [UserController::class, 'destroy'])->name('user.destroy');

    /* end User */

    /* Start Recettes */

    Route::middleware(['president'])->group(function () {

        /* Start approuve Recette*/
        Route::get('/approuve/recette/show', [ApprouveRecettteController::class, 'index'])->name('approuve.recette.show');
        Route::get('/approuve/recette/{id}', [ApprouveRecettteController::class, 'approved'])->name('approuve.recette.post');
        Route::delete('/approuve/recette/delete/{id}', [ApprouveRecettteController::class, 'destroy'])->name('approuve.recette.cancel');
        /* End approuve Recette*/

        /* Start approuve Depense*/
        Route::get('/approuve/depense/show', [ApprouveDepenseController::class, 'index'])->name('approuve.depense.show');
        Route::post('/approuve/depense/{id}', [ApprouveDepenseController::class, 'approved'])->name('approuve.depense.post');
        Route::delete('/approuve/depense/delete/{id}', [ApprouveDepenseController::class, 'destroy'])->name('approuve.depense.cancel');
        /* End approuve Depense*/

        /* Start approuve credit*/
        Route::get('/approuve/credit/show', [ApprouveCreditController::class, 'index'])->name('approuve.credit.show');
        Route::post('/approuve/credit/{id}', [ApprouveCreditController::class, 'approved'])->name('approuve.credit.post');
        Route::delete('/approuve/credit/delete/{id}', [ApprouveCreditController::class, 'destroy'])->name('approuve.credit.cancel');
        /* End approuve credit*/
        /* Start approuve user*/
        Route::get('/approuve/user/show', [UserController::class, 'inApprovedUsers'])->name('approuve.user.show');
        Route::post('/approuve/user/{id}', [UserController::class, 'approve'])->name('approuve.user.post');
        Route::delete('/approuve/user/delete/{id}', [UserController::class, 'cancelApprovment'])->name('approuve.user.cancel');
        /* End approuve user*/

        /* Start approuve Depense*/
        Route::get('/approuve/remboursement/show', [ApprouveremboursementController::class, 'index'])->name('approuve.remboursement.show');
        Route::post('/approuve/remboursement/{id}', [ApprouveremboursementController::class, 'approved'])->name('approuve.remboursement.post');
        Route::delete('/approuve/remboursement/delete/{id}', [ApprouveremboursementController::class, 'destroy'])->name('approuve.remboursement.cancel');
        /* End approuve remboursement*/
        /* Start  documents*/
        // Route::get('/document/edit/{id}', [DocumentController::class, 'edit'])->name('document.edit');
        // Route::delete('/document/delete/{id}', [DocumentController::class, 'destroy'])->name('document.delete');
        // Route::put('/document/update/{id}', [DocumentController::class, 'update'])->name('post.document.edit');
        // Route::get('/document/show', [DocumentController::class, 'show'])->name('document.show');
        // Route::get('/document/pdf/{path}', [DocumentController::class, 'viewPdf'])->name('viewPdf');
        // /*  Adherents Start  */


        Route::resource('adherents', AdherentController::class);
        // /*  Adherents End  */
        Route::resource('categories', CategorieController::class);
    });
    Route::middleware(['tresorie'])->group(function () {

        Route::get('/recette/add',  [RecetteController::class, 'create'])->name('recette.add');
        Route::post('/recette/add', [RecetteController::class, 'add'])->name('post.recette.add');
        Route::get('/depense/add',  [DepenseController::class, 'create'])->name('depense.add');
        Route::post('/depense/add', [DepenseController::class, 'add'])->name('post.depense.add');
        Route::get('/credit/add',  [CreditController::class, 'index'])->name('credit.add');
        Route::post('/credit/add', [CreditController::class, 'store'])->name('post.credit.add');
        Route::get('/remboursement/add',  [remboursementController::class, 'index'])->name('remboursement.add');
        Route::post('/remboursement/add', [remboursementController::class, 'store'])->name('post.remboursement.add');
        Route::get('/remboursement/add/credits/{id}/reste', [remboursementController::class, 'getRemainingBalance']);
    });

    Route::middleware(['isTresorieOrPresident'])->group(function () {

        /* Start add */


        /* End add */
        Route::get('/generate-pdf', [ChartsController::class, 'generatePDF'])->name('generate.financialRepport');

        /* Begin recette */
        Route::get('/recette/edit/{id}', [RecetteController::class, 'edit'])->name('recette.edit');
        Route::delete('/recette/delete/{id}', [RecetteController::class, 'destroy'])->name('recette.delete');
        Route::put('/recette/update/{id}', [RecetteController::class, 'update'])->name('post.recette.edit');
        Route::get('/recette/show', [RecetteController::class, 'show'])->name('recette.show');
        Route::get('/recette/pdf/{path}', [RecetteController::class, 'viewPdf'])->name('viewPdf');
        /* End Recettes */

        /* Start Depnses */
        Route::get('/depense/edit/{id}',     [DepenseController::class, 'edit'])->name('depense.edit');
        Route::delete('depense/delete/{id}', [DepenseController::class, 'destroy'])->name('depense.delete');
        Route::put('/depense/update/{id}', [DepenseController::class, 'update'])->name('post.depense.edit');
        Route::get('/depense/show', [DepenseController::class, 'show'])->name('depense.show');
        Route::get('/depense/pdf/{path}', [DepenseController::class, 'viewPdf'])->name('viewPdf');

        /* End Depnses */

        /* Start Credits */
        Route::get('/credit/edit/{id}',     [CreditController::class, 'edit'])->name('credit.edit');
        Route::delete('credit/delete/{id}', [CreditController::class, 'destroy'])->name('credit.delete');
        Route::put('/credit/update/{id}', [CreditController::class, 'update'])->name('post.credit.edit');
        Route::get('/credit/show', [CreditController::class, 'show'])->name('credit.show');
        Route::get('/credit/pdf/{path}', [CreditController::class, 'viewPdf'])->name('viewPdf');
        // Route::get('/credit/pdf/{credit}', [CreditController::class, 'afficher'])->name('viewPdfCr1');

        /* End Credits */

        /* Start Remboursements */
        Route::get('/remboursement/edit/{id}',     [remboursementController::class, 'edit'])->name('remboursement.edit');
        Route::delete('remboursement/delete/{id}', [remboursementController::class, 'destroy'])->name('remboursement.delete');
        Route::put('/remboursement/update/{id}', [remboursementController::class, 'update'])->name('post.remboursement.edit');
        Route::get('/remboursement/show', [remboursementController::class, 'show'])->name('remboursement.show');
        Route::get('/remboursement/pdf/{path}', [remboursementController::class, 'viewPdf'])->name('viewPdf');
        Route::get('/remboursement/add/credits/{id}/reste', [remboursementController::class, 'getRemainingBalance']);

        /* End Remboursements */
    });

    Route::middleware(['secretaire'])->group(function () {

        /* Start approuve */
        Route::get('/document/add',  [DocumentController::class, 'index'])->name('document.add');
        Route::post('/document/add', [DocumentController::class, 'add'])->name('post.document.add');
    });
    Route::get('/document/edit/{id}', [DocumentController::class, 'edit'])->name('document.edit');
    Route::delete('/document/delete/{id}', [DocumentController::class, 'destroy'])->name('document.delete');
    Route::put('/document/update/{id}', [DocumentController::class, 'update'])->name('post.document.edit');
    /* End approuve */
    Route::get('/document/show', [DocumentController::class, 'show'])->name('document.show');
    Route::get('/document/pdf/{path}', [DocumentController::class, 'viewPdf'])->name('viewPdf');





    Route::get('/home', [ChartsController::class, 'chart'])->name('charts');
});
