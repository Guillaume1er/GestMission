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
        'imputation',
        'previsionBBudgetaire',
        'autorisateur1',
        'autorisateur2',
        'autorisateur3',
        'observationMission',
        'etatMission',
        'nbrVehicule',
        'typeVehicule',
       'nbrTotalNuite',
        'nbrTotalRepas',
        'montantTotalNuite',
        'montantTotalRepas',
        'montantTotalMission', 
        'organisateur_id', 
    ];

    public function organisateur () {
        return $this->hasMany(Organisateur::class);
    }

    public function detailMission() {
        return $this->belongsTo(Detailmission::class);
    }

    public function vehiculeMission() {
        return $this->belongsTo(Vehiculemission::class);
    }
}
