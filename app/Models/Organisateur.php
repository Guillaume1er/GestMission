<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisateur extends Model
{
    use HasFactory;

    protected $fillable =[
        'nomOrganisateur',
    ];

    public function mission() {
        return $this->belongsTo(Mission::class);
    }
   
}
