<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typeintervention extends Model
{
    use HasFactory;

    protected $fillable = [
        'typeIntervention',
        'description',
        'livretBord', 
    ];

    
    public function interventions()
    {
        return $this->hasMany(Intervention::class, 'typeIntervention_id'); 
    }
}
