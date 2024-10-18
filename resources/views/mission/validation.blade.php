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
    <div class="card-body container">
        <div class="header-title mb-4">
            <h4 class="card-title">Validation du personnel affecté à la mission</h4>
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

        {{-- @dd($detailMission_personnel[0]->mission_id); --}}
        <table class="table table-bordered table-sm" id="personnelTable">
            <thead>
                <tr>
                    <th style="width: 20%; padding: 0.2rem;">Nom et Prénoms</th>
                    <th style="width: 10%; padding: 0.2rem;">Indice</th>
                    <th style="width: 10%; padding: 0.2rem;">Rang</th>
                    <th style="width: 10%; padding: 0.2rem;">Date départ</th>
                    <th style="width: 15%; padding: 0.2rem;">Date retour</th>
                    <th style="width: 60%; padding: 0.2rem;">Lieu mission</th>
                    <th style="width: 60%; padding: 0.2rem;">Etat</th>
                    <th style="width: 60%; padding: 0.2rem;">Statut</th>
                </tr>
            </thead>
            {{-- @dd($mission->id); --}}
            <tbody>
                @foreach ($detailMission_personnel as $personnel)
                    <tr>
                        <td>{{ $personnel->personnel->nomPrenomsPersonnel }}</td>
                        <td>{{ $personnel->personnel->indice->code ?? 'Non défini' }}</td>
                        <td>{{ $personnel->personnel->rang->nomRang ?? 'Non défini' }}</td>
                        <td>{{ date('d/m/Y', strtotime($personnel->dateDepart)) }}</td>
                        <td>{{ date('d/m/Y', strtotime($personnel->dateRetour)) }}</td>
                        <td>{{ $personnel->lieuMission->commune ?? '' }}</td>
                        <td>
                            @if ($personnel->statut === 'validé')
                                <p class="h5"><span class="badge bg-success">Validé</span></p>
                            @elseif ($personnel->statut === 'non validé')
                                <p class="h5"><span class="badge bg-danger">Non validé</span></p>
                            @else
                                <p class="h5"><span class="badge bg-primary">Non traité</span></p>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-sm btn-icon {{ $personnel->statut == 'validé' ? 'btn-success' : 'btn-danger' }}"
                                data-bs-toggle="tooltip" data-bs-placement="top"
                                title="{{ $personnel->statut == 'validé' ? 'Cliquez pour annuler' : 'Cliquez pour valider' }}"
                                aria-label=""
                                href="{{ $personnel->statut === 'validé' 
                                    ? route('validation-mission-personnel-annuler', $personnel->personnel_id) 
                                    : ($personnel->statut === 'Non traité' 
                                        ? route('detail-mission', ['id' => $personnel->personnel_id, 'mission_id' => $mission->id]) 
                                        : route('detail-mission', ['id' => $personnel->personnel_id, 'mission_id' => $mission->id])) }}"
                            >

                                <span class="btn-inner">
                                    @if ($personnel->statut == 'validé')
                                        <!-- Icône d'autorisation -->
                                        <svg class="icon-20" width="20" height="20" viewBox="0 0 24 24"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <!-- First validation checkmark -->
                                            <path d="M10 12.5L4.5 7L6.086 5.414L10 9.328L17.914 1.414L19.5 3L10 12.5Z"
                                                fill="currentColor" />

                                            <!-- Second validation checkmark placed below the first one -->
                                            <path d="M10 22.5L4.5 17L6.086 15.414L10 19.328L17.914 11.414L19.5 13L10 22.5Z"
                                                fill="currentColor" />
                                        </svg>
                                    @else
                                        <!-- Icône de désautorisation (X) -->
                                        <svg class="icon-20" width="20" height="20" viewBox="0 0 24 24"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 18L18 6M6 6l12 12" stroke="currentColor" stroke-width="2" />
                                        </svg>
                                    @endif
                                </span>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
