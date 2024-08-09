@extends('layouts.dashboard_sans_sta')

@section('content')
    <div class="card-body">
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

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="datePrevue" class="form-label">Date prévue</label>
                        <input class="form-control" type="date" name="datePrevue"
                            value="{{ $intervention->datePrevue }}" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="dateIntervention" class="form-label">Date intervention</label>
                        <input class="form-control" required type="date" name="dateIntervention"
                            value="{{ $intervention->dateIntervention }}" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="objetIntervention" class="form-label">L'objet de l'intervention</label>
                        <textarea class="form-control" required rows="4" name="objetIntervention">{{ $intervention->objetIntervention }}</textarea>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="kilometrageIntervention" class="form-label">Kilométrage de l'intervention</label>
                        <input class="form-control" required type="number" name="kilometrageIntervention"
                            value="{{ $intervention->kilometrageIntervention }}" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="pannesSurvenues" class="form-label">Pannes survenues</label>
                        <textarea class="form-control" required rows="4" name="pannesSurvenues">{{ $intervention->pannesSurvenues }}</textarea>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="reparationsEffectuees" class="form-label">Reparations effectuées</label>
                        <textarea class="form-control" required rows="4" name="reparationsEffectuees">{{ $intervention->reparationEffectue }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="coutGlobal" class="form-label">Coût global</label>
                        <input class="form-control" type="number" name="coutGlobal"
                            value="{{ $intervention->coutGlobal }}" />
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