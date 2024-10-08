<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typevehicule extends Model
{
    use HasFactory;

    protected $fillable = [
        'typeVehicule',
    ];

    public function vehicule() {
        return $this->hasMany(Vehicule::class, 'typeVehicule_id');
    }
}
