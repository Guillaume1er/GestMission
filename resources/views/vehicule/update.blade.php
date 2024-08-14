@extends('layouts.dashboard_sans_sta')

@section('content')
    <div class="card-body">
        <div class="header-title">
            <h4 class="card-title">Modifier le véhicule</h4>
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

        {{-- @php
            dump($vehicule);
        @endphp --}}

        <form method="POST" action="{{ route('update-vehicule', $vehicule->id) }}">
            @csrf

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="marque_id" class="form-label">Marque du vehicule</label>
                        <select class="form-select" required name="marque_id" id="marque_id" {{ $vehicule->autorisationSortie ? 'disabled' : '' }}>
                            <option value="">Sélectionner une marque</option>
                            @foreach ($marques as $marque)
                                <option value="{{ $marque->id }}" {{$marque->id ? 'selected' : ''}} >{{ $marque->marque }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="typeVehicule_id" class="form-label">Type de véhicule</label>
                        <select class="form-select" required name="typeVehicule_id" id="typeVehicule_id">
                            <option value="">Sélectionner un type de véhicule</option>
                            @foreach ($vehicules as $vehicule)
                                <option value="{{ $vehicule->id }}" {{$vehicule->id ? 'selected' : ''}}> {{ $vehicule->typeVehicule }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="dateAcquisition" class="form-label">Date d'acquisition du véhicule</label>
                        <input type="date" class="form-control" id="dateAcquisition" name="dateAcquisition" value="{{$vehicule->dateAcquisition}}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="immatriculation" class="form-label">Immatriculation</label>
                        <input type="text" class="form-control" id="immatriculation" name="immatriculation" value="{{$vehicule->immatriculation}}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="plaqueVehicule" class="form-label">Plaque du véhicule</label>
                        <input type="text" id="plaqueVehicule" required class="form-control" name="plaqueVehicule" value="{{$vehicule->plaqueVehicule}}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="kilometrageDepart" class="form-label">Kilométrage de départ (Km)</label>
                        <input type="number"  class="form-control" id="kilometrageDepart" name="kilometrageDepart" value="{{$vehicule->kilometrageDepart}}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="responsableVehicule" class="form-label">Responsable du véhicule</label>
                        <input type="text" required class="form-control" id="responsableVehicule"
                            name="responsableVehicule" value="{{$vehicule->responsableVehicule}}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="contactResponsable" class="form-label">Contact du responsable</label>
                        <input type="number" required class="form-control" id="contactResponsable"
                            name="contactResponsable" value="{{$vehicule->contactResponsable}}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="etatVehicule" class="form-label">Etat du véhicule</label>
                        <select class="form-select" required name="etatVehicule" id="etatVehicule">
                            <option value="Neuf" {{$vehicule->Neuf ? 'delected' : ''}}>Neuf</option>
                            <option value="Occasion" {{$vehicule->Occasion ? 'delected' : ''}}>Occasion</option>
                        </select>
                    </div>
                </div>
                {{-- <div class="col-lg-6">
                    <div class="mb-3">
                        <input class="form-check-input" type="checkbox" id="autorisationSortie" value="1"
                            name="autorisationSortie"> <label class="form-check-label" for="autorisationSortie">
                            Autorisation de sortie ?
                        </label>
                    </div>
                </div> --}}
            </div>

            <div class="row">
                  {{-- <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="dateAutorisation" class="form-label">Date d'autorisation du véhicule</label>
                        <input type="text" class="form-control" id="dateAutorisation" name="dateAutorisation">
                    </div> --}}
                </div>  
                <div class="col-lg-6" >
                    <div class="mb-3">
                        <input type="hidden" class="form-control"  value="{{ now() }}"
                            name="dateEnregistrementVehicule" >
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <input class="form-check-input" type="checkbox" id="vehiculePool" value="1"
                            name="vehiculePool" {{$vehicule->vehiculePool ? 'checked' : ''}}>
                        <label class="form-check-label" for="vehiculePool">
                            Véhicule Pool ?
                        </label>
                    </div>
                </div>
                {{-- <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="motifDesautorisation" class="form-label">Motif désautorisation</label>
                        <textarea class="form-control" id="motifDesautorisation" rows="4" name="motifDesautorisation"></textarea>
                    </div>
                </div> --}}
            </div> 

            {{-- <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="dateDesautorisation" class="form-label">Date désautorisation</label>
                        <input type="date" class="form-control" id="dateDesautorisation" name="dateDesautorisation">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="kilometrageActuel" class="form-label">Kilométrage actuelle</label>
                        <input type="number" class="form-control" id="kilometrageActuel" name="kilometrageActuel">
                    </div>
                </div>
            </div> --}}

            {{-- <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="kilometrageAlerte" class="form-label">Kilométrage alerte</label>
                        <input type="number" class="form-control" id="kilometrageAlerte" name="kilometrageAlerte">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="dateDerniereMission" class="form-label">Date de la dernière mission</label>
                        <input type="date" class="form-control" id="dateDerniereMission" name="dateDerniereMission">
                    </div>
                </div>
            </div> --}}

            <div class="text-end">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>

    </div>


@endsection
