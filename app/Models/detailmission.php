<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];


    public function personnel() {
        return $this->belongsTo(Personnel::class);
    }
    
    public function mission() {
        return $this->belongsTo(Mission::class);
    }
    
    public function lieuMission() {
        return $this->belongsTo(Lieumission::class);
    }

    public function vehicule() {
        return $this->belongsTo(Vehicule::class);
    }
}