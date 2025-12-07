<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\InvoiceController;

// Redirect root → login
Route::get('/', function () {
    return redirect()->route('login');
});

// ---------------------------
// AUTH ROUTES (guest only)
// ---------------------------
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Logout (only authenticated users)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ---------------------------
// PROTECTED ROUTES (auth required)
// ---------------------------
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [CarController::class, 'dashboard'])->name('dashboard');

    // Cars
    Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
    Route::get('/cars/create', [CarController::class, 'create'])->name('cars.create');
    Route::post('/cars', [CarController::class, 'store'])->name('cars.store');
    Route::get('/cars/filter', [CarController::class, 'filter'])->name('cars.filter');
    Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');
    Route::get('/cars/{car}/edit', [CarController::class, 'edit'])->name('cars.edit');
    Route::put('/cars/{car}', [CarController::class, 'update'])->name('cars.update');
    Route::delete('/cars/{car}', [CarController::class, 'destroy'])->name('cars.destroy');

    // Clients
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
    Route::get('clients/filter', [ClientController::class, 'filter'])->name('clients.filter');
    Route::get('/clients/show', [ClientController::class, 'showClients'])->name('clients.show');
    Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');
    Route::put('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');
    Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');
    Route::get('/clients/{client}/history', [ClientController::class, 'history'])->name('clients.history');

    // Purchases
    Route::resource('purchases', PurchaseController::class);

    // Transactions
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');

    // Invoices


    Route::get('/settings/invoice', [SettingController::class, 'invoice'])->name('settings.invoice');
Route::post('/settings/invoice', [SettingController::class, 'storeInvoiceSettings'])->name('settings.invoice.store');
Route::get('/invoice-settings', [InvoiceSettingController::class, 'edit'])->name('invoice.settings');
Route::post('/invoice-settings', [InvoiceSettingController::class, 'update'])->name('invoice.settings.update');
Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
Route::post('/invoices', [InvoiceController::class, 'store'])->name('invoices.store');
// Download invoice
Route::get('/invoices/{purchase}/download', [InvoiceController::class, 'download'])->name('invoices.download');
Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
Route::get('/invoices/show', [InvoiceController::class, 'create'])->name('invoices.show');

    Route::post('/invoices', [InvoiceController::class, 'store'])->name('invoices.store');

    Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('/invoices/{invoice}/show', [InvoiceController::class, 'show'])->name('invoices.show');
    Route::resource('invoices', InvoiceController::class)->except(['edit','update','destroy']);
    Route::get('invoices/download/{invoice}', [InvoiceController::class,'download'])->name('invoices.download');



});

// ---------------------------
// ADMIN ROUTES
// ---------------------------
Route::middleware(['auth','admin'])->group(function(){
    Route::get('/users', [UserController::class,'index'])->name('users.index');
    Route::delete('/users/{user}', [UserController::class,'destroy'])->name('users.destroy');
});