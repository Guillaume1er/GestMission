<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Event\Telemetry\System;

class Detailmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'dateTraitementMission', 
        'dateDepart',
        'dateRetour',
        'nbrJour',
        'nbrNuit',
        'coutNuite',
        'montantNuite',
        'moyenDeDeplacement',
        'nbrRepas',
        'coutRepas',
        'montantRepas',
        'montantMission',
        'montantAvance',
        'montantReste',
        'dateSignatureOm',
        'refOm',
        'montantPaye',
        'observation',
        'dateDernierPayement',
        'payementJustifie',
        'etat',
        'mission_id',
        'lieuMission_id',
        'personnel_id',
        'vehicule_id', 
        'statut', 
        'dateValidation',
        'validateur',
        'annulateurTraitement',
        'dateAnnulerValidation',
        'traiteurMission',
        'volumeCarburant',
        'distanceVehiculeMission',
        'montant_carburant',     
    ];


    public function personnel() {
        return $this->belongsTo(Personnel::class, 'personnel_id');
    }
    
    public function mission() {
        return $this->belongsTo(Mission::class, 'mission_id');
    }
    
    public function lieuMission() { 
        return $this->belongsTo(Lieumission::class, 'lieuMission_id');
    }

    public function vehicule() {
        return $this->belongsTo(Vehicule::class, 'vehicule_id');
    }

    public function itineraire()
    {
        return $this->hasMany(Itineraire::class, 'detailmission_id');
    }

    
    public function system()
    {
        return $this->hasMany(Systeme::class, 'detailmission_id');
    }

}
