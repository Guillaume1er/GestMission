<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailmission extends Model
{
    use HasFactory;

    protected $fillable =[

        'dateTraitementMission',
        'dateDepart',
        'dateRetour',
        'nbrJour',
        'nbrNuit',
        'coutNuite',
        'montantNuite',
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
    ];

    public function personnel() {
        return $this->hasMany(Personnel::class);
    }
    
    public function mission() {
        return $this->hasMany(Mission::class);
    }
    
    public function lieuMission() {
        return $this->hasMany(Lieumission::class);
    }
}
