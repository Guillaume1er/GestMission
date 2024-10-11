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
        <h4 class="card-title">Modifier l'exercice budbetaire</h4>
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

    <form method="POST" action="{{ route('update-exercice-budgetaire', $exercicebudgetaire->id) }}">
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="exerciceBudgetaire" class="form-label">Exercice budgetaire </label>
                    <input type="number" required class="form-control" name="exerciceBudgetaire" value="{{ $exercicebudgetaire->exerciceBudgetaire }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="nombreTotalMission" class="form-label">Nombre total de mission</label>
                    <input type="number" required class="form-control" name="nombreTotalMission" value="{{ $exercicebudgetaire->nombreTotalMission }}" />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <input class="form-check-input" type="checkbox" id="clotureExercice" value="1"
                        name="clotureExercice" {{ $exercicebudgetaire->clotureExercice ? 'checked' : '' }}>
                    <label class="form-check-label" for="clotureExercice">
                        Cloturer cet exercice
                    </label>
                </div>
            </div>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
    </form>

</div>


@endsection
