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
        <h1>Liste des Itinéraires pour le Véhicule</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Départ</th>
                    <th>Arrivée</th>
                    <th>Aller-Retour</th>
                    <th>Distance (km)</th>
                    <th>Distance Totale (km)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($itineraireList as $itineraire)
                    <tr>
                        <td>{{ $itineraire->depart }}</td>
                        <td>{{ $itineraire->arrive }}</td>
                        <td>{{ $itineraire->allerRetour ? 'Oui' : 'Non' }}</td>
                        <td>{{ $itineraire->distance_km }}</td>
                        <td>{{ $itineraire->distance_total_km }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection