<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class intervention extends Model
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
        'reparationEffectuee',
        'coutGlobal',
        'validationIntervention',
        'vehicule_id',
        'typeIntervention_id', 
        'responsableIntervention_id',
    ];

    public function typeIntervention() {
        return $this->hasMany(TypeIntervention::class);
    }
}
