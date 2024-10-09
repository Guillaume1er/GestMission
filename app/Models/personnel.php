<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    use HasFactory;

    protected $fillable =[
        'nomPrenomsPersonnel',
        'numeroMatricule',
        'civilite',
        'contact',
        'email',
        'adresse',
        'numIfu',
        'rang_id',
        'indice_id',
    ];

    public function rang() {
        return $this->belongsTo(Rang::class, 'rang_id');
    }

    public function indice() {
        return $this->belongsTo(Indice::class, 'indice_id');
    }
    
    public function detailMission() {
        return $this->hasMany(Detailmission::class);
    }

    public function missions() {
        return $this->hasMany(Detailmission::class, 'personnel_id');
    }
}
