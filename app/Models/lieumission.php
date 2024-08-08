<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lieumission extends Model
{
    use HasFactory;

    protected $fillable =[
        'departement',
        'commune',
        'distance',
        'nuite',
    ];

    public function detailMission() {
        return $this->belongsTo(Detailmission::class);
    }

    
    public function vehiculeMission() {
        return $this->belongsTo(Vehiculemission::class);
    }
}
