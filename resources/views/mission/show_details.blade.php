@extends('layouts.dashboard_sans_sta')

@section('content')

    <div class="card-body container">
        <div class="header-title">
            <h4 class="card-title">Détails de la mission validée</h4>
        </div><br>

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

        <form>
            @csrf

            <!-- Nom du Personnel affiché automatiquement -->
            <div class="row mb-4">
                <div class="col-lg-6">
                    <label class="form-label" class="form-label" for="nom_personnel">Nom du Personnel :</label>
                    <input class="form-control" type="text" name="nom_personnel" id="nom_personnel"
                        value="{{ $personnel->nomPrenomsPersonnel }}" readonly>
                </div>
                <div class="col-lg-6">
                    <label class="form-label" for="refOm">Ref OM :</label>
                    <input class="form-control" type="text" name="refOm" id="refOm"
                        value="{{ $detailMission->refOm }}" readonly>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-lg-6">
                    <label class="form-label" for="dateDepart">Date de début :</label>
                    <input class="form-control" type="date" name="dateDepart" id="dateDepart"
                        value="{{ $detailMission->dateDepart }}" readonly>
                </div>
                <div class="col-lg-6">
                    <label class="form-label" for="dateRetour">Date de fin :</label>
                    <input class="form-control" type="date" name="dateRetour" id="dateRetour"
                        value="{{ $detailMission->dateRetour }}" readonly>
                </div>
                <div class="col-lg-6" hidden>
                    <label class="form-label" for="statut">Statut</label>
                    <input class="form-control" type="text" name="statut" id="statut"
                        value="{{ $detailMission->statut }}" readonly>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-lg-6">
                    <label class="form-label" for="moyenDeDeplacement">Moyen de déplacement :</label>
                    <input class="form-control" type="text" name="moyenDeDeplacement" id="moyenDeDeplacement"
                        value="{{ $detailMission->moyenDeDeplacement }}" readonly>
                </div>
                <div class="col-lg-6">
                    <label class="form-label" for="vehicule_id">Véhicule :</label>
                    <input class="form-control" type="text" name="vehicule_id" id="vehicule_id"
                        value="{{ $detailMission->vehicule_id ? $detailMission->vehicule->plaqueVehicule : 'Non spécifié' }}" readonly>
                </div>
                <div class="col-lg-6">
                    <label class="form-label" for="lieuMission_id">Lieu mission :</label>
                    <input class="form-control" type="text" name="lieuMission_id" id="lieuMission_id"
                        value="{{ $detailMission->lieuMission->commune }}" readonly>
                </div>
            </div><br>

            <div class="text-end">
                <a href="{{ route('validation-mission', $mission->id) }}" class="btn btn-secondary">Retour</a> 
            </div>
        </form>
    </div>

@endsection
