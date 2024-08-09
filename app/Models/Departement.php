<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    protected $fillable =[
        'nomDepartement',
    ];


    public function departement() {
        return $this->hasMany(Lieumission::class);
    }

    public function ville () {
        return $this->hasMany(Ville::class);
    }
}
