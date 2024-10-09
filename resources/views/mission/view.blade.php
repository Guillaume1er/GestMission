@extends('layouts.dashboard_sans_sta')
@section('content')
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