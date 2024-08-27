<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;

    protected $fillable =[
        'numMission',
        'refMission',
        'nomMission',
        'objetMission',
        'dateMission',
        'dateDebutMission',
        'dateFinMission',
        //'imputation',
        //'previsionBBudgetaire',
        'autorisateur1',
        'autorisateur2',
        'autorisateur3',
        'observationMission',
        'etatMission',
        'nbrVehicule',
        //'typeMission',
        'nbrTotalNuite',
        'nbrTotalRepas',
        'montantTotalNuite',
        'montantTotalRepas',
        'montantTotalMission', 
        'organisateur_id', 
        'exerciceBudgetaire_id', 
    ];

    public function organisateur () {
        return $this->belongsTo(Organisateur::class , 'organisateur_id');
    }

    public function exerciceBudgetaire () {
        return $this->belongsTo(ExerciceBudgetaire::class, 'exerciceBudgetaire_id');
    }

    public function detailMission() {
        return $this->hasMany(Detailmission::class);
    }

    public function vehiculeMission() {
        return $this->belongsTo(Vehiculemission::class);
    }



    protected static function booted()
    {
        static::creating(function ($intervention) {
            // Récupérer le dernier numéro d'intervention
            $lastNumero = static::orderBy('numMission', 'desc')->value('numMission');

            // Définir le numéro d'intervention
            $nextNumero = $lastNumero ? $lastNumero + 1 : 1;

            // Formatage pour avoir toujours 4 chiffres
            $intervention->numMission = str_pad($nextNumero, 4, '0', STR_PAD_LEFT);

            // Déterminer les deux derniers chiffres de l'année en cours
            $currentYear = date('y');

            // Créer la référence d'intervention
            $intervention->refMission = 'MI ' . $intervention->numMission . '-' . $currentYear;
        });
    }
}
