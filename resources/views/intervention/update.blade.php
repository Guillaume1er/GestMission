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
            <h4 class="card-title">Modifier une intervention</h4>
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

        <form method="POST" action="{{ route('update-intervention', $intervention->id) }}">
            @csrf

            {{-- <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="responsableIntervention_id" class="form-label">Responsable intervention du
                            vehicule</label>
                        <select class="form-select" required name="responsableIntervention_id"
                            id="responsableIntervention_id">
                            <option selected>Sélectionner un responsable d'intervention</option>
                            @foreach ($responsableInterventions as $responsableIntervention)
                                <option value="{{ $responsableIntervention->id }}" {{ $responsableIntervention ? 'selected' : '' }}>
                                    {{ $responsableIntervention->nomResponsable }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="vehicule_id" class="form-label">Véhicule</label>
                        <select class="form-select" required name="vehicule_id" id="vehicule_id">
                            <option selected>Sélectionner un véhicule</option>
                            @foreach ($vehicules as $vehicule)
                                <option value="{{ $vehicule->id }}" {{ $vehicule->id ? 'selected' : '' }}>{{ $vehicule->plaqueVehicule }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="row" >
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="responsableIntervention" class="form-label">Contact du responsable intervention</label>
                        <input class="form-control" type="number" name="responsableIntervention"
                            value="{{ $intervention->vehicule->contactResponsable }}"/>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="typeIntervention_id" class="form-label">Type intervention du vehicule</label>
                        <select class="form-select" required name="typeIntervention_id" id="typeIntervention_id" >
                            <option selected>Sélectionner un type d'intervention</option>
                            @foreach ($typeInterventions as $typeIntervention)
                                <option value="{{ $typeIntervention->id }}" {{ $typeIntervention->id ? 'selected' : '' }}>{{ $typeIntervention->typeIntervention }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="row" >
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="datePrevue" class="form-label">Date prévue</label>
                        <input class="form-control" type="date" name="datePrevue"
                            value="{{ $intervention->datePrevue }}" {{ $intervention->validationIntervention ? '' : '' }}/>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="dateIntervention" class="form-label">Date intervention</label>
                        <input class="form-control" required type="date" name="dateIntervention"
                            value="{{ $intervention->dateIntervention }}" {{ $intervention->validationIntervention ? '' : '' }}/>
                    </div>
                </div>
            </div> --}}
            <div class="row" >
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="objetIntervention" class="form-label">L'objet de l'intervention</label>
                        <textarea class="form-control" required rows="4" name="objetIntervention" {{ $intervention->validationIntervention ? '' : '' }}>{{ $intervention->objetIntervention }}</textarea>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="reparationEffectue" class="form-label">Reparations effectuées</label>
                        <textarea class="form-control" required rows="4" name="reparationEffectue" {{ $intervention->validationIntervention ? '' : '' }}>{{ $intervention->reparationEffectue }}</textarea>
                    </div>
                </div>
                {{-- <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="kilometrageIntervention" class="form-label">Kilométrage de l'intervention (Km)</label>
                        <input class="form-control" required type="number" name="kilometrageIntervention"
                            value="{{ $intervention->kilometrageIntervention }}" {{ $intervention->validationIntervention ? '' : '' }}/>
                    </div>
                </div> --}}
            </div>
            <div class="row" >
                {{-- <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="pannesSurvenues" class="form-label">Pannes survenues</label>
                        <textarea class="form-control" required rows="4" name="pannesSurvenues" {{ $intervention->validationIntervention ? '' : '' }}>{{ $intervention->pannesSurvenues }}</textarea>
                    </div>
                </div> --}}
            </div>
            {{-- <div class="row" >
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="coutGlobal" class="form-label">Coût global (F CFA)</label>
                        <input class="form-control" type="number" name="coutGlobal"
                            value="{{ $intervention->coutGlobal }}" {{ $intervention->validationIntervention ? '' : '' }}/>
                    </div>
                </div>
            </div> --}}
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="statut">Statut :</label>
                        <select class="form-select" name="statut" id="statut" {{ $intervention->validationIntervention ? '' : '' }}>
                            <option value="bon" {{ $intervention->statut === 'bon' ? 'selected' : '' }}>Bon</option>
                            <option value="mauvais" {{ $intervention->statut === 'mauvais' ? 'selected' : '' }}>Mauvais</option>
                        </select> 
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mt-4">
                        <input class="form-check-input" type="checkbox" id="validationIntervention" value="1"
                            name="validationIntervention">
                        <label class="form-check-label" for="validationIntervention" {{ $intervention->validationIntervention ? 'checked' : '' }}>
                            Validation intervention
                        </label>
                    </div>
                </div>
            </div>         
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>

    </div>

    </form>

    </div>


@endsection
