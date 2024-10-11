@extends('layouts.dashboard_sans_sta')

@section('content')
<div class="mb-4 mt-4 ms-4">
    <a href="{{ url()->previous() }}" class="btn btn-primary d-inline-flex align-items-center">
        <svg class="icon-32 me-2" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M4.25 12.2744L19.25 12.2744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
        Retour
    </a>
</div>
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
