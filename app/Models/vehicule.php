<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vehicule extends Model
{
    use HasFactory;

    protected $fillable = [
        'plaqueVehicule',
        'kilometrageDepart',
        'responsableVehicule',
        'contactResponsable',
        'etatVehicule',
        'autorisationSortie',
        'dateAutorisation',
        'dateEnregistrementVehicule',
        'immatriculation',
        'vehiculePool',
        'motifDesautorisation',
        'dateDesautorisation',
        'kilometrageActuel',
        'kilometrageAlerte',
        'dateDerniereMission',
        'dateAcquisition',
        'typeVehicule_id',
        'marque_id',
    ];

    public function typeVehicule() {
        return $this->hasMany(TypeVehicule::class);
    }
}
