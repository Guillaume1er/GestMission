<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercicebudgetaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'exerciceBudgetaire',
        'nombreTotalMission',
        'clotureExercice',
    ];

    public function exerciceBudgetaire () {
        return $this->hasMany(Mission::class, 'exerciceBudgetaire_id');
    }
}
