<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indice extends Model
{
    use HasFactory;

    protected $fillable =[
        'code',
        'montantNuite',
        'montantNuite',
    ];

    public function personnel () {
        return $this->belongsTo(Personnel::class);
    }
}
