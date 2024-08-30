<?php

use App\Http\Controllers\BanqueController;
use App\Http\Controllers\DetailMissionController;
use App\Http\Controllers\ExercicebudgetaireController;
use App\Http\Controllers\IndiceController;
use App\Http\Controllers\interventionController;
use App\Http\Controllers\LieuMissionController;
use App\Http\Controllers\marqueController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\OrganisateurController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RangController;
use App\Http\Controllers\responsableinterventionController;
use App\Http\Controllers\typeinterventionController;
use App\Http\Controllers\TypevehiculeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehiculeController;
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

// CREUD MARQUE
Route::middleware('auth')->prefix('marque')->group(function () {
    Route::get('/liste', [marqueController::class, 'index'])->name('marques');
    Route::post('/create', [marqueController::class, 'store'])->name('create-marque');
    Route::get('/show', [marqueController::class, 'show'])->name('show-marque');
    Route::get('/consulter/{id}', [marqueController::class, 'consulter'])->name('consulter-marque');
    Route::post('/update/{id}', [marqueController::class, 'update'])->name('update-marque');
    Route::get('/delete/{id}', [marqueController::class, 'delete'])->name('delete-marque');
});


// CREUD Type Banque
Route::middleware('auth')->prefix('banque')->group(function () {
    Route::get('/liste', [BanqueController::class, 'index'])->name('banques');
    Route::post('/create', [BanqueController::class, 'store'])->name('create-banque');
    Route::get('/show', [BanqueController::class, 'show'])->name('show-banque');
    Route::get('/consulter/{id}', [BanqueController::class, 'consulter'])->name('consulter-banque');
    Route::post('/update/{id}', [BanqueController::class, 'update'])->name('update-banque');
    Route::get('/delete/{id}', [BanqueController::class, 'delete'])->name('delete-banque');
});
// CREUD Type Véhicule
Route::middleware('auth')->prefix('type-vehicule')->group(function () {
    Route::get('/liste', [TypevehiculeController::class, 'index'])->name('types-vehicule');
    Route::post('/create', [TypevehiculeController::class, 'store'])->name('create-type-vehicule');
    Route::get('/show', [TypevehiculeController::class, 'show'])->name('show-type-vehicule');
    Route::get('/consulter/{id}', [TypevehiculeController::class, 'consulter'])->name('consulter-type-vehicule');
    Route::post('/update/{id}', [TypevehiculeController::class, 'update'])->name('update-type-vehicule');
    Route::get('/delete/{id}', [TypevehiculeController::class, 'delete'])->name('delete-type-vehicule');
});

// CREUD Véhicule
Route::middleware('auth')->prefix('vehicule')->group(function () {
    Route::get('/liste', [VehiculeController::class, 'index'])->name('vehicules');
    Route::post('/create', [VehiculeController::class, 'store'])->name('create-vehicule');
    Route::get('/show', [VehiculeController::class, 'show'])->name('show-vehicule');
    Route::get('/consulter/{id}', [VehiculeController::class, 'consulter'])->name('consulter-vehicule');
    Route::post('/update/{id}', [VehiculeController::class, 'update'])->name('update-vehicule');
    Route::get('/delete/{id}', [VehiculeController::class, 'delete'])->name('delete-vehicule');

    Route::get('/{vehicule}/autorisation', [VehiculeController::class, 'showAutorisationForm'])->name('vehicule.autorisation');
    Route::post('/{vehicule}/autorisation', [VehiculeController::class, 'autoriser'])->name('vehicule.autoriser');

    Route::get('/{vehicule}/desautorisation', [VehiculeController::class, 'showAutorisationForm'])->name('vehicule.desautorisation');
    Route::post('/{vehicule}/desautorisation', [VehiculeController::class, 'desautoriser'])->name('vehicule.desautoriser');
});

// CREUD Type intervention
Route::middleware('auth')->prefix('type-intervention')->group(function () {
    Route::get('/liste', [typeinterventionController::class, 'index'])->name('types-intervention');
    Route::post('/create', [typeinterventionController::class, 'store'])->name('create-type-intervention');
    Route::get('/show', [typeinterventionController::class, 'show'])->name('show-type-intervention');
    Route::get('/consulter/{id}', [typeinterventionController::class, 'consulter'])->name('consulter-type-intervention');
    Route::post('/update/{id}', [typeinterventionController::class, 'update'])->name('update-type-intervention');
    Route::get('/delete/{id}', [typeinterventionController::class, 'delete'])->name('delete-type-intervention');
});

// CREUD responsable intervention
Route::middleware('auth')->prefix('responsable-intervention')->group(function () {
    Route::get('/liste', [responsableinterventionController::class, 'index'])->name('responsables-intervention');
    Route::post('/create', [responsableinterventionController::class, 'store'])->name('create-responsable-intervention');
    Route::get('/show', [responsableinterventionController::class, 'show'])->name('show-responsable-intervention');
    Route::get('/consulter/{id}', [responsableinterventionController::class, 'consulter'])->name('consulter-responsable-intervention');
    Route::post('/update/{id}', [responsableinterventionController::class, 'update'])->name('update-responsable-intervention');
    Route::get('/delete/{id}', [responsableinterventionController::class, 'delete'])->name('delete-responsable-intervention');
});

// CREUD  intervention
Route::middleware('auth')->prefix('intervention')->group(function () {
    Route::get('/liste', [interventionController::class, 'index'])->name('interventions');
    Route::post('/create', [interventionController::class, 'store'])->name('create-intervention');
    Route::get('/show', [interventionController::class, 'show'])->name('show-intervention');
    Route::get('/consulter/{id}', [interventionController::class, 'consulter'])->name('consulter-intervention');
    Route::post('/update/{id}', [interventionController::class, 'update'])->name('update-intervention');
    Route::get('/delete/{id}', [interventionController::class, 'delete'])->name('delete-intervention');
});

// CREUD  Budgetaire
Route::middleware('auth')->prefix('exercice-budgetaire')->group(function () {
    Route::get('/liste', [ExercicebudgetaireController::class, 'index'])->name('exercices-budgetaire');
    Route::post('/create', [ExercicebudgetaireController::class, 'store'])->name('create-exercice-budgetaire');
    Route::get('/show', [ExercicebudgetaireController::class, 'show'])->name('show-exercice-budgetaire');
    Route::get('/consulter/{id}', [ExercicebudgetaireController::class, 'consulter'])->name('consulter-exercice-budgetaire');
    Route::post('/update/{id}', [ExercicebudgetaireController::class, 'update'])->name('update-exercice-budgetaire');
    Route::get('/delete/{id}', [ExercicebudgetaireController::class, 'delete'])->name('delete-exercice-budgetaire');
});

// CRED USER
Route::middleware('auth')->prefix('utilisateur')->group(function () {
    Route::get('/liste', [userController::class, 'index'])->name('users');
    Route::post('/create', [UserController::class, 'store'])->name('create-user');
    Route::get('/show', [UserController::class, 'show'])->name('show-user');
    Route::get('/consulter/{id}', [UserController::class, 'consulter'])->name('consulter-user');
    Route::post('/update/{id}', [UserController::class, 'update'])->name('update-user');
    Route::get('/delete/{id}', [UserController::class, 'delete'])->name('delete-user');
});
// CRED INDICE
Route::middleware('auth')->prefix('indice')->group(function () {
    Route::get('/liste', [IndiceController::class, 'index'])->name('indices');
    Route::post('/create', [IndiceController::class, 'store'])->name('create-indice');
    Route::get('/show', [IndiceController::class, 'show'])->name('show-indice');
    Route::get('/consulter/{id}', [IndiceController::class, 'consulter'])->name('consulter-indice');
    Route::post('/update/{id}', [IndiceController::class, 'update'])->name('update-indice');
    Route::get('/delete/{id}', [IndiceController::class, 'delete'])->name('delete-indice');
});
// CRED RANG
Route::middleware('auth')->prefix('rang')->group(function () {
    Route::get('/liste', [RangController::class, 'index'])->name('rangs');
    Route::post('/create', [RangController::class, 'store'])->name('create-rang');
    Route::get('/show', [RangController::class, 'show'])->name('show-rang');
    Route::get('/consulter/{id}', [RangController::class, 'consulter'])->name('consulter-rang');
    Route::post('/update/{id}', [RangController::class, 'update'])->name('update-rang');
    Route::get('/delete/{id}', [RangController::class, 'delete'])->name('delete-rang');
});
// CRED PERSONNEL
Route::middleware('auth')->prefix('personnel')->group(function () {
    Route::get('/liste', [PersonnelController::class, 'index'])->name('personnels');
    Route::post('/create', [PersonnelController::class, 'store'])->name('create-personnel');
    Route::get('/show', [PersonnelController::class, 'show'])->name('show-personnel');
    Route::get('/consulter/{id}', [PersonnelController::class, 'consulter'])->name('consulter-personnel');
    Route::post('/update/{id}', [PersonnelController::class, 'update'])->name('update-personnel');
    Route::get('/delete/{id}', [PersonnelController::class, 'delete'])->name('delete-personnel');
});

Route::middleware('auth')->prefix('organisateur')->group(function () {
    Route::get('/liste', [OrganisateurController::class, 'index'])->name('organisateurs');
    Route::post('/create', [OrganisateurController::class, 'store'])->name('create-organisateur');
    Route::get('/show/{id}', [OrganisateurController::class, 'show'])->name('show-organisateur');
    Route::post('/update/{id}', [OrganisateurController::class, 'update'])->name('update-organisateur');
    Route::get('/delete/{id}', [OrganisateurController::class, 'delete'])->name('delete-organisateur');
});


Route::middleware('auth')->prefix('lieu-mission')->group(function () {
    Route::get('/liste', [LieuMissionController::class, 'index'])->name('lieux-mission');
    Route::post('/create', [LieuMissionController::class, 'store'])->name('create-lieu-mission');
    Route::get('/show', [LieuMissionController::class, 'show'])->name('show-lieu-mission');
    Route::get('/consulter/{id}', [LieuMissionController::class, 'consulter'])->name('consulter-lieu-mission');
    Route::post('/update/{id}', [LieuMissionController::class, 'update'])->name('update-lieu-mission');
    Route::get('/delete/{id}', [LieuMissionController::class, 'delete'])->name('delete-lieu-mission');
    Route::get('/villes/{departement}', [LieuMissionController::class, 'getVilles'])->name('getVilles');
});

// DETAIL MISSION
Route::middleware('auth')->prefix('detail-mission')->group(function () {
    Route::get('/{id}', [DetailMissionController::class, 'index'])->name('detail-missions');
    Route::post('/create', [DetailMissionController::class, 'store'])->name('create-detail-mission');
    Route::get('/show/{id}', [DetailMissionController::class, 'show'])->name('show-detail-mission');
    Route::post('/update/{id}', [DetailMissionController::class, 'update'])->name('update-detail-mission');
    Route::post('/delete/{id}', [DetailMissionController::class, 'delete'])->name('delete-detail-mission');
    Route::post('/missions/detail/{id}/update', [DetailMissionController::class, 'update'])->name('detail-mission.update');
    Route::post('/missions/{id}/store', [DetailMissionController::class, 'store'])->name('detail-mission.store');
    // Route pour afficher le formulaire de validation
    Route::get('/mission/{id}/validate', [DetailMissionController::class, 'showValidationForm'])->name('validation.form');

    // Route pour gérer la soumission du formulaire et mettre à jour les détails de la mission
    Route::post('/mission/validate', [DetailMissionController::class, 'updateDetailMission'])->name('validation.update');
    Route::get('mission/mission/{id}/edit', [DetailMissionController::class, 'edit'])->name('detail-mission.edit');
});


// CREUD ORGANISATEUR
Route::middleware('auth')->prefix('organisateur')->group(function () {
    Route::get('/liste', [organisateurController::class, 'index'])->name('organisateurs');
    Route::post('/create', [organisateurController::class, 'store'])->name('create-organisateur');
    Route::get('/show', [organisateurController::class, 'show'])->name('show-organisateur');
    Route::get('/consulter/{id}', [organisateurController::class, 'consulter'])->name('consulter-organisateur');
    Route::post('/update/{id}', [organisateurController::class, 'update'])->name('update-organisateur');
    Route::get('/delete/{id}', [organisateurController::class, 'delete'])->name('delete-organisateur');
});


// CREUD MISSION
Route::middleware('auth')->prefix('mission')->group(function () {
    Route::get('/liste', [missionController::class, 'index'])->name('missions');
    Route::post('/create', [missionController::class, 'store'])->name('create-mission');
    Route::get('/show', [missionController::class, 'show'])->name('show-mission');
    Route::get('/consulter/{id}', [missionController::class, 'consulter'])->name('consulter-mission');
    Route::get('/consulter-detail-mission/{id}', [missionController::class, 'detailMission'])->name('details-mission');
    Route::post('/update/{id}', [missionController::class, 'update'])->name('update-mission');
    Route::get('/delete/{id}', [missionController::class, 'delete'])->name('delete-mission');
    Route::post('/traitement/{id}', [missionController::class, 'traitement'])->name('traitement-mission');
    Route::get('/validation/{id}', [missionController::class, 'validation'])->name('validation-mission');

    // Route pour afficher le formulaire de validation pour un personnel spécifique
    Route::get('/detail/{id}', [MissionController::class, 'showValidationForm'])->name('detail-mission');

    // Route pour valider la mission et enregistrer les informations
    Route::post('/validation{id}', [MissionController::class, 'validateMission'])->name('validateMission');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
