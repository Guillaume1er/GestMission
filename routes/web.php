<?php

use App\Http\Controllers\BanqueController;
use App\Http\Controllers\interventionController;
use App\Http\Controllers\marqueController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\responsableinterventionController;
use App\Http\Controllers\typeinterventionController;
use App\Http\Controllers\TypevehiculeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehiculeController;
use App\Models\typeintervention;
use Illuminate\Support\Facades\Route;

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
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('layouts/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->prefix('marque')->group(function () {
    Route::get('/liste', [marqueController::class, 'index'])->name('marques');
    Route::post('/create', [marqueController::class, 'store'])->name('create-marque');
    Route::get('/show:id', [marqueController::class, 'show'])->name('show-marque');
    Route::post('/update:id', [marqueController::class, 'update'])->name('update-marque');
    Route::post('/delete:id', [marqueController::class, 'delete'])->name('delete-marque');
});

Route::middleware('auth')->prefix('banque')->group(function () {
    Route::get('/liste', [BanqueController::class, 'index'])->name('banques');
    Route::post('/create', [BanqueController::class, 'store'])->name('create-banque');
    Route::get('/show:id', [BanqueController::class, 'show'])->name('show-banque');
    Route::post('/update:id', [BanqueController::class, 'update'])->name('update-banque');
    Route::post('/delete:id', [BanqueController::class, 'delete'])->name('delete-banque');
});

Route::middleware('auth')->prefix('type-vehicule')->group(function () {
    Route::get('/liste', [TypevehiculeController::class, 'index'])->name('types-vehicule');
    Route::post('/create', [TypevehiculeController::class, 'store'])->name('create-type-vehicule');
    Route::get('/show:id', [TypevehiculeController::class, 'show'])->name('show-type-vehicule');
    Route::post('/update:id', [TypevehiculeController::class, 'update'])->name('update-type-vehicule');
    Route::post('/delete:id', [TypevehiculeController::class, 'delete'])->name('delete-type-vehicule');
});

Route::middleware('auth')->prefix('vehicule')->group(function () {
    Route::get('/liste', [VehiculeController::class, 'index'])->name('vehicules');
    Route::post('/create', [VehiculeController::class, 'store'])->name('create-vehicule');
    Route::get('/show:id', [VehiculeController::class, 'show'])->name('show-vehicule');
    Route::post('/update:id', [VehiculeController::class, 'update'])->name('update-vehicule');
    Route::post('/delete:id', [VehiculeController::class, 'delete'])->name('delete-vehicule');
});

Route::middleware('auth')->prefix('type-intervention')->group(function () {
    Route::get('/liste', [typeinterventionController::class, 'index'])->name('types-intervention');
    Route::post('/create', [typeinterventionController::class, 'store'])->name('create-type-intervention');
    Route::get('/show:id', [typeinterventionController::class, 'show'])->name('show-type-intervention');
    Route::post('/update:id', [typeinterventionController::class, 'update'])->name('update-type-intervention');
    Route::post('/delete:id', [typeinterventionController::class, 'delete'])->name('delete-type-intervention');
});

Route::middleware('auth')->prefix('responsable-intervention')->group(function () {
    Route::get('/liste', [responsableinterventionController::class, 'index'])->name('responsables-intervention');
    Route::post('/create', [responsableinterventionController::class, 'store'])->name('create-responsable-intervention');
    Route::get('/show:id', [responsableinterventionController::class, 'show'])->name('show-responsable-intervention');
    Route::post('/update:id', [responsableinterventionController::class, 'update'])->name('update-responsable-intervention');
    Route::post('/delete:id', [responsableinterventionController::class, 'delete'])->name('delete-responsable-intervention');
});

Route::middleware('auth')->prefix('intervention')->group(function () {
    Route::get('/liste', [interventionController::class, 'index'])->name('interventions');
    Route::post('/create', [interventionController::class, 'store'])->name('create-intervention');
    Route::get('/show:id', [interventionController::class, 'show'])->name('show-intervention');
    Route::post('/update:id', [interventionController::class, 'update'])->name('update-intervention');
    Route::post('/delete:id', [interventionController::class, 'delete'])->name('delete-intervention');
});

Route::middleware('auth')->prefix('exercice-budgetaire')->group(function () {
    Route::get('/liste', [interventionController::class, 'index'])->name('exercices-budgetaire');
    Route::post('/create', [interventionController::class, 'store'])->name('create-exercice-budgetaire');
    Route::get('/show:id', [interventionController::class, 'show'])->name('show-exercice-budgetaire');
    Route::post('/update:id', [interventionController::class, 'update'])->name('update-exercice-budgetaire');
    Route::post('/delete:id', [interventionController::class, 'delete'])->name('delete-exercice-budgetaire');
});

Route::middleware('auth')->prefix('utilisateur')->group(function () {
    Route::get('/liste', [userController::class, 'index'])->name('users');
    Route::post('/create', [UserController::class, 'store'])->name('create-user');
    Route::get('/show:id', [UserController::class, 'show'])->name('show-user');
    Route::post('/update:id', [UserController::class, 'update'])->name('update-user');
    Route::post('/delete:id', [UserController::class, 'delete'])->name('delete-user');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
