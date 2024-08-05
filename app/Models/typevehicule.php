<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class typevehicule extends Model
{
    use HasFactory;

    protected $fillable = [
        'typeVehicule',
    ];

    public function vehicule() {
        return $this->belongsTo(Vehicule::class);
    }
}
