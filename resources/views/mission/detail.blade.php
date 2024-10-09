@extends('layouts.dashboard_sans_sta')

@section('content')

    <div class="card-body container">
        <div class="header-title">
            <h4 class="card-title">Validation du personnel {{ $detailMission->nomPrenomsPersonnel }}</h4>
        </div> <br>

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

        <form action="{{ route('validateMission', $detailMission->id) }}" method="POST">
            @csrf

            <input type="hidden" name="detailMission_id" value="{{ $mission_id }}">
            
            <div class="row mb-4">
                <div class="col-lg-6">
                    <label class="form-label" class="form-label" for="nom_personnel">Nom du Personnel :</label>
                    <input class="form-control" type="text" name="nom_personnel" id="nom_personnel"
                        value="{{ $detailMission->nomPrenomsPersonnel }}" readonly>
                </div>
                <div class="col-lg-6">
                    <label class="form-label" for="refOm">Ref OM :</label>
                    <input class="form-control" type="text" name="refOm" id="refOm">
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-lg-6">
                    <label class="form-label" for="dateDepart">Date de début :</label>
                    <input class="form-control" type="date" name="dateDepart" id="dateDepart"
                        value="{{ old('dateDepart', $detailMission->dateDepart) }}">
                </div>
                <div class="col-lg-6">
                    <label class="form-label" for="dateRetour">Date de fin :</label>
                    <input class="form-control" type="date" name="dateRetour" id="dateRetour"
                        value="{{ old('dateRetour', $detailMission->dateRetour) }}">
                </div>
                <div class="col-lg-6" hidden>
                    <label class="form-label" for="statut">Statut</label>
                    <input class="form-control" type="text" name="statut" id="statut"
                        value="validé">
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-lg-6">
                    <label class="form-label" for="moyenDeDeplacement">Moyen de déplacement :</label>
                    <select class="form-control form-select" name="moyenDeDeplacement" id="moyenDeDeplacement">
                        <option value="moyen_prive"
                            {{ old('moyenDeDeplacement', $detailMission->moyenDeDeplacement) === 'moyen_prive' ? 'selected' : '' }}>
                            Moyen privé</option>
                        <option value="moyen_entreprise"
                            {{ old('moyenDeDeplacement', $detailMission->moyenDeDeplacement) === 'moyen_entreprise' ? 'selected' : '' }}>
                            Moyen de l'entreprise</option>
                    </select>
                </div>
                <div class="col-lg-6 mb-4" id="vehicule_select"
                    style="{{ old('moyenDeDeplacement', $detailMission->moyenDeDeplacement) === 'moyen_entreprise' ? 'display:block;' : 'display:none;' }}">
                    <label class="form-label" for="vehicule_id">Sélectionnez un véhicule :</label>
                    <select class="form-control form-select" name="vehicule_id" id="vehicule_id">
                        @foreach ($vehicules as $vehicule)
                            <option value="{{ $vehicule->id }}"
                                {{ old('vehicule_id', $detailMission->vehicule_id) == $vehicule->id ? 'selected' : '' }}>
                                {{ $vehicule->plaqueVehicule }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6">
                    <label class="form-label" for="lieuMission_id">Lieu mission</label>
                    <select class="form-control form-select" name="lieuMission_id" id="lieuMission_id">
                        {{-- <option>Sélectionnez un lieu</option> --}}
                            @foreach ($lieux_mission as $lieu)
                                <option value="{{ $lieu->id }}"> {{ $lieu->commune }} </option>
                            @endforeach
                    </select>
                </div>

            </div><br>

            <div class="text-end row">
                <div class="col-lg-9">
                    <button class="btn btn-danger" type="submit" name="action" value="invalidate">Invalider personnel</button>
                </div>
                <div class="col-lg-3">
                    <button class="btn btn-primary" type="submit" name="action" value="validate">Valider personnel</button>
                </div>
            </div>

        </form>
    </div>

    <script>
        document.getElementById('moyenDeDeplacement').addEventListener('change', function() {
            const vehiculeSelect = document.getElementById('vehicule_select');
            vehiculeSelect.style.display = this.value === 'moyen_entreprise' ? 'block' : 'none';
        });
    </script>
@endsection