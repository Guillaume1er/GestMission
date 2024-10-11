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
                    {{-- <td>
                        @if($itineraireExist) 
                            <a href="{{ route('mission.itineraire.show', ['mission_id' => $mission->id, 'vehicule_id' => $vehicule->['id']]) }}" class="btn btn-primary">
                                Itinéraire
                            </a>
                        @else
                            <a href="{{ route('mission.view', ['mission_id' => $mission->id]) }}" class="btn btn-secondary">
                                Voir Mission
                            </a>
                        @endif
                    </td>
                     --}}
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
