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
        <div class="header-title">
            <h4 class="card-title">Ajouter une intervention</h4>
        </div> <br>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('create-intervention') }}">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="typeIntervention_id" class="form-label">Type intervention du vehicule</label>
                        <select class="form-select" required name="typeIntervention_id" id="typeIntervention_id">
                            <option selected>Sélectionner un type d'ntervention</option>
                            @foreach ($typeInterventions as $typeIntervention)
                                <option value="{{ $typeIntervention->id }}">{{ $typeIntervention->typeIntervention }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="responsableIntervention_id" class="form-label">Responsable intervention du
                            vehicule</label>
                        <select class="form-select" required name="responsableIntervention_id"
                            id="responsableIntervention_id">
                            <option selected>Sélectionner un responsable d'intervention</option>
                            @foreach ($responsableInterventions as $responsableIntervention)
                                <option value="{{ $responsableIntervention->id }}">
                                    {{ $responsableIntervention->nomResponsable }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="vehicule_id" class="form-label">Véhicule</label>
                        <select class="form-select" required name="vehicule_id" id="vehicule_id">
                            <option selected>Sélectionner un véhicule</option>
                            @foreach ($vehicules as $vehicule)
                                <option value="{{ $vehicule->id }}">{{ $vehicule->plaqueVehicule }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="statut">Statut :</label>
                        <select class="form-select" name="statut" id="statut">
                            <option value="bon">Bon</option>
                            <option value="mauvais">Mauvais</option>
                        </select>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
            </div> --}}
            {{-- <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="referenceIntervention" class="form-label">Référence de d'intervention</label>
                        <input type="text" required class="form-control" name="referenceIntervention">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="numeroIntervention" class="form-label">NUméro de l'intervention</label>
                        <input class="form-control" type="date" name="numeroIntervention" />
                    </div>
                </div>
            </div> --}}
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="datePrevue" class="form-label">Date prévue</label>
                        <input class="form-control" type="date" name="datePrevue" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="dateIntervention" class="form-label">Date intervention</label>
                        <input class="form-control" required type="date" name="dateIntervention" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="objetIntervention" class="form-label">L'objet de l'intervention</label>
                        <textarea class="form-control" required rows="4" name="objetIntervention"></textarea>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="kilometrageIntervention" class="form-label">Kilométrage de l'intervention</label>
                        <input class="form-control" required type="number" name="kilometrageIntervention" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="pannesSurvenues" class="form-label">Pannes survenues</label>
                        <textarea class="form-control" required rows="4" name="pannesSurvenues"></textarea>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="reparationEffectue" class="form-label">Reparations effectuées</label>
                        <textarea class="form-control" required rows="4" name="reparationEffectue"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <input class="form-check-input" type="checkbox" id="validationIntervention" value="1"
                            name="validationIntervention">
                        <label class="form-check-label" for="validationIntervention">
                            Validation intervention
                        </label>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="coutGlobal" class="form-label">Coût global (F CFA)</label>
                        <input class="form-control" type="number" name="coutGlobal" />
                    </div>
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
        </form>

    </div>


@endsection
