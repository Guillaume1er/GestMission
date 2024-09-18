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
        return $this->hasMany(Detailmission::class, 'detailMission_id');
    }

    
    public function vehiculeMission() {
        return $this->belongsTo(Vehiculemission::class);
    }

    public function departement() {
        return $this->belongsTo(Departement::class);
    }


    // protected static function booted()
    // {
    //     static::creating(function ($intervention) {
    //         // Récupérer le dernier numéro d'intervention
    //         $lastNumero = static::orderBy('numMission', 'desc')->value('numMission');

    //         // Définir le numéro d'intervention
    //         $nextNumero = $lastNumero ? $lastNumero + 1 : 1;

    //         // Formatage pour avoir toujours 4 chiffres
    //         $intervention->numMission = str_pad($nextNumero, 4, '0', STR_PAD_LEFT);

    //         // Déterminer les deux derniers chiffres de l'année en cours
    //         $currentYear = date('y');

    //         // Créer la référence d'intervention
    //         $intervention->refMission = 'IT ' . $intervention->numMission . '-' . $currentYear;
    //     });
    // }
}
