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



    public function interventions()
    {
        return $this->hasMany(Intervention::class); 
    }

    public function typeVehicule() {
        return $this->belongsTo(TypeVehicule::class,'typeVehicule_id');
    }
    
    public function marque() {
        return $this->belongsTo(Marque::class, 'marque_id');
    }

    
    public function vehiculeMission() {
        return $this->belongsTo(Vehiculemission::class);
    }
}
