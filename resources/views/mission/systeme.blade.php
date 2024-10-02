@extends('layouts.dashboard_sans_sta')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('systeme.store') }}" method="POST">
    @csrf

    <!-- Champ pour la consommation de carburant (L/100km) -->
    <div class="form-group">
        <label for="consommation_vehicule_km">Consommation de carburant (L/100km)</label>
        <input type="number" step="0.01" name="consommation_vehicule_km" class="form-control" required>
    </div>

    <!-- Champ pour le prix du litre d'essence -->
    <div class="form-group">
        <label for="prix_essence_litre">Prix du litre d'essence</label>
        <input type="number" step="0.01" name="prix_essence_litre" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>
@endsection
