@extends('layouts.dashboard_sans_sta')

@section('content')
    <div class="card-body container">
        <div class="header-title mb-4">
            <h4 class="card-title">Traitement de la mission</h4>
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

        <table id="personnelTable" class="table table-bordered table-sm" data-toggle="data-table">

            <thead>
                <tr>
                    <th style="width: 20%; padding: 0.2rem;">Nom</th>
                    <th style="width: 15%; padding: 0.2rem;">Date Départ</th>
                    <th style="width: 15%; padding: 0.2rem;">Date retour</th>
                    <th style="width: 10%; padding: 0.2rem;">Nombre nuité</th>
                    <th style="width: 10%; padding: 0.2rem;">Montant nuité</th>
                    <th style="width: 15%; padding: 0.2rem;">Nombre Repas</th>
                    <th style="width: 15%; padding: 0.2rem;">Montant Repas</th>
                    <th style="width: 15%; padding: 0.2rem;">Montant Mission</th>
                    <th style="width: 60%; padding: 0.2rem;">Etat </th>

                </tr>
            </thead>
            <tbody>
                @foreach ($detailMission_personnel as $personnel)
                    <tr>
                        <td>{{ $personnel->personnel->nomPrenomsPersonnel }}</td>
                        <td>{{ date('d/m/Y', strtotime($personnel->dateDepart)) }}</td>
                        <td>{{ date('d/m/Y', strtotime($personnel->dateRetour)) }}</td>
                        <td class="text-center">{{ $personnel->lieuMission->nuite ?? '' }}</td>
                        <td>{{ number_format($personnel->montantNuite, 0, ',', ' ') }} FCFA</td>
                        <td class="text-center">{{ $personnel->lieuMission->nombreRepas ?? '' }}</td>
                        <td>{{ number_format($personnel->montantRepas, 0, ',', ' ') }} FCFA</td>
                        <td>{{ number_format($personnel->montantMission, 0, ',', ' ') }} FCFA</td>
                        <td>
                            <a class="btn btn-sm btn-icon {{ $personnel->dateTraitementMission !== null ? 'btn-success' : 'btn-warning' }}"
                                data-bs-toggle="tooltip" data-bs-placement="top"
                                title="{{ $personnel->dateTraitementMission !== null ? 'Traitement fait' : 'Cliquer pour traiter' }}"
                                aria-label=""
                                onclick="{{ $personnel->dateTraitementMission === null ? 'return confirm(\'Cette action est irréversible. Voulez-vous vraiment valider le traitement ?\')' : '' }}"
                                href="{{ $personnel->dateTraitementMission !== null ? 'javascript:void(0)' : route('traitement-mission-personnel', $personnel->personnel_id) }}">

                                <span class="btn-inner">
                                    @if ($personnel->dateTraitementMission !== null && $personnel->dateAnnulerTraitement == null)
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
                                        <!-- Icône de désautorisation -->
                                        <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10 17.5L4.5 12L6.086 10.414L10 14.328L17.914 6.414L19.5 8L10 17.5Z "
                                                fill="currentColor" />
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
