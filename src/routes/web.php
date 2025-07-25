<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\ContactsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact/thanks', function(){
    return view('contacts.thanks');
})->name('contacts.thanks');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [ContactController::class,'index'])->name('admin.index');
    Route::delete('/admin/contacts/{id}',[ContactController::class, 'destroy'])->name('admin.contacts.destroy');
    Route::get('/admin/contacts/export', [ContactController::class, 'export'])->name('admin.contacts.export');

    });
Route::get('/contact', [ContactsController::class, 'create'])->name('contacts.create');
Route::post('/contact/confirm', [ContactsController::class, 'confirm'])->name('contacts.confirm');
Route::post('/contact/store', [ContactsController::class, 'store'])->name('contacts.store');
