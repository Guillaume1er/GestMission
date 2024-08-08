<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
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



    public function intervention() {
        return $this->belongsTo(Intervention::class);
    }

    public function typeVehicule() {
        return $this->hasMany(TypeVehicule::class);
    }
    
    public function marque() {
        return $this->hasMany(Marque::class);
    }

    
    public function vehiculeMission() {
        return $this->belongsTo(Vehiculemission::class);
    }
}
