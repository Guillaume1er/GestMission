@extends('layouts.dashboard_sans_sta')

@section('content')
<div class="container">
    <h1>Véhicules attribués à la mission : {{ $mission->nomMission }}</h1>

    @if(count($vehicules) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Véhicule</th>
                    <th>Date Début</th>
                    <th>Date Fin</th>
                    <th>Lieu Mission</th>
                    <th>Distance</th>
                    <th>Volume</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vehicules as $vehicule)
                <tr>
                    <td>{{ $vehicule['plaqueVehicule'] }}</td>
                    <td>{{ $vehicule['dateDepart'] }}</td>
                    <td>{{ $vehicule['dateRetour'] }}</td>
                    <td>{{ $vehicule['lieuMission'] }}</td>
                    <td>{{ $vehicule['distanceVehiculeMission'] }} km</td>
                    <td>{{ $vehicule['volumeCarburant'] }} L</td>
                    {{-- @dd($vehicules) --}}
                    <td>
                        <a href="{{ route('mission.itineraire.show', ['mission_id' => $mission->id, 'vehicule_id' => $vehicule['id']]) }}" class="btn btn-primary">
                            Itinéraire
                        </a>
                        

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Aucun véhicule n'a été attribué à cette mission.</p>
    @endif

    {{-- <a href="{{ route('missions.index') }}" class="btn btn-secondary">Retour aux missions</a> --}}
</div>
@endsection
