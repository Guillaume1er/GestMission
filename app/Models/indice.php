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
        'montantRepas',
    ];

    public function personnel () {
        return $this->hasMany(Personnel::class, 'indice_id');
    }
}
