@extends('layouts.dashboard_sans_sta')

@section('content')
    <div class="card-body">
        <div class="header-title">
            <h4 class="card-title">Ajouter un lieu mission</h4>
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

        <form method="POST" action="{{ route('create-lieu-mission') }}">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="departement" class="form-label">Département</label>
                        <select class="form-select" required name="departement_id" id="departement_id">
                            @foreach ($departements as $departement)
                                <option selected>Sélectionner un département</option>
                                <option value="{{ $departement->id }}">{{ $departement->departement }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="ville" class="form-label">Commune</label>
                        <select class="form-select" required name="ville_id" id="ville_id">
                            @foreach ($villes as $ville)
                                <option selected>Sélectionner une commune</option>
                                <option value="{{ $ville->id }}">{{ $ville->ville }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="distance" class="form-label">Distance</label>
                        <input class="form-control" type="number" name="distance" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <input class="form-check-input" type="checkbox" id="nuite" value="1" name="nuite">
                        <label class="form-check-label" for="nuite">
                            Nuité
                        </label>
                    </div>
                </div>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
        </form>

    </div>

    </div>
@endsection
