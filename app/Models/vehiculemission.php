<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculemission extends Model
{
    use HasFactory;

    protected $fillable =[
        'qteCarburantAffecte',
        'kilometrageDepart',
        'kilometrageFinMission',
        'mission_id',
        'lieuMission_id',
        'vehicule_id',
    ];

    public function mission () {
        return $this->hasMany(Mission::class);
    }
    
    public function lieuMission () {
        return $this->hasMany(Lieumission::class);
    }    
    
    public function vehicule () {
        return $this->hasMany(Vehicule::class);
    }
}
