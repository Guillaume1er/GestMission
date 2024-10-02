<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itineraire extends Model
{
    use HasFactory;
    protected $fillable = [
        'depart',
        'arrive',
        'allerRetour',
        'distance_km',
        'distance_total_km',
        'volume_essence_l',
        'cout_carburant',
        'montant_carburant',
        'vehicule_id',
        'lieumission_id',
        'mission_id',
    ];

    // Relation avec le modèle Vehicule
    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class, 'vehicule_id');
    }

    // Relation avec le modèle Lieumission
    public function lieuMission()
    {
        return $this->belongsTo(Lieumission::class, 'lieumission_id');
    }

    // Relation avec le modèle DetailMission
    public function Mission()
    {
        return $this->belongsTo(Mission::class, 'mission_id');
    }
}
    

