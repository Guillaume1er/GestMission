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
}
