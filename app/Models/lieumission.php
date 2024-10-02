<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Lieumission extends Model
{
    use HasFactory;

    protected $fillable =[
        'distance',
        'commune',
        'nuite',
        'departement_id'
    ];

    public function detailMission() {
        return $this->hasMany(Detailmission::class, 'lieuMission_id');
    }

    
    public function vehiculeMission() {
        return $this->belongsTo(Vehiculemission::class);
    }

    public function departement() {
        return $this->belongsTo(Departement::class);
    }
    
    public function itineraire()
    {
        return $this->hasMany(Itineraire::class, 'lieumission_id');
    }
}



