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
                    <td>{{ $vehicule }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <a href="" class="btn btn-primary">Voir l'itinéraire</a>
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
