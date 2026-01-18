<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Http\Middleware\roleMiddleware;
use App\Http\Controllers\loginController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\animateController;
use App\Http\Controllers\bukuController;
use App\Http\Controllers\kategoriController;
use App\Http\Controllers\restockController;
use App\Http\Controllers\supplierController;
use App\Http\Controllers\transactionController;
use App\Models\Buku;

Route::post('/logout', [loginController::class, 'logout'])->name('logout');
Route::get('/login', [loginController::class, 'ShowLoginForm'])->name('login');
Route::post('/login', [loginController::class, 'login'])->name('login.process');
Route::get('/home', [dashboardController::class, 'home'])->name('dashboard');
Route::get('/indexAdm', [dashboardController::class, 'indexAdm'])->name('indexAdm');
Route::get('/', function () {
    return redirect('/home');
});

Route::get('/animeView', [animateController::class, 'animeView'])->name('animateFiction');
Route::get('/viewFiksi', [bukuController::class, 'viewFiksi'])->name('fiksiFun');
Route::get('/history', [bukuController::class, 'history'])->name('history');
Route::get('/misteri', [bukuController::class, 'misteri'])->name('misteri');
Route::get('/novel', [bukuController::class, 'novel'])->name('novel');


Route::get('/animate', [bukuController::class, 'animate'])->name('animate');
Route::get('/fiksi', [bukuController::class, 'fiksi'])->name('fiksi');
Route::get('/sejarah', [bukuController::class, 'sejarah'])->name('sejarah');
Route::get('/mistery', [bukuController::class, 'mistery'])->name('mistery');
Route::get('/novels', [bukuController::class, 'novels'])->name('novels');



Route::middleware(['auth', 'role:admin'])->group(function (){
    Route::get('/viewProducts', [bukuController::class, 'viewProducts'])->name('products');
    Route::post('/storeBook', [bukuController::class, 'store'])->name('storeBook');
    Route::get('/addProduct', [bukuController::class, 'create'])->name('addProduct');
    Route::get('/viewUpdate/{isbn}', [bukuController::class, 'viewUpdate'])->name('updated');
    Route::put('/update/{isbn}', [bukuController::class, 'update'])->name('update');
    Route::delete('/destroy/{isbn}', [bukuController::class, 'destroy'])->name('destroy');

    Route::get('/addTrans', [transactionController::class, 'addTrans'])->name('addTrans');
    Route::get('/viewTrans', [transactionController::class, 'viewTrans'])->name('viewTrans');
    Route::get('/invoice/{id}', [transactionController::class, 'invoice'])->name('invoice');
    Route::post('/storeTrans', [transactionController::class, 'storeTrans'])->name('TransactStore');
 
    Route::get('/create', [supplierController::class, 'create'])->name('create');
    Route::get('/viewSup', [supplierController::class, 'viewSup'])->name('view.supp');
    Route::post('/stores', [supplierController::class, 'stores'])->name('storeSupp');
    Route::post('/update/{siup}', [supplierController::class, 'update'])->name('update.supp');

    Route::get('/index', [kategoriController::class, 'index'])->name('index.kat');
    Route::post('/addKategori', [kategoriController::class, 'addKategori'])->name('addKategori');

    Route::get('/menu', [restockController::class, 'menu'])->name('menu');
    Route::get('/formReq', [restockController::class, 'formReq'])->name('formReq');
    Route::get('/viewRest', [restockController::class, 'viewRest'])->name('viewRest');
    Route::post('/store', [restockController::class, 'store'])->name('storeRest');
    Route::get('/invoiceReq/{id}', [restockController::class, 'invoiceReq'])->name('invoiceReq');
    Route::get('/viewApproved', [restockController::class, 'viewApproved'])->name('viewApproved');
    Route::post('/updateStatus/{restock}', [restockController::class, 'updateStatus'])->name('updateStatus');
    Route::get('/recent', [restockController::class, 'recent'])->name('recent');
    Route::post('/accepted/{restock}', [restockController::class, 'accepted'])->name('accepted');
    Route::get('/restock/{id}/email', [restockController::class, 'sendGmail'])->name('restock.email');

    Route::get('/buku/price/{isbn}', function($isbn){
        return \App\Models\Buku::where('isbn', $isbn)->select('price')->firstOrFail();
    });
});