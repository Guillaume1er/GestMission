<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    use HasFactory;

    protected $fillable = [
        'referenceIntervention',
        'numeroIntervention',
        'datePrevue',
        'dateIntervention',
        'objetIntervention',
        'kilometrageIntervention',
        'pannesSurvenues',
        'reparationEffectue',
        'coutGlobal',
        'validationIntervention',
        'vehicule_id',
        'typeIntervention_id',
        'responsableIntervention_id',
    ];

    public function typeIntervention()
    {
        return $this->hasMany(Typeintervention::class);
    }

    public function responsableIntervention()
    {
        return $this->hasMany(Responsableintervention::class);
    }
    public function vehicule()
    {
        return $this->hasMany(Vehicule::class);
    }


    // Génération du champ numeroIntervention et de referenceIntervention
    protected static function booted()
    {
        static::creating(function ($intervention) {
            // Récupérer le dernier numéro d'intervention
            $lastNumero = static::orderBy('numeroIntervention', 'desc')->value('numeroIntervention');

            // Définir le numéro d'intervention
            $nextNumero = $lastNumero ? $lastNumero + 1 : 1;

            // Formatage pour avoir toujours 4 chiffres
            $intervention->numeroIntervention = str_pad($nextNumero, 4, '0', STR_PAD_LEFT);

            // Déterminer les deux derniers chiffres de l'année en cours
            $currentYear = date('y');

            // Créer la référence d'intervention
            $intervention->referenceIntervention = 'IT ' . $intervention->numeroIntervention . '-' . $currentYear;
        });
    }
}
