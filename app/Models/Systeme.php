<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Systeme extends Model
{
    use HasFactory;


    protected $table = 'systeme';

    

    protected $fillable = [
        'consommation_vehicule_km',
        'prix_essence_litre',
        
    ];

  

  
}
