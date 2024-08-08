<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsableintervention extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomResponsable',
    ];

    public function intervention() {
        return $this->belongsTo(Intervention::class);
    }
}
