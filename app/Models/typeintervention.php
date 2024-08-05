<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class typeintervention extends Model
{
    use HasFactory;

    protected $fillable = [
        'typeIntervention',
        'description',
        'livretBord',
    ];

    public function intervention() {
        return $this->belongsTo(Intervention::class);
    }
}
