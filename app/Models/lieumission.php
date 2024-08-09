<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lieumission extends Model
{
    use HasFactory;

    protected $fillable =[
        'distance',
        'nuite',
        'departement_id'
    ];

    public function detailMission() {
        return $this->belongsTo(Detailmission::class);
    }

    
    public function vehiculeMission() {
        return $this->belongsTo(Vehiculemission::class);
    }

    public function departement() {
        return $this->belongsTo(Departement::class);
    }
}
