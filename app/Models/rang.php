<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rang extends Model
{
    use HasFactory;

    protected $fillable =[
        'nomRang',
    ];

    public function personnel() {
        return $this->belongsTo(Personnel::class);
    }
}
