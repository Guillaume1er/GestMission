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
        return $this->hasMany(Rang::class);
    }

    public function indice() {
        return $this->hasMany(Indice::class);
    }
    
    public function detailMission() {
        return $this->belongsTo(Detailmission::class);
    }
}
