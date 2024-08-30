@extends('layouts.dashboard_sans_sta')

@section('content')
    <div class="card-body container">
        <div class="header-title">
            <h4 class="card-title">Valider la mission</h4>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg class="flex-shrink-0 bi me-2 icon-24" width="24" height="24">
                    <use xlink:href="#exclamation-triangle-fill"></use>
                </svg>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="flex-shrink-0 bi me-2 icon-24" width="24" height="24">
                    <use xlink:href="#check-circle-fill"></use>
                </svg>
                <div>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <table class="table table-bordered table-sm" id="personnelTable">
            <thead>
                <tr>
                    <th style="width: 20%; padding: 0.2rem;">Nom et Prénoms</th>
                    <th style="width: 10%; padding: 0.2rem;">Indice</th>
                    <th style="width: 10%; padding: 0.2rem;">Rang</th>
                    <th style="width: 15%; padding: 0.2rem;">Date départ</th>
                    <th style="width: 15%; padding: 0.2rem;">Date retour</th>
                    <th style="width: 60%; padding: 0.2rem;">Lieu mission</th>
                    <th style="width: 60%; padding: 0.2rem;">Statut</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($personnels as $personnel)
                    <tr>
                        <td>{{ $personnel->nomPrenomsPersonnel ?? '' }}</td>
                        <td>{{ $personnel->indice->code ?? 'Non défini' }}</td>
                        <td>{{ $personnel->rang->nomRang ?? 'Non défini' }}</td>
                        <td>{{ $personnel->dateDepart ?? '' }}</td>
                        <td>{{ $personnel->dateRetour ?? '' }}</td>
                        <td>{{ $personnel->lieuMission->commune ?? '' }}</td>
                        <td>
                            <a href="{{ route('detail-mission', $personnel->id) }}" class="btn btn-sm status-btn"
                                style="background-color: {{ $personnel->statut == 'validé' ? 'green' : 'red' }}; border-radius: 50%; width: 20px; height: 20px; border: none;">
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
