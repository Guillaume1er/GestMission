@extends('layouts.dashboard_sans_sta')

@section('content')
<div class="card-body">
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
