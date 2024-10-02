@extends('layouts.dashboard_sans_sta')

@section('content')
<div class="container">
    <h1>Informations enregistrées</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="form-group">
        <label for="consommation_vehicule_km">Consommation de carburant (L/100km)</label>
        <input type="text" class="form-control" value="{{ $systeme->consommation_vehicule_km }}" readonly>
    </div>

    <div class="form-group">
        <label for="prix_essence_litre">Prix du litre d'essence</label>
        <input type="text" class="form-control" value="{{ $systeme->prix_essence_litre }}" readonly>
    </div>

    <a href="{{ route('systeme.index') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection
